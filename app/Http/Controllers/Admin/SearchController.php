<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchInProduct(string $text){

       $products = Product::where('id' , $text)
           ->orWhere('name_ar' , 'LIKE', "%$text%")
           ->orWhere('name_en' , 'LIKE', "%$text%")
           ->take(3)
           ->get(['id', 'name_ar' , 'name_en' , 'img']);

       $categories = Category::where('id' , $text)
           ->orWhere('name_ar' , 'LIKE', "%$text%")
           ->orWhere('name_en' , 'LIKE', "%$text%")
           ->take(3)
           ->get(['id', 'name_ar' , 'name_en']);



        if (\request()->ajax()) {

            return response(['products' => $products , 'categories' => $categories]);
        }
    }
}
