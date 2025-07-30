<?php

namespace App\Http\Controllers\front;

use App\BestSeller;
use App\City;
use App\Country;
use App\FcmTokenModel;
use App\Height;
use App\Http\Controllers\Controller;
use App\Notification;
use App\Order;
use App\OrderItem;
use App\ProdHeight;
use App\ProdSize;
use App\Product;
use App\User;
use App\Settings;
use App\View;
use Auth;

//use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Lang;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }


    public function getHeights(Request $request)
    {

        $size_id = $request['size_id'];
        $size = ProdSize::find($size_id);
        $heights = ProdHeight::where([
            'product_id' => $size->product_id,
            'size_id' => $size->size_id
        ])->get();


        $heights_if_without = ProdHeight::where([
            'product_id' => $size->product_id,
            'size_id' => $size->size_id,
            'height_id' => 1
        ])->first();

        $val = '';
        if (!$size->isAvailable()) {
            $val .= '<p style="text-align: center;font-weight: bold">
 نفذت الكميه
</p>';
        } else {
            //CHECK IF COUNT MORE THAN 1 OR LESS THAN ONE

            if (Lang::locale() == 'en') {
                if(!$heights_if_without){
                $val .= '<div id="s" class="color-blocks" style="font-weight: bold">
                <span class="b">Color : </span>';
                }else{
                    $val .= ' <div id="s" class="color-blocks" style="font-weight: bold">';
                }
            } else {
                if(!$heights_if_without){
                $val .= '<div id="s" class="color-blocks" style="font-weight: bold">
                <span class="a">اللون: </span>';}
                else{
                    $val .= ' <div id="s" class="color-blocks" style="font-weight: bold">';
                }
            }


            if ($heights->count() < 1) {


                $val .= '
            المنتج غير متاح حاليا
            ';
            } else {
                if($heights_if_without){
                    if ($heights_if_without->quantity >= 1) {
                        $val .= '  <div class="radio-inline color d-none">'
                            . '<input type="radio"  name="height" value="' . $heights_if_without->id . '" id="height-' . $heights_if_without->id . '" checked>'
                            . '<label for="height-' . $heights_if_without->id . '" >' . $heights_if_without->height->name . '</label>'
                            . '</div>';
                    }

                }else{
                   foreach ($heights as $height) {

                    if ($height->quantity >= 1) {
                        $val .= '  <div class="radio-inline color">'
                            . '<input type="radio" name="height" value="' . $height->id . '" id="height-' . $height->id . '">'
                            . '<label for="height-' . $height->id . '" >' . $height->height->name . '</label>'
                            . '</div>';
                    }
                }
                }

            }


            $val .= ' </div>';
        }

        return response()->json($val);
    }

    public function addToCart(Request $request)
    {

        if (!is_array(Session::get('cart'))) {
            Session::forget('cart');
            //            return   Session::get('cart');
        }
        //
        //        $cart = Session::get('cart');
        //
        //        $cart[$product[0]->id] = array(
        //            "id" => $product[0]->id,
        //            "nama_product" => $product[0]->nama_product,
        //            "harga" => $product[0]->harga,
        //            "pict" => $product[0]->pict,
        //            "qty" => 1,
        //        );
        //
        //        Session::put('cart', $cart);
        //        Session::flash('success','barang berhasil ditambah ke keranjang!');
        //

        //        Session::forget('cart');
        $product = $request->except('_token');
        // dd($product);

        $cart = Session::get('cart');

        $cart_details = Session::get('cart_details');

        $current_product = Product::find($product['product_id']);

        // dd($current_product->basic_category->type);
        if($current_product->basic_category->type == 1){
            $current_height = ProdHeight::where('product_id',$product['product_id'])->where('height_id',0)->where('size_id',0)->first();
            // dd($current_height->quantity);
        }else{
        $current_height = ProdHeight::find($product['product_height_id']);
        }
        // dd($product,$current_product,$current_height);


        if ($product['quantity'] > $current_height->quantity) {

            Alert::error('الكميه الموجوده حاليا لهذا المقاس اقل من الكميه المطلوبه !');

            return back();
        }

        if (isset($cart[$product['product_id']][$product['product_height_id']])) :
            $cart[$product['product_id']][$product['product_height_id']]['quantity'] += $product['quantity'];
        else :
            $cart[$product['product_id']][$product['product_height_id']] = $product;
            $cart[$product['product_id']][$product['product_height_id']]['quantity'] = $product['quantity']; // Dynamically add initial qty
        endif;

        Session::put('cart', $cart);
        // dd(Session::get('cart') );
        $total_price = 0;
        $total_qty = 0;

        if (count($cart) > 0) {
            foreach ($cart as $key => $item) {
                if (count($item) > 0) {
                    foreach ($item as $i) {
                        $total_price += Product::find($key)->price * intval($i['quantity']);
                        $total_qty += intval($i['quantity']);
                        //                        $total_price = $i;
                    }
                }
            }
        }


        $cart_details['totalPrice'] = $total_price;
        $cart_details['totalQty'] = $total_qty;

        Session::put('cart_details', $cart_details);

        return response()->json(
            [
                'success' => true,
                'cart_items' => count(Session::get('cart')),
                'message' => 'Cart updated.',
                'cart_data' => Session::get('cart'),
                'cart_details' => Session::get('cart_details'),

            ]
        );

        //
        //
        //        $product_id =  $request->product_id;
        //        $quantity =  $request->quantity;
        //        $product_size_id =  $request->product_size_id;
        //        $product_height_id =  $request->product_height_id;
        //        $_SESSION['cart'][] = array(
        //            'id' => $product_id,
        //            'qty' => $quantity,
        //            'size' => $product_size_id,
        //            'height' => $product_height_id
        //        );
    }

    public function viewFromCart()
    {

        $cart = Session::get('cart');


        //        $products = Product::latest()->take(1)->get();

        $val = '';

        foreach ($cart as $key => $cart_item) {

            if ($key === array_key_first($cart)) {
                if ($cart_item && ($cart_item != '')) {
                    foreach ($cart_item as $k => $product_details) {
                        if ($k === array_key_first($cart_item)) {
                            if ($product_details && ($product_details != '')) {

                                $product = Product::find($product_details['product_id']);

                                $val .= '  <div>'
                                    . '<div id="cart-content" class=" row">'
                                    . '  <div class="col-3 pad-0">'
                                    . ' <img src=" ' . asset('/storage/' . $product->img) . '" width="50">'
                                    . ' </div>'
                                    . '<div class="col-8">'
                                    . ' <h6><a href="' . route('product', $product->id) . '" class="main-color">'
                                    . $product->title_en . ' - ' . $product->basic_category->name_en . ' - ' . $product->category->name_en .
                                    '</a></h6>'
                                    . '  <p> ' . ProdHeight::find($product_details['product_height_id'])->height->name . ' , '
                                    . ProdSize::find($product_details['product_size_id'])->size->name . '</p>';
                                //=======
                                $val .= '<h6>  ' . $product_details['quantity'] . ' * ';

                                if (Auth::check()) {
                                    $val .= Auth::user()->getPrice($product->price) . ' ';
                                    $val .= Auth::user()->country->currency->code;
                                } else {
                                    if (Cookie::get('name')) {
                                        $val .= number_format(($product->price / Country::find(Cookie::get('name'))->currency->rate), 2) . ' ';

                                        $val .= Country::find(Cookie::get('name'))->currency->code;
                                    } else {

                                        $val .= $product->price . ' KWD';
                                    }
                                    //

                                }



                                $val .=  '</h6> </div>'
                                    . ' <div class="col-1 pad-0">'
                                    . '<a class="  circle " style="padding:5px 10px" id="delete-circle" href="'
                                    . route('remove.from.shopping.cart', [$product_details['product_id'], $product_details['product_height_id']]) . '">
  <i class="fas fa-times ">

</i></a>'
                                    . ' </div>'
                                    . ' </div>'
                                    . ' <hr>';
                            }
                        }
                    }
                }
            }
        }

        $cart_details = Session::get('cart_details');

        $val .= ' <h5 class="text-center">' . \Lang::get('site.subtotal');

        $val .= ' ';

        //            $cart_details['totalPrice']
        if (Auth::check()) {
            $val .= Auth::user()->getPrice($product->price) . ' ';
            $val .= Auth::user()->country->currency->code;
        } else {
            if (Cookie::get('name')) {
                $val .= number_format(($cart_details['totalPrice'] / Country::find(Cookie::get('name'))->currency->rate), 2) . ' ';

                $val .= Country::find(Cookie::get('name'))->currency->code;
            } else {
                $val .= $cart_details['totalPrice'] . ' KWD';
            }
            //

        }


        $val .= ''
            . '</h5> <hr>'
            . '</div>';

        if ($cart) {
            return $val;
        } else {

            $return_val =
                '<div id="cart-content" class="row"><div class="col-12 pad-0">'
                . '<h4 style="text-align: center;font-weight: bold">
                            السله فارغه
                            </h4>'
                . ' </div>'
                . ' <hr>';

            return $return_val;
        }
    }


    public function reduceFromCart(Request $request)
    {
        //        Session::forget('cart');
        //        Session::forget('cart_details');
        //        return  response()->json([
        //            'success' => false,
        //            'msg' => 'Quantity Requested not Available of this item !'
        //        ]);
            // dd($request->all());
        $product_id = $request->product_id;
        $product_height_id = $request->product_height_id;
        $operation = $request->operation;

        //        Session::forget('cart_details');

        $cart = Session::get('cart');

        //        foreach ($cart as $cart_item){
        //            if($cart_item == $cart[$product_id]){
        //                foreach ($cart_item as $key => $value)
        //            }
        //        }
        $item = $cart[$product_id][$product_height_id];
        $quantity = $item['quantity'];
        $product = Product::find($product_id);

        $price = $product->price;
        // dd($cart,$item,$product->basic_category->type);
        $cart_details = Session::get('cart_details');

        $cart_details_quantity = $cart_details['totalQty'];
        $cart_details_price = $cart_details['totalPrice'];
        //        $total_price = $quantity * $price;
        //TODO :: GET OPERATION
        //TODO :: IF OPERATION 1 GET QUANTITY ADD TO QUANTITY

        if ($operation > 0) {
            //IF QUANTITY >= CURRENT PLUS ONE
            if($product->basic_category->type ==1 ){
                $prod_height = ProdHeight::where('product_id',$product_id)->where('height_id',0)->first();
            }
            else{
                $prod_height = ProdHeight::find($product_height_id);
            }
            // dd($prod_height->quantity);
            if ($prod_height->quantity < ($quantity + 1)) {
                return  response()->json([
                    'success' => false,
                    'msg' => 'Quantity Requested not Available of this item !'
                ]);
            }

            $cart[$product_id][$product_height_id]['quantity'] = $cart[$product_id][$product_height_id]['quantity']  + 1;
            $cart_details['totalQty'] = $cart_details['totalQty'] + 1;
            $cart_details['totalPrice'] = $cart_details['totalPrice'] + $price;
        } elseif ($operation < 0) {
            //TODO :: IF OPERATION -1 GET QUANTITY SUB FROM QUANTITY OR REMOVE

            if ($quantity > 1) {
                $cart[$product_id][$product_height_id]['quantity'] =  $cart[$product_id][$product_height_id]['quantity'] - 1;

                $cart_details['totalQty'] = $cart_details['totalQty'] - 1;
                $cart_details['totalPrice'] = $cart_details['totalPrice'] -  $price;
            } else {
                unset($cart[$product_id][$product_height_id]);

                $cart_details['totalQty'] = $cart_details['totalQty'] - $quantity;
                $cart_details['totalPrice'] = $cart_details['totalPrice'] - ($quantity * $price);
            }
        } else {
            return response()->json([
                'success' => false,
                'msg' => 'Error Occur !'
            ]);
        }


        Session::put('cart', $cart);

        Session::put('cart_details', $cart_details);

        return   response()->json([
            'success' => true,
            'msg' => 'تم بنجاح !'
        ]);

        ////        array_splice($cart , $item);
        //        unset($cart[$product_id][$product_height_id]);
        //
        //        if (count($cart[$product_id]) < 1) {
        //            unset($cart[$product_id]);
        //        }
        //
        //        Session::put('cart', $cart);
        //

        //
        //        $cart_details['totalQty'] = $cart_details_quantity - $quantity;
        //        $cart_details['totalPrice'] = $cart_details_price - $total_price;
        //
        //        Session::put('cart_details', $cart_details);
        //
        //        Alert::success('Removed Successfully !!', '');
        //        return redirect()->back();
    }


    public function removeFromShoppingCart($product_id, $product_height_id)
    {

        //        dd($request);


        //GET ITEM AND IF THE QUANTITY EQUALS OR MORE CALL REMOVE CART
        $cart = Session::get('cart');

        //        foreach ($cart as $cart_item){
        //            if($cart_item == $cart[$product_id]){
        //                foreach ($cart_item as $key => $value)
        //            }
        //        }
        $item = $cart[$product_id][$product_height_id];



        $quantity = $item['quantity'];

        $product = Product::find($product_id);

        $price = $product->price;

        $total_price = $quantity * $price;
        //        array_splice($cart , $item);
        unset($cart[$product_id][$product_height_id]);

        if (count($cart[$product_id]) < 1) {
            unset($cart[$product_id]);
        }

        Session::put('cart', $cart);

        $cart_details = Session::get('cart_details');

        $cart_details_quantity = $cart_details['totalQty'];
        $cart_details_price = $cart_details['totalPrice'];

        $cart_details['totalQty'] = $cart_details_quantity - $quantity;
        $cart_details['totalPrice'] = $cart_details_price - $total_price;

        Session::put('cart_details', $cart_details);


        // GET TOTAL PRICE


        toast('Removed Successfully !!');

        return redirect()->back();
    }

    public function getCities(Request $request)
    {


        //        if (Auth::check()) {
        //
        //            return response()->json([
        //                'success' => true,
        //                'cities' => Auth::user()->dcountry_i
        //            ]);
        //
        //            $country = Country::find(Auth::user()->country_id);
        //
        //            if (!$country) {
        //                return response()->json([
        //                    'success' => false,
        //                    'msg' => 'Can not find Country  !!'
        //                ]);
        //            }
        //
        //            $val = '';
        //
        //            foreach ($country->cities as $city) {
        //                $val .= '<option value="' . $city->id . '">' . $city->name_en . ' - ' . $city->name_ar . '</option>';
        //            }
        //
        //            return response()->json([
        //                'success' => true,
        //                'cities' => $val
        //            ]);
        //
        //        } else {


         $country_id = $request->country;
        // dd($count_q);
        if (!$country_id) {
            return response()->json([
                'success' => false,
                'msg' => 'Please Choose Country  !!'
            ]);
        }
        $country = Country::find($country_id);
        if (!$country) {
            return response()->json([
                'success' => false,
                'msg' => 'Can not find Country  !!'
            ]);
        }

        $val = '';
        $delivery = '';

        if (app()->getLocale() == 'en') {
            foreach ($country->cities as $city) {
                $val .= '<option value="' . $city->id . '">' . $city->name_en .  '</option>';
                //                $delivery .= '<p> '.$city->delivery_period .'</p>';

            }
        } else {
            foreach ($country->cities as $city) {
                $val .= '<option value="' . $city->id . '">' .  $city->name_ar . '</option>';
                //                $delivery .= '<p> '.$city->delivery_period .'</p>';

            }
        }
        return response()->json([
            'success' => true,
            'cities' => $val,
            //                'delivery' => $delivery
        ]);
        //        }



    }

    public function getDelivery(Request $request)
    {
        //        dd($request->all());
        $city_id = $request->city;

        if (!$city_id) {
            return response()->json([
                'success' => false,
                'msg' => 'Please Choose City  !!'
            ]);
        }
        $city = City::find($city_id);

        if (!$city) {
            return response()->json([
                'success' => false,
                'msg' => 'Can not find City  !!'
            ]);
        }


        //---------------------TRANSLATE  -----------------//
        $delivery = '';
        if( $city->country_id != 1){

                        $cart_details = Session::get('cart_details');
                        $count_q=$cart_details['totalQty']-1;
                        $pric_de_for_first=Settings::first()->international_shipping;
                        $pric_de_for_sec=Settings::first()->international_shipping_2;
                        $v_q=($pric_de_for_sec*$count_q)+$pric_de_for_first;

        }
        if (app()->getLocale() == 'en') {


            $val = '';

            //<p style="text-align: center;color: white;font-weight: bolder;font-size: 18px">* You Should Know that </p>
            //';

            //        foreach ($city->cities as $city1) {
            //            $val .= '<option value="' . $city1->id . '">' . $city->delivery_period . ' - ' . $city->name_ar . '</option>';
            //            $delivery .= '<p style="color: white;text-align: center;"> The delivery period for '. '<strong> '.$city->name_en.' : '.$city->delivery_period.' Days </strong></p>';
            $delivery .= $city->delivery_period . ' Days';
            //            $delivery .= '<p style="text-align: center;color: white"> The delivery cost for '. '<strong>'.$city->name_en.' : ';


            if (Auth::check()) {
                //                $delivery .= Auth::user()->getPrice($city->delivery).' ';
                //                $delivery .= Auth::user()->country->currency->code;
                if( $city->country_id != 1){

                        $val =Auth::user()->getPrice($v_q).' ';
                }else{
                    $val = Auth::user()->getPrice($city->delivery) . ' ';
                }
                $val .= Auth::user()->country->currency->code;
            } else {
                if (Cookie::get('name')) {
                    //                    $delivery .= number_format(($city->delivery / Country::find(Cookie::get('name'))->currency->rate),2) . ' ';

                    //                    $delivery .= Country::find(Cookie::get('name'))->currency->code;
                    if( $city->country_id != 1){


                        $val = number_format(( $v_q / Country::find(Cookie::get('name'))->currency->rate), 2) . ' ';
                    }else{
                    $val = number_format(($city->delivery / Country::find(Cookie::get('name'))->currency->rate), 2) . ' ';
                    }
                    $val .= Country::find(Cookie::get('name'))->currency->code;
                } else {

                    //                    $delivery .=$city->delivery. ' KWD';
                    if( $city->country_id != 1){

                             $val = $v_q . ' KWD';
                    }else{
                            $val = $city->delivery . ' KWD';

                    }
                }
                //

            }
            //            $delivery .='</strong></p></div>';


        } else {

            //        $val = '';
            //            $delivery = '<div style="width: 100%;background-color: #d420da;padding:10px;margin-bottom: 10px" >

            //<p style="text-align: center;color: white;font-weight: bolder;font-size: 18px">* يرجي العلم بأنه</p>
            //';

            //        foreach ($city->cities as $city1) {
            //            $val .= '<option value="' . $city1->id . '">' . $city->delivery_period . ' - ' . $city->name_ar . '</option>';
            //            $delivery .= '<p style="color: white;text-align: center;"> مدة التوصيل لمدينة '. '<br><strong>' .$city->name_ar.' : '.$city->delivery_period.' ايام </strong></p>';
            $delivery .= $city->delivery_period . ' ايام ';
            //            $delivery .= '<p style="text-align: center;color: white"> تكلفة التوصيل لمدينة '. '<br><strong>' .$city->name_ar.' : ';


            if (Auth::check()) {
                //                $delivery .= Auth::user()->getPrice($city->delivery).' ';
                //                $delivery .= Auth::user()->country->currency->code;


                if( $city->country_id != 1){

                        $val =Auth::user()->getPrice($v_q).' ';
                }else{
                    $val = Auth::user()->getPrice($city->delivery) . ' ';
                }
                $val .= Auth::user()->country->currency->code;
            } else {
                if (Cookie::get('name')) {
                    //                    $delivery .= number_format(($city->delivery / Country::find(Cookie::get('name'))->currency->rate),2) . ' ';

                    //                    $delivery .= Country::find(Cookie::get('name'))->currency->code;
                    if( $city->country_id != 1){
                         $val = number_format(($v_q / Country::find(Cookie::get('name'))->currency->rate), 2) . ' ';
                    }else{
                         $val = number_format(($city->delivery / Country::find(Cookie::get('name'))->currency->rate), 2) . ' ';
                    }
                    $val .= Country::find(Cookie::get('name'))->currency->code;
                } else {

                    //                    $delivery .=$city->delivery. ' KWD';
                    if( $city->country_id != 1){

                             $val = $v_q . ' KWD';
                    }else{
                            $val = $city->delivery . ' KWD';

                    }
                }
                //

            }
            //            $delivery .='</strong></p></div>';

        }

        $total_value = 0;
        $val2 = 0;
        $val3 = 0;
        $total_value_string = 0;
        if (Auth::check()) {
             if( $city->country_id != 1){
                $val2 = Auth::user()->getPrice($v_q);

            }else{
                $val2 = Auth::user()->getPrice($city->delivery);
            }
            $val3 = (Auth::user()->getPrice($request->total_value));
            $total_value = $val2 + $val3;
            $total_value_string = ' ' . $total_value . ' ' . Auth::user()->country->currency->code;
            //            $total_value .= Auth::user()->country->currency->code;

        } else {
            if (Cookie::get('name')) {
                if( $city->country_id != 1){
                    $val2 = ($v_q / Country::find(Cookie::get('name'))->currency->rate);
                }else{
                    $val2 = ($city->delivery / Country::find(Cookie::get('name'))->currency->rate);
                }

                $val3 = $request->total_value / Country::find(Cookie::get('name'))->currency->rate;
                $total_value = number_format($val2 + $val3, 2);
                $total_value_string = $total_value . ' ' . Country::find(Cookie::get('name'))->currency->code;
            } else {
                if( $city->country_id != 1){
                    $total_value = $request->total_value + $v_q;

                }else{
                    $total_value = $request->total_value + $city->delivery;
                }
                $total_value_string = $total_value . " KWD ";
            }

            //            dd($total_value_string);
            //

        }

        //---------------------------------------------------------------//
        //        $delivery .= '<p> '.$city->delivery_period .'</p>';

        //        }
        $is_free_shop=Settings::first()->is_free_shop;
      if($is_free_shop==1){
        $text_free=__('text_free_shopping');
        return response()->json([
            'success' => true,
            'ship' => __('site.text_free_shopping'),
            'total_value' => $request->total_value . " KWD ",
            'delivery' => $delivery
        ]);
      }
        return response()->json([
            'success' => true,
            'ship' => $val,
            'total_value' => $total_value_string,
            'delivery' => $delivery
        ]);
        //        }

    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    public function store(Request $request)
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
            //            'postal_code.required' => "يرجي إدخال الرمز البريدي",

        ];

        $validator = Validator::make($request->all(), [

            'name' => ['required'],

            // 'email' => ['required', 'email'],

            'country_id' => ['required'],

            'city_id' => ['required'],

            'phone' => ['required', 'max:11', 'min:3'],

            'the_plot' => ['required'],
            'region' => ['required'],
            'the_street' => ['required'],
            'building_number' => ['required'],
            // 'floor' => ['required'],
            // 'apartment_number' => ['required'],

            //  	 'postal_code' => ['required'],

        ], $messeges);


        if ($validator->fails()) {
            Alert::error($validator->errors()->first(), '');
            return back();
        }
        if ($request->email == null) {
            $request->merge(['email' => 'no@gmail.com']);
        }

        \session()->put('country_id',$request->get('country_id'));

        //        dd($request);

        $cart_details = Session::get('cart_details');

        if ($cart_details == null){
            return redirect()->route('cart');
        }
        $city = City::find($request['city_id']);



        $variation = str_replace("+", "", $request['phone']);
        $variation2 = str_replace("-", "", $variation);
        $is_free_shop=Settings::first()->is_free_shop;
        $des=0;
          if( Session::get('coupon')){
              $des=Session::get('coupon')['discount'];
          }
        if($is_free_shop!=1){
          if( $city->country_id != 1){

                        $cart_details = Session::get('cart_details');
                        $count_q=$cart_details['totalQty']-1;
                        $pric_de_for_first=Settings::first()->international_shipping;
                        $pric_de_for_sec=Settings::first()->international_shipping_2;
                        $v_q=($pric_de_for_sec*$count_q)+$pric_de_for_first;
                         $request->merge([
                                'total_price' => $cart_details['totalPrice'] + $v_q - $des,
                                'total_quantity' => $cart_details['totalQty'],
                                'phone' => $variation2
                            ]);

        }else{
             $request->merge([
            'total_price' => $cart_details['totalPrice'] + $city->delivery - $des,
            'total_quantity' => $cart_details['totalQty'],
            'phone' => $variation2
        ]);

        }

      }else {
        $request->merge([
            'total_price' => $cart_details['totalPrice']  - $des,
            'total_quantity' => $cart_details['totalQty'],
            'phone' => $variation2
        ]);
      }


        //MAKE ORDER TABLE

        //ADD TO TABLE



        $order = Order::create($request->except('_token'));


        //mails


     

        //dd($order);
        //    dd($order);

        if (!$order) {
            Alert::error('Order Not Completed an error occur ', '');

            return back();
        }
        //        dd($order);

        //CHECK IF QUANTITIES FROM CART IS AVAILABLE AND THEN MAKE PAYMENT

        $cart = Session::get('cart');

        //REACH HEIGHT AND ABSTRACT THE QUANTITY

        foreach ($cart as $cart_item) {
            foreach ($cart_item as $item) {
                $cat_type=(Product::find($item['product_id']))->basic_category->type;
                if($cat_type == 1){
                    $height = ProdHeight::where("product_id",$item['product_id'])->where('height_id',0)->first();
                }else{

                    $height = ProdHeight::find($item['product_height_id']);
                }
                if ($height->quantity >= $item['quantity']) {
                    $height->quantity = $height->quantity - $item['quantity'];
                    $height->save();

                    $item['order_id']  = $order->id;

                    OrderItem::create($item);

                    $b = BestSeller::where([
                        'product_id' => $item['product_id']
                    ])->first();

                    if (!$b) {
                        $be = new BestSeller();
                        $be->product_id = $item['product_id'];
                        $be->rate = 1;
                        $be->save();
                    } else {
                        $b->rate = $b->rate + 1;
                        $b->save();
                    }

                    BestSeller::firstOrCreate([
                        'product_id' => $item['product_id']
                    ])->touch();
                } else {

                    $msg = ' المنتج ';
                    $msg .= Product::find($item['product_id'])->title_en;
                    $msg .=  ' لا يتوفر منه العدد المطلوب في المقاس ';
                    $msg .=  ProdHeight::find($item['product_height_id'])->height->name;
                    $msg .=  ' مع الحجم ';
                    $msg .=  ProdSize::find($item['product_size_id'])->size->name;
                    $msg .=  '    يرجي اختبار مقاسات اخري';

                    Alert::error($msg, '');
                    return back();
                }
            }
        }

        // Session::forget('cart');
        // Session::forget('cart_details');



        if ($request->get('paymentType') == "cash"){
            $order->status = 3;
            $order->cash = 1;
            $order->save();
            if ($order->user){
                if($order->user->email !=null){
                    //   invoice
                   /*  $data['invoice']=$order;
                    $data["email"]=$order->user->email;
                    $from=env('MAIL_FROM_ADDRESS');
                    $data["subject"]= 'order';

                    Mail::send('emails.orderStore', $data, function ($message) use ($data, $from) {
                        $message->from($from)->to($data["email"], $data["email"] )
                            ->subject($data["subject"]);
                    }); */

                $data['username']=$order->name;
                $data['order_id']=$order->id;
                $data["email"]=$order->email;
                $from=env('MAIL_FROM_ADDRESS');
                $data["subject"]= 'شكراً لطلبك من أركان – رقم الطلب #'. $order->id;

                Mail::send('emails.orderStoreUser', $data, function ($message) use ($data, $from) {
                    $message->from($from)->to($data["email"], $data["email"] )
                        ->subject($data["subject"]);
                });

                $data["subject"]= 'تنبيه: تم استلام طلب جديد – رقم الطلب #'. $order->id;


                $admins = User::where('job_id' , 1)->latest()->get();
                foreach ($admins as $admin){
                    $data["email"]=$admin->email;
                    Mail::send('emails.orderStoreAdmin', $data, function ($message) use ($data, $from) {
                        $message->from($from)->to($data["email"], $data["email"] )
                            ->subject($data["subject"]);
                    });
                }

                foreach ($order->order_items as $item)
                {
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
                            $data['order']=$order;
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

                }
                $this->notificationUSER($order->user, $order);

                if($order->user_id != null){

                    self::save_notf(null,
                        false ,'Order',$order->id ,3,$order,
                        $order->user_id);

                }
            }
            else{

                if($order->email !=null){
                    //   invoice
                   /*  $data['invoice']=$order;
                    $data["email"]=$order->email;
                    $from=env('MAIL_FROM_ADDRESS');
                    $data["subject"]= 'order';

                    Mail::send('emails.orderStore', $data, function ($message) use ($data, $from) {
                        $message->from($from)->to($data["email"], $data["email"] )
                            ->subject($data["subject"]);
                    }); */

                    $data['username']=$order->name;
                    $data['order_id']=$order->id;
                    $data["email"]=$order->email;
                    $from=env('MAIL_FROM_ADDRESS');
                    $data["subject"]= 'شكراً لطلبك من أركان – رقم الطلب #'. $order->id;

                    Mail::send('emails.orderStoreUser', $data, function ($message) use ($data, $from) {
                        $message->from($from)->to($data["email"], $data["email"] )
                            ->subject($data["subject"]);
                    });

                    $data["subject"]= 'تنبيه: تم استلام طلب جديد – رقم الطلب #'. $order->id;


                    $admins = User::where('job_id' , 1)->latest()->get();
                    foreach ($admins as $admin){
                        $data["email"]=$admin->email;
                        Mail::send('emails.orderStoreAdmin', $data, function ($message) use ($data, $from) {
                            $message->from($from)->to($data["email"], $data["email"] )
                                ->subject($data["subject"]);
                        });
                    }

                     foreach ($order->order_items as $item)
                {
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
                            $data['order']=$order;
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

                }
            }

            \session()->put('order',$order);
            session()->forget('coupon');
            Session::forget('cart');
            Session::forget('cart_details');

            Alert::success('Payment Completed Successfully !', '');

            return redirect()->to('/')->with('success','Order Completed Successfully !');
        }
        elseif ($request->get('paymentType') == "tabby"){
            $response = $this->payWithTabby(\Illuminate\Support\Facades\Request::merge(['order_id' => $order->id]));


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
        else{


            $data = $this->makePayment(\Illuminate\Support\Facades\Request::merge(['order_id' => $order->id]));

            //        dd($data);
            $json = json_decode($data->getContent(), true);

            $success =  $json['success'];

            if (!$success) {
                Alert::error($json['msg'], '');

                return back();
            }

            $data['username']=$order->name;
            $data['order_id']=$order->id;
            $data["email"]=$order->email;
            $from=env('MAIL_FROM_ADDRESS');
            $data["subject"]= 'شكراً لطلبك من أركان – رقم الطلب #'. $order->id;

            Mail::send('emails.orderStoreUser', $data, function ($message) use ($data, $from) {
                $message->from($from)->to($data["email"], $data["email"] )
                    ->subject($data["subject"]);
            });

            $data["subject"]= 'تنبيه: تم استلام طلب جديد – رقم الطلب #'. $order->id;


            $admins = User::where('job_id' , 1)->latest()->get();
            foreach ($admins as $admin){
                $data["email"]=$admin->email;
                Mail::send('emails.orderStoreAdmin', $data, function ($message) use ($data, $from) {
                    $message->from($from)->to($data["email"], $data["email"] )
                        ->subject($data["subject"]);
                });
            }

             foreach ($order->order_items as $item)
                {
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
                            $data['order']=$order;
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

            //mail here
            //        Mail::send('email.donePay',['name' => $request->name,'order_id'=>$order->id,'total_price'=>$request->total_price,'total_quantity'=>$request->total_quantity,'invoice_link'=>$order->invoice_link], function($message) use($request,$order){
            //            $message->to($request->email)
            //                ->from('sales@easyshop-qa.com', 'Example')
            //            ->subject('Pay done');
            //        });

            DB::commit();
            return redirect($json['link']);
        }



        //Take to my my Fatoorah

        //when get back forget session

        //view orders for user and admin

        //        Session::forget('cart');
        //        Session::forget('cart_details');


        //PAYMENT


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


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



        //        $user_id = $order->user_id;
        //
        //        $user = User::find($user_id);
        //
        //
        //        if(!$user){
        //            return  response()->json(
        //                [
        //                    'success' =>false,
        //
        //                    'msg' => 'User is not exists',
        //
        //                ]
        //            );
        //        }


        //TODO :: GET USER PHONE

        $country_code = $order->country->code;
        $phone = ($order->phone);
        $name = ($order->name) ?: '';
        $email = ($order->email) ?: '';

        //        TODO :: VALIDATION FOR BOOKING  IF  MONEY ALREADY PAID


        /* ------------------------ Configurations ---------------------------------- */
        //Test


        // $apiURL = 'https://apitest.myfatoorah.com';
        // $apiKey = 'rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL';
        //Live
        $apiURL = 'https://api.myfatoorah.com';
        $apiKey = 'GnU465_twWngnRHW5vL_oW6Y9-D8n2OqC-WxpOIvhQNYUkEQDT59thwVA6kb4627K1vFKJoPz-4DRu72vjWEuHZx_fb1PqoKlvCf5kyKS6E4z14_OZBp1ntT-U9_vXXI1DVR_xfvcL5G_wo7pMzLCGWs0hK9qFw0Sp7LpHOabU8rjokKKGfMQBNPzSXwUKIJFw9FoxzLA0zReS_chMUK2_F5yAfPIVnBsETA-6Jv8HJSEIrSE1f-ob7WI_-evjyWbNaYqT0mHWMOUFcsGGVwi49WnUXvJAsopIleFGdGdC1ExwsCLX6TMjuJDIaRrOtQpJ6XFxg7CpL_9fzWyycHQ1m18l9cqDEKphhx6EJIkLtV-WaTTQB5h-AmqwbWYDPguCEKygQO4ONHgBgIErxjkVUixl1iKCWfvMs5Jd43gxcNtgUZUiDbbfZVrQRi81X45DC1kqTO6lI4XGC7QSEUete72gIB_Ex5OXEvkjg273kSiGAHn04ChAu2nca6J2eF89AxHllbOx-wQDCWM-cdLfVOf0nRCzZ8VFZosgNX0E1rm7iKXDXQOnJs3m1En29C2QNiptTe2boZ-DdnKsW8IFGxuOmLjxHDG-WYtxWgHaCi-cdGt1pxREb7y0k69Cp0ip5gDGKxCPIo9o0Sc-YNefmz4M_b5CKRsADzhM0Uofkfg-hE'; //Live token value to be placed here: https://myfatoorah.readme.io/docs/live-token


        /* ------------------------ Call SendPayment Endpoint ----------------------- */
        //Fill customer address array
        /* $customerAddress = array(
          'Block'               => 'Blk #', //optional
          'Street'              => 'Str', //optional
          'HouseBuildingNo'     => 'Bldng #', //optional
          'Address'             => 'Addr', //optional
          'AddressInstructions' => 'More Address Instructions', //optional
          ); */

        //Fill invoice item array
        /* $invoiceItems[] = [
          'ItemName'  => 'Item Name', //ISBAN, or SKU
          'Quantity'  => '2', //Item's quantity
          'UnitPrice' => '25', //Price per item
          ]; */

        $order_item = OrderItem::where('order_id', $request->order_id)->get();
        $delivery_cost = City::find($order->city_id);
        // dd($delivery_cost);

        $invoiceItems = array();
        if (Session::get('coupon')) {
            $coupon = Session::get('coupon');
            // dd($coupon);
            foreach ($order_item as $item) {

                // dd(Product::find($item->product_id)->price*$coupon['percentage']/100);
                $product_price=Product::find($item->product_id)->price*$coupon['percentage']/100;
                array_push($invoiceItems, [
                    'ItemName'  => Product::find($item->product_id)->title_ar, //ISBAN, or SKU
                    'Quantity'  => $item->quantity, //Item's quantity
                    'UnitPrice' => number_format($product_price, 3, '.', ''), //Price per item
                ]);
            }

            // dd("Coupon is",$coupon->discount * -1);
            // array_push($invoiceItems, [
            //     'ItemName'  => "Coupon discount", //ISBAN, or SKU
            //     'Quantity'  => 1, //Item's quantity
            //     'UnitPrice' => number_format($coupon['discount'], 3, '.', ''), //Price per item
            // ]);
        }else{
            foreach ($order_item as $item) {
                array_push($invoiceItems, [
                    'ItemName'  => Product::find($item->product_id)->title_ar, //ISBAN, or SKU
                    'Quantity'  => $item->quantity, //Item's quantity
                    'UnitPrice' => number_format(Product::find($item->product_id)->price, 3, '.', ''), //Price per item
                ]);
            }
        }




        $is_free_shop=Settings::first()->is_free_shop;
        if($is_free_shop!=1){
          // dd($request->all());
             if($delivery_cost->country_id != 1){

                        $cart_details = Session::get('cart_details');
                        $count_q=$cart_details['totalQty']-1;
                        $pric_de_for_first=Settings::first()->international_shipping;
                        $pric_de_for_sec=Settings::first()->international_shipping_2;
                        $v_q=($pric_de_for_sec*$count_q)+$pric_de_for_first;


                 array_push($invoiceItems, [
                    'ItemName'  => "Shippng cost", //ISBAN, or SKU
                    'Quantity'  => 1, //Item's quantity
                    'UnitPrice' => number_format($v_q, 3, '.', ''), //Price per item
                ]);

    }else{

        array_push($invoiceItems, [
            'ItemName'  => "Shippng cost", //ISBAN, or SKU
            'Quantity'  => 1, //Item's quantity
            'UnitPrice' => number_format($delivery_cost->delivery, 3, '.', ''), //Price per item
        ]);
    }
            }
        // dd(


        // dd(Session::get('coupon'));

        // dd(Session::get('cart_details'),$invoiceItems);





        //Fill POST fields array
        $postFields = [
            //Fill required data
            'NotificationOption' => 'Lnk', //'SMS', 'EML', or 'ALL'
            'InvoiceValue' => $order->total_price,
            'CustomerName' => $name,
            //Fill optional data
            'DisplayCurrencyIso' => 'KWD',
            'MobileCountryCode'  => $country_code,
            'CustomerMobile'     => $phone,
            'CustomerEmail'      => $email ?? "no@gmail.com",
            'CallBackUrl'        => 'https://rayan-storee.com/payment_callback',
            'ErrorUrl'           =>  'https://rayan-storee.com/payment_error', //or 'https://example.com/error.php'
            //'Language'           => 'en', //or 'ar'
            //            'CustomerReference'  => $order->id,
            //            'CustomerCivilId'    => $order->national_id,
            //'UserDefinedField'   => 'This could be string, number, or array',
            //'ExpiryDate'         => '', //The Invoice expires after 3 days by default. Use 'Y-m-d\TH:i:s' format in the 'Asia/Kuwait' time zone.
            //'SourceInfo'         => 'Pure PHP', //For example: (Laravel/Yii API Ver2.0 integration)
            //            'CustomerAddress'    => $order->address1,
            //            'InvoiceItems'       => $order->order_items,
            'InvoiceItems'       => $invoiceItems,

        ];

        //Call endpoint
        $data = $this->sendPayment($apiURL, $apiKey, $postFields);

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
        // $apiURL = 'https://apitest.myfatoorah.com';
        // $apiKey = 'rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL';

        //Live
        $apiURL = 'https://api.myfatoorah.com';
        $apiKey = 'GnU465_twWngnRHW5vL_oW6Y9-D8n2OqC-WxpOIvhQNYUkEQDT59thwVA6kb4627K1vFKJoPz-4DRu72vjWEuHZx_fb1PqoKlvCf5kyKS6E4z14_OZBp1ntT-U9_vXXI1DVR_xfvcL5G_wo7pMzLCGWs0hK9qFw0Sp7LpHOabU8rjokKKGfMQBNPzSXwUKIJFw9FoxzLA0zReS_chMUK2_F5yAfPIVnBsETA-6Jv8HJSEIrSE1f-ob7WI_-evjyWbNaYqT0mHWMOUFcsGGVwi49WnUXvJAsopIleFGdGdC1ExwsCLX6TMjuJDIaRrOtQpJ6XFxg7CpL_9fzWyycHQ1m18l9cqDEKphhx6EJIkLtV-WaTTQB5h-AmqwbWYDPguCEKygQO4ONHgBgIErxjkVUixl1iKCWfvMs5Jd43gxcNtgUZUiDbbfZVrQRi81X45DC1kqTO6lI4XGC7QSEUete72gIB_Ex5OXEvkjg273kSiGAHn04ChAu2nca6J2eF89AxHllbOx-wQDCWM-cdLfVOf0nRCzZ8VFZosgNX0E1rm7iKXDXQOnJs3m1En29C2QNiptTe2boZ-DdnKsW8IFGxuOmLjxHDG-WYtxWgHaCi-cdGt1pxREb7y0k69Cp0ip5gDGKxCPIo9o0Sc-YNefmz4M_b5CKRsADzhM0Uofkfg-hE'; //Live token value to be placed here: https://myfatoorah.readme.io/docs/live-token


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
    public function callBackUrl(Request $request)
    {
        //        dd($request->all());
        $payment_id = $request->paymentId;


        $invoice_data =  $this->getPaymentStatus($payment_id);
        //        return $invoice_data;
        $invoice_id = $invoice_data->original->InvoiceId;
        $invoice_status = $invoice_data->original->InvoiceStatus;

        //ORDER
        /*"Pending"
            "Paid"
            "Canceled"*/
             $order = Order::where('invoice_id', $invoice_id)->first();

            if (!$order) {
                Alert::error('Order is not Exist !');
                return redirect()->route('/');
            }
        if("Paid"){


        session()->forget('coupon');

        $order->status = 1;
        $order->paid_by = 1;
        $order->save();
        if($order->email !=null || $order->email != 'no@gmail.com'){
                //   invoice
              /*   $data['invoice']=$order;
                $data["email"]=$order->email;
                    $from=env('MAIL_FROM_ADDRESS');
                $data["subject"]= 'order';

                    Mail::send('emails.orderStore', $data, function ($message) use ($data, $from) {
                        $message->from($from)->to($data["email"], $data["email"] )
                        ->subject($data["subject"]);
                     }); */


          $data['username']=$order->name;
            $data['order_id']=$order->id;
            $data["email"]=$order->email;
            $from=env('MAIL_FROM_ADDRESS');
            $data["subject"]= 'شكراً لطلبك من أركان – رقم الطلب #'. $order->id;

            Mail::send('emails.orderStoreUser', $data, function ($message) use ($data, $from) {
                $message->from($from)->to($data["email"], $data["email"] )
                    ->subject($data["subject"]);
            });

            $data["subject"]= 'تنبيه: تم استلام طلب جديد – رقم الطلب #'. $order->id;


            $admins = User::where('job_id' , 1)->latest()->get();
            foreach ($admins as $admin){
                $data["email"]=$admin->email;
                Mail::send('emails.orderStoreAdmin', $data, function ($message) use ($data, $from) {
                    $message->from($from)->to($data["email"], $data["email"] )
                        ->subject($data["subject"]);
                });
            }

             foreach ($order->order_items as $item)
                {
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
                            $data['order']=$order;
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


        }

        Session::forget('cart');
        Session::forget('cart_details');

        Alert::success('Payment Completed Successfully !', '');

            // send notification with paid
            if ($order->user){
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

            }


            return redirect()->route('/')->with(['order' => $order]);
        }

        // send notification with paid
        if ($order->user){
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

        }

        return redirect($order->invoice_link);
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

        return redirect()->route('/');
    }


    public function payNow($order_id)
    {

        $order = Order::find($order_id);

        if (!$order) {
            Alert::error('Order is not Exist', '');

            return back();
        }

        if ($order->invoice_link && ($order->invoice_link != null)) {
            if ($order->status != 0) {
                Alert::error('Payment Can not be completed, Maybe you already paid for this', '');

                return back();
            }
            return redirect($order->invoice_link);
        }

        $data = $this->makePayment(\Illuminate\Support\Facades\Request::merge(['order_id' => $order->id]));

        $json = json_decode($data->getContent(), true);

        $success =  $json['success'];

        if (!$success) {
            Alert::error($json['msg'], '');

            return back();
        }

        $data['username']=$order->name;
            $data['order_id']=$order->id;
            $data["email"]=$order->email;
            $from=env('MAIL_FROM_ADDRESS');
            $data["subject"]= 'شكراً لطلبك من أركان – رقم الطلب #'. $order->id;

            Mail::send('emails.orderStoreUser', $data, function ($message) use ($data, $from) {
                $message->from($from)->to($data["email"], $data["email"] )
                    ->subject($data["subject"]);
            });

            $data["subject"]= 'تنبيه: تم استلام طلب جديد – رقم الطلب #'. $order->id;


            $admins = User::where('job_id' , 1)->latest()->get();
            foreach ($admins as $admin){
                $data["email"]=$admin->email;
                Mail::send('emails.orderStoreAdmin', $data, function ($message) use ($data, $from) {
                    $message->from($from)->to($data["email"], $data["email"] )
                        ->subject($data["subject"]);
                });
            }

             foreach ($order->order_items as $item)
                {
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
                            $data['order']=$order;
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

        //mail here
        //        Mail::send('email.donePay',['name' => $request->name,'order_id'=>$order->id,'total_price'=>$request->total_price,'total_quantity'=>$request->total_quantity,'invoice_link'=>$order->invoice_link], function($message) use($request,$order){
        //            $message->to($request->email)
        //                ->from('sales@easyshop-qa.com', 'Example')
        //            ->subject('Pay done');
        //        });


        return redirect($json['link']);
    }


    public function payWithTabby(Request $request){

        //dd('s');

        $order = Order::find($request->get('order_id'));

        $curl = curl_init();

        $order_id = $order->id;

        //dd($order->total_price - $order->coupon_amount - $order->delivery_cost_req);
        if (Settings::first()->is_tabby_active){
            $total_price = $order->total_price - $order->delivery_cost_req;

            $tabby_fixed_amount_total = $total_price * 7 / 100;
            $total = $order->total_price + $tabby_fixed_amount_total;

        }else{
            $total = $order->total_price;
        }
        // get price helper here




        $total = number_format($total,2);
        \session()->get('country_id');

        $currency_en = Country::find(\session()->get('country_id'))->currency->code;
        $total = $total / Country::find(\session()->get('country_id'))->currency->rate;
        //dd($currency_en);
        //dd($total);
        $merchant_code = null;

        // get the created at

        // Retrieve a customer (replace 1 with the actual customer ID)
        $customer = User::find($order->user_id);

        if ($customer){

            $createdAt = $customer->created_at;
            $iso8601Date = Carbon::parse($createdAt)->toIso8601String();



        }else{
            // Specify the date you're interested in
            $dateToCheck = Carbon::create(2023, 1, 1, 0, 0, 0, 'UTC');
            $iso8601Date = $dateToCheck->toIso8601String();

        }



        $createdAtOrder = $order->created_at;
        $iso8601DateOrder = Carbon::parse($createdAtOrder)->toIso8601String();

        switch ($currency_en){
            case "SAR":
                $merchant_code = "rayanstoresau";
                break;

            case "AED":
                $merchant_code = "rayanstoreare";
                break;

            case "QAR":
                $merchant_code = "rayanstoreqat";
                break;

            case "BHD":
                $merchant_code = "rayanstorebhr";
                break;

            default :
                $merchant_code = "rayanstorekwt";
        }
        //dd($merchant_code);
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
    "currency": "'.$currency_en.'",
    "description": "Payment Description",
    "buyer": {
      "phone": "'.$order->phone.'",
      "email": "'.$order->email.'",
      "name": "'.$order->name.'"
    },
    "shipping_address": {
      "city": "'.$order->region.'",
      "address": "'.$order->address1.'",
      "zip": "123456"
    },
    "order": {
      "tax_amount" : "0",
      "shipping_amount" : "0",
      "discount_amount" : "0",
      "reference_id": "'.$order->id.'",
      "items": [
                {
                    "title": "'.$order->products()->first()->title_ar.'",
                    "quantity": '.$order->total_quantity.',
                    "unit_price": "'. $total .'",
                    "category": "منتجات"
                }
            ]
    },

    "order_history": [
            {
                "purchased_at": "'.$iso8601DateOrder.'",
                "amount": "'.$total.'",
                "payment_method": "card",
                "status": "new",
                "buyer": {
                    "phone": "'.$order->phone.'",
                    "email": "'.$order->email.'",
                    "name": "'.$order->name.'"
                },
                "shipping_address": {
                    "city": "'.$order->region.'",
                    "address": "'.$order->address1.'",
                    "zip": "123456"
                }

            }
        ],

     "buyer_history": {
            "registered_since": "'.$iso8601Date.'",
            "loyalty_level": 0
        },

    "meta": {
      "order_id": "'.$order_id.'"
    }
  },
  "lang": "'.app()->getLocale().'",
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
                'Authorization: Bearer pk_96b383b9-0536-4149-a109-c4b3ce9284f1',
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


    /*
     * tabbySuccess
tabbyCancel
tabbyFailure
     * */

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
                'Authorization: Bearer sk_e300a43e-da68-4112-a07a-e2484098619f'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $data = json_decode($response,true);

        $order_id = $data['order']['reference_id'];
        $order = Order::find($order_id );

        $order->paid_by = 2;
        $order->status = 1;
        if (Settings::first()->is_tabby_active){
            $total_price = $order->total_price - $order->delivery_cost_req;
            $tabby_amount =  ($total_price * 7 / 100);

        }else{
            $tabby_amount = 0;
        }

        $order->paid_by = 2;
        $order->status = 1;
        $order->tabby_amount = $tabby_amount;

        $order->save();


        if($order->email !=null || $order->email != 'no@gmail.com'){
            //   invoice
            $data['invoice']=$order;
            $data["email"]=$order->email;
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

        session()->forget('coupon');
        Session::forget('cart');
        Session::forget('cart_details');

        Alert::success('Payment Completed Successfully !', '');

        \session()->flash('error','Payment Completed Successfully !');

        // send notification with paid
        if ($order->user){
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

        }


        return redirect()->route('/')->with(['order' => $order]);





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
                'Authorization: Bearer sk_e300a43e-da68-4112-a07a-e2484098619f'
            ),
        ));

        $response = curl_exec($curl);

        $data = json_decode($response,true);

        $order_id = $data['order']['reference_id'];
        $order = Order::find($order_id );

        // delete order items
        \Illuminate\Support\Facades\DB::table('order_items')->where('order_id',$order_id)->delete();

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
                'Authorization: Bearer sk_e300a43e-da68-4112-a07a-e2484098619f'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response,true);

        //dd($data);

        $order_id = $data['order']['reference_id'];

        // delete order items
        \Illuminate\Support\Facades\DB::table('order_items')->where('order_id',$order_id)->delete();

        $order = Order::find($order_id );


        $order->delete();

        //Alert::error('', '');

        \session()->flash('error',__('site.tabby_cancel'));

        return redirect()->route('checkout');


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
            \Log::info($response);
        }


    }

   /* static function save_notf($fcm_token , $is_all ,$type ,$type_id,$step=null,$type_model=null,$user_id_model=null){

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
                        if ($fcm_token){

                            $user_token=   FcmTokenModel::create([
                                'token'=>$fcm_token,
                                'user_id'=>$user_id_model,
                            ]);
                        }else{

                            $user_id=[$user_id_model];

                            //$token($fcm_token->token);
                            $not= Notification::create([
                                'fcm_token'=>null,
                                'user_id'=>$user_id,
                                'type'=>$type,
                                'type_id'=>$type_id,
                                'title_ar'=>$title_ar,
                                'title_en'=>$title_en,
                                'body_ar'=>$body_ar,
                                'body_en'=>$body_en,
                                'image'=>$image,
                            ]);

                            return;


                        }
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
