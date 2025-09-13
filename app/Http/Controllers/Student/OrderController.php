<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Mail\StatusOrderMail;
use App\Models\Order;
use App\Models\ProductOrder;

use App\MyDataTable\MDT_Query;
use Illuminate\Http\Request;
use App\Models\FcmTokenModel;
use App\Models\Notification;

class OrderController extends Controller
{
       use MDT_Query;

      public function index()
      {

          $ordersIds = ProductOrder::where('student_id',auth()->guard('student')->id())->pluck('order_id')->unique()->toArray();
          #$ordersIds = array_values($ordersIds);
        return $this->MDT_Query_method(// Start Query
            Order::class,
            'student/pages/orders/index',
            false, // Soft Delete
            [
                'with_RS' => ['shipping_address'],
                #'condition' => ['where' , 'brand_id' , auth()->guard('student')->id()],
                'condition2' => ['wherein' , 'status' , ["accept","done","shipping"]],
                'condition3' => ['wherein' , 'payment_method'  , ["knet","tabby",'wallet']],
                'condition' => ['wherein' , 'id' , $ordersIds],


            ],'order'
            ); // end query

      }

    public function refused()
    {

        $ordersIds = ProductOrder::where('student_id',auth()->guard('student')->id())->pluck('order_id')->unique()->toArray();
        #$ordersIds = array_values($ordersIds);
        return $this->MDT_Query_method(// Start Query
            Order::class,
            'student/pages/orders/refused',
            false, // Soft Delete
            [
                'with_RS' => ['shipping_address'],
                'condition2' => ['wherein' , 'status' , ["reject"]],
                'condition' => ['wherein' , 'id' , $ordersIds],


            ],'order'
        ); // end query

    }

    /*public function notComplete()
    {

        return $this->MDT_Query_method(// Start Query
            Order::class,
            'student/pages/orders/not_complete',
            false, // Soft Delete
            [
                'with_RS' => ['shipping_address'],
                'condition' => ['where' , 'brand_id' , auth()->guard('student')->id()],
                'condition2' => ['wherein' , 'status' , ["pending"]],
                'condition3' => ['wherein' , 'payment_method'  , ["knet"]],
            ],'order'
        ); // end query

    }*/

    public function notComplete(){
        $ordersIds = ProductOrder::where('student_id',auth()->guard('student')->id())->pluck('order_id')->unique()->toArray();
        return $this->MDT_Query_method(// Start Query
            Order::class,
            'student/pages/orders/not_complete',
            false, // Soft Delete
            [
                'with_RS' => ['shipping_address'],
                'condition' => ['wherein' , 'id' , $ordersIds],
                'condition2' => ['wherein' , 'status' , ["pending"]],
                'condition3' => ['wherein' , 'payment_method' , [ "knet","tabby",'wallet']],
            ]
        ); // end query
    }

        public function index_cach(){
            $ordersIds = ProductOrder::where('student_id',auth()->guard('student')->id())->pluck('order_id')->unique()->toArray();
            return $this->MDT_Query_method(// Start Query
                Order::class,
                'student/pages/orders/index_cach',
                false, // Soft Delete
                [
                    'with_RS' => ['shipping_address'],
                    'condition' => ['wherein' , 'id' , $ordersIds],
                    'condition2' => ['wherein' , 'status' , ["accept","done","shipping","pending"]],
                    'condition3' => ['wherein' , 'payment_method' , ["cash"]],
                    ]
                ); // end query
        }

    public function update(Request $request, $id)
    {

        $order = Order::findOrFail($id);

        $oldStatus = $order->status;

        $order->update($this->columnsDB($request));

        if ($order->status != $oldStatus) {
            // New Notification Here
            //$this->notificationUSER($order->user, $order);
            \Mail::to($order->user->email)->send(new StatusOrderMail($order  , $oldStatus));
        }
        if($order->status == 'shipping'){
         if($order->user_id != null){
             // New Notification Here

            /*$FcmTokenModel= FcmTokenModel::where('user_id',$order->user_id)->first();
                 self::save_notf($FcmTokenModel->fcm_token,false ,'Order',$order->id ,2,$order,$order->user_id);
            }else{
                $old_notf = Notification::where('type_id',$order->id )->where('type','Order')->first();
                if($old_notf){
                  if(count($old_notf->fcm_token) != 0){
                      self::save_notf($old_notf->fcm_token[0],false ,'Order',$order->id ,2);
                    }
                }
             */
            }

        }


        return response(['status' => 'success' , 'message' =>__('form.response.update order')]);

    }


    public function show($id)
    {
        $order = Order::with(['products' => function ($query) {
            $query->withTrashed(); // Include soft-deleted products
        }])->findOrFail($id);



        return view('student.pages.orders.show')->with([
            'order' => $order,
            'lang' => app()->getLocale(),
        ]);
    }



    ///////////////////////////////////////////////////////
    ////                                               ////
    //// ..........  Methods Clean Code .............. ////
    ////                                               ////
    ///////////////////////////////////////////////////////


    public function columnsDB($request){


        return [
            'status'         => $request->status,
//            'order_price'    => $request->order_price,
//            'shipping_price' => $request->shipping_price,
//            'total_price'     => $request->total_price,
        ];
    }

    function notificationUSER($user,$order)
    {

        $SERVER_API_KEY = "AAAAQkEc80w:APA91bFGAI0nYJDlGN9Ch_iiEBZgfQihK-vVobnAGiZmRs-mOHKR4Lt_3rScqXye89vgQnJsFv3_dueKzTWl9wlpfVO-6FgHVfyRAWZty8Ds1iGmzY0hWiuvn60QjV8Q51-D1Obo8Zhz";

        $data = [
            "registration_ids" => [$user->device_token],
            "notification" => [
                "title" => 'update order status',
                "body" => __("aliases.status.$order->status"),
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
