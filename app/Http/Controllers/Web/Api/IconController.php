<?php

namespace App\Http\Controllers\Web\Api;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Icon;
use Illuminate\Http\Request;

class IconController extends Controller
{

    public function index(){

      $icons['icons_sp']= Icon::whereIn('title',['phone','whatsapp'])->get();
      $icons['icons'] = Icon::whereNotIn('title',['phone','whatsapp'])->get();

      return response([
          'status' => $icons['icons']->count() > 0 ? Response_Success : Response_Fail,
          'data'  => $icons,
      ]);
    }
}
