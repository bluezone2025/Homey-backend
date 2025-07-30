<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;
use App\BasicCategory;
use App\OrderItem;
use App\ProdHeight;
use App\Product;
use App\Settings;
use App\Slider;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeProductsController extends Controller
{
    const COUNT_ROWS = 15;

    public function __construct() {

        $this->middleware('auth.guard:web-api')->only('idsProductLike');
    }

    public function index(){


        $categories = BasicCategory::with('categories')
            ->orderBy('id' , 'desc')
            ->get();
       $sliders = Slider::all();

        $new_arrive = Product::orderBy('created_at', 'desc')->where('new', 1)->where('appearance', 1)
            ->offset(0)->limit(8)->get();
        $offers = Product::orderBy('created_at', 'desc')->where('has_offer', 1)->where('appearance', 1)
            ->where('has_reception', 0)->offset(0)->limit(8)->get();
        $best_sell = Product::orderBy('created_at', 'desc')->where('best_selling', 1)->where('appearance', 1)
            ->offset(0)->limit(5)->get();
        $posts = Post::orderBy('created_at', 'desc')->where('appearance', 1)
            ->offset(0)->limit(3)->get();
        $reception_products = Product::orderBy('created_at', 'desc')->where('has_reception', 1)->where('appearance', 1)
            ->offset(0)->limit(5)->get();
        return  response([

            'status' => Response_Success,
            'data'   => [

                'categories'     => $categories,
                'sliders'         => $sliders,
                'new_arrive'        => $new_arrive,
                'offers' => $offers,
                'best_sell'        => $best_sell,
                'posts'           => $posts,
                'reception_products'        => $reception_products,

            ],
        ]);

    }
    public function check_quantity(Request $request)
    {

        $booking_dates = explode(',', $request->BookingDates);

        $product=Product::find($request->product_id);



        $pro= ProdHeight::where('product_id',$request->product_id)->where('height_id',0)->first();

        if (!$product) {

            return response([
                'status' => Response_Fail,
                'message' => 'prodect Not Found' ,
            ]);
        }
        // get the days that not have quantities
        $days=[];
        $quantity = 1000000000000;
        foreach($booking_dates as $key=> $item){

            $order_qut=OrderItem::where('product_id',$product->id)->where('booking_date',$item)->sum('quantity');


           if($pro){
               if ($pro->quantity < $order_qut) {
                   $days[]=$item;
               }
               /*else
               {
                   $q=$pro->quantity-$order_qut;

                   //                   $days[]=[$item=>$q];
               }*/

               if ($pro->quantity < $order_qut) {
                   $quantity=0;
                   break;
               }
               else
               {
                   $q = $pro->quantity - $order_qut;

                   if($quantity > $q){
                       $quantity = $q;
                   }
               }
           }



        }


        return response([
            'status' => Response_Success,
            'quantity' => $quantity,
            'days' => $days,

        ]);
    }

    public function reception()
    {


        $receptions = Product::where('has_reception', 1)->where('appearance', 1)->orderBy('updated_at',  'DESC')->simplePaginate(self::COUNT_ROWS);
        // dd($new_arrivals);



        return  response([

            'status' => $receptions->count() >= 1 ? Response_Success : Response_Fail,
            'data'   => [

                'receptions'     => $receptions

            ],
        ]);
    }

    public function new_arrive()
    {


        $new_arrivals = Product::where('new', 1)->where('appearance', 1)->orderBy('updated_at',  'DESC')->simplePaginate(self::COUNT_ROWS);
        // dd($new_arrivals);



        return  response([

            'status' => $new_arrivals->count() >= 1 ? Response_Success : Response_Fail,
            'data'   => [

                'new_arrivals'     => $new_arrivals

            ],
        ]);
    }
    public function offers()
    {


        $offers = Product::where('has_offer', 1)->where('appearance', 1)->where('has_reception', 0)->orderBy('updated_at',  'DESC')->simplePaginate(self::COUNT_ROWS);
        // dd($new_arrivals);


         return  response([

            'status' => $offers->count() >= 1 ? Response_Success : Response_Fail,
            'data'   => [

                'offers'     => $offers

            ],
        ]);
    }

    public function get_order($order_id){


        $order = Order::first();//findorfail($order_id);
        if(request()->Result== "CAPTURED"  && $order ){
          $order->status='pending';
          $order->save();
        }elseif ($order) {
          $order->status='Paymentfailed';
          $order->save();
        }
        // return request()->all();
        return response([
            'status' => $order ? Response_Success : Response_Fail,
            'order' => $order,
        ]);


    }


    public function idsProductLike(){

        $likes = auth()->user()->likes->map->product_id;

        return response([
            'status'=> count($likes) > 0 ? Response_Success : Response_Fail,
            'data'  => $likes,
        ]);
    }


    public function tabbyStatus(){

        return response()->json([
            'status'    => true,
            'data'      => Settings::first()->is_tabby_active
        ]);
    }
}
