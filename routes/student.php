<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\Student\Auth\LoginController;
use \App\Http\Controllers\Student\Auth\RegisterController;
use \App\Http\Controllers\Student\Auth\ForgotPasswordController;
use \App\Http\Controllers\Student\Auth\ResetPasswordController;
use \App\Http\Controllers\Student\Auth\ConfirmPasswordController;

use \App\Http\Controllers\Student\DashboardController;
use \App\Http\Controllers\Student\ProfileController;
use \App\Http\Controllers\Student\OrderController;
use \App\Http\Controllers\Student\ProductController as ProductControllerBrand;

use App\Http\Controllers\Student\CitiesStudentController as CitiesController;
use App\Http\Controllers\Student\CountriesStudentController as CountriesController;

// Login
Route::get('login', [LoginController::class , 'showLoginForm'])->name('login');
Route::post('login',  [LoginController::class , 'login']);
Route::any('logout',  [LoginController::class , 'logout'])->name('logout');

// Register
Route::get('register', [RegisterController::class,'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class,'register']);


// Reset Password
Route::get('password/reset', [ForgotPasswordController::class , 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class , 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class , 'showResetForm'])->name('password.reset');
Route::post('password/reset',  [ResetPasswordController::class , 'reset'])->name('password.update');

// Confirm Password
Route::get('password/confirm', [ConfirmPasswordController::class,'showConfirmForm'])->name('password.confirm');
Route::post('password/confirm', [ConfirmPasswordController::class,'confirm']);


// Verify Email
// Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
// Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
// Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

Route::view('notActive' , 'student.pages.notActive.index')->name('notActive');

Route::get('save-lang/{lang}', [\App\Http\Controllers\LangController::class, 'index'])->name('lang.change');

Route::middleware('student.auth')->group(function () {

    Route::get('/' , [DashboardController::class , 'index'])->name('home');
    Route::get('/add-product' , [DashboardController::class , 'addProduct'])->name('add-product');
    Route::post('/store-product' , [DashboardController::class , 'storeProduct'])->name('store-product');


    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('profile/img', [ProfileController::class, 'updateImg'])->name('profile.updateImg');
    Route::put('profile', [ProfileController::class, 'updateInfo'])->name('profile.updateInfo');
    Route::post('profile', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::post('profile/update-discount', [ProfileController::class, 'updateDiscount'])->name('profile.update-discount');
    Route::post('profile/update-discount-by-product', [ProfileController::class, 'updateDiscountByProducts'])->name('profile.update-discount-by-product');
    Route::get('profile/remove-discount', [ProfileController::class, 'removeDiscount'])->name('profile.remove-discount');
    //
    // Route::get('products/showCategories' , [ProductController::class,  'showCategories'])->name('showCategories');
    //
    // Route::get('products/myProducts' , [ProductController::class,  'myProducts'])->name('myProducts');
    //
    // Route::get('products/showProducts/{cat_id}' , [ProductController::class,  'showProducts'])->name('showProducts');
    //
    // Route::post('products/saveProduct/{id}' , [ProductController::class,  'saveProduct'])->name('saveProduct');
    //
    // Route::post('products/removeProduct/{id}' , [ProductController::class,  'removeProduct'])->name('removeProduct');

        Route::resource('products' , ProductController::class );
        Route::post('import/products' , [ProductControllerBrand::class , 'import'])->name('products.import');
        Route::get('products/{id}/edit/' , [ProductControllerBrand::class , 'edit'])->name('products.edit2');
        Route::get('trash/products/{id?}' , [ProductControllerBrand::class , 'index'])->name('products.trash');
        Route::post('trash/products/{id}' , [ProductControllerBrand::class , 'restore'])->name('products.restore');
        Route::delete('trash/products/{id}' , [ProductControllerBrand::class , 'finalDelete'])->name('products.finalDelete');
        Route::get('attributes/products/{id}' , [ProductControllerBrand::class , 'attribute'])->name('products.attributes');
        Route::get('orders' , [OrderController::class,  'index'])->name('orders');

        // Route::resource('orders' , OrderController::class );
    // Route::get('orders/inpaid/' , [OrderController::class , 'index_inpaid'])->name('orders_inpaid.index');
        Route::get('orders/inpaid/' , [OrderController::class , 'index_inpaid'])->name('index_inpaid.index');
        Route::get('orders/refused/all' , [OrderController::class , 'refused'])->name('refused.index');
        Route::get('orders/cach/' , [OrderController::class , 'index_cach'])->name('index_cach.index');
        Route::get('orders/not-complete/' , [OrderController::class , 'notComplete'])->name('not-complete.index');
        Route::PUT ('orders/update/{id}' , [OrderController::class , 'update'])->name('orders.update');
        Route::get('orders/{id}' , [OrderController::class , 'show'])->name('orders.show');

    //countries

    Route::resource('countries' , CountriesStudentController::class );
    Route::get('trash/countries/{id?}' , [CountriesController::class , 'index'])->name('countries.trash');
    Route::post('trash/countries/{id}' , [CountriesController::class , 'restore'])->name('countries.restore');
    Route::delete('trash/countries/{id}' , [CountriesController::class , 'finalDelete'])->name('countries.finalDelete');


    //cities

    Route::resource('areas' , CitiesStudentController::class );
    Route::get('trash/areas/{id?}' , [CitiesController::class , 'index'])->name('areas.trash');
    Route::post('trash/areas/{id}' , [CitiesController::class , 'restore'])->name('areas.restore');
    Route::delete('trash/areas/{id}' , [CitiesController::class , 'finalDelete'])->name('areas.finalDelete');
    Route::post('options' ,[\App\Http\Controllers\Student\OptionController::class,'store'])->name('options.store');



});
