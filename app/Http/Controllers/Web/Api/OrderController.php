<?php

namespace App\Http\Controllers\Web\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderRequest;
use App\Models\Area;
use App\Models\BoxOrder;
use App\Models\cities_student;
use App\Models\Coupon;
use App\Models\Option;
use App\Models\OptionValue;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\Setting;
use App\Models\ShippingAddress;
use App\Models\ProdColor;
use App\Models\Student;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Models\Notification;
use App\Models\FcmTokenModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

use Matrix\Exception;
use function Symfony\Component\Translation\t;
use DB;
class OrderController extends Controller
{
    private $order_price = 0;
    private $products_count = 0;
    private $unique_id;
    private $optionData = true;
    private $student_id = null;
    private $product_regular_price = 0;
    private $product_sale_price = 0;
    private $error = null;
    private $options = [];
    private $optionValueWanted = [];

    public function __construct()
    {

        $this->middleware('auth.guard:web-api')->except('save','shippingTime','getOrder','updateOrder','updateOrderTabby');

        if(request()->header('auth-token')){

            $this->middleware('auth.guard:web-api')->only('save','shippingTime','getOrder','updateOrder','updateOrderTabby');

        }
    }

    public function getOrder()
    {

        $order = Order::where('id', \request()->id)
            ->with([
                'products' => function ($query) {
                    $query->withTrashed(); // Include soft-deleted products
                },
                'products.subCategories', // Load subCategories for each product
                'shipping_address'
            ])
            ->first();

        if ($order) {
            // Transform attributes JSON to array
            foreach ($order->products as $product) {
                if ($product->pivot && $product->pivot->attributes) {
                    $decoded = json_decode($product->pivot->attributes, true);
                    $product->pivot->attributes = is_array($decoded) ? $decoded : null;
                }
            }
        }

        return response([
            'status' => $order ? Response_Success : Response_Fail,
            'order' => $order,
        ]);
    }
    public function shippingTime(Request $request)
    {

        $max = Product::wherein('id',$request->products)->max('day_order');


        return response(['status' => Response_Success , 'time' => $max]);

    }
    public function getOrders()
    {


        $paid_orders = auth()->user()
            ->orders()
            ->whereIn('payment_method',['knet','tabby','wallet'])
            ->whereIn('status',['accept','done','shipping'])
            ->with(['products' => function ($query) {
                $query->withTrashed(); // Retrieve soft deleted products
            }])
            ->orderBy('id', 'desc')
            ->get();

        $cash_orders = auth()->user()
            ->orders()
            ->where('payment_method','cash')
            ->with(['products' => function ($query) {
                $query->withTrashed(); // Retrieve soft deleted products
            }])
            ->orderBy('id', 'desc')
            ->get();

        return response([
            'status' => count($paid_orders) > 0 || count($cash_orders) > 0  ? Response_Success : Response_Fail,
            'paid_orders' => $paid_orders,
            'cash_orders' => $cash_orders,
        ]);
    }

    public function save(Request $request)
    {

        // start save shipping address




        $validator = \Validator::make($request->all(), (new OrderRequest())->rules());

        if ($validator->fails()) {

            return response([
                'status' => Response_Fail,
                'message' => $validator->errors()->all(),
            ]);
        }

        $shipping_address_id = $request->shipping_address_id;

        $area = Area::where('id' , $request->area_id)->first();


        if (!$area) {

            return response([
                'status' => Response_Fail,
                'message' => 'area not found',
            ]);
        }

        if (!$shipping_address_id) { // if not request shipping address id save data

            $shipping_address = $this->saveShippingAddressId($request);

            $shipping_address_id = $shipping_address->id;
        }
        // end save shipping address


        // start order

        if ( $this->foreachProducts($request) === false) {

            if ($this->error){

                return response([
                    'status' => Response_Fail,
                    'order' => $this->error,
                ]);
            }else{
                return response([
                    'status' => Response_Fail,
                    'order' => "error",

                ]);
            }
        }


        $order  = $this->saveDataOrder($request , $shipping_address_id , $area);
        $order = Order::where('id',$order->id)->with('products','shipping_address')->first();


        if ($order->areStudentIdsEqual()) {
            $first_product=$order->products->first();
            if($first_product){
                $st_pro= DB::table('product_student')->where('product_id',$first_product->id)->first();
                if($st_pro){
                    $order->brand_id= $st_pro->student_id;
                    $order->save();
                }
            }
        }
        if ($request->get('box_order_id')){
            $box_order = $box = BoxOrder::where('id',$request->get('box_order_id'))
                ->with('shipping_address')
                ->with('box', function ($q){$q->with('images');})->first();
        }else{
            $box_order = null;
        }











        return response([
            'status' => Response_Success,
            'order' => $order,
            'box_order' => $box_order,
        ]);

        //end order
    }

    private function foreachProducts($request)
    {
        $this->unique_id = random_int(100000, 90000000);

        // Parse all inputs while maintaining their order
        $productItems = [];

        // Split all comma-separated values
        $productIds = explode(',', $request->products_id);
        $quantities = $this->parseKeyValuePairs($request->quantity_products);
        $variantIds = $this->parseKeyValuePairs($request->variant_ids ?? '');
        $studentIds = $this->parseKeyValuePairs($request->student_id ?? '');
        $colorIds = $this->parseKeyValuePairs($request->color_id ?? '');

        // Create item entries maintaining their original order
        // Create item entries maintaining their original order
        foreach ($productIds as $index => $productId) {
            $item = [
                'product_id' => $productId,
                'quantity' => $quantities[$index] ?? 1, // Default to 1 if not specified
                'variant_id' => $variantIds[$index] ?? null,
                'student_id' => $studentIds[$index] ?? null,
                'color_id' => $colorIds[$index] ?? null,
            ];
            $productItems[] = $item;
        }


        //dd($productItems);
        // Now process each item
        foreach ($productItems as $item) {
            $product = Product::find($item['product_id']);
            if (!$product) {
                $this->error = __('Product not found: ') . $item['product_id'];
                return false;
            }

            $variant = null;
            if ($item['variant_id']) {
                $variant = $product->variants()->where('id', $item['variant_id'])->first();
                //dd($variant);
                if (!$variant) {
                    $this->error = __('Variant not found for product: ') . $product->name;
                    return false;
                }

                if ($variant->quantity < $item['quantity']) {
                    $this->error = __('Insufficient variant quantity for product: ') . $product->name;
                    return false;
                }

                if (!in_array(request()->get('payment_method'), ['knet', 'tabby'])) {
                    $variant->decrement('quantity', $item['quantity']);
                }


                if ($product->has_paid_variant){

                    $this->product_regular_price = $variant->price;
                    $this->product_sale_price = $variant->discount_price ?? 0;
                    $this->options = $variant->full_combination;
                }else{

                    $this->product_regular_price = $product->final_regular_price;
                    $this->product_sale_price = $product->final_sale_price;
                }

                //dd($this->product_regular_price ,$this->product_sale_price);

            } else {
                if ($item['quantity'] > $product->quantity) {
                    $this->error = __('Insufficient quantity for product: ') . $product->name;
                    return false;
                }

                if (!in_array(request()->get('payment_method'), ['knet', 'tabby'])) {
                    $product->decrement('quantity', $item['quantity']);
                }

                $this->product_regular_price = $product->final_regular_price;
                $this->product_sale_price = $product->final_sale_price;
            }

            $this->student_id = $item['student_id'];
            $this->priceProductAndUpdateOrderPrice($product, $item['quantity'],$variant);
            $this->saveProductOrder($product, $item['quantity'], $item['color_id'], $variant);
        }

        return true;
    }

    // New helper function that properly maintains order for duplicate product IDs
    private function parseKeyValuePairs($inputString)
    {
        $result = [];
        if (empty($inputString)) {
            return $result;
        }

        $pairs = explode(',', $inputString);
        foreach ($pairs as $pair) {
            if (strpos($pair, '=>') !== false) {
                [$key, $value] = explode('=>', $pair);
                $result[] = $value; // We only care about the value, order is maintained by array position
            } else {
                $result[] = $pair;
            }
        }

        return $result;
    }

    private function foreachProductsOld($request)
    {

        $this->unique_id = random_int(100000, 90000000);

        $products_id = explode(',', $request->products_id);
        //dd($products_id);

        $quantity_products = explode(',', $request->quantity_products);

        $students_id = explode(',', $request->student_id);

        $products = Product::whereIn('id', $products_id)->get(); // get request products

        if ($products->count() <= 0){return false;}
        //dd($products);

        $color_ids = explode(',', $request->color_id); // Extract color IDs

        $variant_ids = explode(',', $request->variant_ids ?? ''); // e.g. "12=>5,13=>6"

        //dd($variant_ids);
        $variantMap = [];

        foreach ($variant_ids as $pair) {
            if (strpos($pair, '=>') !== false) {
                [$prodId, $varId] = explode('=>', $pair);
                $variantMap[$prodId] = $varId;
            }
        }

        $products = Product::whereIn('id', $products_id)->get();

        if ($products->count() <= 0) {
            return false;
        }

        foreach ($products as $product) {


            // get quantity product
            $quantityProduct = $this->quantity_products($quantity_products, $product);
            $variantId = $variantMap[$product->id] ?? null;
            $variant = null;

            if ($variantId) {
                $variant = $product->variants()->where('id', $variantId)->first();

                if (!$variant || $variant->quantity < $quantityProduct) {
                    $this->error = __('site.insufficient_variant_quantity', ['product' => $product->name]);
                    return false;
                }

                if (request()->get('payment_method') != "knet" || request()->get('payment_method') != 'tabby') {
                    $variant->decrement('quantity', $quantityProduct);
                }

                $this->product_regular_price = $variant->price;
                $this->product_sale_price = $variant->discount_price ?? 0;
                $this->options = $variant->full_combination;
                $this->optionData = true;
            }else {
                // fallback to normal product stock
                if ($quantityProduct > $product->quantity) {
                    $this->error = __('site.insufficient_quantity', ['product' => $product->name]);
                    return false;
                }

                if ($this->updateQuantityOfProduct($quantityProduct, $product) === false) {
                    return false;
                }
            }




            $colorId = $this->getColorId($color_ids, $product); // Get color ID


            // get price product adn save order;
            $this->priceProductAndUpdateOrderPrice($product, $quantityProduct);

            // get student id
            $this->getStudentId($students_id , $product);

            // save product_order;
            $this->saveProductOrder($product, $quantityProduct, $colorId, $variant);

        }

        return  true;
    }


    private function getColorId($color_ids, $product)
    {
        foreach ($color_ids as $color) {
            if (strpos($color, "$product->id=>") !== false) {
                return explode('=>', $color)[1]; // Extract the color ID
            }
        }
        return null; // Return null if no color is selected
    }

    private function quantity_products($quantity_products, $product)
    {

        $quantityProduct = null;

        foreach ($quantity_products as $quantity) {



            if (strpos($quantity, "$product->id=>") !== false) {

                $quantityProduct = explode('=>', $quantity)[1];
                //dd($quantityProduct);
            }
        }

        //dd($quantity_products);

        return $quantityProduct;
    }

    //

    private function updateQuantityOfProduct($quantityProduct, $product)
    {

        if ($product->is_clothes) {
            $ProdColorQuantity = ProdColor::where('product_id', $product->id)->sum('quantity');

            if ($product->quantity != $ProdColorQuantity) {
                $product->update([
                    'quantity' => $ProdColorQuantity
                ]);
                // Update quantity for related products with same barcode
                foreach ($relatedProducts as $relatedProduct) {
                    $relatedProduct->update([
                        'quantity' => $ProdColorQuantity
                    ]);
                }
            }
        }

        if ($quantityProduct && $product->quantity >= $quantityProduct) {
            if (request()->get('payment_method') != "knet" || request()->get('payment_method') != 'tabby') {
                $product->update([
                    'quantity' => \DB::raw("quantity - $quantityProduct")
                ]);
            }

            $this->products_count += $quantityProduct;
            return true;
        }

        return false;
    }


    private function priceProductAndUpdateOrderPrice($product, $quantityProduct,$variant){
        if ($product->has_paid_variant){

            if ($variant){
                if ($variant->discount_price > 0) {
                    $this->order_price += get_price_helper2($variant->discount_price) * $quantityProduct;
                }else{
                    $this->order_price += get_price_helper2($variant->price) * $quantityProduct;
                }
            }else{
                if ($product->final_sale_price > 0) {

                    $this->order_price += get_price_helper2($product->final_sale_price)* $quantityProduct;

                } else {

                    $this->order_price += get_price_helper2($product->final_regular_price) * $quantityProduct;
                }
            }
        }else{
            if ($product->final_sale_price > 0) {

                $this->order_price += get_price_helper2($product->final_sale_price)* $quantityProduct;

            } else {

                $this->order_price += get_price_helper2($product->final_regular_price) * $quantityProduct;
            }
        }

        /*$optionValueWanted =  end(  $this->optionValueWanted);
//dd($this->options);
        {

            if ($product->in_sale) {

                $this->order_price += $product->final_sale_price > 0 ? $product->final_sale_price* $quantityProduct : $product->final_regular_price* $quantityProduct;

            } else {

                $this->order_price += $product->final_regular_price* $quantityProduct;
            }

            $this->product_regular_price = $product->final_regular_price ;

            $this->product_sale_price = $product->final_sale_price ;

        }

        $this->optionValueWanted = [];*/
    }

    private function getStudentId($students_id , $product){
    //    dd($students_id);
        foreach ($students_id as $student_id) {
  //          dd($student_id);
            list($prodId, $studId) = explode('=>', $student_id);
            if ($prodId == $product->id) {
                // Set the student_id
                $this->student_id = $studId;
                // Optionally, return or perform other actions as needed
                return $this->student_id;
            }

        }

    }

    private function saveProductOrder($product , $quantityProduct,$colorId =null,$variant = null){


        if (Cache::has('points_percentage')){

            $points_percentage = Cache::get('points_percentage');

        } else {

            $points_percentage =  Setting::where('name' , 'points_percentage')->first()->value;

            Cache::put('points_percentage', $points_percentage);
        }


        $end_price = $this->product_sale_price > 0 ? $this->product_sale_price : $this->product_regular_price;

        $points = (($end_price * $points_percentage)/100) * $quantityProduct;

        //dd($this->student_id);
        if ($this->optionData == true ){

            ProductOrder::create([
                'order_id' => $this->unique_id,
                'product_id' => $product->id,
                'product_name' => $product->name_ar .' | '.$product->name_en,
                'quantity' => $quantityProduct,
                'sale_price' => $this->product_sale_price,
                'regular_price' => $this->product_regular_price,
                'end_price' => $end_price,
                'attributes' => $variant ? $variant->full_combination : null,
                #'variant_id'    => $variant? $variant->id :null,
                'student_id' => $this->student_id,
                'color_id' => $colorId, // Save color ID
                'points' => $points,
            ]);

        }



        if ($this->student_id) {

            Student::where('id' , $this->student_id)->update([
                'points' => \DB::raw("points+$points"),
            ]);
        }

        $this->options = [];
        $this->product_regular_price = 0 ;
        $this->product_sale_price = 0;
        $this->student_id = null;


    }

    private function saveDataOrder($request , $shipping_address_id ,$area){


        if ($request->get('box_order_id')){
            $box_order = BoxOrder::find($request->get('box_order_id'));
            $box_order->update([
                'shipping_address_id'   => $shipping_address_id
            ]);
            $shipping_price = 0;
            $box_order_id = $request->get('box_order_id');

            // send box email


            if ($box_order->shipping_address->email !=null){
                try{
                    $data['invoice']=$box_order;
                    $data["email"]=$box_order->shipping_address->email ;

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
                $data['invoice']=$box_order;
                $from=env('MAIL_FROM_ADDRESS');
                Mail::send('emails.boxStore', $data, function ($message) use ($data, $from) {
                    $message->from($from)->to("bdinarkd@gmail.com","bdinarkd@gmail.com")
                        ->subject("New Box Order");
                });
            }catch (Exception $e){

            }


        }else{
            // add shipping price here


            $box_order_id = null;
        }


        if ($this->student_id != null || $this->student_id != 0){
            // check the student has the value for this area or no
            $area2 = cities_student::where('student_id',$this->student_id)->where('area_id',$area->id)->first();
            if ($area2){

                $shipping_price = $area2->shipping_price;
            }else{
                $shipping_price = $area->shipping_price;
            }
        }else{
            $shipping_price = $area->shipping_price;
        }

        $discount = $this->coupon($request->coupon_code , $this->order_price);
        $coupon = $this->getCoupon($request->coupon_code , $this->order_price);
        $coupon_code = null;
        $coupon_discount = $discount;
        $coupon_id = null;
        if ($coupon){

            $coupon_code = $coupon->code;
            $coupon_id = $coupon->id;
        }
        $total = ($shipping_price + $this->order_price) - $discount;
        if ($request->get('payment_method') == "wallet" && auth()->user()->total_wallet < $total){
            return response([
                'status' => Response_Fail,
                'order' => __('There is an error in the wallet'),
            ]);
        }

        $order = Order::create([
            'products_count' => $this->products_count,
            'shipping_price' => $shipping_price,
            'discount' => $discount,
            'coupon_code' => $coupon_code,
            'coupon_id' => $coupon_id,
            'order_price' => $this->order_price,
            'payment_method' => $request->payment_method,
            'note' => $request->note,
            'status' => 'pending',
            'shipping_address_id' => $shipping_address_id,
            'total_price' => ($shipping_price + $this->order_price) - $discount,
            'user_id' => auth()->id(),
            'box_order_id' => $box_order_id,
        ]);

        ProductOrder::where('order_id', $this->unique_id)->update([

            'order_id' => $order->id
        ]);

        if ($request->get('payment_method') == "cash"){

            if($order->shipping_address->email !=null){
                //   invoice
                $data['invoice']=$order;
                $data["email"]=$order->shipping_address->email;

                $from=env('MAIL_FROM_ADDRESS');
                $data["subject"]= 'order';

                try{
                    if ($coupon){
                        $coupon->use = $coupon->use + 1 ;
                        $coupon->save();
                    }
                    Mail::send('emails.orderStore', $data, function ($message) use ($data, $from) {
                        $message->from($from)->to($data["email"], $data["email"] )
                            ->subject($data["subject"]);
                    });
                }catch (\Exception $e){

                }
            }

            try{
                /*$data['invoice']=$order;
                $from=env('MAIL_FROM_ADDRESS');
                Mail::send('emails.orderStore', $data, function ($message) use ($data, $from) {
                    $message->from($from)->to("bdinarkd@gmail.com","bdinarkd@gmail.com")
                        ->subject("New Box Order");
                });*/
            }catch (Exception $e){

            }
        }
        elseif ($request->get('payment_method') == "wallet"){
            $order->status="accept";
            $order->paid_by = 3;
            $order->save();
            // remove the total amount from user wallet

            Wallet::create([
                'user_id'   => auth()->id(),
                'wallet_type'   => "withdraw",
                'amount'    => ($shipping_price + $this->order_price) - $discount,
                'order_id'  => $order->id,
                'title' => "طلب جديد"
            ]);

            if($order->shipping_address->email !=null){
                //   invoice
                $data['invoice']=$order;
                $data["email"]=$order->shipping_address->email;

                $from=env('MAIL_FROM_ADDRESS');
                $data["subject"]= 'order';

                Mail::send('emails.orderStore', $data, function ($message) use ($data, $from) {
                    $message->from($from)->to($data["email"], $data["email"] )
                        ->subject($data["subject"]);
                });
            }

            try{
                $data['invoice']=$order;
                $from=env('MAIL_FROM_ADDRESS');
                Mail::send('emails.orderStore', $data, function ($message) use ($data, $from) {
                    $message->from($from)->to("bdinarkd@gmail.com","bdinarkd@gmail.com")
                        ->subject("New Box Order");
                });
            }catch (Exception $e){

            }

            if ($coupon){
                $coupon->use = $coupon->use + 1 ;
                $coupon->save();
            }
        }

        return $order;

    }


    private function saveShippingAddressId($request)
    {

        return ShippingAddress::create([

            'title' => $request->title ?? Carbon::now()->format('Y-m-d'),
            'name' => $request->name,
            'delivered_by' => $request->delivered_by?? "address",
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


    private function coupon($coupon_code , $order_price){

        if ($coupon_code) {


            $coupon = Coupon::where('code' , $coupon_code)
                ->whereDate('end_date' , '>=' , Carbon::now()->format('Y-m-d'))
                ->where('is_active' , 1)
                ->where('min_price' , '<=', $order_price)
                ->first();

            if ($coupon && ($coupon->use < $coupon->limit)) {


                if ($coupon->type_discount === "percentage"):

                    $discount = ( $order_price * $coupon->discount) / 100;

                    return ((integer)$discount > $order_price) ? $order_price : $discount;

                else:

                    $discount = $coupon->discount;

                    return ((integer)$discount > $order_price) ? $order_price : $discount;

                endif;


            }//end  if find coupon adn coupon limit not end

            return  0;
        } // end if find coupon_code in request

        return 0;
    }

    private function getCoupon($coupon_code , $order_price){

        if ($coupon_code) {


            $coupon = Coupon::where('code' , $coupon_code)
                ->whereDate('end_date' , '>=' , Carbon::now()->format('Y-m-d'))
                ->where('is_active' , 1)
                ->where('min_price' , '<=', $order_price)
                ->first();

            if ($coupon) {

                if ($coupon->use < $coupon->limit_use){

                    return $coupon;
                }

                return  null;




            }//end  if find coupon adn coupon limit not end

            return  null;
        } // end if find coupon_code in request

        return  null;
    }

    public function updateOrder(Request $request)
    {

      $order=Order::whereId($request->order_id)->first();
        if(!$order){
            // write log here
            \Log::info($request->order_id);
            return response([
                'status' => Response_Fail,
                'order' => __('Order Not Found'),
            ]);
        }

      // update quantities
      $items = $order->productItems;

      /*
       *
       * */

      $order->payment_method = 'knet';
      $order->status = 'accept';
      $order->paid_by = 1;
      $order->invoice_id = $request->get('invoice_id');
      $order->invoice_link = $request->get('invoice_link');
      $order->save();


        // Update the quantities
        foreach ($items as $item) {
            $attributes = json_decode($item->attributes, true);
            $product = $item->product;
            $quantityProduct = $item->quantity;



            // Update main product quantity
            $product->update([
                'quantity' => \DB::raw("quantity - $quantityProduct")
            ]);

        }

        if($order->shipping_address->email !=null){
            //   invoice
            $data['invoice']=$order;
            $data["email"]=$order->shipping_address->email;

            $from=env('MAIL_FROM_ADDRESS');
            $data["subject"]= 'order';

            try{

                Mail::send('emails.orderStore', $data, function ($message) use ($data, $from) {
                    $message->from($from)->to($data["email"], $data["email"] )
                        ->subject($data["subject"]);
                });
            }catch (\Exception $e){

            }
        }

        try{
            $data['invoice']=$order;
            $from=env('MAIL_FROM_ADDRESS');
            Mail::send('emails.orderStore', $data, function ($message) use ($data, $from) {
                $message->from($from)->to("bdinarkd@gmail.com","bdinarkd@gmail.com")
                    ->subject("New Box Order");
            });

            $coupon = Coupon::find($order->coupon_id);
            if ($coupon){
                $coupon->use = $coupon->use + 1 ;
                $coupon->save();
            }

        }catch (Exception $e){

        }

      return response([
          'status' => Response_Success,
          'order' => $order,
      ]);

    }

    public function updateOrderTabby(Request $request)
    {

        $order=Order::whereId($request->order_id)->first();
        if(!$order){
            // write log here
            \Log::info($request->order_id);
            return response([
                'status' => Response_Fail,
                'order' => __('Order Not Found'),
            ]);
        }

        // update quantities
        $items = $order->productItems;

        /*
         *
         * */

        $order->payment_method = 'tabby';
        $order->status = 'accept';
        $order->paid_by = 2;
        $order->save();


        foreach ($items as $item) {
            $attributes = json_decode($item->attributes, true);
            $product = $item->product;
            $quantityProduct = $item->quantity;


            // Update main product quantity
            $product->update([
                'quantity' => \DB::raw("quantity - $quantityProduct")
            ]);

        }

        if($order->shipping_address->email !=null){
            //   invoice
            $data['invoice']=$order;
            $data["email"]=$order->shipping_address->email;

            $from=env('MAIL_FROM_ADDRESS');
            $data["subject"]= 'order';

            try{

                Mail::send('emails.orderStore', $data, function ($message) use ($data, $from) {
                    $message->from($from)->to($data["email"], $data["email"] )
                        ->subject($data["subject"]);
                });
            }catch (\Exception $e){

            }
        }

        try{
            $coupon = Coupon::find($order->coupon_id);
            if ($coupon){
                $coupon->use = $coupon->use + 1 ;
                $coupon->save();
            }

            $data['invoice']=$order;
            $from=env('MAIL_FROM_ADDRESS');
            Mail::send('emails.orderStore', $data, function ($message) use ($data, $from) {
                $message->from($from)->to("bdinarkd@gmail.com","bdinarkd@gmail.com")
                    ->subject("New Box Order");
            });
        }catch (Exception $e){

        }


        return response([
            'status' => Response_Success,
            'order' => $order,
        ]);

    }

    function notificationUSER($user,$order)
    {



        if ($user && $user->device_token){
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
            \Log::info($response);
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
        }else{
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

}
