<?php

namespace App\Http\Controllers\Api;

use App\FcmTokenModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderRequest;
use App\City;
use App\Coupon;
use App\Notification;
use App\Option;
use App\OptionValue;
use App\Order;
use App\Product;
use App\ProductOrder;
use App\Settings;

use App\BestSeller;
use App\OrderItem;
use App\ProdHeight;
use App\ProdSize;
use App\User;
use App\View;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use function Symfony\Component\Translation\t;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    private $order_price = 0;
    private $products_count = 0;
    private $unique_id;
    private $student_id = null;
    private $product_regular_price = 0;
    private $product_sale_price = 0;
    private $options = [];
    private $optionValueWanted = [];

    public function __construct()
    {
        $this->middleware('auth.guard:web-api')->except(['save','getOrder','saveCash','getDelivery','addLinkOrder','payment_callback','successPayment']);

        if(request()->header('auth-token')){

            $this->middleware('auth.guard:web-api')->only(['callAPI','getPaymentStatus','save','getDelivery','addLinkOrder','payment_callback','successPayment']);

        }
    }
    public function getOrders()
    {

        $orders = auth()->user()
            ->orders()
            ->with('products')
            ->get();

        return response([
            'status' => count($orders) > 0 ? Response_Success : Response_Fail,
            'orders' => $orders,
        ]);
    }
    public function getOrder()
    {

        $order = Order::where('id', \request()->id)
            ->with(['order_items'])
            ->first();

        return response([
            'status' => $order ? Response_Success : Response_Fail,
            'order' => $order,
        ]);
    }

    public function getDelivery(Request $request)
    {
        //        dd($request->all());
        $city_id = $request->city;

        if (!$city_id) {
            return response()->json([
                'success' => Response_Fail,
                'msg' => 'Please Choose City  !!'
            ]);
        }
        $city = City::find($city_id);

        if (!$city) {
            return response()->json([
                'success' => Response_Fail,
                'msg' => 'Can not find City  !!'
            ]);
        }
        $delivery = $city->delivery_period;

        $is_free_shop=Settings::first()->is_free_shop;
        if($is_free_shop==1){
            return response()->json([
                'success' => Response_Success,
                'ship' => __('site.text_free_shopping'),
                'value' => 0,
                'delivery' => $delivery
            ]);
        }

        //---------------------TRANSLATE  -----------------//
        if( $city->country_id != 1){

            $totalQty = $request->totalQty;
            $count_q=$totalQty-1;
            $pric_de_for_first=Settings::first()->international_shipping;
            $pric_de_for_sec=Settings::first()->international_shipping_2;
            $val=($pric_de_for_sec*$count_q)+$pric_de_for_first;

        }else{
            $val=$city->delivery;
        }




        return response()->json([
            'success' => Response_Success,
            'value' => $val,
            'delivery' => $delivery
        ]);
        //        }

    }

    public function save(Request $request)
    {

        //ORDER STORE
        $messeges = [

            'name.required' => "اسم العميل مطلوب",
            'email.required' => "البريد الإلكتروني للعميل مطلوب",
            'email.email' => "يرجي كتابة البريد الالكتروني بشكل صحيح",
            'country_id.required' => "يرجي إختيار الدوله",
            'city_id.required' => "يرجي إختيار المدينه",
            'phone.required' => "يرجي إدخال رقم الهاتف",
            'phone.max' => "رقم الهاتف يجب ألا يزيد عن 11 رقم",
            'phone.min' => "رقم الهاتف يجب ألا يقل عن 3 أرقام",
            'the_plot.required' => "يرجي ادخال المنطقة",
            'region.required' => " يرجي اختيار المنطقة",
            'the_street.required' => "يرجي ادخال اسم او رقم الشارع",
            'building_number.required' => "يرجي ادخال رقم المبني",
            'delivered_by.required' => " نوع التوصيل مطلوب ",
            //            'postal_code.required' => "يرجي إدخال الرمز البريدي",

            //            'postal_code.required' => "يرجي إدخال الرمز البريدي",

        ];

        $validator = Validator::make($request->all(), [

            'name' => ['required'],

            // 'email' => ['required', 'email'],

            'country_id' => ['required'],

            'city_id' => ['required'],
            'delivered_by' => ['required'],

            'phone' => ['required', 'max:11', 'min:3'],
            'owner_phone' => ['nullable'],

            'the_plot' => ['nullable'],
            'region' => ['nullable'],
            'the_street' => ['nullable'],
            'building_number' => ['nullable'],

            //            'postal_code' => ['required'],

        ], $messeges);

        // if($request->name != 'mo-dev'){

        //     return response([
        //         'status' => Response_Fail,
        //         'message' => 'حدث مشكلة ماا يرجي المحاوله لاحقاُ او الطلب من خلال الموقع الرسمي : https://rayan-storee.com/ar ',
        //     ]);
        // }
        if ($validator->fails()) {

            return response([
                'status' => Response_Fail,
                'message' => $validator->errors()->all(),
            ]);
        }

        if ($request->email == null) {
            $request->merge(['email' => 'no@gmail.com']);
        }


        $city = City::find($request['city_id']);

        $products_id = explode(',', $request->products_id);

        // $quantity_products = json_decode($request->quantity_products);
//        $optionValue_products = json_decode( $request->optionValue_products);
        // dd($optionValue_products);

        $products = Product::whereIn('id', $products_id)->get(); // get request products

        if ($products->count() == 0) {

            return response([
                'status' => Response_Fail,
                'message' => 'prodect Not Found' ,
            ]);
        }


        $variation = str_replace("+", "", $request['phone']);
        $variation2 = str_replace("-", "", $variation);
        $is_free_shop=Settings::first()->is_free_shop;

        $totalQty=0;
        $totalPrice=0;


        $optionValue_products = $request->optionValue_products;

// decode if it is a JSON string
        if (is_string($optionValue_products)) {
            $optionValue_products = json_decode($optionValue_products, true);
        }


        if (!is_array($optionValue_products)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid format for optionValue_products',
            ], 422);
        }

        $index=0;




        $keys=[];
        $items=[];
        $flag_arrays=[];

        foreach($optionValue_products as $key=> $item){

            $keys[]=$key;
            $items[]=$item;

            $pro=Product::find($key);
            if(!$pro)
            {
                return response([
                    'status' => Response_Fail,
                    'message' => 'error in product height key product not found',
                ]);
            }
            if (is_array($item[0]) && isset($item[0][0])) {
                // 🔁 Case 1: This is a nested array (multiple options for one product)
                $flag_arrays[]= "Multiple option sets";

                foreach ($item as $i){
                    $cat_type=$pro->basic_category->type;
                    if($cat_type == 1)
                    {
                        $height = ProdHeight::where("product_id",$key)->where('height_id',0)->first();
                    }
                    else
                    {

                        $height = ProdHeight::find($i[0]['height']);
                        if (!$height){
                            $msg = ' المنتج ';
                            $msg .= Product::find($key)->title;
                            $msg .=  'ليس له المقاس  رقم';
                            $msg .=  $i[0]['height'];
                            $msg .=  ' مع الحجم رقم';
                            $msg .=  $i[1]['size'];
                            $msg .=  '    يرجي اختبار مقاسات صحيحة';
                            return response([
                                'status' => Response_Fail,
                                'message' => $msg,
                            ]);
                        }
                    }
                    if($i[3]['is_reception']==1){
                        $totalQty= $totalQty+$i[2]['quantity'];
                        $totalPrice= $totalPrice + ($pro->price *$i[2]['quantity']);

                    }
                    else{
                        if ($height->quantity < $i[2]['quantity']) {
                            $msg = ' المنتج ';
                            $msg .= Product::find($key)->title;
                            $msg .=  ' لا يتوفر منه العدد المطلوب في المقاس ';
                            $msg .=  (ProdHeight::find($i[0]['height']) &&ProdHeight::find($i[0]['height'])->height)?
                            ProdHeight::find($i[0]['height'])->height->name:"رقم".$i[0]['height'];
                            $msg .=  ' مع الحجم ';
                            $msg .=  ( ProdSize::find($i[1]['size']) &&  ProdSize::find($i[1]['size'])->size)?
                            ProdSize::find($i[1]['size'])->size->name:"رقم".$i[1]['size'];
                            $msg .=  '    يرجي اختبار مقاسات اخري';
                            return response([
                                'status' => Response_Fail,
                                'message' => $msg,
                            ]);

                        }
                        else
                        {
                            $totalQty= $totalQty+$i[2]['quantity'];
                            $totalPrice= $totalPrice + ($pro->price *$i[2]['quantity']);
                        }
                    }
                }
            }
            elseif (is_array($item[0])) {
                // ✅ Case 2: This is a flat array (single option set)
                $flag_arrays[]=  "Single option set";

                $cat_type=$pro->basic_category->type;
                if($cat_type == 1)
                {
                    $height = ProdHeight::where("product_id",$key)->where('height_id',0)->first();
                }
                else
                {

                    $height = ProdHeight::find($item[0]['height']);
                    if (!$height){
                        $msg = ' المنتج ';
                        $msg .= Product::find($key)->title;
                        $msg .=  'ليس له المقاس  رقم';
                        $msg .=  $item[0]['height'];
                        $msg .=  ' مع الحجم رقم';
                        $msg .=  $item[1]['size'];
                        $msg .=  '    يرجي اختبار مقاسات صحيحة';
                        return response([
                            'status' => Response_Fail,
                            'message' => $msg,
                        ]);
                    }
                }
                if($item[3]['is_reception']==1){
                    $totalQty= $totalQty+$item[2]['quantity'];
                    $totalPrice= $totalPrice + ($pro->price *$item[2]['quantity']);

                }
                else{
                    if ($height->quantity < $item[2]['quantity']) {
                        $msg = ' المنتج ';
                        $msg .= Product::find($key)->title;
                        $msg .=  ' لا يتوفر منه العدد المطلوب في المقاس ';
                        $msg .=  (ProdHeight::find($item[0]['height']) && ProdHeight::find($item[0]['height'])->height)?
                        ProdHeight::find($item[0]['height'])->height->name:'رقم '.$item[0]['height'];
                        $msg .=  ' مع الحجم ';
                        $msg .= (ProdSize::find($item[1]['size'])&& ProdSize::find($item[1]['size'])->size)?
                         ProdSize::find($item[1]['size'])->size->name:'رقم '.$item[1]['size'];
                        $msg .=  '    يرجي اختبار مقاسات اخري';
                        return response([
                            'status' => Response_Fail,
                            'message' => $msg,
                        ]);

                    }
                    else
                    {
                        $totalQty= $totalQty+$item[2]['quantity'];
                        $totalPrice= $totalPrice + ($pro->price *$item[2]['quantity']);
                    }
                }
            }
            else {
                $flag_arrays[]=  "Invalid structure";
            }



        }

//        return response([
//            'status' => Response_Fail,
//            'keys' => $keys,
//            'items' => $items,
//            'flag_arrays'=>$flag_arrays,
//
//        ]);
        $des=0;
        if($request->coupon_code){
            $coupon = Coupon::where('code' , \request('coupon_code'))->first();
            if($coupon){
                $des=($coupon ->percentage/100) * $totalPrice;

            }
        }
        if($is_free_shop != 1){
            if( $city->country_id != 1){
                //  $totalQty = $request->totalQty;
                $count_q=$totalQty-1;
                $pric_de_for_first=Settings::first()->international_shipping;
                $pric_de_for_sec=Settings::first()->international_shipping_2;
                $v_q=($pric_de_for_sec*$count_q)+$pric_de_for_first;

                if (Settings::first()->is_tabby_active){
                    $total_price = $totalPrice + $v_q - $des;

                    $tabby_fixed_amount_total = $total_price * 7 / 100;

                }else{
                    $tabby_fixed_amount_total = 0;
                }

                $request->merge([
                    'total_price' => $totalPrice + $v_q - $des,
                    'total_quantity' => $totalQty,
                    'phone' => $variation2,
                    'tabby_amount'  => $tabby_fixed_amount_total
                ]);

            }else{
                if (Settings::first()->is_tabby_active){
                    $total_price = $totalPrice + $city->delivery - $des;

                    $tabby_fixed_amount_total = $total_price * 7 / 100;

                }else{
                    $tabby_fixed_amount_total = 0;
                }
                $request->merge([
                    'total_price' => $totalPrice + $city->delivery - $des,
                    'total_quantity' => $totalQty,
                    'phone' => $variation2,
                    'tabby_amount'  => $tabby_fixed_amount_total
                ]);

            }

        }else {

            if (Settings::first()->is_tabby_active){
                $total_price = $totalPrice  - $des;

                $tabby_fixed_amount_total = $total_price * 7 / 100;

            }else{
                $tabby_fixed_amount_total = 0;
            }

            $request->merge([
                'total_price' => $totalPrice  - $des,
                'total_quantity' => $totalQty,
                'phone' => $variation2,
                'tabby_amount'  => $tabby_fixed_amount_total
            ]);
        }
        //   dd(auth()->id());
        if(request()->header('auth-token')){
            $request->merge([
                'user_id'=>auth()->id(),
            ]);
        }

        $order = Order::create($request->except('_token'));

        if (!$order) {
            return response([
                'status' => Response_Fail,
                'message' => 'Order Not Completed an error occur ',
            ]);
        }
        ($request->delivery_time_id)?$order->delivery_time_id=$request->delivery_time_id
            :$order->delivery_time_id=null;
        $order->address1=null;
        $order->save();





        foreach($optionValue_products as $key=> $item){

            if (is_array($item[0]) && isset($item[0][0])) {
                // 🔁 Case 1: This is a nested array (multiple options for one product)
               foreach ($item as $i){
                   if($i[3]['is_reception']==1){
                       $c=count($i[4]['booking_date']);
                       foreach ($i[4]['booking_date'] as $one){
                           OrderItem::create([
                               'order_id'=>$order->id ,
                               'product_id'=>$key ,
                               'product_height_id'=>$i[0]['height'] ,
                               'product_size_id'=>$i[1]['size'] ,
                               'quantity'=>$i[2]['quantity']/$c,
                               'booking_date'=>$one,


                           ]);}




                   }
                   else{
                       OrderItem::create([
                           'order_id'=>$order->id ,
                           'product_id'=>$key ,
                           'product_height_id'=>$i[0]['height'] ,
                           'product_size_id'=>$i[1]['size'] ,
                           'quantity'=>$i[2]['quantity'],
                           'booking_date'=>null,
                       ]);
                   }

                    $product=Product::find($key);
                    $category_type=$product->basic_category->type;
                    if($category_type == 1)
                    {
                        $prod_height = ProdHeight::where("product_id",$key)->where('height_id',0)->first();
                    }
                    else
                    {
                          $prod_height = ProdHeight::find($i[0]['height']);
                    }
                    $newQuantity=$prod_height->quantity - $i[2]['quantity'];

                    $prod_height=$prod_height->update([
                        'quantity'=>$newQuantity,
                    ]);
                   
               }
            }
            elseif (is_array($item[0])) {
                // ✅ Case 2: This is a flat array (single option set)
                if($item[3]['is_reception']==1){
                    $c=count($item[4]['booking_date']);
                    foreach ($item[4]['booking_date'] as $one){
                        OrderItem::create([
                            'order_id'=>$order->id ,
                            'product_id'=>$key ,
                            'product_height_id'=>$item[0]['height'] ,
                            'product_size_id'=>$item[1]['size'] ,
                            'quantity'=>$item[2]['quantity']/$c,
                            'booking_date'=>$one,


                        ]);}


                }
                else{
                    OrderItem::create([
                        'order_id'=>$order->id ,
                        'product_id'=>$key ,
                        'product_height_id'=>$item[0]['height'] ,
                        'product_size_id'=>$item[1]['size'] ,
                        'quantity'=>$item[2]['quantity'],
                        'booking_date'=>null,
                    ]);




                }

                $product=Product::find($key);
                $category_type=$product->basic_category->type;
                if($category_type == 1)
                {
                    $prod_height = ProdHeight::where("product_id",$key)->where('height_id',0)->first();
                }
                else
                {
                        $prod_height = ProdHeight::find($item[0]['height']);
                }
                $newQuantity=$prod_height->quantity - $item[2]['quantity'];

                $prod_height=$prod_height->update([
                    'quantity'=>$newQuantity,
                ]);
            }


            $b = BestSeller::where([
                'product_id' => $key
            ])->first();

            if (!$b) {
                $be = new BestSeller();
                $be->product_id = $key;
                $be->rate = 1;
                $be->save();
            } else {
                $b->rate = $b->rate + 1;
                $b->save();
            }

            BestSeller::firstOrCreate([
                'product_id' =>$key
            ])->touch();
        }

        $order = Order::whereId($order->id)->with('country','city','order_items')->first();







        return response([
            'status' => Response_Success,
            'order' => $order,
        ]);





        // return response([
        //     'status' => Response_Success,
        //     'order' => $order,
        // ]);

        //end order
    }

    function sanitizeEmail($email, $fallback = 'support@arkan-q8.com') {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return $fallback;

        $domain = explode('@', $email)[1] ?? '';
        if (!checkdnsrr($domain, 'MX')) return $fallback;

        return $email;
    }



    public function successPayment($order_id){
        $order = Order::find($order_id);

        $order->paid_by = 2;
        $order->status = 1;

        $order->save();

        $order_obj = Order::whereId($order->id)->with('country','city','order_items')->first();

        $data['username']=$order->name;
        $data['order_id']=$order->id;
        $data["email"]=$order->email;
        $data['order']=$order_obj;
        $from=env('MAIL_FROM_ADDRESS');
        $data["subject"]= 'شكراً لطلبك من أركان – رقم الطلب '. $order->id;

        $data["email"] = $this->sanitizeEmail($order->email);

        try {
            Mail::send('emails.orderStoreUser', $data, function ($message) use ($data, $from) {
                $message->from($from)->to($data["email"], $data["email"] )
                    ->subject($data["subject"]);
            });
        } catch (\Exception $e) {

            return response([
                'status' => Response_Fail,
                'message' => "Mail error: " . $e->getMessage(),
            ]);

        }



        $data["subject"]= 'تنبيه: تم استلام طلب جديد – رقم الطلب '. $order->id;


        $admins = User::where('job_id' , 1)->latest()->get();
        foreach ($admins as $admin){
            $data["email"] = $this->sanitizeEmail($admin->email);


            try {
                Mail::send('emails.orderStoreAdmin', $data, function ($message) use ($data, $from) {
                    $message->from($from)->to($data["email"], $data["email"] )
                        ->subject($data["subject"]);
                });
            } catch (\Exception $e) {

                return response([
                    'status' => Response_Fail,
                    'message' => "Mail error: " . $e->getMessage(),
                ]);

            }

        }


        foreach ($order->order_items as $item){
            $pro=Product::findOrFail($item->product_id);

            if($pro){
                if($pro->brand){
                    $brand_name=$pro->brand->name_ar;
                    $brand_email=$pro->brand->email;
                    $data['brand_name']=$brand_name;
                    $data['order_id']=$order->id;
                    $from=env('MAIL_FROM_ADDRESS');
                    $data["subject"]= 'طلب جديد من تطبيق اركان – رقم الطلب '. $order->id;
                    $data["email"]=$brand_email;
                    $data['order']=$order_obj;
                    $data['product_name']=$pro->title_ar;
                    $data['product_quantity']=$item->quantity;
                    $data["email"] = $this->sanitizeEmail($brand_email);

                    Mail::send('emails.orderStoreBrand', $data, function ($message) use ($data, $from) {
                        $message->from($from)->to($data["email"], $data["email"] )
                            ->subject($data["subject"]);
                    });
                }


            }
        }

//        try{
//            if($order->email !=null){
//                //   invoice
//                $data['invoice']=$order;
//                $data["email"]=$order->email;
//                $from=env('MAIL_FROM_ADDRESS');
//                $data["subject"]= 'order';
//
//                Mail::send('emails.orderStore', $data, function ($message) use ($data, $from) {
//                    $message->from($from)->to($data["email"], $data["email"] )
//                        ->subject($data["subject"]);
//                });
//            }
//        }catch (\Exception $e){
//
//        }



        return response([
            'status' => Response_Success,
            'order' => $order,
        ]);

    }


    public function saveCash(Request $request)
    {

        $id = $request->get('order_id');
        $fcm_token = $request->get('fcm_token',null);
        $order  = Order::find($id);
        if($order)
        {
            $order->status = 3;
            $order->cash = 1;
            $order->save();

            $order_obj = Order::whereId($order->id)->with('country','city','order_items')->first();

            $data['username']=$order->name;
            $data['order_id']=$order->id;
            $data["email"]=$order->email;
            $data['order']=$order_obj;
            $from=env('MAIL_FROM_ADDRESS');
            $data["subject"]= 'شكراً لطلبك من أركان – رقم الطلب '. $order->id;

            $data["email"] = $this->sanitizeEmail($order->email);

            try {
                Mail::send('emails.orderStoreUser', $data, function ($message) use ($data, $from) {
                    $message->from($from)->to($data["email"], $data["email"] )
                        ->subject($data["subject"]);
                });
            } catch (\Exception $e) {

                return response([
                    'status' => Response_Fail,
                    'message' => "Mail error: " . $e->getMessage(),
                ]);

            }



            $data["subject"]= 'تنبيه: تم استلام طلب جديد – رقم الطلب '. $order->id;


            $admins = User::where('job_id' , 1)->latest()->get();
            foreach ($admins as $admin){
                $data["email"] = $this->sanitizeEmail($admin->email);


                try {
                    Mail::send('emails.orderStoreAdmin', $data, function ($message) use ($data, $from) {
                        $message->from($from)->to($data["email"], $data["email"] )
                            ->subject($data["subject"]);
                    });
                } catch (\Exception $e) {

                    return response([
                        'status' => Response_Fail,
                        'message' => "Mail error: " . $e->getMessage(),
                    ]);

                }

            }


            foreach ($order->order_items as $item){
                $pro=Product::findOrFail($item->product_id);

                if($pro){
                    if($pro->brand){
                        $brand_name=$pro->brand->name_ar;
                        $brand_email=$pro->brand->email;
                        $data['brand_name']=$brand_name;
                        $data['order_id']=$order->id;
                        $from=env('MAIL_FROM_ADDRESS');
                        $data["subject"]= 'طلب جديد من تطبيق اركان – رقم الطلب '. $order->id;
                        $data["email"]=$brand_email;
                        $data['order']=$order_obj;
                        $data['product_name']=$pro->title_ar;
                        $data['product_quantity']=$item->quantity;
                        $data["email"] = $this->sanitizeEmail($brand_email);

                        Mail::send('emails.orderStoreBrand', $data, function ($message) use ($data, $from) {
                            $message->from($from)->to($data["email"], $data["email"] )
                                ->subject($data["subject"]);
                        });
                    }


                }
            }

//            if ($order->email){
//                //   invoice
//                $data['invoice']=$order;
//                $data["email"]=$order->email;
//                $from=env('MAIL_FROM_ADDRESS');
//                $data["subject"]= 'order';
//
//                try{
//                    Mail::send('emails.orderStore', $data, function ($message) use ($data, $from) {
//                        $message->from($from)->to($data["email"], $data["email"] )
//                            ->subject($data["subject"]);
//                    });
//                    /*if ($order->user){
//                        $this->notificationUSER($order->user, $order);
//
//                        if($order->user_id != null){
//                            $FcmTokenModel= FcmTokenModel::where('user_id',$order->user_id)->first();
//
//                            //dd($FcmTokenModel);
//                            if (($FcmTokenModel && isset($FcmTokenModel->token )) || $fcm_token){
//                                self::save_notf($FcmTokenModel->token??$fcm_token,
//                                    false ,'Order',$order->id ,3,$order,
//                                    $order->user_id);
//                            }
//
//                        }
//
//
//                    }*/
//
//                }catch (\Exception $e){
//                }
//            }

        return response([
            'status' => Response_Success ,
            'order' => $order,
        ]);
        }

      else{
          return response([
            'status' => Response_Fail ,
            'msg' => 'order not found',
        ]);
      }

    }

    public function addLinkOrder(Request $request ,$id)
    {

        $order = Order::whereId($id)->first();
        $fcm_token = $request->get('fcm_token',null);
        if($order){
            $order->invoice_link= $request ->invoice_link;
            $order->invoice_id= $request ->invoice_id;
            $order->save();


            try{
                if ($order->user){
                    $this->notificationUSER($order->user, $order);

                    if($order->user_id != null){
                        $FcmTokenModel= FcmTokenModel::where('user_id',$order->user_id)->first();
                        //dd($FcmTokenModel);
                        if (($FcmTokenModel && isset($FcmTokenModel->token )) || $fcm_token){
                            self::save_notf($FcmTokenModel->token??$fcm_token,
                                false ,'Order',$order->id ,1,$order,
                                $order->user_id);
                        }

                    }

                }
            }catch (\Exception $e){

            }



        }
        return response([
            'status' => $order ? Response_Success : Response_Fail,
            'order' => $order,
        ]);
    }

    public   function callAPI($endpointURL, $apiKey, $postFields = [], $requestType = 'POST')
    {

        $curl = curl_init($endpointURL);
        curl_setopt_array($curl, array(
            CURLOPT_CUSTOMREQUEST => $requestType,
            CURLOPT_POSTFIELDS => json_encode($postFields),
            CURLOPT_HTTPHEADER => array("Authorization: Bearer $apiKey", 'Content-Type: application/json'),
            CURLOPT_RETURNTRANSFER => true,
        ));

        $response = curl_exec($curl);
        $curlErr = curl_error($curl);

        curl_close($curl);

        if ($curlErr) {
            //Curl is not working in your server
            die("Curl Error: $curlErr");
        }

        $error = $this->handleError($response);
        if ($error) {
            die("Error: $error");
        }

        return json_decode($response);
    }

    public function getPaymentStatus($payment_id): \Illuminate\Http\JsonResponse
    {


        /* ------------------------ Configurations ---------------------------------- */

        //Test
        //$apiURL = 'https://apitest.myfatoorah.com';
        //$apiKey = 'rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL';

        //Live
        $apiURL = 'https://api.myfatoorah.com';
        $apiKey = 'WCuWqL9a-aCqaGBL9zk7KrS1w0cAuymXsSnXJzyp-ctEi8TH-6Etpv-d7DdE-NGVMnGuE1ODXV80UILG3n-45mahc4zHFImPivt5zQ52nvCY_XQXMDpOEenNEVG5OSBLy9h6SECjx4m-ePMK3JnDZdoMayYWQZCpqNGxyDboIQscZeCuWwf2T4IrZF9mwz8ErXy1uGl55LXXzBqmwkh7ffdfn1AYLkNn3dibJ3F5VrVoRSbqtJi6plk4bha-f39yAB8TUgMXBkldkcf4Wz3zm5pX3PC_Xmt4v0QNJBumYUjPJpa8zJqJrjyLOBKEDYi-tbURShKYgHMIqKy2uWHxiCAfkKkDaXrJZiE7Pl2PqZ1FzYErg0si9hf9xMFucQlOUj5rLqJL0A58Z8aaWpQWRFvXpjx3Qk9DX79YoufoJQpqiQ85WOXhuiQt5r_C6XTvB1Q03K2DY5xlcaHQClXQfbv25qqwbuROS4sSxj0ztWFF5O5HI4q082lUl4agC9exOiGQfKTFD1yWsn7pLMqM7y0G2zTzecbNwLtjc7szo1stTFhauSUnBRLEV0A24eqY1pYG-oEtBI9_9O_rvFpOEltJQg29ZoI_0jN-t7qeGwO-Z1mSfHWzjsWD3-YQ5B5_cAd8P2T_Hkj2PCiSmd2eAjRxWfLZL6wwP0J8wuZ0ZoHUxm0Z3lpF4di-nNAG2R__AoOPMETFdj_64b7fZyNIM31i1fQK6MFZjTSMaVziwaE6_M7e'; //Live token value to be placed here: https://myfatoorah.readme.io/docs/live-token


        /* ------------------------ Call getPaymentStatus Endpoint ------------------ */
        //Inquiry using paymentId
        $keyId = $payment_id;
        $KeyType = 'paymentId';

        //Inquiry using invoiceId
        //        $keyId   = $invoice_id;
        //        $KeyType = 'invoiceId';

        //Fill POST fields array
        $postFields = [
            'Key' => $keyId,
            'KeyType' => $KeyType
        ];
        //Call endpoint
        $json = $this->callAPI("$apiURL/v2/getPaymentStatus", $apiKey, $postFields);

        //Display the payment result to your customer
        return response()->json($json->Data);
    }

    //////
    public function payment_callback(Request $request,$id)
    {
        //        dd($request->all());
        $payment_id = $request->paymentId;


        $invoice_data =  $this->getPaymentStatus($payment_id);
        //        return $invoice_data;
        $invoice_id = $invoice_data->original->InvoiceId;
        $invoice_status = $invoice_data->original->InvoiceStatus;



        //ORDER

        $order = Order::where('id', $id)->first();

        if (!$order) {
            return response([
                'status' =>  Response_Fail,
                'orders' => 'Order is not Exist !',
            ]);
        }


        $order->status = 1;
        $order->paid_by = 1;
        $order->save();

        /*try{

            $items= OrderItem::where('order_id',$order->id)->get();

            foreach($items as  $item){
                $pro=Product::find($item->product_id);
                if(!$pro){
                    return response([
                        'status' => Response_Fail,
                        'message' => 'error in product height key product not found',
                    ]);
                }
                $cat_type=$pro->basic_category->type;
                if($cat_type == 1){
                    $height = ProdHeight::where("product_id",$key)->where('height_id',0)->first();
                }else{

                    $height = ProdHeight::find($item->height_id);
                }
                if($height){
                    if ($height->quantity >= $item->quantity) {
                        $height->quantity=$height->quantity - $item->quantity;
                        $height->save();
                    }
                }

            }

            if($order->email !=null){
                //   invoice
                $data['invoice']=$order;
                $data["email"]=$order->email;
                $from=env('MAIL_FROM_ADDRESS');
                $data["subject"]= 'order';

                Mail::send('emails.orderStore', $data, function ($message) use ($data, $from) {
                    $message->from($from)->to($data["email"], $data["email"] )
                        ->subject($data["subject"]);
                });
            }


        }catch (\Exception $e){

        }

        */

        /*
             * order with order_id and price is price paid successfully and delivery is happening
             *
             *
             * */


        // Mail::send('email.donePay', ['name' => $order->name, 'order_id' => $request->paymentId, 'total_price' => $order->total_price, 'total_quantity' => $order->total_quantity, 'invoice_link' => $order->invoice_link], function ($message) use ($order) {
        //     $message->to($order->email)
        //         ->from('sales@easyshop-qa.com', 'Sara Merdas')
        //         ->subject('Pay done');
        // });

        //        Mail::send('email.donePay',['name' => $request->name,'order_id'=>$order->id,'total_price'=>$request->total_price,'total_quantity'=>$request->total_quantity], function($message) use($request,$order){
        //            $message->to($request->email)
        //                ->from('sales@easyshop-qa.com', 'Example')
        //                ->subject('Pay done');
        //        });
        //TODO ::MAIL IS HERE
        return response([
            'status' =>  Response_Success,
            'orders' => __('site.Payment Completed Successfully !'),
        ]);



        //ORDER 1


        //ALERT


        //HOME

    }


    public  function handleError($response)
    {

        $json = json_decode($response);
        if (isset($json->IsSuccess) && $json->IsSuccess == true) {
            return null;
        }

        //Check for the errors
        if (isset($json->ValidationErrors) || isset($json->FieldsErrors)) {
            $errorsObj = isset($json->ValidationErrors) ? $json->ValidationErrors : $json->FieldsErrors;
            $blogDatas = array_column($errorsObj, 'Error', 'Name');

            $error = implode(', ', array_map(function ($k, $v) {
                return "$k: $v";
            }, array_keys($blogDatas), array_values($blogDatas)));
        } else if (isset($json->Data->ErrorMessage)) {
            $error = $json->Data->ErrorMessage;
        }

        if (empty($error)) {
            $error = (isset($json->Message)) ? $json->Message : (!empty($response) ? $response : 'API key or API URL is not correct');
        }

        return $error;
    }


    function notificationUSER($user,$order)
    {



        if ($user && $user->device_token){
            $SERVER_API_KEY = "AAAAG8IdLfY:APA91bEhmQ8iEBm1xpF0OO2BtpSozCLuked6S3TPUMZ8TIDm99zpzpBSIhuRVEjtAXnVDJiUyyI2JXGe07X6hfnCpFphO2rWrN0iG0lKLGDQA3GxMaP6ErujafUOpKnScEX6SsO0Zcjq";

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
            //\Log::info($response);
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
                $image=null;//$type_model->img;
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

    }*/


}