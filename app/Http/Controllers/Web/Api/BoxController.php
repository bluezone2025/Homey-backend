<?php

namespace App\Http\Controllers\Web\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\BoxOrderRequest;
use App\Models\Box;
use App\Models\BoxOrder;
use App\Models\FcmTokenModel;
use App\Models\Info;
use App\Models\Notification;
use App\Models\ShippingAddress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Matrix\Exception;

class BoxController extends Controller
{
    public function __construct()
    {
        if(request()->header('auth-token')){

            $this->middleware('auth.guard:web-api');

        }else{
            $this->middleware('auth.guard:web-api')->except('index');
        }


    }

    public function index(){

        $boxes = Box::query();
        $boxes->where('quantity','>=',1);

        if (auth()->check()){
            $box_categories_that_user_buy_it = BoxOrder::where('status','paid')
                ->where('user_id',auth()->id())->pluck('box_category_id')->toArray();

            $buyed_boxes = BoxOrder::where('status','paid')
                ->where('user_id',auth()->id())->pluck('box_id')->toArray();

            if(count($box_categories_that_user_buy_it) > 0){
                $boxes->whereHas('boxCategory', function ($q)use($box_categories_that_user_buy_it){
                    $q->where('can_by_multiple',1)
                        ->orWhereNotIn('id',$box_categories_that_user_buy_it);
                });

                $boxes->whereNotIn('id',$buyed_boxes);

                $boxes = $boxes->orderBy('id','desc')->paginate(20);
            }else{
                $boxes = $boxes->orderBy('id','desc')->paginate(20);
            }
            //

        }else{
            $boxes = $boxes->orderBy('id','desc')->paginate(20);
        }

        return response([
            'status' => $boxes ? Response_Success : Response_Fail,
            'data'  => $boxes,
        ]);


    }

    public function getBox($box_id){

        $box = Box::where('id' , $box_id)
            ->select(['id' ,'title_ar','title_en','default_image','price', 'description_ar' , 'description_en','required_order','order_min_price','created_at'])
            ->with('images')->first();

        if(!$box){
            return  response([
                'status'      =>  Response_Fail,
                'data'        => __('api.errors.bo_notfound'),
            ]);
        }else{
            $data['box'] = $box;
        }




        return  response([
            'status'      => $data['box'] ? Response_Success : Response_Fail,
            'data'        => $data,
        ]);

    }


    public function save(Request $request){

        $validator = \Validator::make($request->all(), (new BoxOrderRequest())->rules());

        if ($validator->fails()) {

            return response([
                'status' => Response_Fail,
                'message' => $validator->errors()->all(),
            ]);
        }

        $user = auth()->user();

        $box = Box::find($request->get('box_id'));
        $box = BoxOrder::create([
            'box_id'    => $request->get('box_id'),
            'box_category_id'    => $box->box_category_id,
            'user_id'    => $user->id?? NULL,
            'total_price'   => $request->get('total_price'),
            'note'          => $request->get('note'),
            'status'        => "not_paid",
        ]);

        $box = BoxOrder::where('id',$box->id)
            ->with('shipping_address')
            ->with('box', function ($q){$q->with('images');})->first();


        return response([
            'status' => Response_Success,
            'box_order' => $box,
        ]);

    }

    public function savePayment(Request $request){

        $validator = \Validator::make($request->all(), [
            'order_id'  => 'required|exists:box_orders,id',
            'payment_method'  => 'required|in:knet',
            'invoice_id'  => 'required',
            'invoice_link'  => 'required',
            'status'        => 'required',
        ]);


        if ($validator->fails()) {

            return response([
                'status' => Response_Fail,
                'message' => $validator->errors()->all(),
            ]);
        }



        $order = BoxOrder::find($request->get('order_id'));

        $order->update([
            'payment_method'  =>    $request->get('payment_method'),
            'invoice_id'  =>    $request->get('invoice_id'),
            'invoice_link'  =>    $request->get('invoice_link'),
            'status'  =>    $request->get('status'),
            'admin_status'  =>    "paid",
        ]);

        $box = BoxOrder::where('id',$order->id)
            ->with('shipping_address')
            ->with('box', function ($q){$q->with('images');})->first();

        // update the quantity here
        $box2 =  Box::find($box->box_id);
        if ($box2){
            $box2->quantity = $box2->quantity - 1;
            $box2->save();
        }

        // New Notification Here

        //$this->notificationUSER(auth()->user(),$box);

        $FcmTokenModel= FcmTokenModel::where('user_id',$box->user_id)->first();
        if (($FcmTokenModel && isset($FcmTokenModel->token )) || $request->get('fcm_token')){

            // New Notification Here

            /*self::save_notf($FcmTokenModel->token??$request->get('fcm_token'),
                false ,'Box',$box->box->id ,1,$box->box,
                $box->user_id);*/
        }

        // add new session for user to send email
        session()->put("user_box_$box->id","user_box_$box->id");

        //dd(session()->get("user_box_$box->id"));
        return response([
            'status' => Response_Success,
            'box_order' => $box,
        ]);
    }


    public function addShippingForBoxOrder(Request $request){

        if ($request->get('shipping_address_id')){
            $validator = \Validator::make($request->all(), [
                'shipping_address_id' => ['nullable' , 'integer' , 'exists:shipping_addresses,id'],
            ]);
        }else{
            $validator = \Validator::make($request->all(), [
                'shipping_address_id' => ['nullable' , 'integer' , 'exists:shipping_addresses,id'],
                'area_id'  => ['required' , 'integer' , 'exists:areas,id'],
                'name'        => ['required' , 'string' , 'max:100'],
                'email'       => ['nullable' , 'email'  , 'max:255'],
                'phone'       => ['required' , 'string' , 'max:20'],
                'phone2'      => ['nullable' , 'string' , 'max:20'],
                'address'     => ['required' , 'string' , 'max:255'],
                'address_d'     => ['nullable' ,  'max:255'],
            ]);
        }




        if ($validator->fails()) {

            return response([
                'status' => Response_Fail,
                'message' => $validator->errors()->all(),
            ]);
        }


        $shipping_address_id = $request->get('shipping_address_id');


        if (!$shipping_address_id){
            $shipping_address = $this->saveShippingAddressId($request);
            $shipping_address_id = $shipping_address->id;
        }

        $order = BoxOrder::find($request->get('order_id'));

        $order->update([
            'shipping_address_id'   => $shipping_address_id,
        ]);

        $box = BoxOrder::where('id',$order->id)
            ->with('shipping_address')
            ->with('box', function ($q){$q->with('images');})->first();

        if ($box->shipping_address->email !=null){

            try{
                $data['invoice']=$order;
                $data["email"]=$box->shipping_address->email ;

                $from=env('MAIL_FROM_ADDRESS');
                $data["subject"]= 'Box Order';

                \Mail::send('emails.boxStore', $data, function ($message) use ($data, $from) {
                    $message->from($from)->to($data["email"], $data["email"] )
                        ->subject($data["subject"]);
                });
            }catch (\Exception $e){


            }

        }


        try{
            $data['invoice']=$order;
            $from=env('MAIL_FROM_ADDRESS');
            \Mail::send('emails.boxStore', $data, function ($message) use ($data, $from) {
                $message->from($from)->to("bdinarkd@gmail.com","bdinarkd@gmail.com")
                    ->subject("New Box Order");
            });
        }catch (Exception $e){

        }


        return response([
            'status' => Response_Success,
            'box_order' => $box,
        ]);

    }


    private function saveShippingAddressId($request)
    {

        return ShippingAddress::create([

            'title' => $request->title ?? Carbon::now()->format('Y-m-d'),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'phone2' => $request->phone2,
            'area_id' => $request->area_id,
            'region' => $request->region,
            'piece' => $request->piece,
            'avenue' => $request->avenue,
            'street' => $request->street,
            'flat_number' => $request->flat_number,
            'house_number' => $request->house_number,
            'floor' => $request->floor,
            'address' => $request->address,
            'note' => $request->note,
            'lat_and_long' => $request->lat_and_long,
            'user_id' => auth()->id(),
        ]);
    }


    public function getOrders()
    {

        $orders = auth()->user()
            ->boxOrders()->where('status','paid')->with('shipping_address')
                ->with('box', function ($q){$q->with('images');})->withTrashed()->orderBy('id', 'desc')
            ->get();

        return response([
            'status' => count($orders) > 0 ? Response_Success : Response_Fail,
            'orders' => $orders,
        ]);
    }

    public function getOrder()
    {

        $order = BoxOrder::where('id', \request()->id)
            ->with(['box'=> function($q){
                $q->with('galleries');
            }, 'shipping_address'])->withTrashed()
            ->first();

        return response([
            'status' => $order ? Response_Success : Response_Fail,
            'order' => $order,
        ]);
    }

    function notificationUSER($user,$box)
    {



        if ($user){
            $SERVER_API_KEY = "AAAAQkEc80w:APA91bFGAI0nYJDlGN9Ch_iiEBZgfQihK-vVobnAGiZmRs-mOHKR4Lt_3rScqXye89vgQnJsFv3_dueKzTWl9wlpfVO-6FgHVfyRAWZty8Ds1iGmzY0hWiuvn60QjV8Q51-D1Obo8Zhz";


            $data = [
                "registration_ids" => [$user->device_token],
                "notification" => [
                    "title" => 'box notification',
                    "body" => __("aliases.status_box.$box->status"),
                    "sound" => "default" // required for sound on ios
                ],
            ];
            $dataString = json_encode($data);
            $headers = [
                'Authorization: key=' . $SERVER_API_KEY,
                'Content-Type: application/json',
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
            $response = curl_exec($ch);

            \Log::info($response);
            //dd($response);
        }


    }

    static function save_notf($fcm_token , $is_all ,$type ,$type_id,$step=null,$type_model=null,$user_id_model=null){

        switch($type){
            case 'Order' :
                $title_ar=__('site.notifi_order_step'.$step.'_title',[],'ar');
                $body_ar=__('site.notifi_order_step'.$step.'_body',[],'ar');
                $title_en =__('site.notifi_order_step'.$step.'_title',[],'en');
                $body_en =__('site.notifi_order_step'.$step.'_body',[],'en');
                $image=null;
                $notifi=__('site.notifi_order_step'.$step.'_body');
                break;
            case 'Product' :
                $title_ar=__('site.notifi_product_title',[],'ar');
                $body_ar=__('site.notifi_product_body',['productName'=>$type_model->name_ar],'ar');
                $title_en=__('site.notifi_product_title',[],'en');
                $body_en=__('site.notifi_product_body',['productName'=>$type_model->name_en],'en');
                $productName=app()->getLocale()== 'ar'? $type_model->name_ar:$type_model->name_en ;
                $notifi=__('site.notifi_product_body',['productName'=>$productName]);
                $image=$type_model->img;
                break;
            case 'Info' :
                if($type_model != null && $step==1){
                    if($type_model->type_discount == "price"){
                        $descount_ar= $type_model->discount .' '. __('site.KWD',[],'ar');
                        $descount_en= $type_model->discount .' '. __('site.KWD',[],'en');
                    }else{
                        $descount_ar= $type_model->discount .' %';
                        $descount_en= $type_model->discount .' %';
                    }
                    $title_ar=__('site.notifi_copoun_des_title',[],'ar');
                    $body_ar=__('site.notifi_copoun_des_body',['descount'=>$descount_ar,'code'=>$type_model->code],'ar');
                    $title_en=__('site.notifi_copoun_des_title',[],'en');
                    $body_en=__('site.notifi_copoun_des_body',['descount'=>$descount_en,'code'=>$type_model->code],'en');
                    $descount=app()->getLocale()== 'ar'? $descount_ar:$descount_en ;
                    $notifi=__('site.notifi_copoun_des_body',['descount'=>$descount,'code'=>$type_model->code]);
                    $image=null;
                }elseif($step==2){
                    $imgName = null;
                    $img = $type_model->file('img');
                    if ($img) {
                        $imgName = time().$img->getClientOriginalExtension();
                        $img->move(public_path('assets/images/notifications') , $imgName);
                    }
                    $title_ar=$type_model->title_ar;
                    $body_ar=$type_model->note_ar;
                    $title_en=$type_model->title_en;
                    $body_en=$type_model->note_en;
                    $notifi= $type_model->note_ar;
                    $image=$imgName;
                }

                break;
            case 'Box' :

                $title_ar=$type_model->title_ar;
                $body_ar=$type_model->description_ar;
                $title_en=$type_model->title_en;
                $body_en=$type_model->description_en;
                $image=null;
                $notifi=__('site.notifi_box_step'.$step.'_body');
                break;
        }
        // dd($body_en);
        $app=__('site.app_name');
        if(!$is_all){
            $user_token=FcmTokenModel::where('token',$fcm_token)->first();


            if(!$user_token){
                if($user_id_model){
                    $user_token=FcmTokenModel::where('user_id',$user_id_model)->first();
                    if($user_token){
                        if($user_token->token != $fcm_token && $fcm_token != null ){
                            $user_token->token = $fcm_token;
                            $user_token->save();
                        }
                    }else{
                        $user_token=   FcmTokenModel::create([
                            'token'=>$fcm_token,
                            'user_id'=>$user_id_model,
                        ]);
                    }
                }else{
                    // dd('$user_id_model');
                    $user_token=    FcmTokenModel::create([
                        'token'=>$fcm_token,
                    ]);
                }
            }


            if($user_token->user_id == null){
                $token=[$user_token->token];
                $user_id=[];
            }
            else{
                // dd($user_token->user_id);
                $token=[];
                $user_id=[$user_id_model];
            }


            //$token($fcm_token->token);
            $not= Notification::create([
                'fcm_token'=>$token,
                'user_id'=>$user_id,
                'type'=>$type,
                'type_id'=>$type_id,
                'title_ar'=>$title_ar,
                'title_en'=>$title_en,
                'body_ar'=>$body_ar,
                'body_en'=>$body_en,
                'image'=>NULL,
            ]);
            self::send_notf($user_token->token,$notifi,$app,$not);
        }



    }
}
