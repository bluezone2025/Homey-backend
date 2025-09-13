<?php

namespace App\Http\Controllers\Student\Api;

use App\Http\Controllers\Controller;
use App\Models\cities_student;
use App\Models\countries_student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
    public function GetCountriesForBrand(Request $request){
        $countries = countries_student::where('student_id',$request->brand_id)
            ->with('areas','currency')
            ->get();

        return response([
            'status' => count($countries) > 0 ? Response_Success : Response_Fail,
            'data' => $countries,
        ]);

    }
}
