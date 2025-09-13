<?php

namespace App\Http\Controllers\Web\Api;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Like;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {

        $areas = Area::latest()->get();

        return response([
            'status' => count($areas) > 0 ? Response_Success : Response_Fail,
            'data' => $areas,
        ]);
    }}
