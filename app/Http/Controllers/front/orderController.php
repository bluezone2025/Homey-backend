<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class orderController extends Controller
{
    public function index(){
//        $orders = OrderItem::distinct('product_id','')->pluck('product_id')->all();

//        $orders = Order::all();
//        dd($orders->order_item);

//        $comment = Order::all();
//
//        dd($comment->order_item) ;

//        foreach ($orders->order_item as $order){
//            dd($order->id);
//
//        }

//        $orders= Order::with('order_item')->where('id', 'like', '%1%')->first();
//
//        $postComment = array();
//
//        foreach($orders->order_item as $post){
//            $postComment = $post->order_item;
//        }
//        dd($postComment);
//
//        $comments = [];
//
//            $user = Order::where('country_id', 1)->with(['order_item.order' => function($query) use (&$comments) {
//            $comments = $query->get();
//        }])->first();
//foreach ($comments as $u){
//    echo("11") ;
//
//}
        $user_id = auth()->user()->id;
        $orders = Order::where('user_id',$user_id)->get();
//                dd($user);

//        $orders=[];
//        foreach ($user as $us){
//            array_push($orders,$us);
//
//        }


//        dd($orders);

        return view('front.myorder',compact('orders'));
    }


}
