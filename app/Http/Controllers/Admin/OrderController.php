<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\StatusOrderMail;
use App\Models\OptionValue;
use App\Models\Order;
use App\Models\ProdColor;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\ProductOrderDelete;
use App\Models\Wallet;
use App\MyDataTable\MDT_Method_Action;
use App\MyDataTable\MDT_Query;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\FcmTokenModel;
use App\Models\Notification;

class OrderController extends Controller
{

    use MDT_Query;
    use MDT_Method_Action;

    private $lang;

    public function __construct()
    {

        $this->lang = app()->getLocale();

        $this->middleware('haveRole:order.index')->only('index');
        $this->middleware('haveRole:order.update')->only('update');
        $this->middleware('haveRole:order.show')->only('show');
    }

    public function index()
    {

        // dd(Order::first()->image);

        $payment_type = \request()->get('payment_type',null);
        if ($payment_type){

            return $this->MDT_Query_method(// Start Query
                Order::class,
                'admin/pages/orders/index',
                false, // Soft Delete
                [
                    'with_RS' => ['shipping_address'],
                    'condition' => ['whereIn' , 'payment_method'  , [$payment_type]],
                    'condition2' => ['wherein' , 'status' , ["accept","done","shipping","reject"]],
                ],'order'
            ); // end query

        }else{


            return $this->MDT_Query_method(// Start Query
                Order::class,
                'admin/pages/orders/index',
                false, // Soft Delete
                [
                    'with_RS' => ['shipping_address'],
                    'condition' => ['whereIn' , 'payment_method'  , ['knet','tabby','wallet']],
                    'condition2' => ['wherein' , 'status' , ["accept","done","shipping","reject"]],
                ],'order'
            ); // end query


        }
    }


    public function notComplete()
    {

        // dd(Order::first()->image);

        return $this->MDT_Query_method(// Start Query
            Order::class,
            'admin/pages/orders/not_complete',
            false, // Soft Delete
            [
                'with_RS' => ['shipping_address'],
                'condition' => ['whereIn' , 'payment_method'  , ['knet','tabby','wallet']],
                'condition2' => ['wherein' , 'status' , ["pending","reject"]],
            ],'order'
        ); // end query

    }

    public function index_cach(){
        // dd('fff');
        return $this->MDT_Query_method(// Start Query
            Order::class,
            'admin/pages/orders/index_cach',
            false, // Soft Delete
            [
                'with_RS' => ['shipping_address'],
                'condition' => ['where' , 'payment_method' , '=' , "cash"],
                'condition2' => ['wherein' , 'status' , ["pending","accept","done","shipping"]],
                'condition3' => ['wherein' , 'payment_method' , [ "cash","reject"]],
                ]
            ); // end query
    }

        public function index_inpaid(){

            return $this->MDT_Query_method(// Start Query
                Order::class,
                'admin/pages/orders/index_inpaid',
                false, // Soft Delete
                [
                    'with_RS' => ['shipping_address'],
                    'condition' => ['whereIn' , 'payment_method'  , ['knet','tabby','wallet']],
                    'condition2' => ['wherein' , 'status' , ["pending","reject"]],
                ]
                ); // end query
        }


    public function update(Request $request, $id)
    {

        $order = Order::findOrFail($id);

        $oldStatus = $order->status;

        $order->update($this->columnsDB($request));

        if ($order->status != $oldStatus) {

            if ($order->status == "reject"){
                // Iterate through each order item to refund quantities
                foreach ($order->products as $product) {

                    $orderItemId = $product->pivot->id;
                    $orderItem = ProductOrder::find($orderItemId);
                    $quantity = $orderItem->quantity;

                    // Refund the quantity of the product
                    $this->refundQuantityOfProduct($quantity, $product);

                    // Add the removed item to the `product_order_deletes` table
                    #ProductOrderDelete::create($orderItem->toArray());

                    ProductOrderDelete::create([
                        'id' => $orderItem->id,
                        'product_id' => $orderItem->product_id,
                        'order_id' => $orderItem->order_id,
                        'product_name' => $orderItem->product_name,
                        'quantity' => $orderItem->quantity,
                        'sale_price' => $orderItem->sale_price,
                        'regular_price' => $orderItem->regular_price,
                        'attributes' => $orderItem->attributes,
                        'student_id' => $orderItem->student_id,
                        #'points' => $orderItem->points, // Remove if this column does not exist in the target table
                        'created_at' => $orderItem->created_at,
                        'updated_at' => $orderItem->updated_at,
                        'end_price' => $orderItem->end_price
                    ]);

                }

                $payment_type = $order->payment_method;
                if ($order->user){

                    if (in_array($order->payment_method, ['knet', 'wallet', 'tabby'])) {

                        Wallet::create([
                            'user_id' => $order->user->id,
                            'wallet_type' => 'deposit',
                            'title' => 'استرداد قيمة طلب',
                            'amount' => $order->order_price,
                            'order_id'  => $order->id,
                        ]);
                    }
                }
            }

            if ($oldStatus == "reject"){
                // Iterate through each order item to refund quantities
                foreach ($order->products as $product) {

                    $orderItemId = $product->pivot->id;
                    $orderItem = ProductOrder::find($orderItemId);
                    $quantity = $orderItem->quantity;

                    // Refund the quantity of the product
                    $this->removeQuantityOfProduct($quantity, $product);

                    // Remove the archived item from `product_order_deletes` if necessary
                    ProductOrderDelete::where('id', $orderItemId)->delete();


                }

                if ($order->user){

                    if (in_array($order->payment_method, ['knet', 'wallet', 'tabby'])) {

                        $wallet = Wallet::where('user_id',$order->user->id)->where('order_id',$order->id)->first();
                        if ($wallet){
                            $wallet->delete();
                        }
                    }
                }


            }
            $this->notificationUSER($order->user, $order);
            if ($order->user)
                \Mail::to($order->user->email)->send(new StatusOrderMail($order  , $oldStatus));
        }

        return response(['status' => 'success' , 'message' =>__('form.response.update order')]);

    }

    public function today(){
            /*
             *
            'orders_count_today' => Order::wherein('payment_method',['knet','tabby','wallet'])->wherein('status',["accept","done","shipping"])
                                    ->whereDate('created_at', Carbon::today())->count() + Order::where('payment_method','cash')
                    ->whereDate('created_at', Carbon::today())->wherein("status",["pending","accept","done","shipping"])->count()
             * */

        $ordersIds = Order::wherein('payment_method',['knet','tabby','wallet'])->wherein('status',["accept","done","shipping"])
            ->whereDate('created_at', Carbon::today())->pluck('id')->toArray();

        $ordersIds2 = Order::where('payment_method','cash')
            ->whereDate('created_at', Carbon::today())->wherein("status",["pending","accept","done","shipping"])->pluck('id')->toArray();

        $ordersIdsAll = array_merge($ordersIds,$ordersIds2);
        $ordersIdsAll = array_unique($ordersIdsAll);

        return $this->MDT_Query_method(// Start Query
            Order::class,
            'admin/pages/orders/today',
            false, // Soft Delete
            [
                'with_RS' => ['shipping_address'],
                'condition2' => ['wherein' , 'id' , $ordersIdsAll],
            ]
        ); // end query
    }


    public function show($id)
    {
        $order = Order::with(['products' => function ($query) {
            $query->withTrashed(); // Include soft-deleted products
        }])->findOrFail($id);
        //dd($order->brand);

//        if ($order) {
//            // Transform attributes JSON to array
//            foreach ($order->products as $product) {
//                if ($product->pivot && $product->pivot->attributes) {
//                    $decoded = json_decode($product->pivot->attributes, true);
//                    $product->pivot->attributes = is_array($decoded) ? $decoded : null;
//                }
//            }
//        }
//        dd($order);

        return view('admin.pages.orders.show')->with([
            'order' => $order,
            'lang' => $this->lang,
        ]);
    }


    public function destroy($id){

        $this->MDT_delete(Order::class , $id);

        return response([
            'status' => 'success',
            'message' => __('form.response.delete order'),
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



        if ($user){
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

    public function removeItem($orderItemId){



        $orderItem = ProductOrder::find($orderItemId);
        $order = Order::find($orderItem->order_id);
        $product = Product::find($orderItem->product_id);
        $quantity = $orderItem->quantity;
       // dd('s');

        // Refund the quantity of the product
        $this->refundQuantityOfProduct($quantity, $product);

        $price = $orderItem->end_price;
        // check the order here and update the total amount
        $order->order_price = $order->order_price - $orderItem->end_price;
        $order->total_price = $order->total_price - $orderItem->end_price;
        $order->save();

        // Add the removed item to the `product_order_deletes` table
        #ProductOrderDelete::create($orderItem->toArray());

        ProductOrderDelete::create([
            'id' => $orderItem->id,
            'product_id' => $orderItem->product_id,
            'order_id' => $orderItem->order_id,
            'product_name' => $orderItem->product_name,
            'quantity' => $orderItem->quantity,
            'sale_price' => $orderItem->sale_price,
            'regular_price' => $orderItem->regular_price,
            'attributes' => $orderItem->attributes,
            'student_id' => $orderItem->student_id,
            #'points' => $orderItem->points, // Remove if this column does not exist in the target table
            'created_at' => $orderItem->created_at,
            'updated_at' => $orderItem->updated_at,
            'end_price' => $orderItem->end_price
        ]);


        $orderItem->delete();
        if ($order->order_price == 0){

            $payment_type = $order->payment_method;
            if ($order->user){

                if ($order->status != "pending" && in_array($order->payment_method, ['knet', 'wallet', 'tabby'])) {

                    Wallet::create([
                        'user_id' => $order->user->id,
                        'wallet_type' => 'deposit',
                        'title' => 'استرداد قيمة طلب',
                        'amount' => $price,
                    ]);
                }
            }

            $order->delete();

            if (in_array($payment_type, ['knet', 'wallet', 'tabby'])){

                return redirect()->route('admin.orders.index');
            }else{

                return redirect()->route('admin.index_cach.index');
            }
        }

        // check the order payment is online (wallet, knet, tabby) and status not pending and payment method knet tabby wallet

        // then add to wallet if order assign to user

        if ($order->user){

            if ($order->status != "pending" && in_array($order->payment_method, ['knet', 'wallet', 'tabby'])) {

                Wallet::create([
                    'user_id' => $order->user->id,
                    'wallet_type' => 'deposit',
                    'title' => 'استرجاع قيمة طلب',
                    'amount' => $price,
                ]);
            }
        }




        session()->flash('success',__('form.response.update order'));

        return redirect()->back();


        //dd($orderItemId);

    }

    private function refundQuantityOfProduct($quantityProduct, $product)
    {
        // Update quantity of all products with the same barcode
        $relatedProducts = Product::where('barcode', $product->barcode)
            ->where('barcode', '!=', null)
            ->where('id', '!=', $product->id)
            ->get();



        if ($quantityProduct) {
            $product->update([
                'quantity' => \DB::raw("quantity + $quantityProduct")
            ]);

            foreach ($relatedProducts as $relatedProduct) {
                $relatedProduct->update([
                    'quantity' => \DB::raw("quantity + $quantityProduct")
                ]);
            }
        }
    }


    private function removeQuantityOfProduct($quantityProduct, $product)
    {
        // Update quantity of all products with the same barcode
        $relatedProducts = Product::where('barcode', $product->barcode)
            ->where('barcode', '!=', null)
            ->where('id', '!=', $product->id)
            ->get();



        if ($quantityProduct) {
            $product->update([
                'quantity' => \DB::raw("quantity - $quantityProduct")
            ]);

            foreach ($relatedProducts as $relatedProduct) {
                $relatedProduct->update([
                    'quantity' => \DB::raw("quantity - $quantityProduct")
                ]);
            }
        }
    }


    public function refused()
    {

        // dd(Order::first()->image);
        return $this->MDT_Query_method(// Start Query
            Order::class,
            'admin/pages/orders/refused',
            false, // Soft Delete
            [
                'with_RS' => ['shipping_address'],
                'condition' => ['wherein' , 'status' , ["reject"]],
            ],'order'
        ); // end query



    }



}
