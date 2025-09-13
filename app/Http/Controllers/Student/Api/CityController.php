<?php

namespace App\Http\Controllers\Student\Api;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\cities_student;
use App\Models\countries_student;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function GetCitiesForBrand(Request $request){

        $areas = Area::all();
        $student_id = $request->brand_id;
        $areas->each(function($area) use($student_id){

            $student_area = cities_student::where('student_id',$student_id)->where('area_id',$area->id)->first();
            if ($student_area){
                $area->shipping_price = $student_area->shipping_price;
                $area->shipping_time = $student_area->shipping_time;
            }
            return $area;
        });

        //$areas = cities_student::where('student_id',$request->brand_id)->get();
        return response([
            'status' => count($areas) > 0 ? Response_Success : Response_Fail,
            'data' => $areas,
        ]);

    }
}
