<?php

namespace App\Http\Controllers\Web\Api;

use App\Http\Controllers\Controller;
use App\Models\Info;
use App\Models\Setting;
use Illuminate\Http\Request;

class InfoController extends Controller
{

    public function index(){

        $infos = Info::where('type' , \request('type'))
            ->orderBy('sort', 'desc')
            ->get(['id' ,'name' , 'description_ar' , 'description_en']);


        return response([
            'status' => $infos->count() > 0 ? Response_Success : Response_Fail,
            'data'  => $infos,
        ]);
    }

    public function minTotalOrder(){

        $min_order_price = Setting::where('name' , 'min_order_price')->select('name' ,'value' , 'description')->first();
        if ($min_order_price){
            $data = [
                'name'  => $min_order_price->name,
                'value' => (float) number_format($min_order_price->value,2),
                'description'   => $min_order_price->description
            ];
        }else{
            $data = [];
        }
        return response([
            'status' => $min_order_price ? Response_Success : Response_Fail,
            'data'  => $data,
        ]);
    }
}
