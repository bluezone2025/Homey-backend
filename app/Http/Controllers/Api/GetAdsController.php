<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Category;
use App\BasicCategory;
use App\Models\Ads;
use App\Models\Brand;
use Illuminate\Http\Request;

class GetAdsController extends Controller
{


    public function index(){
        $ads = Ads::get();
        return response([

            'status' => Response_Success,
            'data' => $ads

        ]);
    }


     public function adsInPosition($position){

        $ads = Ads::where('position',$position)->orderBy('sort','asc')->get();
         return response([

            'status' => Response_Success,
            'data' => $ads

        ]);


    }



}
