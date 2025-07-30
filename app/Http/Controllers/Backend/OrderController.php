<?php

namespace App\Http\Controllers\Backend;

use App\Country;
use App\FcmTokenModel;
use App\Http\Controllers\Controller;
use App\Notification;
use App\Order;
use App\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{


    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = Order::where('status','!=',0)->where('cash',0)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($artist) {
                    if($artist->status == 0){

                        return 'لم يتم الدفع بعد';
                    }
                    if($artist->status == 1){
                        return 'جاري الشحن';
                    }
                    if($artist->status == 2){
                        return 'تم الأستلام';
                    }
                })

                ->addColumn('created_at', function ($artist) {
                    if ($artist->created_at)
                        return Carbon::parse($artist->created_at)->format('Y-m-d');

                    return "";
                })
                ->addColumn('paid_by', function ($artist) {
                    if ($artist->cash == 1){
                        return "كاش";
                    }
                    if($artist->paid_by == 1){

                        return 'ماي فاتورة';
                    }
                    if($artist->paid_by == 2){
                        return 'تابي';
                    }
                })
                ->addColumn('action', function($row){
//                    <a class="btn btn-success"  href="'.route('countries.edit' , $row->id).'" id="edit-user" >Edit </a>
                    $action = '
                        <a class="btn btn-primary"
                         style="margin:5px"
                         href="'.route('order.items.view' , $row->id).'" id="edit-user" >'.\Lang::get('site.order_details').' </a>

                     ';

                    if($row->status == 1){
                    $action .='         <a class="btn btn-success"
                      style="margin:5px"
                    href="'.route('orders.received' , $row->id).'" id="edit-user" >'.\Lang::get('site.switch_received').' </a>';
                    }

                    if($row->status == 2){
                    $action .='         <a class="btn btn-dark"
                      style="margin:5px"
                     id="edit-user" >'.\Lang::get('site.received_done').' </a>';
                    }

                    $action .='
                        <a onclick="if(!confirm(\'Are You Sure ? \')) return false;"  href="'.url('orders/destroy' , $row->id).'" class="btn btn-danger">'.\Lang::get('site.delete').'</a>';

                    return $action;

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.orders.index');
    }


    public function today(Request $request)
    {
        if ($request->ajax()) {
            //dd('s');
            $data = Order::where('status','!=',0)->whereDate('created_at', Carbon::today())->orWhere(function ($qb){
                $qb->where('cash',1);
                $qb->whereDate('created_at', Carbon::today());
            })->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($artist) {
                    if($artist->status == 0){

                        return 'لم يتم الدفع بعد';
                    }
                    if($artist->status == 1){
                        return 'جاري الشحن';
                    }
                    if($artist->status == 2){
                        return 'تم الأستلام';
                    }
                })

                ->addColumn('created_at', function ($artist) {
                    if ($artist->created_at)
                        return Carbon::parse($artist->created_at)->format('Y-m-d');

                    return "";
                })
                ->addColumn('paid_by', function ($artist) {
                    if ($artist->cash == 1){
                        return "كاش";
                    }
                    if($artist->paid_by == 1){

                        return 'ماي فاتورة';
                    }
                    if($artist->paid_by == 2){
                        return 'تابي';
                    }
                })
                ->addColumn('action', function($row){
//                    <a class="btn btn-success"  href="'.route('countries.edit' , $row->id).'" id="edit-user" >Edit </a>
                    $action = '
                        <a class="btn btn-primary"
                         style="margin:5px"
                         href="'.route('order.items.view' , $row->id).'" id="edit-user" >'.\Lang::get('site.order_details').' </a>

                     ';

                    if($row->status == 1){
                        $action .='         <a class="btn btn-success"
                      style="margin:5px"
                    href="'.route('orders.received' , $row->id).'" id="edit-user" >'.\Lang::get('site.switch_received').' </a>';
                    }

                    if($row->status == 2){
                        $action .='         <a class="btn btn-dark"
                      style="margin:5px"
                     id="edit-user" >'.\Lang::get('site.received_done').' </a>';
                    }

                    $action .='
                        <a onclick="if(!confirm(\'Are You Sure ? \')) return false;"  href="'.url('orders/destroy' , $row->id).'" class="btn btn-danger">'.\Lang::get('site.delete').'</a>';
                    return $action;

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.orders.today');
    }

    public function cash(Request $request)
    {

        if ($request->ajax()) {
            $data = Order::where('cash','=',1)->orderBy('id','desc')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($artist) {
                    if($artist->status == 0){

                        return 'لم يتم الدفع بعد';
                    }
                    if($artist->status == 1){
                        return 'جاري الشحن';
                    }
                    if($artist->status == 2){
                        return 'تم الأستلام';
                    }

                    if($artist->status == 3){
                        return 'الدفع عند الاستلام';
                    }
                })
                ->addColumn('created_at', function ($artist) {
                    if ($artist->created_at)
                        return Carbon::parse($artist->created_at)->format('Y-m-d');

                    return "";
                })
                ->addColumn('action', function($row){
//                    <a class="btn btn-success"  href="'.route('countries.edit' , $row->id).'" id="edit-user" >Edit </a>
                    $action = '
                        <a class="btn btn-primary"
                         style="margin:5px"
                         href="'.route('order.items.view' , $row->id).'" id="edit-user" >'.\Lang::get('site.order_details').' </a>

                     ';

                    if($row->status == 1){
                        $action .='         <a class="btn btn-success"
                      style="margin:5px"
                    href="'.route('orders.received' , $row->id).'" id="edit-user" >'.\Lang::get('site.switch_received').' </a>';
                    }

                    if($row->status == 3){
                        $action .='         <a class="btn btn-success"
                      style="margin:5px"
                    href="'.route('orders.received' , $row->id).'" id="edit-user" >'.\Lang::get('site.switch_delivered').' </a>';
                    }

                    if($row->status == 2){
                        $action .='         <a class="btn btn-dark"
                      style="margin:5px"
                     id="edit-user" >'.\Lang::get('site.received_done').' </a>';
                    }



                    $action .='
                        <a onclick="if(!confirm(\'Are You Sure ? \')) return false;"  href="'.url('orders/destroy' , $row->id).'" class="btn btn-danger">'.\Lang::get('site.delete').'</a>';
                    return $action;

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.orders.cash');
    }

    public function not_paid(Request $request)
    {
        // dd('ok');
        // dd($data);
        if ($request->ajax()) {
            $data = Order::where('status',0)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($artist) {
                    if($artist->status == 0){

                        return 'غير مدفوع';
                    }
                    if($artist->status == 1){
                        return 'تم الدفع';
                    }
                    if($artist->status == 2){
                        return 'تم الأستلام';
                    }
                })
                ->addColumn('created_at', function ($artist) {
                    if ($artist->created_at)
                        return Carbon::parse($artist->created_at)->format('Y-m-d');

                    return "";
                })
                ->addColumn('action', function($row){
//                    <a class="btn btn-success"  href="'.route('countries.edit' , $row->id).'" id="edit-user" >Edit </a>
                    $action = '
                        <a class="btn btn-primary"
                         style="margin:5px"
                         href="'.route('order.items.view' , $row->id).'" id="edit-user" >'.\Lang::get('site.order_details').'  </a>

                     ';

                    $action .= '
                        <a class="btn btn-primary"
                         style="margin:5px"
                         onclick="confirm(\' هل متأكد من دفع الطلب \')"
                         href="'.route('order.paid' , $row->id).'" id="edit-user" >'.\Lang::get('site.paid_order').'  </a>

                     ';

                    if($row->status == 1){
                    $action .='         <a class="btn btn-success"
                      style="margin:5px"
                    href="'.route('orders.received' , $row->id).'" id="edit-user" >Recevied </a>';
                    }

                    $action .='
                        <a onclick="if(!confirm(\'Are You Sure ? \')) return false;"  href="'.url('orders/destroy' , $row->id).'" class="btn btn-danger">'.\Lang::get('site.delete').'</a>';

                    return $action;

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.orders.not_paid');
    }

    public function receive($order_id){

        $order = Order::find($order_id);

        if(!$order){
            Alert::error('Order Not Found' , '');

            return back();
        }

        if ($order->status == 3){
            $order->status = 1;
            if ($order->user){
                try{
                    $this->notificationUSER($order->user, $order);

                    if($order->user_id != null){
                        $FcmTokenModel= FcmTokenModel::where('user_id',$order->user_id)->first();
                        //dd($FcmTokenModel);
                        if (($FcmTokenModel && isset($FcmTokenModel->token ))){
                            self::save_notf($FcmTokenModel->token,
                                false ,'Order',$order->id ,1,$order,
                                $order->user_id);
                        }

                    }
                }catch (\Exception $e){

                }


            }
        }else{
            $order->status = 2;

            try{
                if($order->user_id != null){
                    $FcmTokenModel= FcmTokenModel::where('user_id',$order->user_id)->first();
                    //dd($FcmTokenModel);
                    if (($FcmTokenModel && isset($FcmTokenModel->token ))){
                        self::save_notf($FcmTokenModel->token,
                            false ,'Order',$order->id ,2,$order,
                            $order->user_id);
                    }

                }
            }catch (\Exception $e){

            }


        }



        $order->save();

        //TODO :: MAIL IS HERE

        // Mail::send('email.doneDelivery',['name' => $order->name,'address' => $order->address1,'invoice_id' => $order->invoice_id], function($message) use($order){
        //     $message->to($order->email)
        //         ->from('sales@easyshop-qa.com', 'Abati sakbah')
        //         ->subject('Pay done');
        // });


        Alert::success('Order updated Successfully !' , '');

        return back();
    }


    public function items( Request $request,$order_id){

        $order = Order::find($order_id);
        $items = OrderItem::where('order_id' , $order_id)->latest()->get();
        $brands=[];
        foreach($items as $item){
            if($item->product->brand){
                $brands[]=($item->product->brand)?
                $item->product->brand->{'name_' . app()->getLocale()} :"-";
            }

        }
        // dd($order);
        if(!$order){
            Alert::error('خطأ','الطلب غير موجود بالنظام ');
            return back();
        }

        if ($request->ajax()) {
            $data = OrderItem::where('order_id' , $order_id)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('product', function ($artist) {
                    return ($artist->product)?$artist->product->{'title_'. app()->getLocale()} :'' ;
                })
                ->addColumn('brand', function ($artist) {
                    return $artist->product->brand?$artist->product->brand->{'name_' . app()->getLocale()}:'' ;
                })
                ->addColumn('category', function ($artist) {
                    if($artist->product->basic_category){
                        $main_category=$artist->product->basic_category->{'name_' . app()->getLocale()};
                    }
                    else{
                        $main_category='';
                    }
                     if($artist->product->category){
                        $category=$artist->product->category->{'name_' . app()->getLocale()};
                    }
                    else{
                        $category='';
                    }
                    $val = '';
                    $val .= '( '.$main_category .' ) /';
                    $val .= ' ( '. $category  .' ) ';
                    return $val;

                })
                ->addColumn('image', function ($artist) {
                    $url = asset('/storage/' . $artist->product->img);
                    return $url;
                })
                ->addColumn('price', function ($artist) {
                    return $artist->product->price?:"";
                })
                ->addColumn('height', function ($artist) {
                    if ($artist->product->basic_category->type == 1) {
                        return "-";
                    }
                    else{
                    if(isset($artist->height->height)&&isset($artist->height->height->name)){

                        return $artist->height->height->name?:"";
                    }
                    else{
                        return "-";
                    }
                    }
                })
                ->addColumn('size', function ($artist) {
                    if ($artist->product->basic_category->type == 1) {
                        return "-";
                    }
                    else{

                    if(isset($artist->size->size) && isset($artist->size->size->name)){

                        return $artist->size->size->name?:"";
                    }
                    else{

                    return "-";
                    }                    }
                })
//                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.orders.view' , compact('order','brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $order = Order::find($id);
        if ($order){
            $order->is_deleted = 1;
            $order->save();
        }


        return back();

    }

    function notificationUSER($user,$order)
    {



        if ($user && $user->device_token){
            $SERVER_API_KEY = "AAAAQkEc80w:APA91bFGAI0nYJDlGN9Ch_iiEBZgfQihK-vVobnAGiZmRs-mOHKR4Lt_3rScqXye89vgQnJsFv3_dueKzTWl9wlpfVO-6FgHVfyRAWZty8Ds1iGmzY0hWiuvn60QjV8Q51-D1Obo8Zhz";

            $data = [
                "registration_ids" => [$user->device_token],
                "notification" => [
                    "title" => __('aliases.update-order',[],'ar') . ' ' . __('aliases.update-order',[],'en'),
                    "body" => __("aliases.status.$order->status",[],'ar') . ' ' . __("aliases.status.$order->status",[],'en') ,
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
            // dd($response);
        }


    }

/*static function save_notf($fcm_token , $is_all ,$type ,$type_id,$step=null,$type_model=null,$user_id_model=null){

        switch($type){
            case 'Order' :
                $title_ar=__('site.notifi_order_step'.$step.'_title',[],'ar');
                $body_ar=__('site.notifi_order_step'.$step.'_body',[],'ar');
                $title_en =__('site.notifi_order_step'.$step.'_title',[],'en');
                $body_en =__('site.notifi_order_step'.$step.'_body',[],'en');
                $image=null;
                $notifi=__('site.notifi_order_step'.$step.'_body',[],'ar') . ' ' . __('site.notifi_order_step'.$step.'_body',[],'en');
                break;
            case 'Product' :
                $title_ar=__('site.notifi_product_title',[],'ar');
                $body_ar=__('site.notifi_product_body',['productName'=>$type_model->name_ar],'ar');
                $title_en=__('site.notifi_product_title',[],'en');
                $body_en=__('site.notifi_product_body',['productName'=>$type_model->name_en],'en');
                $productNameAr=$type_model->title_ar;
                $productNameEn=$type_model->title_en ;
                $notifi=__('site.notifi_product_body',['productName'=>$productNameAr],'ar') . ' ' .__('site.notifi_product_body',['productName'=>$productNameEn],'en');
                $image=$type_model->img;
                break;
        }
        // dd($body_en);
        $app=__('site.app_name',[],'ar') . ' ' . __('site.app_name',[],'en');
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
            }else{
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
                'image'=>$image,
            ]);
            self::send_notf($user_token->token,$notifi,$app,$not);
        }
        else{
            $user_tokens=FcmTokenModel::get();
            $tokens = $user_tokens->whereNull('user_id')->pluck('token')->toArray();
            $user_ids = $user_tokens->whereNotNull('user_id')->pluck('user_id')->toArray();
            $not=  Notification::create([
                'fcm_token'=>$tokens,
                'user_id'=>$user_ids,
                'type'=>$type,
                'type_id'=>$type_id,
                'title_ar'=>$title_ar,
                'title_en'=>$title_en,
                'body_ar'=>$body_ar,
                'body_en'=>$body_en,
                'image'=>$image,
            ]);
            self::send_notf_array($tokens,$notifi,$app,$not);

        }

    }
    */
    public function payOrder($id){

        $order  = Order::find($id);

        $order->status = 1;

        $order->save();
        Alert::success('Order updated Successfully !' , '');

        return back();
    }
}
