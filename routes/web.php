<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Session;

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
Route::get('/coming-soon', function () {
    return view('coming-soon');
});

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

    $order = \App\Order::find($order_id);

    //\Illuminate\Support\Facades\Log::info($inputs['order']['reference_id']);
    //\Illuminate\Support\Facades\Log::info($inputs['amount']);
    //\Illuminate\Support\Facades\Log::info($order);
    //\Illuminate\Support\Facades\Log::info($inputs['status']);
    //\Illuminate\Support\Facades\Log::info($order->total_price?? 0);
    //\Illuminate\Support\Facades\Log::info($order->tabby_amount?? 0);

    $total = $order->total_price + $order->tabby_amount;
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
                'Authorization: Bearer sk_01906df0-1e90-6966-bc4a-db8c58a4135d',
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


Route::get('tabby-success', 'front\CartController@tabbySuccess');
Route::get('tabby-cancel', 'front\CartController@tabbyCancel');
Route::get('tabby-failure', 'front\CartController@tabbyFailure');

Route::get('//product/{id}','front\homeController@product');
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'/*,'comingSoon'*/ ]
    ], function(){ //...

        Route::get('design' , function (){
           return view('dashboard.design');
        });



//        Route::get('rest' , 'HomeController@rest');
    Route::get('home', function () {
        return redirect()->route('/');
    });

    Auth::routes(['verify' => true]);

//    Route::get('/home', 'HomeController@index')->name('home');
//    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/','front\homeController@home')->name('/');
//    Route::get('/account','front\homeController@account')->name('account');
    Route::get('/cart','front\homeController@cart')->name('cart');
    Route::get('/post/{id}','front\homeController@post')->name('post');
    Route::get('/category/{type}/{id}','front\homeController@category')->name('category');
    Route::get('/new_arrive','front\homeController@new_arrive')->name('new');
    Route::get('/offers','front\homeController@offers')->name('offer');
    Route::get('/checkout','front\homeController@checkout')->name('checkout');
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/myaccount', 'front\homeController@myaccount')->name('myaccount');
        Route::get('/notifications', 'front\homeController@notifications')
            ->name('notifications');
        Route::post('users/data/update/{id}','front\homeController@updateUser')->name('update.user');
        Route::get('/myorder','front\orderController@index')->name('myorder');
        Route::get('/wishlists/products','Backend\WishListController@index')->name('wishlist.view');

    });
    Route::get('/payment','front\homeController@payment')->name('payment');
    Route::get('/policy','front\homeController@policy')->name('policy');
    Route::get('/product/{id}','front\homeController@product')->name('product');
//    Route::get('/index','front\homeController@home')->name('index');

//    Route::get('/forget-password', 'ForgotPasswordController@getEmail');
//    Route::post('/forget-password', 'ForgotPasswordController@postEmail');
//    Route::get('/reset-password/{token}', 'ResetPasswordController@getPassword');
//    Route::post('/reset-password', 'ResetPasswordController@updatePassword');

    Route::get('forget-password', 'Auth\ForgotPasswordController@showForgetPasswordForm')->name('forget.password.get');
    Route::post('forget-password',  'Auth\ForgotPasswordController@submitForgetPasswordForm')->name('forget.password.post');
    Route::get('reset-password/{token}',  'Auth\ForgotPasswordController@showResetPasswordForm')->name('reset.password.get');
    Route::post('reset-password', 'Auth\ForgotPasswordController@submitResetPasswordForm')->name('reset.password.post');

//    TODO :: DASHBOARD ROUTES


//wishList routes
    Route::get('/wishlist', 'Backend\WishListController@store')->name('wishlist.store');
//    Route::get('/wishlist/products', 'Backend\WishListController@index')->name('wishlist.products.index');
    Route::delete('/wishlist', 'Backend\WishListController@destroy')->name('wishlist.destroy');
//wishList routes End
    Route::get('/searching' ,'front\homeController@store')->name('searching');
    //
    Route::get('/cookie/set/{country}','CookieController@setCookie')->name('cookie.set');
    Route::get('/cookie/get','CookieController@getCookie')->name('cookie.get');

    Route::get('/add-to-cart/{id}','front\homeController@getAddToCart')->name('product.addToCart');
    Route::post('/addToCart','front\CartController@addToCart')->name('add.to.cart');
    Route::get('/viewFromCart','front\CartController@viewFromCart')->name('view.from.cart');
    Route::post('/removeFromCart','front\CartController@reduceFromCart')->name('reduce.from.cart');
    Route::get('/removeFromCart/{product}/{height}','front\CartController@removeFromCart')->name('remove.from.cart');
    Route::get('/removeFromShoppingCart/{product}/{height}','front\CartController@removeFromShoppingCart')->name('remove.from.shopping.cart');
    Route::get('/pay_now/{order_id}','front\CartController@payNow')->name('pay.now');


    Route::get('/shopping-cart','front\homeController@getCart')->name('product.shoppingCart');
    Route::get('/contact_us_user','front\homeController@contactUs')->name('contact.us');
    Route::post('/contact_us_user','front\homeController@contactUsStore')->name('contact.us');
    Route::get('/getHeights','front\CartController@getHeights')->name('get.heights');
    Route::post('/getCities','front\CartController@getCities')->name('get.cities');
    Route::post('/getDelivery','front\CartController@getDelivery')->name('get.delivery');
    Route::post('/checkCategory','front\homeController@checkCat')->name('check.cat');

    Route::post('/order/store','front\CartController@store')->name('order.store');


    Route::get('/sendEmail' , 'front\homeController@sendEmail');

    Route::get('payment_callback' , 'front\CartController@callBackUrl');
    Route::get('payment_error' , 'front\CartController@errorUrl');
    Route::get('/coupon/store','front\CouponController@store')->name('coupon.store');
    Route::delete('/coupon','front\CouponController@destroy')->name('coupon.destroy');


    Route::group(['middleware' => ['adminAuth']], function () {
        Route::resource('users','Backend\UserController');
        Route::get('users/destroy/{id}','Backend\UserController@destroy')->name('users.destroy');
        Route::get('admins/destroy/{id}','Backend\AdminController@destroy');
//        Route::get('users/destroy/{id}','Backend\UserController@destroy')->name('users.destroy');
        Route::get('basic_categories/destroy/{id}','Backend\BasicCategoryController@destroy');
        Route::get('brands/destroy/{id}','Backend\BrandsController@destroy');

        Route::get('size_guides/destroy/{id}','Backend\SizeGuideController@destroy');
        Route::get('countries/destroy/{id}','Backend\CountryController@destroy');
        Route::get('cities/destroy/{id}','Backend\CityController@destroy');
        Route::get('cities/view/{country_id}','Backend\CountryController@cities')->name('cities.view');
        Route::resource('pages','Backend\PagesController');
        Route::resource('admins','Backend\AdminController');
        Route::resource('settings','Backend\SettingsController');
        Route::get('setting/toggle-tabby/{id}','Backend\SettingsController@toggleTabby')->name('settings.toggle-tabby');
        Route::resource('basic_categories','Backend\BasicCategoryController');
        Route::resource('brands','Backend\BrandsController');

        Route::resource('size_guides','Backend\SizeGuideController');
        Route::resource('categories','Backend\CategoryController');
        Route::resource('ads','Backend\AdsController');

        Route::resource('currencies','Backend\CurrencyController');
        Route::resource('countries','Backend\CountryController');
        Route::resource('cities','Backend\CityController');
        Route::resource('sliders','Backend\sliderController');
        Route::resource('sizes','Backend\SizeController');
        Route::resource('heights','Backend\HeightController');
        Route::resource('products','Backend\ProductController');
        Route::resource('delivery_times','Backend\DeliveryTimesController');
        Route::resource('preparations','Backend\PreparationsController');
        Route::resource('preparations','Backend\PreparationsController');
        Route::resource('contact_us','Backend\ContactUsController');
        Route::resource('orders','Backend\OrderController');
        Route::get('/order/notpaid','Backend\OrderController@not_paid')->name('noorders');
        Route::get('/order/cashorders','Backend\OrderController@cash')->name('cashorders');
        Route::get('/orders/destroy/{id}','Backend\OrderController@destroy')->name('orders.destroy');
        Route::get('todayorders','Backend\OrderController@today')->name('todayorders');
        Route::resource('posts','Backend\PostController');
        Route::resource('news','Backend\NewsController');
        Route::resource('coupons','Backend\CouponController');
        Route::resource('notifications','Backend\NotificationController');

//islam 26 august



        Route::get('/product_galaries/{id}', 'Backend\productGalaryController@index')->name("product_galaries.index");
        Route::post('/product_galaries/store/{id}', 'Backend\productGalaryController@store')->name("product_galaries.store");
        Route::delete('/product_galaries/destroy/{id}', 'Backend\productGalaryController@destroy')->name("product_galaries.destroy");

        Route::get('/preparation_galaries/{id}', 'Backend\preparationGalaryController@index')->name("preparation_galaries.index");
        Route::post('/preparation_galaries/store/{id}', 'Backend\preparationGalaryController@store')->name("preparation_galaries.store");
        Route::delete('/preparation_galaries/destroy/{id}', 'Backend\preparationGalaryController@destroy')->name("preparation_galaries.destroy");

        Route::get('/news/destroy/{id}', 'Backend\NewsController@destroy')->name("news.destroy");
        Route::get('/coupons/destroy/{id}', 'Backend\CouponController@destroy')->name("coupons.destroy");
        Route::get('/posts/destroy/{id}', 'Backend\PostController@destroy')->name("posts.destroy");


        Route::get('/ajax-subcat','Backend\ProductController@ajaxcat');


        Route::get('cities/view/{country_id}' ,'Backend\CountryController@cities')->name('cities.view');
        Route::get('items/view/{order_id}' ,'Backend\OrderController@items')->name('order.items.view');
        Route::get('items/paid/{order_id}' ,'Backend\OrderController@payOrder')->name('order.paid');
        Route::get('order/receive/{order_id}' ,'Backend\OrderController@receive')->name('orders.received');
        Route::post('custom_users/update','Backend\UserController@updateUser')->name('users.update.user');
//<<<<<<< Updated upstream
        Route::post('custom_admins/update','Backend\AdminController@updateAdmin')->name('admins.update.admin');
        Route::post('custom_countries/update/{id}','Backend\CountryController@updateCountry')->name('countries.update.country');
        Route::post('custom_cities/update/{id}','Backend\CityController@updateCity')->name('cities.update.city');
        Route::post('custom_pages/update/{id}','Backend\PagesController@updatePage')->name('pages.update.page');
        Route::post('custom_basic_categories/update/{id}','Backend\BasicCategoryController@updateBasicCategory')->name('basic_categories.update.basic_category');
        Route::post('custom_brands/update/{id}','Backend\BrandsController@updateBrand')->name('brands.update.brand');


        Route::post('custom_sizes_guide/update/{id}','Backend\SizeGuideController@updateSizeGuide')->name('size_guides.update.size_guide');
        Route::post('custom_categories/update/{id}','Backend\CategoryController@updateCategory')->name('categories.update.category');
        Route::post('custom_ads/update/{id}','Backend\AdsController@updateAd')->name('ads.update.ad');

        Route::post('custom_settings/update/{id}','Backend\SettingsController@updateSetting')->name('settings.update.setting');
        Route::post('custom_sliders/update/{id}','Backend\sliderController@updateSlider')->name('sliders.update.slider');
        Route::post('custom_sizes/update/{id}','Backend\SizeController@updateSize')->name('sizes.update.size');
        Route::post('custom_heights/update/{id}','Backend\HeightController@updateHeight')->name('heights.update.height');
        Route::post('custom_products/update/{id}','Backend\ProductController@updateProduct')->name('products.update.product');
        Route::post('custom_preparations/update/{id}','Backend\PreparationsController@updatePreparation')->name('preparations.update.preparation');
        Route::post('custom_delivery_times/update/{id}','Backend\DeliveryTimesController@updateDeliveryTime')->name('delivery_times.update.delivery_time');

        Route::post('custom_posts/update/{id}','Backend\PostController@updatePost')->name('posts.update.post');

        Route::get('/edit_delivery_time_note/{id}','Backend\DeliveryTimesController@editNote')->name('delivery_time.note.edit');
        Route::post('custom_delivery_times_note/update/{id}','Backend\DeliveryTimesController@updateNote')->name('delivery_times.update.note');

        Route::post('custom_posts/update/{id}','Backend\PostController@updatePost')->name('posts.update.post');
        Route::post('custom_news/update/{id}','Backend\NewsController@updateNews')->name('news.update.news');
//=======
        Route::post('currencies_users/update','Backend\CurrencyController@updateCurrency')->name('currencies.update.currency');
//>>>>>>> Stashed changes
        Route::get('admin' , 'Backend\AdminController@admin')->name('admin');

        Route::group(['prefix' => 'roles'], function () {
            Route::get('/', 'Backend\RoleController@index') -> name('admin.roles');
            Route::get('create','Backend\RoleController@create') -> name('admin.roles.create');
            Route::post('store','Backend\RoleController@store') -> name('admin.roles.store');
            Route::get('edit/{id}','Backend\RoleController@edit') -> name('admin.roles.edit');
            Route::post('update/{id}','Backend\RoleController@update') -> name('admin.roles.update');
            Route::DELETE('delete/{id}','Backend\RoleController@destroy') -> name('admin.roles.destroy');
        });

    });

    Route::get('admin/login' , 'HomeController@adminLogin');
    Route::post('admin/login' , 'HomeController@loginAdmin')->name('admin.login');

});
