<?php

namespace App\Http\Controllers\Web\Api;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Country;
use App\Models\Like;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {

        $countries = Country::with('areas','currency')->latest()->get();

        return response([
            'status' => count($countries) > 0 ? Response_Success : Response_Fail,
            'data' => $countries,
        ]);
    }}
