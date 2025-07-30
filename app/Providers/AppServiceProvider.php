<?php

namespace App\Providers;

use App\BasicCategory;
use App\BestSeller;
use App\Product;
use App\Settings;
use App\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $my_setting = Settings::first();
        $best_selling = BestSeller::orderBy('rate' , 'DESC')->take(9)->get();
        $last_views = View::orderBy('updated_at' ,  'DESC')->take(3)->get();
        $system_basic_categories = BasicCategory::all();
        view()->share(compact('my_setting' , 'best_selling' , 'last_views' , 'system_basic_categories'));

    }
}
