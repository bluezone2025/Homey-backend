<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(){

        $products = [];

        $student = auth('student')->user();

        // ProductOrder::latest('id')
        //     ->where('student_id' , '=' , $student->id)
        //     ->where('created_at' ,  '>'  , Carbon::now()->subWeek())
        //     ->get(['id' , 'created_at'])
        //     ->groupBy(function($item) {
        //         return $item->created_at->format('Y-m-d');
        //     })->each(function ($value) use (&$products){
        //         $products [] = $value->count();
        //     });
        $ordersIds = ProductOrder::where('student_id', $student->id)
            ->distinct('order_id')
            ->pluck('order_id')
            ->toArray();

        $orders = Order::where(function ($query) use ($ordersIds) {
            $query->whereIn('id', $ordersIds) // Orders associated with the student
            ->wherein('payment_method', ['knet','tabby','wallet']) // KNET payments
            ->where('status', '!=', 'pending'); // Non-pending status
        })->orWhere(function ($query) use ($ordersIds) {
            // Orders with 'cash' payment method that are not in the previous 'whereIn' clause
            $query->where('payment_method', 'cash')
                ->whereIn('id', $ordersIds);
        })->take(10)->get();

        /*$ordersCount = ProductOrder::where('student_id', $student->id)
            ->distinct('order_id')
            ->pluck('order_id')
            ->toArray();*/

        $ordersCountNew = Order::where(function ($query) use ($ordersIds) {
            $query->whereIn('id', $ordersIds) // Orders associated with the student
            ->wherein('payment_method', ['knet','tabby','wallet']) // KNET payments
            ->where('status', '!=', 'pending'); // Non-pending status
        })->orWhere(function ($query) use ($ordersIds) {
            // Orders with 'cash' payment method that are not in the previous 'whereIn' clause
            $query->where('payment_method', 'cash')
                ->whereIn('id', $ordersIds);
        })->count();

        // Count orders meeting the criteria
        /*$ordersCountNew = Order::where(function ($query) use ($student) {
            $query->where('brand_id', $student->id) // Orders associated with the student
            ->where('payment_method', 'knet') // KNET payments
            ->where('status', '!=', 'pending'); // Non-pending status
        })->orWhere(function ($query) use ($student) {
            // Orders with 'cash' payment method that are not in the previous 'whereIn' clause
            $query->where('payment_method', 'cash')
                ->where('brand_id', $student->id);
        })->count();*/

        $orders_count_today = Order::where(function ($query) use ($ordersIds) {
            $query->whereIn('id', $ordersIds) // Orders associated with the student
            ->wherein('payment_method', ['knet','tabby','wallet']) // KNET payments
            ->where('status', '!=', 'pending') // Non-pending status
            ->whereDate('created_at', Carbon::today()->format('Y-m-d'));
        })->orWhere(function ($query) use ($ordersIds) {
            // Orders with 'cash' payment method that are not in the previous 'whereIn' clause
            $query->where('payment_method', 'cash')
                ->whereIn('id', $ordersIds)->whereDate('created_at', Carbon::today()->format('Y-m-d'));
        })->count();

        /*$orders_count_today = Order::where(function ($query) use ($student) {
            $query->where('brand_id', $student->id) // Orders associated with the student
            ->where('payment_method', 'knet') // KNET payments
            ->where('status', '!=', 'pending')->whereDate('created_at', Carbon::today()->format('Y-m-d')); // Non-pending status
        })->orWhere(function ($query) use ($student) {
            // Orders with 'cash' payment method that are not in the previous 'whereIn' clause
            $query->where('payment_method', 'cash')
                ->where('brand_id', $student->id)->whereDate('created_at', Carbon::today()->format('Y-m-d'));

        })->count();*/

        //dd($orders_count_today);


        $orders_total_today_ids = Order::where(function ($query) use ($ordersIds) {
            $query->whereIn('id', $ordersIds) // Orders associated with the student
            ->wherein('payment_method', ['knet','tabby','wallet']) // KNET payments
            ->where('status', '!=', 'pending') // Non-pending status
            ->whereDate('created_at', Carbon::today()->format('Y-m-d'));
        })->orWhere(function ($query) use ($ordersIds) {
            // Orders with 'cash' payment method that are not in the previous 'whereIn' clause
            $query->where('payment_method', 'cash')
                ->whereIn('id', $ordersIds)->whereDate('created_at', Carbon::today()->format('Y-m-d'));
        })->pluck('id')->toArray();
        //dd($orders_total_today_ids);

        $orders_total_today = \DB::table('product_order')
            ->whereIn('order_id', $orders_total_today_ids)  // Filter by order_id list
            ->where('student_id', auth('student')->id())
            ->whereDate('created_at', Carbon::today())  // Filter by today's date
            ->selectRaw('SUM(end_price) as total_price')  // Calculate total price
            ->value('total_price');  // Get the sum value
        //dd($orders_total_today);

        //dd($student->id);
        /*$orders_total_today = Order::where(function ($query) use ($student) {
            $query->where('brand_id', $student->id) // Orders associated with the student
            ->where('payment_method', 'knet') // KNET payments
            ->where('status', '!=', 'pending')
            ->whereDate('created_at', Carbon::today()->format('Y-m-d')); // Non-pending status
        })->orWhere(function ($query) use ($student) {
            // Orders with 'cash' payment method that are not in the previous 'whereIn' clause
            $query->where('payment_method', 'cash')
                ->where('brand_id', $student->id)
            ->whereDate('created_at', Carbon::today()->format('Y-m-d'));
        })->sum('order_price');
        //dd($orders_total_today);*/

        /*$orders_total_this_month = Order::where(function ($query) use ($student) {
            $query->where('brand_id', $student->id) // Orders associated with the student
            ->where('payment_method', 'knet') // KNET payments
            ->where('status', '!=', 'pending')
                ->whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', Carbon::now()->month); // Non-pending status
        })->orWhere(function ($query) use ($student) {
            // Orders with 'cash' payment method that are not in the previous 'whereIn' clause
            $query->where('payment_method', 'cash')
                ->where('brand_id', $student->id)
                ->whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', Carbon::now()->month);
        })->sum('order_price');
        */


// Retrieve order IDs for the current month
        $orders_total_month_ids = Order::where(function ($query) use ($ordersIds) {
            $query->whereIn('id', $ordersIds)  // Orders associated with the student
            ->wherein('payment_method', ['knet', 'tabby', 'wallet'])  // Specific payment methods
            ->where('status', '!=', 'pending')  // Non-pending status
            ->whereMonth('created_at', Carbon::now()->month)  // Current month
            ->whereYear('created_at', Carbon::now()->year);   // Current year
        })
            ->orWhere(function ($query) use ($ordersIds) {
                $query->where('payment_method', 'cash')  // Cash payments
                ->whereIn('id', $ordersIds)
                    ->whereMonth('created_at', Carbon::now()->month)  // Current month
                    ->whereYear('created_at', Carbon::now()->year);   // Current year
            })
            ->pluck('id')->toArray();

// Calculate the total price for the current month
        $orders_total_this_month = \DB::table('product_order')
            ->where('student_id', auth('student')->id())
            ->whereIn('order_id', $orders_total_month_ids)  // Filter by order_id list
            ->whereMonth('created_at', Carbon::now()->month)  // Filter by current month
            ->whereYear('created_at', Carbon::now()->year)    // Filter by current year
            ->selectRaw('SUM(end_price) as total_price')  // Calculate total price
            ->value('total_price');  // Get the sum value



        // Retrieve order IDs for the current month
        $orders_total_ids = Order::where(function ($query) use ($ordersIds) {
            $query->whereIn('id', $ordersIds)  // Orders associated with the student
            ->wherein('payment_method', ['knet', 'tabby', 'wallet'])  // Specific payment methods
            ->where('status', '!=', 'pending');  // Non-pending status
        })
            ->orWhere(function ($query) use ($ordersIds) {
                $query->where('payment_method', 'cash')  // Cash payments
                ->whereIn('id', $ordersIds);

            })
            ->pluck('id')->toArray();

// Calculate the total price for the current month
        $orders_total = \DB::table('product_order')
            ->where('student_id', auth('student')->id())
            ->whereIn('order_id', $orders_total_ids)  // Filter by order_id list
            ->selectRaw('SUM(end_price) as total_price')  // Calculate total price
            ->value('total_price');  // Get the sum value




        /*$orders_total = Order::where(function ($query) use ($student) {
            $query->where('brand_id', $student->id) // Orders associated with the student
            ->where('payment_method', 'knet') // KNET payments
            ->where('status', '!=', 'pending');
        })->orWhere(function ($query) use ($student) {
            // Orders with 'cash' payment method that are not in the previous 'whereIn' clause
            $query->where('payment_method', 'cash')
                ->where('brand_id', $student->id);
        })->sum('order_price');*/


        // percentage
        $student_percentage = $orders_total_this_month * $student->student_percentage / 100;
        $student_total_percentage = $orders_total * $student->student_percentage / 100;


        $orders_count_this_month = count($orders_total_month_ids);

        //$orders_count_today=   ProductOrder::where('student_id' , '=' , $student->id)->whereDate('created_at', Carbon::today());
        $added_products_count = Product::whereRelation('students' , 'student_id' , '=' , $student->id)->count();


        // Assuming you have the selected month available in $_GET['selected_month']
        //$selected_month = $_GET['selected_month'];

        $selected_month = \request()->get('selected_month', null);
        $selected_year = \request()->get('selected_year', null);

// If selected month and year are provided
        if ($selected_month && $selected_year) {
            // Parse the selected year and month to a Carbon object
            $selected_date = Carbon::createFromFormat('Y-m', $selected_year . '-' . $selected_month);

            // Retrieve order IDs for the selected month and year
            $orders_total_month_ids = Order::where(function ($query) use ($ordersIds, $selected_date) {
                $query->whereIn('id', $ordersIds)  // Orders associated with the student
                ->whereIn('payment_method', ['knet', 'tabby', 'wallet'])  // Specific payment methods
                ->where('status', '!=', 'pending')  // Non-pending status
                ->whereYear('created_at', $selected_date->year)
                    ->whereMonth('created_at', $selected_date->month);  // Selected month
            })
                ->orWhere(function ($query) use ($ordersIds) {
                    $query->where('payment_method', 'cash')  // Cash payments
                    ->whereIn('id', $ordersIds)
                        ->whereMonth('created_at', Carbon::now()->month)  // Current month
                        ->whereYear('created_at', Carbon::now()->year);  // Current year
                })
                ->pluck('id')->toArray();

            // Calculate the total price for the selected month and year
            $orders_count_by_month = \DB::table('product_order')
                ->where('student_id', auth('student')->id())
                ->whereIn('order_id', $orders_total_month_ids)  // Filter by order_id list
                ->whereYear('created_at', $selected_date->year)
                ->whereMonth('created_at', $selected_date->month)  // Selected month
                ->selectRaw('SUM(end_price) as total_price')  // Calculate total price
                ->value('total_price');  // Get the sum value

            // Apply student percentage
            $orders_count_by_month = $orders_count_by_month * $student->student_percentage / 100;
        } else {
            $orders_count_by_month = null;
        }


        return view('student.pages.dashboard.index')->with([

            'products' => array_reverse($products),
            'student' => $student,
            'last_orders' => $orders,
            'orders_count' => $ordersCountNew,
            'orders_count_today' => $orders_count_today,
            'added_products_count' => $added_products_count,
            'orders_total_today'    => $orders_total_today,
            'orders_total_in_month' => $orders_total_this_month,
            'orders_count_in_month' => $orders_count_this_month,
            'student_percentage'    => $student_percentage,
            'student_total_percentage'    => $student_total_percentage,
            'orders_count_by_month'    => $orders_count_by_month
        ]);
    }

    public function addProduct(){

        $products = Product::whereNotIn('id',auth('student')->user()->products->pluck('id')->toArray())->get();

        return view('student.pages.products.add-product',compact('products'));

    }

    public function storeProduct(Request $request){

        //dd($request->all());
        $student_id = auth('student')->id();


        foreach ($request->get('product_ids') as $product_id){

            // check product this in the student

            $productFound = \DB::table('product_student')->where('student_id',$student_id)->where('product_id',$product_id)->first();

            if (!$productFound){

                // can create here

                $this->duplicateProduct($product_id, $student_id);

            }
        }

        return back()->with('success', 'تم اضافة المنتجات بنجاح');
    }


    public function duplicateProduct($productId, $studentId)
    {
        // Find the original product
        $originalProduct = Product::with(['attributes', 'categories', 'images', 'product_colors', 'product_sizes', 'statements', 'kurly', 'optionsValue'])->findOrFail($productId);

        // Duplicate the product
        $newProduct = $originalProduct->replicate();
        if (!$originalProduct->sale_price)
            $newProduct->sale_price = 0;
        $newProduct->save();

        // Duplicate product attributes
        foreach ($originalProduct->attributes as $attribute) {
            $newAttribute = $attribute->replicate();
            $newAttribute->product_id = $newProduct->id;
            $newAttribute->save();
        }

        // Duplicate product categories
        foreach ($originalProduct->categories as $category) {
            $newProduct->categories()->attach($category->id);
        }

        // Duplicate product images
        foreach ($originalProduct->images as $image) {
            $newImage = $image->replicate();
            $newImage->product_id = $newProduct->id;
            $newImage->save();
        }

        // Duplicate product colors
        foreach ($originalProduct->product_colors as $color) {
            $newColor = $color->replicate();
            $newColor->product_id = $newProduct->id;
            $newColor->save();
        }

        // Duplicate product sizes
        foreach ($originalProduct->product_sizes as $size) {
            $newSize = $size->replicate();
            $newSize->product_id = $newProduct->id;
            $newSize->save();
        }

        // Duplicate statements
        foreach ($originalProduct->statements as $statement) {
            $newStatement = $statement->replicate();
            $newStatement->product_id = $newProduct->id;
            $newStatement->save();
        }

        // Duplicate kurly
        foreach ($originalProduct->kurly as $k) {
            $newKurly = $k->replicate();
            $newKurly->product_id = $newProduct->id;
            $newKurly->save();
        }

        // Duplicate options value
        foreach ($originalProduct->optionsValue as $optionValue) {
            $newOptionValue = $optionValue->replicate();
            $newOptionValue->product_id = $newProduct->id;
            $newOptionValue->save();
        }

        // Associate the duplicated product with the student
        \DB::table('product_student')->insert([
            'product_id' => $newProduct->id,
            'student_id' => $studentId,
        ]);
    }



}
