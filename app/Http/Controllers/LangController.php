<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LangController extends Controller
{
    function index($lang,Request $request){
        $lang = $lang === "ar" ? 'ar' : 'en';

        $cookie = Cookie::forever('3d-lang' , $lang);
      if ($request->is('api/*')) {
        app()->setlocale($lang);
        return  response([
            'status'      => 1,

        ]);
        }else{
          return back()->withCookie($cookie);

        }
    }

}
