<?php

namespace App\Http\Controllers\Web\Api;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Info;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{

    public function index(){

        $sliders = Slider::all();

        return response([
            'status' => $sliders->count() > 0 ? Response_Success : Response_Fail,
            'data'  => $sliders,
        ]);
    }
}
