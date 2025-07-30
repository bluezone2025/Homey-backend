<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CookieController extends Controller {
    public function setCookie(Request $request,$country) {
        $minutes = 43829;
        $response = new Response('Hello World');
        return
        redirect()->back()->withCookie(cookie('name', $country, $minutes));
    }
    public function getCookie(Request $request) {
        $value = $request->cookie('name');
        echo $value;
    }
}