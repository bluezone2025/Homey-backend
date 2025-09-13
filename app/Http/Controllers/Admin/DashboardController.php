<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoxOrder;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $orders = [];


        Order::latest('id')
            ->where('created_at' ,  '>'  , Carbon::now()->subWeek())
            ->get(['id' , 'created_at'])
            ->groupBy(function($item) {
                return $item->created_at->format('Y-m-d');
            })->each(function ($value) use (&$orders){
                $orders [] = $value->count();
            });


        $lastProducts = Product::latest()
            ->take(10)
            ->get();


        $lastOrders =
            Order::where(function ($query)  {
                $query->wherein('payment_method', ['knet','tabby']) // KNET payments
                ->where('status', '!=', 'pending');
            })->orWhere(function ($query)  {
                // Orders with 'cash' payment method that are not in the previous 'whereIn' clause
                $query->where('payment_method', 'cash');
            })->take(10)->get();


        $topProductsLikes = Product::orderBy('likes_count' , 'desc')
            ->take(10)
            ->get();

        $topProductsRating = Product::orderBy('ratings' , 'desc')
            ->take(10)
            ->get();
            // dd(Order::sum('total_price'));

        $selected_month = \request()->get('selected_month', null);
        $selected_year = \request()->get('selected_year', null);

        if ($selected_month && $selected_year) {
            // Parse the selected year and month to a Carbon object
            $selected_date = Carbon::createFromFormat('Y-m', $selected_year . '-' . $selected_month);

            // Calculate the total order money for the selected year and month
            $orders_money_by_month = Order::where(function ($query) use ($selected_date) {
                $query->whereIn('payment_method', ['knet', 'tabby']) // KNET payments
                ->where('status', '!=', 'pending')
                    ->whereYear('created_at', $selected_date->year)
                    ->whereMonth('created_at', $selected_date->month); // Non-pending status
            })->orWhere(function ($query) use ($selected_date) {
                // Orders with 'cash' payment method that are not in the previous 'whereIn' clause
                $query->where('payment_method', 'cash')
                    ->whereYear('created_at', $selected_date->year)
                    ->whereMonth('created_at', $selected_date->month);
            })->sum('total_price');

            // Calculate the count of orders for the selected year and month
            $orders_count_by_month = Order::where(function ($query) use ($selected_date) {
                $query->whereIn('payment_method', ['knet', 'tabby']) // KNET payments
                ->where('status', '!=', 'pending')
                    ->whereYear('created_at', $selected_date->year)
                    ->whereMonth('created_at', $selected_date->month); // Non-pending status
            })->orWhere(function ($query) use ($selected_date) {
                // Orders with 'cash' payment method that are not in the previous 'whereIn' clause
                $query->where('payment_method', 'cash')
                    ->whereYear('created_at', $selected_date->year)
                    ->whereMonth('created_at', $selected_date->month);
            })->count('total_price');
        } else {
            $orders_count_by_month = null;
            $orders_money_by_month = null;
        }
        return view('admin.pages.dashboard.index')->with([

            'lang' => app()->getLocale(),
            'orders_count_by_month' => $orders_count_by_month,
            'orders_money_by_month' => $orders_money_by_month,
            'orders' => array_reverse($orders),
            'products_count' => Product::count(),
            'orders_count_online' => Order::wherein('payment_method',['knet','tabby','wallet'])->wherein('status',["accept","done","shipping"])->count(),
            'orders_amount_online' => Order::wherein('payment_method',['knet','tabby','wallet'])->wherein('status',["accept","done","shipping"])->sum('total_price'),
            'orders_count_cash' => Order::where('payment_method','cash')->wherein("status",["pending","accept","done","shipping"])->count(),
            'orders_amount_cash' => Order::where('payment_method','cash')->wherein("status",["pending","accept","done","shipping"])->sum('total_price'),
            'box_order_count' => BoxOrder::where('payment_method','knet')
                ->with('box')->withTrashed()
                ->where('status','paid')->count(),
            'box_order_amount' => BoxOrder::where('payment_method','knet')
                ->with('box')->withTrashed()
                ->where('status','paid')->sum('total_price'),
            'orders_count_today' => Order::wherein('payment_method',['knet','tabby','wallet'])->wherein('status',["accept","done","shipping"])
                                    ->whereDate('created_at', Carbon::today())->count() + Order::where('payment_method','cash')
                    ->whereDate('created_at', Carbon::today())->wherein("status",["pending","accept","done","shipping"])->count(),
            'orders_price_today' => Order::wherein('payment_method',['knet','tabby','wallet'])->wherein('status',["accept","done","shipping"])
                    ->whereDate('created_at', Carbon::today())->sum('total_price') + Order::where('payment_method','cash')
                    ->whereDate('created_at', Carbon::today())->wherein("status",["pending","accept","done","shipping"])->sum('total_price'),
            'orders_price' => Order::where('payment_method','cash')->wherein("status",["pending","accept","done","shipping"])->sum('total_price') +
                              Order::wherein('payment_method',['knet','tabby','wallet'])->wherein('status',["accept","done","shipping"])->sum('total_price') +
                              BoxOrder::where('payment_method','knet')
                                  ->with('box')->withTrashed()
                                  ->where('status','paid')->sum('total_price'),
            //'box_orders_price' => BoxOrder::where('payment_method','knet')->where('status','paid')->sum('total_price')  ,
            'students_count' => Student::where('is_active',1)->count(),
            'users_count' => User::count(),
            'last_products' => $lastProducts,
            'last_orders' => $lastOrders,
            'top_products_likes' => $topProductsLikes,
            'top_products_ratings' => $topProductsRating,
        ]);
    }



    public function discounts(){

        $students = Student::all();

        return view('admin.pages.discounts.create', compact('students'));
    }


    public function saveDiscounts(Request $request){

        //dd($request->all());


        $student = Student::find($request->get('student_id'));

        $old_discount_percentage = $student->discount_percentage;

        if ($old_discount_percentage > 0){
            session()->flash('error',"هذا البائع لدية نسبة خصم من قبل برجاء جعل قيمة صفر قبل استخداقيمة اخري");
            return back();
        }

        $discount_percentage = $request->get('discount_percentage');

        $student->discount_percentage = $request->get('discount_percentage');
        $student->save();
        //dd($student->products);

        if ($discount_percentage == 0){
            // Delete the old discount_percentage from all student products

            foreach ($student->products as $product){
                if ($product->in_sale && $product->discount_percentage > $old_discount_percentage){

                    $product_discount_percentage = $product->discount_percentage - $old_discount_percentage;
                    $product->discount_percentage = $product->discount_percentage - $old_discount_percentage;

                    // update product price
                    $product->sale_price = round($product->regular_price - ($product->regular_price * $product_discount_percentage / 100),2);
                    $product->save();

                }else{
                    $product->in_sale = 0;
                    $product->sale_price = 0;
                    $product->discount_percentage = 0;
                    $product->save();
                }
            }
        }else{
            foreach ($student->products as $product){
                if ($product->in_sale){

                    $product_discount_percentage = $product->discount_percentage + $discount_percentage;
                    $product->discount_percentage = $product->discount_percentage + $old_discount_percentage;

                    // update product price
                    $product->sale_price = round ($product->regular_price - ($product->regular_price * $product_discount_percentage / 100),2);
                    $product->save();

                }else{
                    //dd('ss');
                    $product->in_sale = 1;
                    $product->sale_price = $product->regular_price - ($product->regular_price * $discount_percentage / 100);;
                    $product->discount_percentage = $discount_percentage;
                    $product->save();
                }
            }
        }

        //dd('done');

        session()->flash('success',"تم الحفظ");
        return back();


    }

}
