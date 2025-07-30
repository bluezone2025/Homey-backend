<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeliveryTime;
use App\Models\DeliveryTimeNote;
use Illuminate\Http\Request;

class DeliveryTimesController extends Controller
{
    public function index(Request $request)
    {
        $delivery_times = DeliveryTime::where('begin_time','>=',$request->time)->get();
        $note = DeliveryTimeNote::orderBy('id',  'DESC')->first();

        if($delivery_times->count() >= 1){
            return  response([

                'status' =>  Response_Success,
                'data'   => [
                    'delivery_times'     => $delivery_times,
                    'note'               =>$note,

                ],
            ]);
        }
        else{
            return  response([

                'status' =>  Response_Fail,
                'data'   => 'لا يوجد مواعيد متاحة'
            ]);
        }

    }

}
