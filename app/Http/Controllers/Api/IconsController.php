<?php

namespace App\Http\Controllers\Web\Api;

use App\Http\Controllers\Admin\IconController;
use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Icon;
use App\Models\Info;
use Illuminate\Http\Request;

class IconsController extends Controller
{

    public function index(){

        $icons = Icon::all();

        return response([
            'status' => $icons->count() > 0 ? Response_Success : Response_Fail,
            'data'  => $icons,
        ]);
    }
}
