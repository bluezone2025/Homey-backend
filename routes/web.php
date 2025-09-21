<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\front\homeController;
use App\Http\Controllers\front\cartController;
use App\Http\Controllers\Auth\ClientAuthController;
use App\Http\Controllers\front\clientsLoginController;
use App\Http\Controllers\front\productsController;
use App\Http\Controllers\WishListController;
use App\Http\Controllers\front\InfoController;

Route::get('tabby-success', [cartController::class,'tabbySuccess']);
Route::get('tabby-cancel', [cartController::class,'tabbyCancel']);
Route::get('tabby-failure', [cartController::class,'tabbyFailure']);

Route::get('/api/get-products', [homeController::class, 'getProducts'])->name('api.getProducts');
Route::get('/api/get-brands', [homeController::class, 'getBrands'])->name('api.getBrands');
Route::get('/api/get-categories', [homeController::class, 'getCategories'])->name('api.getCategories');

Route::get('/get-product/{id}', [homeController::class, 'getSingleProduct'])->name('api.getProduct');
Route::get('/get-brand/{id}', [homeController::class, 'getSingleBrand'])->name('api.getBrand');
Route::get('/get-category/{id}', [homeController::class, 'getSingleCategory'])->name('api.getCategory');

Route::post('/validate-coupon', [homeController::class, 'validateCoupon'])->name('validate.coupon');

Route::get('/auth/google', [homeController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [homeController::class, 'handleGoogleCallback']);


Route::post('web-hooks-event', function (Illuminate\Http\Request $request){

    /*
         * Capture the payment in tabby
         * */


    $inputs = $request->all();

    //\Illuminate\Support\Facades\Log::info($inputs);

    $cur = $inputs['currency'];

    $order_id = $inputs['order']['reference_id'];

    \Illuminate\Support\Facades\Log::info($inputs['order']);
    \Illuminate\Support\Facades\Log::info($cur);

    //\Illuminate\Support\Facades\Log::info($inputs['order']['reference_id']);

    $order = \App\Models\Order::find($order_id);

    //\Illuminate\Support\Facades\Log::info($inputs['order']['reference_id']);
    //\Illuminate\Support\Facades\Log::info($inputs['amount']);
    //\Illuminate\Support\Facades\Log::info($order);
    //\Illuminate\Support\Facades\Log::info($inputs['status']);
    //\Illuminate\Support\Facades\Log::info($order->total_price?? 0);
    //\Illuminate\Support\Facades\Log::info($order->tabby_amount?? 0);

    $total = $order->total_price;
    $total = number_format($total,3);

    $curl2 = curl_init();

    if (($inputs['status'] == "authorized") && empty($inputs['captures'])){

        curl_setopt_array($curl2, array(
            CURLOPT_URL => "https://api.tabby.ai/api/v1/payments/".$request->get('id')."/captures",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "amount": "'.$total.'"
            }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer sk_01900622-e193-bf61-1422-412044b10991',
                'Content-Type: application/json'
            ),
        ));

        $response2 = curl_exec($curl2);

        curl_close($curl2);
        \Illuminate\Support\Facades\Log::info($response2);
        //\Illuminate\Support\Facades\Log::info('Done');

        return \response()->json('Webhook done', 200);
    }

    return \response()->json('Webhook done', 200);

});

Route::get('/.well-known/apple-app-site-association', function() {
    return response()->json([
        "applinks"=> [
            "apps"=> [],
            "details"=> [
                [
                    "appID"=> "4W85KLPQDW.com.B-dinar-zone",
                    "paths"=> ["*"]
                ]
            ]
        ]
    ]);
});


Route::group(['prefix' => LaravelLocalization::setLocale(),	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function()


{
     Route::get('/de', [ClientAuthController::class,"de"] )->name('de');
    //islam
     Route::get('/login/client', [ClientAuthController::class,"showClientLoginForm"])->name('login/client');//islam
    Route::post('/login/client', [ClientAuthController::class,"clientLogin"] )->name('login');//islam
    Route::get('/register/client', [ClientAuthController::class,"showClientRegisterForm"] )->name("register/client");//islam
    Route::post('/register/client', [ClientAuthController::class,"createClient"] )->name('register');//islam
    Route::get('/check',[clientsLoginController::class,"check"] )->middleware(['auth:clients']);//islam
     Route::get('/logout/client', [ClientAuthController::class,"logout"] )->name('logout.client');

    //wishList routes islam
    Route::get('/wishlist', [WishListController::class , 'store'])->name('wishlist.store');
    Route::get('/wishlist/products', [WishListController::class , 'index'])->name('wishlist.products.index');
    Route::delete('/wishlist', [WishListController::class , 'destroy'])->name('wishlist.destroy');
//wishList routes End islam
    //23 july Islam
    Route::get('/account', [ClientAuthController::class,'account'])->name('account.index');
    Route::get('/account/orders/{id}', [ClientAuthController::class,'orders'])->name('account.orders');

    Route::get('/address/client/{id}', [ClientAuthController::class,'address_index'])->name('address.index');
    Route::get('/address/create/', [ClientAuthController::class,'address_view'])->name('address.create');
    Route::post('/address/client', [ClientAuthController::class,'address_store'])->name('address.store');
    Route::get('/wishlists-account/{has_wishlist}', [ClientAuthController::class,'account'])->name('showWishlists');


    ///////islam 22 august/////

    Route::get('/client/verify/{token}', [ClientAuthController::class,'verifyUser']);
    Route::get('/forgot-password', [ClientAuthController::class,'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('/forgot-password', [ClientAuthController::class,'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('/reseet-password/{token}', [ClientAuthController::class,'showResetPasswordForm'])->name('reset.password.get');
    Route::post('/reseet-password', [ClientAuthController::class,'submitResetPasswordForm'])->name('reset.password.post');

        Route::get('/order/view/{id}', [ClientAuthController::class,'order_view'])->name('order.view');


    /////////////End Islam////////////
    Route::delete('/address/delete/{id}', [ClientAuthController::class,'address_delete'])->name('address.destroy');
    Route::get('/address/edit/{id}', [ClientAuthController::class,'address_edit'])->name('address.edit');
    Route::put('/address/update/{id}', [ClientAuthController::class,'address_update'])->name('address.update');


    Route::get('/account/edit/{id}', [ClientAuthController::class,'account_edit'])->name('account.edit');
    Route::put('/account/update/{id}', [ClientAuthController::class,'account_update'])->name('account.update');


//23 july Islam
    //home controller
    Route::get('/', [homeController::class, 'home'] )->name("home");
    Route::get('/home', [homeController::class, 'home'] )->name("home");


    Route::get('/product/{id}', [homeController::class,"product"]  )->name("product");
    Route::post('/get-variant-details', [homeController::class, 'getVariantDetails'])->name('get.variant.details');
    Route::get('/show/{type}', [homeController::class,"productByType"]  )->name("productByType");
    Route::get('/vendor/{id}', [homeController::class,"vendor"] )->name("vendor");
    Route::get('/brands', [homeController::class,"brands"] )->name("brands");
    Route::get('/brand/{id}', [homeController::class,"brand"] )->name("brand");
    Route::post('/getCity',[cartController::class,'getCity'])->name('get.city');
    Route::post('/getDelivery',[cartController::class,'getDelivery'])->name('get.delivery');
    Route::get('/vendors', [homeController::class,"vendors"] )->name("vendors");
    Route::get('/order/{id}', [cartController::class,"showInvoice"] )->name("show_invoice");


    Route::get('/cart/count', function () {
    return response()->json([
        'count' => \App\Models\CartItem::countForUser()
    ]);
})->name("cart.count");



//cart controller


        Route::get('/checkout', [cartController::class,"checkout"] )->name("checkout");

         Route::get('/payment/{id}', [cartController::class,"v2_payment"] )->name("v2_payment");


         Route::get('/success/payment/{order_id}', [cartController::class,'success_payment'])->name("success_payment");
          Route::get('/error/payment/{order_id}', [cartController::class,'error_payment'])->name("error_payment");

          Route::get('/msg', [cartController::class,'msg'])->name("msg");

        Route::post('/checkout/store', [cartController::class,"checkout_store"] )->name("checkout.store");

        Route::get('/cart/remove', [cartController::class,"remove_from_cart"] )->name("cart.remove");


    Route::get('/cart/{id}/{qut}', [cartController::class,"add_to_cart"] )->name("add.cart");


    Route::get('/cart/index', [cartController::class,"go_to_cart"] )->name("cart.show");

    Route::post('/cart/add', [cartController::class,"add_to_cart_post"] )->name("add.cart.post");
    Route::post('/cart/update', [cartController::class,"update2"] )->name("cart.update");
    Route::post('/cart/update2', [cartController::class,"update2"] )->name("cart.update2");

 Route::get('/update_cart/{id}/{qut}/{key}', [cartController::class,"update_cart"]  )->name("update_cart");



// //    TODO :: VIEW PRODUCTS OF CAT
//     Route::get('/cat/product/{cat_id}' ,[productsController::class , 'catProduct'] )->name('cat.products');
//
//
// //    TODO :: VIEW PRODUCTS OF SUB-CAT
//     Route::get('/sub/cat/product/{sub_cat_id}' ,[productsController::class , 'subCatProduct'] )->name('sub.cat.products');





Route::get('contact-us', function() {

      return view("front.contact");
  })->name("contact");




Route::get('info/{type}', [InfoController::class,"index"] )->name("front.info");






  //TODO :: SEARCH
      Route::get('/searching' ,[productsController::class , 'store'])->name('searching');

      Route::post('/search/ajax', [productsController::class,"searchAjax"] )->name("searchAjax");


      Route::get('/migrate', function() {
        $exitCode = Artisan::call('migrate');
        return '<h1>Cache facade value cleared</h1>';
    });


});
