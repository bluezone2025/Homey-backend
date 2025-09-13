<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use App\Models\Country;
use App\Models\Category;
use App\Models\Icon;
use App\Models\Ad;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Paginator::useBootstrap();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DB::statement("UPDATE products SET sale_price = 0 WHERE sale_price IS NULL;");

         $lang = Cookie::get('3d-lang') ? Cookie::get('3d-lang') : 'ar';
        $kokart_country = Country::get();
        $icons = Icon::where('type' , 'icon')->get(['title' , 'img' , 'link']);

        $blue_zone_cats =  Category::where('parent_id',0)->get();
         $ads_h= Ad::where('position' , 3)->inRandomOrder()->get();
        app()->setLocale($lang);


               view()->share(compact("kokart_country",'blue_zone_cats','icons','ads_h'));

    }
}
