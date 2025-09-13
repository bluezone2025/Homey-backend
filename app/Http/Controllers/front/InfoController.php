<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Info;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */

    public function index($type)
    {
      $pages = Info::where('type' , $type)
          ->get(['id' ,'type','name' , 'description_ar' , 'description_en']);


        return view('front.info', compact('pages'));
    }


}
