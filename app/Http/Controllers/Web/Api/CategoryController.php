<?php

namespace App\Http\Controllers\Web\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function parentCategories(){


        $categories = Category::with('subCategories')
            ->where('parent_id' , 0)
            ->orderBy('sort' , 'desc')
            ->get();

        return response([

            'status' => count($categories) > 0 ? Response_Success : Response_Fail,
            'data' => $categories

        ]);
    }


    public function subCategories()
    {

        $categories = Category::where('parent_id', '!=', 0)
            ->orderBy('sort' , 'desc')
            ->get();

        return response([

            'status' => count($categories) > 0 ? Response_Success : Response_Fail,
            'data' => $categories
        ]);
    }


}
