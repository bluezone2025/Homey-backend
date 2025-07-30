<?php

use App\Http\Controllers\Api\DeliveryTimesController;
use App\Http\Controllers\Api\GetAdsController;
use App\Http\Controllers\Api\GetBrandsController;
use App\Http\Controllers\Backend\BrandsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HomeProductsController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductInCategoriesController;
use App\Http\Controllers\Api\SingleProductController;
use App\Http\Controllers\Api\SearchProductController;
use App\Http\Controllers\Api\CountryController;

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\LikeController;


use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\InfoController;

use App\Http\Controllers\Api\NotificationController;

use App\Http\Controllers\Web\Api\TapProductController;
use App\Http\Controllers\Web\Api\RatingProductController;
use App\Http\Controllers\Web\Api\AreaController;
use App\Http\Controllers\Student\Api\StudentController;

use App\Http\Controllers\Student\Api\AuthController as AuthStudentController;

const Response_Success = 1;
const Response_Fail = 0;

//////////////////////////////// start  auth /////////////////////////////////////////////
Route::group(['middleware' => ['token.valid']],function () {

    Route::post('login', [AuthController::class , 'login']);
    Route::post('register', [AuthController::class , 'register']);
    Route::post('check_email_phone', [AuthController::class , 'check_email_phone']);
    Route::post('logout', [AuthController::class , 'logout']);
    Route::post('refresh', [AuthController::class , 'refresh']);
    Route::get('profile', [AuthController::class , 'userProfile']);
    Route::post('edit-profile', [AuthController::class , 'editProfile']);
    Route::post('change-password', [AuthController::class , 'changePassword']);
    Route::post('check-phone', [AuthController::class , 'checkPhone']);
    Route::post('activation-code', [AuthController::class , 'activationCode']);

    Route::post('forgot-password', [AuthController::class , 'forgotPassword']);
    Route::post('remove-account', [AuthController::class , 'removeAccount']);
    Route::post('custom-remove-account', [AuthController::class , 'customRemoveAccount']);
    Route::post('active-remove-account', [AuthController::class , 'ActiveRemoveAccount']);

//////////////////////////////// end  auth /////////////////////////////////////////////


///////////////////////////////// start Home /////////////////////////////////////

    Route::get('get-home-products' , [HomeProductsController::class , 'index']);
    Route::get('get-tabby-status' , [HomeProductsController::class , 'tabbyStatus']);
    Route::get('new_arrive' , [HomeProductsController::class , 'new_arrive']);
    Route::get('offers' , [HomeProductsController::class , 'offers']);
    Route::get('reception' , [HomeProductsController::class , 'reception']);


    Route::get('get-order-payment/{id}' , [HomeProductsController::class , 'get_order'])->name('get-order-payment');

    Route::get('get-ids-product-like' ,  [HomeProductsController::class , 'idsProductLike']);

///////////////////////////////// end Home /////////////////////////////////////


///////////////////////////////// start categories /////////////////////////////////////

    Route::get('get-parent-categories' , [CategoryController::class , 'parentCategories']);

    Route::get('get-parent-categories' , [CategoryController::class , 'parentCategories']);


    Route::get('get-brands' , [GetBrandsController::class , 'index']);
    Route::get('get-products-in-brand/{brand_id}' , [GetBrandsController::class , 'productsInBrand']);
    Route::get('get-products-in-discount-brand/{brand_id}' , [GetBrandsController::class , 'productsInDiscountBrand']);

    Route::get('get-ads' , [GetAdsController::class , 'index']);
    Route::get('get-ads-in-position/{position}' , [GetAdsController::class , 'adsInPosition']);


///////////////////////////////// end categories ///////////////////////////////////////


/////////////////////////////////// start products in categories //////////////////////////

    Route::get('get-products-in-parentCategory/{category_id}' , [ProductInCategoriesController::class , 'productsInParentCategory']);

    Route::get('get-products-in-child/{category_id}' , [ProductInCategoriesController::class , 'getProductsInChild']);

/////////////////////////////////// end products in categories //////////////////////////////



/////////////////////////////////// start single products///////////////////////////////////

    Route::get('get-product/{product_id}' , [SingleProductController::class , 'getProduct'])->name('product');
    Route::get('get-product-colors/{product_id}/{size_id}' , [SingleProductController::class , 'getProductColors'])->name('getProductColors');
    Route::post('check_product_for_add_cart/' , [SingleProductController::class , 'check_quantity'])->name('check_quantity');



    Route::get('product/get-ratings' , [SingleProductController::class , 'getRatings']);

/////////////////////////////////// end single product ///////////////////////////////////////


///////////////////////////////////////// start rating ///////////////////////////////////////////////

    Route::post('get-my-ratings' , [RatingProductController::class , 'getMyRating']);

    Route::post('save-rating' , [RatingProductController::class , 'saveRating']);

///////////////////////////////////////// end rating ////////////////////////////////////////////////
    Route::post('get-my-search' , [SearchProductController::class , 'get_my_search']);
    Route::post('delete-my-search' , [SearchProductController::class , 'delete_my_search']);
    Route::post('search' , [SearchProductController::class , 'search']);




///////////////////////////////////////// start order /////////////////////////////////////////

    Route::get('get-countries' , [CountryController::class , 'index']);

    Route::post('get-cities' , [CountryController::class , 'cities']);

    Route::post('get-order' , [OrderController::class , 'getOrder']);
    Route::post('get-orders' , [OrderController::class , 'getOrders']);
    Route::post('get-delivery' , [OrderController::class , 'getDelivery']);
    Route::post('save-order' , [OrderController::class , 'save']);
    Route::post('save-cash' , [OrderController::class , 'saveCash']);
    Route::post('add-link-order/{id}' , [OrderController::class , 'addLinkOrder']);
    Route::post('payment_callback/{id}' , [OrderController::class , 'payment_callback']);
    Route::post('tabby_callback/{id}' , [OrderController::class , 'successPayment']);
    Route::post('check_quantity' , [HomeProductsController::class , 'check_quantity']);

    Route::post('payment-test' , [OrderController::class , 'payment_order']);

    Route::post('check-coupon' , [CouponController::class , 'checkCoupon']);

    Route::post('delivery-times' , [DeliveryTimesController::class , 'index']);

///////////////////////////////////////// end order /////////////////////////////////////////////////

///////////////////////////////// start notifications //////////////////////////////////////////
    Route::post('notifications', [NotificationController::class, 'index']);
    Route::post('notifications/save_token' , [NotificationController::class , 'save_token']);
    Route::post('notifications/count' , [NotificationController::class , 'count']);
    Route::post('notifications/show' , [NotificationController::class , 'show']);

///////////////////////////////// end notifications ///////////////////////////////////////////////
///
///////////////////////////////////////// start info ///////////////////////////////////////////////

    Route::get('infos/all' , [InfoController::class , 'all']);
    Route::get('infos' , [InfoController::class , 'index']);
    Route::get('settings' , [InfoController::class , 'settings']);
///////////////////////////////////////// end info /////////////////////////////////////////////////


///////////////////////////////////////// start info ///////////////////////////////////////////////

    Route::get('/get-wish-list' , [LikeController::class , 'getMyProductsLikes']);
    Route::post('/add-remove-wish-list' , [LikeController::class , 'saveOrRemove']);
///////////////////////////////////////// end info /////////////////////////////////////////////////

///////////////////////////////////////// start contact ///////////////////////////////////////////////

    Route::post('contact' , [ContactController::class , 'save']);

///////////////////////////////////////// end contact /////////////////////////////////////////////////

});
