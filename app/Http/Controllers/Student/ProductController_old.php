<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function myProducts(){


        $products = Product::whereRelation('students' , 'student_id' , '=' ,  auth('student')->id())
            ->latest()
            ->paginate(24);

        return view('student.pages.products.myProducts')->with([
            'products' => $products,
            'lang' => app()->getLocale(),
        ]);
    }


    public function showCategories(){

        $student = auth('student')->user();

        $categories = false;

        if($student->limit_products > $student->products()->count()) {

            $categories = Category::withCount('productsNotSave')
                ->where('parent_id', '>', 0)
                ->get();
        }

        return view('student.pages.products.showCategories')->with([
            'categories' => $categories,
            'lang' => app()->getLocale(),
        ]);
    }


    public function showProducts($id){

        $products = Product::whereRelation('categories' , 'category_id' , '=' , $id)
            ->whereDoesntHave('students' , function ($q){
                return $q->where( 'student_id' , '=' , auth('student')->id());
            })->latest()
            ->paginate(24);

        return view('student.pages.products.showProducts')->with([
            'products' => $products,
            'lang' => app()->getLocale(),
        ]);
    }


    public function saveProduct($id){

        $student = auth('student')->user();

        if($student->limit_products > $student->products()->count()) {

            Product::findOrFail($id);

            auth('student')->user()->products()->attach([$id]);

            return response(['status' => 'success']);

        }


        return response(['status' => false]);
    }

    public function removeProduct($id){

        Product::findOrFail($id);

        auth('student')->user()->products()->detach([$id]);
        return "success save";
    }
}
