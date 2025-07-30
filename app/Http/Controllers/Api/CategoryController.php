<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Category;
use App\BasicCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function parentCategories(){


        $categories = BasicCategory::with('categories')->get();

        return response([

            'status' => count($categories) > 0 ? Response_Success : Response_Fail,
            'data' => $categories

        ]);
    }


    public function subCategories()
    {

        $categories = Category::get();

        return response([

            'status' => count($categories) > 0 ? Response_Success : Response_Fail,
            'data' => $categories
        ]);
    }


}
