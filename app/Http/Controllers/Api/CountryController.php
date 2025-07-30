<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Area;
use App\Country;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {

//        $countries = Country::with('currency')->latest()->get();
        $countries = Country::with('currency')
            ->orderByRaw("name_en LIKE '%Kuwait%' DESC")
            ->orderBy('name_en')
            ->get();
        return response([
            'status' => count($countries) > 0 ? Response_Success : Response_Fail,
            'data' => $countries,
        ]);
    }
     public function cities(Request $request)
    {
         $country_id = $request->country_id;


        $country = Country::where('id',$country_id)->first();
        if(!$country){
            return response([
                'status' =>  Response_Fail ,
                'data' => null,
            ]);
        }
           $cities= $country->cities;

        return response([
            'status' => $cities->count() > 0 ? Response_Success : Response_Fail ,
            'data' => $cities,
        ]);
    }


}
