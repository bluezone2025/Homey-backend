<?php

namespace App\Http\Controllers\Web\Api;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Info;
use Illuminate\Http\Request;

class AdController extends Controller
{

    public function index(){

        $ads = Ad::all();

        return response([
            'status' => $ads->count() > 0 ? Response_Success : Response_Fail,
            'data'  => $ads,
        ]);
    }
}
