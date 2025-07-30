<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Pages;
use App\Settings;
use Illuminate\Http\Request;

class InfoController extends Controller
{

    public function all(){

        $infos = Pages::get(['id' ,'page_title_ar' ,'page_title_en','image' ]);


        return response([
            'status' => $infos->count() ? Response_Success : Response_Fail,
            'data'  => $infos,
        ]);
    }
    
    
     public function index(){

        $infos = Pages::where('id' , \request('type'))
            ->get(['id' ,'page_title_ar' ,'page_title_en' , 'page_details_ar' , 'page_details_en','image','video'])->first();


        return response([
            'status' => $infos ? Response_Success : Response_Fail,
            'data'  => $infos,
        ]);
    }
     public function settings(){

        $infos = Settings::first();


        return response([
            'status' => $infos ? Response_Success : Response_Fail,
            'data'  => $infos,
        ]);
    }
}
