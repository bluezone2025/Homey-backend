<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\cities_student;
use App\Models\OptionValue;
use App\Models\ProductVariant;
use App\Models\Setting;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use  App\Models\Item;
use  App\Models\Category;
use  App\Models\Slider;
use  App\Models\SubCategory;
use  App\Models\Product;
use  App\Models\ProdColor;
use App\Models\Country;
use App\Models\Area;
use App\Models\Coupon;

use App\Models\ShippingAddress;
use Carbon\Carbon;

use  App\Models\Order;
use  App\Models\ProductOrder as OrderItem;
use Illuminate\Support\Facades\Mail;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Matrix\Exception;
use RealRashid\SweetAlert\Facades\Alert;


class cartController extends Controller
{
    public function showInvoice($order_id){

        $order=Order::findOrFail($order_id);
        return view('front.cart.success')->with(['order' => $order]);

    }

    public function getCity(Request $request){
//        dd($request->all());
        $city_id = $request->city;

        $govern= Area::where('country_id',$city_id)->get();
//        dd($govern);
        if (!$govern) {
            return response()->json([
                'success' => false,
                'msg' => __('site.Can not find country  !!')
            ]);
        }

        $val = '';
        $delivery = '';
        foreach ($govern as $item){
            $delivery .= '<option value="' . $item->id .'">' . $item->name . '</option>';

        }

        return response()->json([
            'success' => true,
            'delivery' => $delivery
        ]);

    }

    public function getDelivery(Request $request){
        $govern_id = $request->city;
        if (!$govern_id ) {
            return response()->json([
                'success' => false,
                'msg' => __('site.Please Choose City  !!')
            ]);
        }
        $first_product = ($request->product_ids[0]);
        $brand_id = DB::table('product_student')->where('product_id',$first_product)->first();
        if ($brand_id){
            $student_id = $brand_id->student_id;
        }else{
            $student_id = null;
        }
        $max_days =  Product::wherein('id',$request->product_ids)->max('day_order');
        // dd($max_days);
        $govern=Area::where('id',$govern_id )->first();
        // dd($govern);
        if (!$govern) {
            return response()->json([
                'success' => false,
                'msg' => __('site.Can not find City  !!')
            ]);
        }

        if ($student_id != null){
            $shipping_item = cities_student::where('area_id',$govern_id)->where('student_id',$student_id)->first();
            if ($shipping_item){
                $shipping_price = $shipping_item->shipping_price;
            }else{
                $shipping_price = $govern->shipping_price;
            }
        }else{
            $shipping_price = $govern->shipping_price;
        }
        $val = get_price_helper($shipping_price);
        $val2 = get_price_helper2($shipping_price);
        $total=get_price_helper2($request->total);
        #dd($total);
        $total=round($total+ $shipping_price,1);
        $total=get_price_helper($total);
        $delivery = '';
        $delivery .= '<p style="color: red ;font-size: 18px" >'.__('site.The delivery cost for') .' ' .$govern->name .' : '.get_price_helper($shipping_price)."</p>";

        return response()->json([
            'success' => true,
            'delivery1' => $val,
            'shipping_cost' => $val2,
            'total1' => $total,
            'delivery' => $delivery,
            'order_day'=>$max_days,
        ]);

    }

    public function go_to_cart(){
//        dd(session('cart'));
        return view ("front.cart.cart");
    }

    public function checkout(){
        $cart = session()->get('cart');

        if($cart==[]){
            Alert::error('error Title', "cart is empty");
            return back();
        }

        return view("front.cart.checkout_en");
    }

    public function remove_from_cart(Request $request)
    {
        $cart = session()->get('cart');
        $productId = $request->id;
        $variantId = $request->variant_id;
        $key = $request->key;
        if ($variantId) {
            $cartKey = $productId . '_' . $variantId;
           // dd($cart);
            if (isset($cart[$cartKey])) {
                unset($cart[$cartKey]);

                // Remove the variant group if empty
                if (empty($cart[$cartKey])) {
                    unset($cart[$cartKey]);
                }
            }
        } else {
            if (isset($cart[$productId])) {
                //dd($cart[$productId]);
                unset($cart[$productId]);

                // Remove the product group if empty
                if (empty($cart[$productId])) {
                    unset($cart[$productId]);
                }
            }
        }

        session()->put('cart', $cart);
        session()->flash('keep_cart_open', true);

        session()->flash('success', trans('site.Product removed successfully'));
        return redirect()->back();
    }

    public function update_cart($item_id,$qut,$key,Request $request){
        //dd($item_id,$qut,$key);
        $cart = session()->get('cart');

        if($cart){

            if(isset($cart[$item_id])) {
                $cart[$item_id][$key]['quantity'] = $qut;
                session()->put('cart', $cart);
                $cart_item = CartItem::where('ip_address',\request()->ip())->where('product_id',$item_id)->first();
                #dd($cart_item);
                if ($cart_item){
                    $cart_item->quantity = $qut;
                    $cart_item->save();
                }
            }else{
                return get_response("0","error",1);
            }

        }else{
            return get_response("0","error",0);
        }

        $total = 0;
        session()->put('cart', $cart);
        if(count(session('cart')) > 0){
            foreach(session('cart') as $id => $details){
                foreach ($details as $key2 => $value) {
                    $total += $value['price'] * $value['quantity'] ;

                }
            }
        }
        return get_response("0","error",get_price_helper($total,true));

    }

    //get method
    public function add_to_cart($item_id,$qut,Request $request){

        $product = Product::findOrFail($item_id);
        #return redirect()->route("product",$item_id);
        $cart = session()->get('cart');
        $product = Product::findOrFail($item_id);
        // if cart is empty then this the first product
        if(!$cart) {
            $cart = [
                $item_id => [
                    "id" => $product->id,
                    "category_id"=>$product->vendor_id,
                    "option_id"=>$request->option_id,
                    "name" => $product->name,
                    "name_en" => $product->name_en,
                    "quantity" => $qut,
                    "price" =>  $product->if_sale ? $product->sale_price :$product->regular_price,
                    "image" => $product->img,
                    "slug" => $product->id
                ]
            ];
            session()->put('cart', $cart);
            return view("front.cart.cart");
            //return redirect()->route("cart")->with('success', 'تم اضافة المنتج الي السلة..');
        }else{
            if(isset($cart[$item_id])  ) {
                return view("front.cart.cart");

                //return redirect()->route("cart")->with('success', 'تم اضافة المنتج الي السلة..');

            }else{
                /*$vendor_id = $product->vendor_id ??0;
                foreach($cart as $k => $v) {
                    if($vendor_id != $v["category_id"]){
                        Alert::error('error Title', "Cart products must be from one Vendor, you can empty the cart");
                        return back();
                    }
                }*/

                $cart[$item_id] = [
                    "id" => $product->id,
                    "name" => $product->name,
                    "name_en" => $product->name_en,
                    "quantity" => $qut,
                    "price" =>$product->if_sale ? $product->sale_price :$product->regular_price,
                    "image" => $product->img,
                    "category_id"=>$product->vendor_id,
                    "option_id"=>$request->option_id,

                    "slug" => $product->id
                ];
                session()->put('cart', $cart);
                //print_r($cart);
                //die;
                session()->flash('success', 'تم اضافة المنتج الي السلة..');

                return view("front.cart.cart");

                #return redirect()->route("cart")->with('success', 'تم اضافة المنتج الي السلة..');
            }
        }


    }

    // In your CartController
    public function update(Request $request)
    {
        $cart = session()->get('cart');
        dd($request->all());

        if (isset($cart[$request->id])) {
            // For products without variants
            if ($request->variant_id === null) {
                if (isset($cart[$request->id][0])) {
                    $cart[$request->id][0]['quantity'] = $request->quantity;
                }
            }
            // For products with variants
            else {
                // Find the variant in cart
                $variantKey = $request->id . '_' . $request->variant_id;

                if (isset($cart[$variantKey])) {
                    $cart[$variantKey]['quantity'] = $request->quantity;
                } else {
                    // Handle case where variant exists but not found in cart
                    return response()->json([
                        'status' => 'error',
                        'message' => __('site.variant_not_found_in_cart')
                    ]);
                }
            }

            session()->put('cart', $cart);

            return response()->json([
                'status' => 'success',
                'cart_count' => $this->countCartItems(),
                'formatted_total' => get_price_helper($this->calculateCartTotal(), true)
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => __('site.product_not_found_in_cart')
        ]);
    }

    public function update2(Request $request)
    {
        $cart = session()->get('cart');
        $productId = $request->id;
        $variantId = $request->variant_id; // may be null if not using variant_id
        $key = $request->key; // combination string, like "Size:42-Color:Red"
        $quantity = (int) $request->quantity;

        $product = Product::with('variants')->find($productId);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => __('Product not found'),
            ], 200);
        }

        $cartKey = $variantId ? ($productId . '_' . $variantId) : ($key ?? $productId);

        if (!isset($cart[$cartKey])) {
            return response()->json([
                'success' => false,
                'message' => __('Item not found in cart'),
            ], 200);
        }

        // ✅ Check quantity for variant if applicable
        if ($variantId) {
            $variant = $product->variants->where('id', $variantId)->first();
            if (!$variant || $variant->quantity < $quantity) {
                return response()->json([
                    'success' => false,
                    'message' => __('site.error_in_quantity'),
                ], 200);
            }
        }
        else {
            // Simple product quantity check

            if ($product->quantity < $quantity) {
                return response()->json([
                    'success' => false,
                    'message' => __('site.error_in_quantity'),
                ], 200);
            }
        }

        // ✅ Update cart item quantity
        $cart[$cartKey]['quantity'] = $quantity;
        session()->put('cart', $cart);

        $itemPrice = $cart[$cartKey]['price'];

        // ✅ Recalculate total
        $total = 0;
        foreach ($cart as $items) {

            $product = \App\Models\Product::find($items['id']);
            $variant = isset($items['variant_id']) ? \App\Models\ProductVariant::find($items['variant_id']) : null;


            // Get the correct price
            if ($product->has_paid_variant){

                $price = $variant ? ($variant->discount_price ?: $variant->price) : ($product->if_sale ? $product->final_sale_price : $product->final_regular_price);

            }else{
                $price = $product->sale_price ? $product->final_sale_price : $product->final_regular_price;
            }
            $total += $price * $items['quantity'];
        }

        return response()->json([
            'success' => true,
            'message' => __('site.Cart updated successfully'),
            'cart'=>$cart,
            'item_price' => $itemPrice,
            'formatted_subtotal' => get_price_helper($itemPrice * $quantity, true),
            'total' => $total,
            'formatted_total' => get_price_helper($total, true)
        ]);
    }


    private function countCartItems()
    {
        $count = 0;
        $cart = session()->get('cart', []);

        foreach ($cart as $items) {
            if (is_array($items)) {
                foreach ($items as $item) {
                    $count += $item['quantity'];
                }
            }
        }

        return $count;
    }

    private function calculateCartTotal()
    {
        $total = 0;
        $cart = session()->get('cart', []);

        foreach ($cart as $items) {
            if (is_array($items)) {
                foreach ($items as $item) {
                    $total += $item['price'] * $item['quantity'];
                }
            }
        }

        return $total;
    }

    //post method
    public function add_to_cart_post_old(Request $request){
        $item_id = $request->item_id;
        $qut = $request->qut ;
        if($item_id =="" || $qut == ""){
            return back();
        }
        $cart = session()->get('cart');
        // dd( $cart);
        $product = Product::findOrFail($item_id);
        $attributes =  $request->has('attributes') ?  $request->input('attributes') : null;

        if($attributes){
            if(in_array(0,$attributes)){
                if($request->ajax()){
                    return response([
                        'status' => 'error',
                        'data'  => __('site.error_in_attributes') ,
                    ]);
                }

                return redirect()->back()->with('error',__('site.error_in_attributes'));

            }
            // $product->
            if($product-> is_clothes == 0){
                foreach ($product->options as $option) {

                    if(in_array($option->id,$attributes)){
                        if($option->quantity < $request->qut ){
                            if($request->ajax()){
                                return response([
                                    'status' => 'error',
                                    'data'  => __('site.error_in_quantity') ,
                                ]);
                            }
                            return redirect()->back()->with('error',__('site.error_in_quantity'));
                        }
                    }
                }
            }else{
                $ProdColor=ProdColor::where('product_id',$product->id)

                    ->where('color_id',@$attributes[7])
                    ->where('size_id',$attributes[6])
                    ->where('quantity','>=',$qut)->first();
                if(!$ProdColor){
                    if($request->ajax()){
                        return response([
                            'status' => 'error',
                            'data'  => __('site.error_in_quantity') ,
                        ]);
                    }
                    return redirect()->back()->with('error',__('site.error_in_quantity'));
                }

            }

        }
        else{
            if($product->quantity < $request->qut){
                if($request->ajax()){
                    return response([
                        'status' => 'error',
                        'data'  => __('site.error_in_quantity') ,
                    ]);
                }
                return redirect()->back()->with('error',__('site.error_in_quantity'));
            }
        }
        $brand_id = $product->students->first() ? $product->students->first()->id : 0;

        $ip = \request()->ip();
        $cart_item = CartItem::where('ip_address',$ip)->where('product_id',$item_id)->first();
        if ($cart_item){
            $cart_item->update(['quantity'=>$qut]);
        }else{
            CartItem::create([
                'product_id' => $item_id,
                'user_id' => auth('web')->check() ? auth('web')->id() : null,   // Store user_id for logged-in users
                'username' => auth('web')->check() ? auth('web')->user()->name : null,   // Store user_id for logged-in users
                'phone' => auth('web')->check() ? auth('web')->user()->phone : null,   // Store user_id for logged-in users
                'ip_address' => request()->ip(), // Store IP for guests
                'quantity' => $qut,
                'price' => $product->if_sale ? $product->sale_price :$product->regular_price,
            ]);
        }

        // if cart is empty then this the first product
        if(!$cart) {
            $cart = [
                $item_id =>[
                    0 =>[
                        "id" => $product->id,
                        "quantity" => $qut,
                        "price" =>  $product->if_sale ? $product->sale_price :$product->regular_price,// $product->price,
                        "brand_id"=>$brand_id,
                        "attributes"=>$attributes,
                    ]
                ]
            ];
            session()->put('cart', $cart);
            // dd( $cart);
            // return view("front.cart.cart");
            if($request->ajax()){
                return response([
                    'status' => 'success',
                    'data'  => __('site.addToCartDone') ,
                ]);
            }
            return redirect()->back()->with('success',__('site.addToCartDone'));
        }
        else{
            $old_product = Product::whereId($cart[array_key_first($cart)][0]['id'])->First();
            /*if($brand_id != $cart[array_key_first($cart)][0]['brand_id']){
                if($request->ajax()){
                    return response([
                        'status' => 'error',
                        'data'  => __('site.error_in_brand') ,
                    ]);
                }
                return redirect()->back()->with('error',__('site.error_in_brand'));
            }*/
            /*if($product->is_order != $old_product->is_order){
                if($request->ajax()){
                    return response([
                        'status' => 'error',
                        'data'  => __('site.error_is_order'.$product->is_order) ,
                    ]);
                }
                return redirect()->back()->with('error',__('site.error_is_order'.$product->is_order));
            }*/



            if(isset($cart[$item_id])) {
                $is_eq=0;
                foreach ($cart[$item_id] as $key =>  $value) {

                    if( $attributes == $value['attributes']){
                        $is_eq=1;
                        $cart[$item_id][$key]['quantity'] = $qut;
                        // dd($cart[$item_id]);

                    }
                    // dd( $cart);
                    // dd('false');

                }
                if($is_eq==0){
                    $new_cart =[
                        "id" => $product->id,
                        "quantity" => $qut,
                        "price" =>  $product->if_sale ? $product->sale_price :$product->regular_price,// $product->price,
                        "brand_id"=>$brand_id,
                        "attributes"=>$attributes,
                    ];
                    array_push($cart[$item_id],$new_cart);
                }
                session()->put('cart', $cart);
                // dd($cart);
                if($request->ajax()){
                    return response([
                        'status' => 'success',
                        'data'  => __('site.addToCartDone') ,
                    ]);
                }
                return redirect()->back()->with('success',__('site.addToCartDone'));

            }else{

                $cart[$item_id] = [
                    0 =>[
                        "id" => $product->id,
                        "quantity" => $qut,
                        "price" =>  $product->if_sale ? $product->sale_price :$product->regular_price,// $product->price,
                        "brand_id"=>$brand_id,
                        "attributes"=>$attributes,
                    ]
                ];
                session()->put('cart', $cart);
                if($request->ajax()){
                    return response([
                        'status' => 'success',
                        'data'  => __('site.addToCartDone') ,
                    ]);
                }
                return redirect()->back()->with('success',__('site.addToCartDone'));

            }
        }

    }

    public function add_to_cart_post(Request $request) {
         /* return response([
                'status' => 'success',
                'data' => $request->attribute,
            
            ]); */

       if($request->attribute){
         \Log::info('Selected Attributes:', $request->attribute);
       }
       if($request->variant_id){
        \Log::info(', Variant ID: ' . $request->variant_id);
       }
        \Log::info('Product ID: ' . $request->item_id  . ', Quantity: ' . $request->qut);

       $item_id = $request->item_id;
        $qut = $request->qut;
        $variant_id = $request->variant_id;
        $selected_attributes = $request->attribute;
        //dd($item_id,$qut,$variant_id,$selected_attributes);

        

        if ($item_id == "" || $qut == "") {
            return back();
        }

        $product = Product::findOrFail($item_id);
        $variant = null;
        $price = $product->regular_price;
        $sale_price = $product->sale_price;

        // If variant is selected, validate it
        if ($variant_id) {
            if ($product->has_paid_variant)
            {

                $variant = ProductVariant::where('product_id', $item_id)
                    ->where('id', $variant_id)
                    ->first();


                if ($variant) {
                    $price = $variant->price ?? $price;
                    $sale_price = $variant->discount_price>0 ?$variant->discount_price: $sale_price;

                    // Check variant quantity
                    if ($variant->quantity < $qut) {
                        return $this->cartErrorResponse($request, __('site.error_in_quantity'));
                    }
                } else {
                    return $this->cartErrorResponse($request, __('site.variant_not_found'));
                }
            }
            else{


                $variant = ProductVariant::where('product_id', $item_id)
                    ->where('id', $variant_id)
                    ->first();

                if ($variant) {
                    $price = $product->final_regular_price;
                    $sale_price = $product->final_sale_price;;

                    // Check variant quantity
                    if ($variant->quantity < $qut) {
                        return $this->cartErrorResponse($request, __('site.error_in_quantity'));
                    }
                } else {
                    return $this->cartErrorResponse($request, __('site.variant_not_found'));
                }
            }
        }
        else {
            // Check product quantity for non-variant products
            if ($product->quantity < $qut) {
                return $this->cartErrorResponse($request, __('site.error_in_quantity'));
            }
        }

        $brand_id = $product->students->first() ? $product->students->first()->id : 0;
        $ip = \request()->ip();

        // Find or create cart item
        $cart_item = CartItem::where('ip_address', $ip)
            ->where('product_id', $item_id)
            ->when($variant_id, function($query) use ($variant_id) {
                return $query->where('variant_id', $variant_id);
            })
            ->first();

        if ($cart_item) {
            $cart_item->update(['quantity' => $qut]);
        } else {
            CartItem::create([
                'product_id' => $item_id,
                'variant_id' => $variant_id,
                'user_id' => auth('web')->check() ? auth('web')->id() : null,
                'username' => auth('web')->check() ? auth('web')->user()->name : null,
                'phone' => auth('web')->check() ? auth('web')->user()->phone : null,
                'ip_address' => $ip,
                'quantity' => $qut,
                'price' => $sale_price ?: $price,
                'attributes' => $selected_attributes ? json_encode($selected_attributes) : null,

            ]);
        }

        // Handle session cart
        $cart = session()->get('cart', []);
        $cart_key = $item_id . ($variant_id ? '_' . $variant_id : '');

        

        $cart[$cart_key] = [
            "id" => $product->id,
            "variant_id" => $variant_id,
            "quantity" => $qut,
            "price" => $sale_price ?: $price,
            "brand_id" => $brand_id,
            "attributes" => $selected_attributes
        ];

        /*  return response([
                'status' => 'success',
                'data' => $cart,
            
            ]); */
        //dd($cart);

        session()->put('cart', $cart);

        return $this->cartSuccessResponse($request, __('site.addToCartDone'));

      
    }

    public function checkout_store(Request $request) {

        //dd($request->all());
        if(session('cart') and !empty(session('cart'))) {
            $rules = [
                'username' => 'required',
                'phone1' => 'nullable',
                'country' => 'required',
                'city' => 'required',
                'address' => 'nullable',
            ];

            $messages = [
                'username.required' => 'Please enter your username',
                'address.required' => 'Please enter the address',
                'phone.required' => 'Please enter the phone',
                'country.required' => 'Please choose country',
                'city.required' => 'Please enter the city',
            ];

            $valid = Validator::make($request->all(), $rules, $messages);
            if ($valid->fails()) {
                return back()->with('error', $valid->errors()->first());
            }

            // Update cart items with user info
            $cartItems = CartItem::where('ip_address', \request()->ip())->get();
            if (!$cartItems->isEmpty()) {
                CartItem::where('ip_address', \request()->ip())
                    ->update([
                        'username' => $request->get('username'),
                        'phone' => $request->get('phone')
                    ]);
            }

            // Check minimum order price
            $min_order_price = Setting::where('name', 'min_order_price')->select('name', 'value', 'description')->first();
            if ($min_order_price && $min_order_price->value > $request->price) {
                return back()->with('error', "Please complete the minimum order amount which is {$min_order_price->value} KWD");
            }

            // Save shipping address if not provided
            if (!$request->shipping_address_id) {
                $shipping_address = $this->saveShippingAddressId($request);
                $shipping_address_id = $shipping_address->id;
            }

            // Apply coupon discount
            $discount = $this->coupon($request->coupon_code, ($request->price + $request->discount_value));
            $coupon = $this->getCoupon($request->coupon_code, $request->price);

            $coupon_code = null;
            $coupon_discount = $discount;
            $coupon_id = null;
            if ($coupon){

                $coupon_code = $coupon->code;
                $coupon_id = $coupon->id;
            }
            //dd($request->all(),$discount);
            // Check if all products belong to the same brand
            $firstBrandId = null;
            $allEqual = true;

            foreach(session('cart') as $key => $item) {
                //dd($item);
                if (is_null($firstBrandId)) {
                    $firstBrandId = $item['brand_id'];
                } elseif ($item['brand_id'] != $firstBrandId) {
                    $allEqual = false;
                    break;
                }

            }

            // Determine shipping price
            if ($allEqual) {
                foreach(session('cart') as $key => $item) {
                    $product_data = Product::whereId($item['id'])->first();
                    $student_data = $product_data->students->first();
                    $student__data_id = $student_data ? $student_data->id : null;
                }

                if (isset($student__data_id)) {
                    $govern = cities_student::where('area_id', $request->city)
                        ->where('student_id', $student__data_id)
                        ->first();
                    if (!$govern) {
                        $govern = Area::where('id', $request->city)->first();
                    }
                } else {
                    $govern = Area::where('id', $request->city)->first();
                }
            } else {
                $govern = Area::where('id', $request->city)->first();
            }



            $val = $govern->shipping_price;
            $total = ($request->price + $govern->shipping_price) - $discount;



            // Determine payment method
            $payment_method = 'cash';
            if ($request->type == 'knet') {
                $payment_method = 'knet';
            }
            elseif ($request->type == "pay_with_wallet") {
                $payment_method = "wallet";
            }
            elseif ($request->type == "pay_with_tabby") {
                $payment_method = "tabby";
            }
            //dd($payment_method);

            // Wallet payment validation
            if ($request->type == "pay_with_wallet") {
                if (!auth('web')->check()) {
                    return back()->with('error', "Please login to use wallet");
                }

                $userWithWallets = User::where('id', auth('web')->id())
                    ->whereHas('wallets')
                    ->with(['wallets' => function ($query) {
                        $query->select('user_id',
                            DB::raw("SUM(CASE WHEN wallet_type = 'deposit' THEN amount ELSE 0 END) as total_deposit"),
                            DB::raw("SUM(CASE WHEN wallet_type = 'withdraw' THEN amount ELSE 0 END) as total_withdraw"))
                            ->groupBy('user_id');
                    }])
                    ->first();

                $total_wallet = 0;
                if ($userWithWallets) {
                    $totalDeposit = $userWithWallets->wallets->first()->total_deposit ?? 0;
                    $totalWithdraw = $userWithWallets->wallets->first()->total_withdraw ?? 0;
                    $total_wallet = $totalDeposit - $totalWithdraw;
                }

                if ($total_wallet < $total) {
                    return back()->with('error', "Insufficient wallet balance");
                }
            }


            // Create the order
            $save = Order::create([
                "note" => $request->note,
                "products_count" => 0,
                "order_price" => $request->price,
                "shipping_price" => $val,
                "total_price" => $total,
                "user_id" => $request->user_id,
                "shipping_address_id" => $shipping_address_id??null,
                "discount" => $discount,
                "coupon_code" => $coupon_code,
                "coupon_id" => $coupon_id,
                'payment_method' => $payment_method,
            ]);



            if ($save) {
                // Process each cart item
                foreach(session('cart') as $key => $item) {

                    $product = Product::whereId($item['id'])->first();
                    $variant = isset($item['variant_id']) ? ProductVariant::find($item['variant_id']) : null;

                    $student = $product->students->first();
                    $student_id = $student ? $student->id : 0;


                    // Determine price - variant price takes precedence
                    $price = $variant ? ($variant->final_discount_price ?: $variant->final_regular_price) :
                        ($product->in_sale ? $product->final_sale_price : $product->final_regular_price);



                    // Create order item
                    OrderItem::create([
                        "product_id" => $product->id,
                        //"variant_id" => $variant ? $variant->id : null,
                        "order_id" => $save->id,
                        "product_name" => $product->name,
                        "quantity" => $item['quantity'],
                        "sale_price" => $variant ? $variant->final_discount_price : $product->final_sale_price,
                        "regular_price" => $variant ? $variant->final_regular_price : $product->final_regular_price,
                        "attributes" => $variant ? $variant->full_combination: null,
                        "student_id" => $student_id,
                        "end_price" => $price * $item['quantity'],
                    ]);

                    // Update product quantity
                    if ($variant) {
                        $variant->decrement('quantity', $item['quantity']);
                    } else {
                        $product->decrement('quantity', $item['quantity']);
                    }

                    $save->increment('products_count', $item['quantity']);

                }

                // Update order totals
                $price = OrderItem::where('order_id', $save->id)->sum('end_price');
                $discount = $this->coupon($request->coupon_code, $price);

                $save->total_price = ($price + $govern->shipping_price) - $discount;
                $save->order_price = $price;
                $save->brand_id = $allEqual ? ($student_id ?? 0) : 0;
                $save->save();

                // Handle different payment methods
                if ($request->type == "knet") {
                    return redirect()->route('v2_payment', $save->id);
                }
                elseif ($request->type == "pay_with_tabby") {
                    $save->payment_method = "tabby";
                    $save->paid_by = 2;
                    $save->save();

                    $response = $this->payWithTabby(\Illuminate\Support\Facades\Request::merge(['order_id' => $save->id]));

                    if (($response['status']) == "created") {
                        $link = $response['configuration']['available_products']['installments'][0]['web_url'];
                    } else {
                        if ($response['status'] == "rejected") {
                            $reason = $response['configuration']['products']['installments']['rejection_reason'];
                            return back()->with('error', __("site.$reason"));
                        }
                        return back()->with('error', 'Payment status now '.$response['status'] . ' please try again');
                    }

                    return redirect($link);
                }
                elseif ($request->type == "pay_with_wallet") {
                    $save->status = "accept";
                    $save->paid_by = 3;
                    $save->save();



                    // Deduct from wallet
                    Wallet::create([
                        'user_id' => auth('web')->id(),
                        'wallet_type' => "withdraw",
                        'amount' => $total,
                        'order_id' => $save->id,
                        'title' => "New order"
                    ]);

                    // Send email notifications
                    $this->sendOrderNotifications($save);

                    session()->forget('cart');
                    CartItem::where('ip_address', \request()->ip())->delete();
                    if ($coupon){
                        $coupon->use = $coupon->use + 1 ;
                        $coupon->save();
                    }
                    return view('front.cart.success')->with(['order' => $save]);
                }
                else {
                    $save->status = "pending";
                    $save->save();

                    if ($coupon){
                        $coupon->use = $coupon->use + 1 ;
                        $coupon->save();
                    }

                    // Send email notifications
                    $this->sendOrderNotifications($save);

                    session()->forget('cart');
                    CartItem::where('ip_address', \request()->ip())->delete();
                    return view('front.cart.success')->with(['order' => $save]);
                }
            }
        } else {
            return back()->with('error', __('site.cart is empty'));
        }
    }

    // Helper function for sending emails
    protected function sendOrderNotifications($order) {
        if ($order->shipping_address->email != null) {
            $data['invoice'] = $order;
            $data["email"] = $order->shipping_address->email;
            $from = env('MAIL_FROM_ADDRESS');
            $data["subject"] = 'order';

            try{

                Mail::send('emails.orderStore', $data, function ($message) use ($data, $from) {
                    $message->from($from)->to($data["email"], $data["email"])
                        ->subject($data["subject"]);
                });
            }catch (\Exception $e){

            }
        }

    }

    public function  checkout_store_old (Request $request) {
       
        if(session('cart') and !empty(session('cart'))) {
            $rules = [
                'username' => 'required',
                'phone1' => 'nullable',
                'country' => 'required',
                'city' => 'required',
                'address' => 'nullable',

            ];
            $messages= [
                'username.required'  => 'Please enter your username',
                'address.required'  => 'Please enter the address',
                'phone.required'  => 'Please enter the phone',
                'country.required'  => 'Please choosse country ',
                'city.required'  => 'Please enter the city',
            ];

            $valid=Validator::make($request->all(),$rules, $messages);
            if ($valid->fails()) {
                return back()->with('error',$valid->errors()->first());
            }
            //dd($request->all());
            $cartItems = CartItem::where('ip_address', \request()->ip())->get();

            if ($cartItems->isEmpty()) {

            }else{
                CartItem::where('ip_address', \request()->ip())
                    ->update([
                        'username' => $request->get('username'),
                        'phone' => $request->get('phone')
                    ]);
            }


            $min_order_price = Setting::where('name' , 'min_order_price')->select('name' ,'value' , 'description')->first();

            $valueData = $min_order_price->value;
            if ($min_order_price){

                if ($min_order_price->value > $request->price){

                    return back()->with('error', " برجاء اتمام الحد الادني للطلب وهو $valueData د.ك ");
                }
            }

            //dd($min_order_price);


            if (!$request->shipping_address_id) {
                $shipping_address = $this->saveShippingAddressId($request);
                $shipping_address_id = $shipping_address->id;
            }

            $discount = $this->coupon($request->coupon_code ,  $request->price);

            $firstBrandId = null;
            $allEqual = true;


            foreach(session('cart') as $k => $items) {

                foreach ($items as $key => $v) {
                    // code...
                    if (is_null($firstBrandId)) {
                        $firstBrandId = $v['brand_id'];
                    } else {
                        if ($v['brand_id'] != $firstBrandId) {
                            $allEqual = false;
                            break 2; // Exit both loops
                        }
                    }

                    //$product_data = Product::whereId($k)->first();
                    //$student_data = $product_data->students->first();

                    //$student__data_id = $student_data ? $student_data->id : null;
                }
            }
            if ($allEqual){
                foreach(session('cart') as $k => $items) {

                    foreach ($items as $key => $v) {


                        $product_data = Product::whereId($k)->first();
                        $student_data = $product_data->students->first();

                        $student__data_id = $student_data ? $student_data->id : null;
                    }
                }
                if (isset($student__data_id)) {
                    $govern = cities_student::where('area_id', $request->city)->where('student_id', $student__data_id)->first();
                    if (!$govern)
                        $govern = Area::where('id', $request->city)->first();

                }else
                    $govern=Area::where('id',$request->city )->first();
            }else{

                $govern=Area::where('id',$request->city )->first();
            }




            $val = $govern->shipping_price;
            $total=($request->price + $govern->shipping_price )-$discount;
            $payment_method='cash';
            if($request->type=='knet'){
                $payment_method='knet';
            }elseif ($request->type == "pay_with_wallet"){
                $payment_method = "wallet";
            }

            if ($request->type == "pay_with_wallet" && auth('web')->check()){

                $userWithWallets = User::where('id', auth('web')->id()) // Filter to get only user with ID 1
                ->whereHas('wallets') // Ensure user has wallets
                ->with(['wallets' => function ($query) {
                    $query->select('user_id',
                        DB::raw("SUM(CASE WHEN wallet_type = 'deposit' THEN amount ELSE 0 END) as total_deposit"),
                        DB::raw("SUM(CASE WHEN wallet_type = 'withdraw' THEN amount ELSE 0 END) as total_withdraw"))
                        ->groupBy('user_id');
                }])
                    ->first(); // Retrieve the single result for user 1

                // Accessing the total deposit and withdraw values
                if ($userWithWallets){
                    $totalDeposit = $userWithWallets->wallets->first()->total_deposit ?? 0;
                    $totalWithdraw = $userWithWallets->wallets->first()->total_withdraw ?? 0;
                    $total_wallet = $totalDeposit - $totalWithdraw;
                }else{
                    $total_wallet = 0;
                }

                //dd($total_wallet);
                if ($total_wallet < $total){
                    return back()->with('error', "رصيد المحفظة غير كافي");
                }

            }

            if ($request->type == "pay_with_wallet" && !auth('web')->check()){
                return back()->with('error', "برجاء تسجيل الدخول لاستخدام المحفظة");
            }

            // dd(Order::first());
            $save = Order::create([
                "note" =>$request->note,
                "products_count" => 0,
                "order_price" => $request->price,
                "shipping_price" => $val,
                "total_price" => $total,
                "user_id"=>$request->user_id,
                "shipping_address_id" => $shipping_address_id,
                "discount" => $discount,
                'payment_method'=>$payment_method,
            ]);
            // dd($save);

            if($save){
                foreach(session('cart') as $k => $items) {
                    foreach ($items as $key => $v) {
                        // code...

                        $product=Product::whereId($k)->first();


                        $student = $product->students->first();
                        $student_id= $student ? $student->id : 0 ;

                        // "final_sale_price" => 773.0
                        // "final_regular_price" => 917.0
                        // dd(OrderItem::first());
                        $end_price =  $product->in_sale ? get_price_helper2($product->sale_price,true) : get_price_helper2($product->final_regular_price,true);
                        OrderItem::create([
                            "product_id"=>  $product->id,
                            "order_id"=> $save->id,
                            "product_name"=>$product->name,
                            "quantity"=>$v["quantity"],
                            "sale_price"=>$product->final_sale_price,
                            "regular_price"=>$product->final_regular_price,
                            "attributes"=>  json_encode($v["attributes"]),
                            "student_id"=>   $student_id,
                            "end_price"=>$end_price*$v["quantity"],
                        ]);

                        $save->increment('products_count',$v["quantity"]);
                    }
                }

                $price=OrderItem::where('order_id',$save->id)->sum('end_price');
                $discount = $this->coupon($request->coupon_code ,  $price);
                $save->total_price=($price + $govern->shipping_price )-$discount;
                $save->order_price=$price;
                //   dd($student_id);
                if ($allEqual){
                    $save->brand_id= $student_id??0;
                }else{
                    $save->brand_id= 0;
                }
                #$save->brand_id= $student_id;
                $save->save();

                if($request->type=="knet"){

                    //session()->forget('cart');
                    return redirect()->route('v2_payment',$save->id); //order id
                }
                elseif ($request->type == "pay_with_tabby"){

                    //dd('coming soon');

                    $save->payment_method = "tabby";
                    $save->paid_by = 2;
                    $save->save();

                    $response = $this->payWithTabby(\Illuminate\Support\Facades\Request::merge(['order_id' => $save->id]));


                    if (($response['status']) == "created"){
                        $link = $response['configuration']['available_products']['installments'][0]['web_url'];
                    }else{
                        if($response['status'] == "rejected"){
                            DB::rollback();
                            $reason= $response['configuration']['products']['installments']['rejection_reason'];
                            \session()->flash('error', __("site.$reason"));
                            Alert::error( __("site.$reason"),'');
                            return \redirect()->back();
                        }
                        DB::rollback();
                        \session()->flash('error','Payment status now '.$response['status'] . ' please try again');

                        Alert::error( 'Payment status now '.$response['status'] . ' please try again','');
                        return \redirect()->back();
                    }

                    DB::commit();

                    return redirect($link);
                }

                elseif ($request->type == "pay_with_wallet"){

                    $save->status="accept";
                    $save->paid_by = 3;
                    $save->save();
                    // remove the total amount from user wallet

                    Wallet::create([
                        'user_id'   => auth('web')->id(),
                        'wallet_type'   => "withdraw",
                        'amount'    => $total,
                        'order_id'  => $save->id,
                        'title' => "طلب جديد"
                    ]);

                    if($save->shipping_address->email !=null){
                        //   invoice
                        $data['invoice']=$save;
                        $data["email"]=$save->shipping_address->email;
                        $from=env('MAIL_FROM_ADDRESS');
                        $data["subject"]= 'order';

                        Mail::send('emails.orderStore', $data, function ($message) use ($data, $from) {
                            $message->from($from)->to($data["email"], $data["email"] )
                                ->subject($data["subject"]);
                        });
                    }


                    try{

                        $items = $save->productItems;

                        foreach ($items as $item) {
                            $attributes = json_decode($item->attributes, true);
                            $product = $item->product;
                            $quantityProduct = $item->quantity;

                            // Get all related products with the same barcode
                            $relatedProducts = Product::where('barcode', $product->barcode)
                                ->where('barcode', '!=', null)
                                ->where('id', '!=', $product->id)
                                ->get();

                            if ($product->is_clothes) {
                                $ProdColorQuantity = ProdColor::where('product_id', $product->id)->sum('quantity');

                                if ($product->quantity != $ProdColorQuantity) {
                                    $product->update([
                                        'quantity' => $ProdColorQuantity
                                    ]);
                                }
                            }

                            // Update main product quantity
                            $product->update([
                                'quantity' => \DB::raw("quantity - $quantityProduct")
                            ]);

                            // Update related products quantity
                            foreach ($relatedProducts as $relatedProduct) {
                                $relatedProduct->update([
                                    'quantity' => \DB::raw("quantity - $quantityProduct")
                                ]);
                            }

                            if (!$product->is_clothes) {
                                $option_value_id = $attributes[0]['id'] ?? null;
                                $optionValueRow = OptionValue::where('product_id', $product->id)
                                    ->where('option_id', $option_value_id)
                                    ->first();

                                if ($optionValueRow) {
                                    $optionValueRow->quantity -= $quantityProduct;
                                    $optionValueRow->save();

                                    // Update related products' option values
                                    foreach ($relatedProducts as $relatedProduct) {
                                        $relatedOptionValueRow = OptionValue::where('product_id', $relatedProduct->id)
                                            ->where('option_id', $option_value_id)
                                            ->first();

                                        if ($relatedOptionValueRow) {
                                            $relatedOptionValueRow->quantity -= $quantityProduct;
                                            $relatedOptionValueRow->save();
                                        }
                                    }
                                }
                            } else {
                                $ProdColor = ProdColor::where('product_id', $product->id)
                                    ->where('color_id', $attributes[0]['id'])
                                    ->where('size_id', $attributes[1]['id'])
                                    ->first();

                                if ($ProdColor) {
                                    $ProdColor->quantity -= $quantityProduct;
                                    $ProdColor->save();

                                    // Update related products' ProdColor
                                    foreach ($relatedProducts as $relatedProduct) {
                                        $relatedProdColor = ProdColor::where('product_id', $relatedProduct->id)
                                            ->where('color_id', $attributes[0]['id'])
                                            ->where('size_id', $attributes[1]['id'])
                                            ->first();

                                        if ($relatedProdColor) {
                                            $relatedProdColor->quantity -= $quantityProduct;
                                            $relatedProdColor->save();
                                        }
                                    }
                                }
                            }
                        }

                        $from=env('MAIL_FROM_ADDRESS');
                        $data['invoice'] = $save;

                        Mail::send('emails.orderStore', $data, function ($message) use ($data, $from) {
                            $message->from($from)->to("bdinarkd@gmail.com","bdinarkd@gmail.com")
                                ->subject("New Order");
                        });
                    }catch (Exception $e){

                    }
                    session()->forget('cart');
                    CartItem::where('ip_address',\request()->ip())->delete();
                    return view('front.cart.success')->with(['order'=>$save]);


                }


                else{
                    $save->status="pending";
                    if($save->shipping_address->email !=null){
                        //   invoice
                        $data['invoice']=$save;
                        $data["email"]=$save->shipping_address->email;
                        $from=env('MAIL_FROM_ADDRESS');
                        $data["subject"]= 'order';

                        Mail::send('emails.orderStore', $data, function ($message) use ($data, $from) {
                            $message->from($from)->to($data["email"], $data["email"] )
                                ->subject($data["subject"]);
                        });
                    }


                    try{

                        $items = $save->productItems;

                        foreach ($items as $item) {
                            $attributes = json_decode($item->attributes, true);
                            $product = $item->product;
                            $quantityProduct = $item->quantity;

                            // Get all related products with the same barcode
                            $relatedProducts = Product::where('barcode', $product->barcode)
                                ->where('barcode', '!=', null)
                                ->where('id', '!=', $product->id)
                                ->get();

                            if ($product->is_clothes) {
                                $ProdColorQuantity = ProdColor::where('product_id', $product->id)->sum('quantity');

                                if ($product->quantity != $ProdColorQuantity) {
                                    $product->update([
                                        'quantity' => $ProdColorQuantity
                                    ]);
                                }
                            }

                            // Update main product quantity
                            $product->update([
                                'quantity' => \DB::raw("quantity - $quantityProduct")
                            ]);

                            // Update related products quantity
                            foreach ($relatedProducts as $relatedProduct) {
                                $relatedProduct->update([
                                    'quantity' => \DB::raw("quantity - $quantityProduct")
                                ]);
                            }

                            if (!$product->is_clothes) {
                                $option_value_id = $attributes[0]['id'] ?? null;
                                $optionValueRow = OptionValue::where('product_id', $product->id)
                                    ->where('option_id', $option_value_id)
                                    ->first();

                                if ($optionValueRow) {
                                    $optionValueRow->quantity -= $quantityProduct;
                                    $optionValueRow->save();

                                    // Update related products' option values
                                    foreach ($relatedProducts as $relatedProduct) {
                                        $relatedOptionValueRow = OptionValue::where('product_id', $relatedProduct->id)
                                            ->where('option_id', $option_value_id)
                                            ->first();

                                        if ($relatedOptionValueRow) {
                                            $relatedOptionValueRow->quantity -= $quantityProduct;
                                            $relatedOptionValueRow->save();
                                        }
                                    }
                                }
                            } else {
                                /*$ProdColor = ProdColor::where('product_id', $product->id)
                                    ->where('color_id', $attributes[0]['id'])
                                    ->where('size_id', $attributes[1]['id'])
                                    ->first();

                                if ($ProdColor) {
                                    $ProdColor->quantity -= $quantityProduct;
                                    $ProdColor->save();

                                    // Update related products' ProdColor
                                    foreach ($relatedProducts as $relatedProduct) {
                                        $relatedProdColor = ProdColor::where('product_id', $relatedProduct->id)
                                            ->where('color_id', $attributes[0]['id'])
                                            ->where('size_id', $attributes[1]['id'])
                                            ->first();

                                        if ($relatedProdColor) {
                                            $relatedProdColor->quantity -= $quantityProduct;
                                            $relatedProdColor->save();
                                        }
                                    }
                                }
                                */
                            }
                        }

                        $from=env('MAIL_FROM_ADDRESS');
                        $data['invoice'] = $save;

                        Mail::send('emails.orderStore', $data, function ($message) use ($data, $from) {
                            $message->from($from)->to("bdinarkd@gmail.com","bdinarkd@gmail.com")
                                ->subject("New Order");
                        });
                    }catch (Exception $e){

                    }
                    session()->forget('cart');
                    CartItem::where('ip_address',\request()->ip())->delete();


                    return view('front.cart.success')->with(['order'=>$save]);
                }
            }


        }else{
            return back()->with('error',__('site.cart is empty'));
        }
    }





    public function v2_payment(Request $request,$order_id,$user_id = null){

        $order =  Order::find($order_id);


        $data = $this->makePayment(\Illuminate\Support\Facades\Request::merge(['order_id' => $order->id]));

        // dd($data);
        $json = json_decode($data->getContent(), true);

        $success =  $json['success'];

        if (!$success) {
            Alert::error($json['msg'], '');

            return back();
        }
        //mail here
        //        Mail::send('email.donePay',['name' => $request->name,'order_id'=>$order->id,'total_price'=>$request->total_price,'total_quantity'=>$request->total_quantity,'invoice_link'=>$order->invoice_link], function($message) use($request,$order){
        //            $message->to($request->email)
        //                ->from('sales@easyshop-qa.com', 'Example')
        //            ->subject('Pay done');
        //        });


        return redirect($json['link']);





    }


    public function success_payment($order_id,Request $request){



        $order = Order::findOrFail($order_id);
        $order->status = "accept";
        $order->paid_by = 2;
        $order->save();

        $this->sendOrderNotifications($order);

        $coupon = Coupon::find($order->coupon_id);
        if ($coupon){
            $coupon->use = $coupon->use + 1 ;
            $coupon->save();
        }
        session()->forget('cart');
        CartItem::where('ip_address',\request()->ip())->delete();
        return view('front.cart.success')->with(compact('order'));

    }


    /************** payment *********************/

    public function makePayment(Request $request): \Illuminate\Http\JsonResponse
    {

        if (!$request->order_id) {
            response()->json(
                [
                    'success' => false,
                    'msg' => 'Data Not Match Any Order !'
                ]
            );
        }

        $order = Order::find($request->order_id);

        if (!$order) {
            response()->json(
                [
                    'success' => false,
                    'msg' => 'Order is not exist !'
                ]
            );
        }

        //TODO :: GET USER PHONE
        $ShippingAddress=ShippingAddress::find($order->shipping_address_id);
        $country_code =$ShippingAddress->area != null ? ($ShippingAddress->area->country != null ? $ShippingAddress->area->country->code:"+965" ):"+965";
        $name=$ShippingAddress->name?:'Test Name';
        $email=$ShippingAddress->email?:'test@test.com';
        $phone=$ShippingAddress->phone?:'12345678';
        $success_url = route('success_payment',$order->id);
        $error_url = route('error_payment',$order->id);

        //        TODO :: VALIDATION FOR BOOKING  IF  MONEY ALREADY PAID


        /* ------------------------ Configurations ---------------------------------- */
        //Test

        // $password = $live ?env('UPAY_PASSWORD'):stripslashes('test');
        // $api_key = $live ?env('UPAY_API_KEY'):'jtest123';


        // $apiURL = 'https://apitest.myfatoorah.com';
        // $apiKey = 'rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL';
        //Live
        $apiURL = env('API_URL_MYFATOORAH') ;
        $apiKey = env('API_KEY_MYFATOORAH'); //Live token value to be placed here: https://myfatoorah.readme.io/docs/live-token


        /* ------------------------ Call SendPayment Endpoint ----------------------- */

        $order_item = OrderItem::where('order_id', $request->order_id)->get();
        $delivery_cost = $ShippingAddress->area;

         $invoiceItems = [];

    // منتجات الطلب
    foreach ($order_item as $item) {
        $invoiceItems[] = [
            'ItemName'  => $item->product_name,
            'Quantity'  => 1,
            'UnitPrice' => number_format($item->end_price, 3, '.', ''),
        ];
    }

    // تكلفة الشحن
    if ($order->shipping_price > 0) {
        $invoiceItems[] = [
            'ItemName'  => "Shipping cost",
            'Quantity'  => 1,
            'UnitPrice' => number_format($order->shipping_price, 3, '.', ''),
        ];
    }

    // الخصم (بالسالب)

    if ($order->discount > 0) {
        $invoiceItems[] = [
            'ItemName'  => "Discount",
            'Quantity'  => 1,
            'UnitPrice' => -number_format($order->discount, 3, '.', ''),
        ];
    }

    // جمع القيم للتأكد
    $totalItemsValue = 0;
    foreach ($invoiceItems as $i) {
        $totalItemsValue += $i['Quantity'] * $i['UnitPrice'];
    }

    //dd($invoiceItems);


        // dd(

        //dd($order->total_price,$invoiceItems);


        //Fill POST fields array
        $postFields = [
            //Fill required data
            'NotificationOption' => 'Lnk', //'SMS', 'EML', or 'ALL'
            'InvoiceValue' => number_format($totalItemsValue, 3, '.', ''),
            'CustomerName' => $name,
            //Fill optional data
            'DisplayCurrencyIso' => 'KWD',
            'MobileCountryCode'  => $country_code,
            'CustomerMobile'     => $phone,
            'CustomerEmail'      => $email ?? "no@gmail.com",
            'CallBackUrl'        => $success_url,
            'ErrorUrl'           =>  $error_url,
            'InvoiceItems'       => $invoiceItems,

        ];

        //Call endpoint
        $data = $this->sendPayment($apiURL, $apiKey, $postFields);
        // dd($data);
        //You can save payment data in database as per your needs
        $invoiceId = $data->InvoiceId;
        $paymentLink = $data->InvoiceURL;

        $order->invoice_id = $invoiceId;
        $order->invoice_link = $paymentLink;
        $order->save();


        return response()->json(
            [
                'success' => true,
                'link' => $paymentLink,
                'data' => $data,
                'order' => $order
            ]
        );
    }


    public function sendPayment($apiURL, $apiKey, $postFields)
    {
        $json = $this->callAPI("$apiURL/v2/SendPayment", $apiKey, $postFields);
        return $json->Data;
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

    public   function callAPI($endpointURL, $apiKey, $postFields = [], $requestType = 'POST')
    {
        //dd($postFields);

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

        // //Test
        // $apiURL = 'https://apitest.myfatoorah.com';
        // $apiKey = 'rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL';

        //Live
        $apiURL = env('API_URL_MYFATOORAH') ;
        $apiKey = env('API_KEY_MYFATOORAH'); //Live token value to be placed here: https://myfatoorah.readme.io/docs/live-token


        /* ------------------------ Call getPaymentStatus Endpoint ------------------ */
        //Inquiry using paymentId
        $keyId = $payment_id;
        $KeyType = 'paymentId';


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
    public function callBackUrl(Request $request)
    {
        //        dd($request->all());
        $payment_id = $request->paymentId;


        $invoice_data =  $this->getPaymentStatus($payment_id);
        //        return $invoice_data;
        $invoice_id = $invoice_data->original->InvoiceId;
        $invoice_status = $invoice_data->original->InvoiceStatus;

        //ORDER

        $order = Order::where('invoice_id', $invoice_id)->first();

        if (!$order) {
            //                    dd($request->all());

            Alert::error('Order is not Exist !');
            return redirect()->route('/');
        }
        session()->forget('coupon');

        $order->status = 1;
        $order->save();

        $coupon = Coupon::find($order->coupon_id);
        if ($coupon){
            $coupon->use = $coupon->use + 1 ;
            $coupon->save();
        }

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

        Session::forget('cart');
        Session::forget('cart_details');

        Alert::success('Payment Completed Successfully !', '');


        return redirect()->route('/')->with(['order' => $order]);
        //ORDER 1


        //ALERT


        //HOME

    }

    public function errorUrl(Request $request)
    {
        // dd($request->all());
        $payment_id = $request->paymentId;



        $invoice_data =  $this->getPaymentStatus($payment_id);
        //        return $invoice_data;
        $invoice_id = $invoice_data->original->InvoiceId;
        $invoice_status = $invoice_data->original->InvoiceStatus;

        $order = Order::where('invoice_id', $invoice_id)->first();
        // dd($order);
        session()->forget('coupon');


        Alert::error('Payment Not Completed !', '');

        return redirect()->route('/')->with(['order' => $order]);;
    }
    /**************************************/
    public function error_payment($order_id,Request $request){
        //  dd("error");
        $paymentId=$request->paymentId;
        $data=$this->getPaymentStatus($paymentId);

        $order = Order::findOrFail($order_id);
        $json = json_decode($data->getContent(), true);

        $data = Order::findOrFail($order_id);

        if($json['InvoiceStatus'] == "Paid"){
            return redirect()->route('success_payment',$order->id);

        }
        // return redirect()->route('v2_payment',$data->id);
        return view('front.cart.error');

    }

    private function saveShippingAddressId($request)
    {

        return ShippingAddress::create([

            'title' => $request->title ?? Carbon::now()->format('Y-m-d'),
            'name' => $request->username,
            'email' => $request->email ?? 'no@gmail.com',
            'phone' => $request->phone1?? $request->phone2,
            'area_id' => $request->city,
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
            'user_id' =>  $request->user_id,
            'delivered_by' =>  $request->delivered_by,
        ]);
    }
    private function coupon($coupon_code , $order_price){

        if ($coupon_code) {


            $coupon = Coupon::where('code' , $coupon_code)
                ->whereDate('end_date' , '>=' , Carbon::now()->format('Y-m-d'))
                ->where('is_active' , 1)
                ->where('min_price' , '<=', $order_price)
                ->first();



            if ($coupon) {

                 if ($coupon->use < $coupon->limit_use){
                    if ($coupon->type_discount === "percentage"):

                        $discount = ( $order_price * $coupon->discount) / 100;

                        return ($discount > $order_price) ? $order_price : $discount;

                    else:

                        $discount = $coupon->discount;

                        return ((integer)$discount > $order_price) ? $order_price : $discount;

                    endif;
                 }
                
                 return  0;

               


            }//end  if find coupon adn coupon limit not end

            return  0;
        } // end if find coupon_code in request

         return  0;
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


    public function payWithTabby(Request $request){

        //dd($request->all());

        $order = Order::find($request->get('order_id'));
        //$setting = Settings::first();


        $curl = curl_init();

        $order_id = $order->id;


        $total = $order->total_price;


        $total = number_format($total,2);

        $merchant_code = "trendatkwt";

        $createdAtOrder = $order->created_at;
        $iso8601DateOrder = Carbon::parse($createdAtOrder)->toIso8601String();

        $customer = User::find($order->user_id);
        if ($customer){

            $createdAt = $customer->created_at;
            $iso8601Date = Carbon::parse($createdAt)->toIso8601String();

            // get the order history
            $orders = Order::where('user_id', $customer->id)->where('status','!=','pending')->orderBy('id','desc')->take(5)->get();
            $array_items = [];
            foreach ($orders as $order2){

                $array_items[] = [
                    "purchased_at" => Carbon::parse($order2->created_at)->toIso8601String(),
                    "amount"    =>  (float)$order2->total_price,
                    "payment_method"=> "card",
                    "status" => "new",
                    "buyer" =>  [
                        "phone" => $order2->shipping_address->phone,
                        "email" => $order2->shipping_address->email,
                        "name"  => $order2->shipping_address->name
                    ],
                    "shipping_address"=> [
                        "city"=>$order2->shipping_address->region,
                        "address"=>$order2->shipping_address->address,
                        "zip"=>"123456"
                    ]
                ];
            }

            $lolatyLevel = Order::where('status','!=','pending')->where('user_id',$customer->id)->count();


        }
        else{
            // Specify the date you're interested in

            $lastOrder = Order::whereHas('shipping_address', function ($query) use ($order) {
                $query->where('email', $order->shipping_address->email);
            })
                ->where('id','!=',$order->id)
                ->where('status', '!=', 'pending')
                ->orderBy('id', 'desc')
                ->first();
            if ($lastOrder){
                $createdAt = $lastOrder->created_at;
                $iso8601Date = Carbon::create($createdAt)->toIso8601String();
            }else{
                $iso8601Date = Carbon::create(now())->toIso8601String();;
            }





            $orders_items = Order::whereHas('shipping_address', function ($query) use ($order) {
                $query->where('email', $order->shipping_address->email);
            })
                ->where('status', '!=', 'pending')
                ->orderBy('id', 'desc')
                ->take(5)->get();
            $array_items = [];
            foreach ($orders_items as $order2){

                $array_items[] = [
                    "purchased_at" => Carbon::parse($order->created_at)->toIso8601String(),
                    "amount"    =>  $order2->total_price,
                    "payment_method"=> "card",
                    "status" => "new",
                    "buyer" =>  [
                        "phone" => $order2->shipping_address->phone,
                        "email" => $order2->shipping_address->email,
                        "name"  => $order2->shipping_address->name
                    ],
                    "shipping_address"=> [
                        "city"=>$order2->shipping_address->region,
                        "address"=>$order2->shipping_address->address,
                        "zip"=>"123456"
                    ]
                ];
            }

            $lolatyLevel  =  Order::whereHas('shipping_address', function ($query) use ($order) {
                $query->where('email', $order->shipping_address->email);
            })
                ->where('status', '!=', 'pending')
                ->orderBy('id', 'desc')->count();

            #dd($order);

        }



        #dd($array_items);

        $orderItems = [];


        foreach ($order->productItems as $item){
            // Assuming $product is an instance of the Product model
            $firstCategory = $item->product->categories()->first();

            if ($firstCategory) {
                $firstCategoryName = $firstCategory->name_ar;

            } else {
                $firstCategoryName = 'منتجات';
            }
            $orderItems[] = [
                "title"=>$item->product->name_ar,
                "quantity"=> (int)$item->quantity,
                "unit_price"=> (float)$item->end_price,
                "category"=> $firstCategoryName
            ];
        }


        #dd($order);
        $coupon_amount = $order->discount?? 0;

        #dd($orderItems);
        //$total = $order->total_price + ($order->total_price * 7 / 100);
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.tabby.ai/api/v2/checkout',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
  "payment": {
    "amount": "'.$total.'",
    "currency": "KWD",
    "description": "Payment Description",
    "buyer": {
      "phone": "'.$order->shipping_address->phone.'",
      "email": "'.$order->shipping_address->email.'",
      "name": "'.$order->shipping_address->name.'"
    },
    "shipping_address": {
      "city": "'.$order->shipping_address->region.'",
      "address": "'.$order->shipping_address->address.'"
    },
    "order": {
      "tax_amount" : "0",
      "shipping_amount" : "0",
      "discount_amount" :"'.$coupon_amount.'",
      "reference_id": "'.$order->id.'",
      "items": '.json_encode($orderItems).'
    },


    "order_history": '. json_encode($array_items) .',


     "buyer_history": {
            "registered_since": "'.$iso8601Date.'",
            "loyalty_level": '.$lolatyLevel.'
        },

    "meta": {
      "order_id": "'.$order_id.'"
    }
  },
  "lang": "ar",
  "merchant_code": "'.$merchant_code.'",
  "merchant_urls": {
    "success": "'.env('TABBY_SUCCESS').'",
    "cancel": "'.env('TABBY_CANCEL').'",
    "failure": "'.env('TABBY_FAILURE').'"
  },
  "create_token": false,
  "token": null
}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer pk_01900622-e193-bf61-1422-411fc5df05f3',
                'Content-Type: application/json',
                'Cookie: _cfuvid=Fh6ApIZgOcXK7bZ2kIduqO_I0q4UZMMzvRwAfG70PkQ-1694644313415-0-604800000'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response,true);
        //dd($response);
        return $response;

        //dd($request->all());
    }

    public function tabbySuccess(Request $request){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.tabby.ai/api/v1/payments/' . $request->get('payment_id'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer sk_01900622-e193-bf61-1422-412044b10991'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $data = json_decode($response,true);

        $order_id = $data['order']['reference_id'];
        $order = Order::find($order_id );

        $order->payment_method = "tabby";
        $order->paid_by = 2;
        $order->status = "accept";

        $order->save();


        if($order->shipping_address->email !=null ){
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
            $items = $order->productItems;

            foreach ($items as $item) {
                $attributes = json_decode($item->attributes, true);
                $product = $item->product;
                $quantityProduct = $item->quantity;

                // Get all related products with the same barcode
                $relatedProducts = Product::where('barcode', $product->barcode)
                    ->where('barcode', '!=', null)
                    ->where('id', '!=', $product->id)
                    ->get();

                if ($product->is_clothes) {
                    $ProdColorQuantity = ProdColor::where('product_id', $product->id)->sum('quantity');

                    if ($product->quantity != $ProdColorQuantity) {
                        $product->update([
                            'quantity' => $ProdColorQuantity
                        ]);
                    }
                }

                // Update main product quantity
                $product->update([
                    'quantity' => \DB::raw("quantity - $quantityProduct")
                ]);

                // Update related products quantity
                foreach ($relatedProducts as $relatedProduct) {
                    $relatedProduct->update([
                        'quantity' => \DB::raw("quantity - $quantityProduct")
                    ]);
                }

                if (!$product->is_clothes) {
                    $option_value_id = $attributes[0]['id'] ?? null;
                    $optionValueRow = OptionValue::where('product_id', $product->id)
                        ->where('option_id', $option_value_id)
                        ->first();

                    if ($optionValueRow) {
                        $optionValueRow->quantity -= $quantityProduct;
                        $optionValueRow->save();

                        // Update related products' option values
                        foreach ($relatedProducts as $relatedProduct) {
                            $relatedOptionValueRow = OptionValue::where('product_id', $relatedProduct->id)
                                ->where('option_id', $option_value_id)
                                ->first();

                            if ($relatedOptionValueRow) {
                                $relatedOptionValueRow->quantity -= $quantityProduct;
                                $relatedOptionValueRow->save();
                            }
                        }
                    }
                } else {
                    $ProdColor = ProdColor::where('product_id', $product->id)
                        ->where('color_id', $attributes[0]['id'])
                        ->where('size_id', $attributes[1]['id'])
                        ->first();

                    if ($ProdColor) {
                        $ProdColor->quantity -= $quantityProduct;
                        $ProdColor->save();

                        // Update related products' ProdColor
                        foreach ($relatedProducts as $relatedProduct) {
                            $relatedProdColor = ProdColor::where('product_id', $relatedProduct->id)
                                ->where('color_id', $attributes[0]['id'])
                                ->where('size_id', $attributes[1]['id'])
                                ->first();

                            if ($relatedProdColor) {
                                $relatedProdColor->quantity -= $quantityProduct;
                                $relatedProdColor->save();
                            }
                        }
                    }
                }
            }
        }catch (\Exception $e){

        }

        session()->forget('cart');
        CartItem::where('ip_address',\request()->ip())->delete();

        #Alert::success('Payment Completed Successfully !', '');

        \session()->flash('success','تمت عملية الدفع بنجاح !');

        // send notification with paid
        /*if ($order->user){
            try{
                $this->notificationUSER($order->user, $order);

                if($order->user_id != null){
                    $FcmTokenModel= FcmTokenModel::where('user_id',$order->user_id)->first();
                    //dd($FcmTokenModel);
                    if (($FcmTokenModel && isset($FcmTokenModel->token ))){
                        self::save_notf($FcmTokenModel->token??$request->get('fcm_token'),
                            false ,'Order',$order->id ,1,$order,
                            $order->user_id);
                    }

                }
            }catch (\Exception $e){

            }

        }*/


        return view('front.cart.success')->with(compact('order'));






        //dd('Payment Completed and order is paid now');
        //dd(json_decode($response,true));

    }

    public function tabbyCancel(Request $request){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.tabby.ai/api/v1/payments/' . $request->get('payment_id'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer sk_01900622-e193-bf61-1422-412044b10991'
            ),
        ));

        $response = curl_exec($curl);

        $data = json_decode($response,true);

        $order_id = $data['order']['reference_id'];
        $order = Order::find($order_id );

        // delete order items
        DB::table('product_order')->where('order_id',$order_id)->delete();

        $order->delete();

        \session()->flash('error',__('site.tabby_cancel'));

        return redirect()->route('checkout');

    }

    public function tabbyFailure(Request $request){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.tabby.ai/api/v1/payments/' . $request->get('payment_id'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer sk_01900622-e193-bf61-1422-412044b10991'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response,true);

        //dd($data);

        $order_id = $data['order']['reference_id'];

        // delete order items
        DB::table('product_order')->where('order_id',$order_id)->delete();

        $order = Order::find($order_id );


        $order->delete();

        //Alert::error('', '');

        \session()->flash('error',__('site.tabby_cancel'));

        return redirect()->route('checkout');


    }

    private function cartErrorResponse($request, $message) {
        if ($request->ajax()) {
            return response([
                'status' => 'error',
                'data' => $message,
            ]);
        }
        return redirect()->back()->with('error', $message);
    }

    private function cartSuccessResponse($request, $message) {
        $cart = session('cart') ?? []; // أو session()->get('cart')
        $count = count($cart);
        if ($request->ajax()) {
            return response([
                'status' => 'success',
                'data' => $message,
                'cart_count' => $count,
                'ajax or not'=>'ajax',
            ]);
        }
    
        return redirect()->back()->with('success', $message);
    }

}
