<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Category;
use App\BasicCategory;

use App\Product;
use Illuminate\Http\Request;

class ProductInCategoriesController extends Controller
{
    const COUNT_ROWS = 10;


    public function productsInParentCategory($category_id){

        $category = BasicCategory::with('categories:id,basic_category_id')  // ge all sub Category for that parent
            ->where('id' , $category_id)  // Check from category in database
            ->first();



        if ($category) { // start if the categories exists

            $subCategories = $category->categories->map->id->all();

            $allCategories = array_merge($subCategories , [$category_id]); // merge parent categories with sub categories

            $products = Product::whereIn('category_id' , $allCategories)
                ->orWhere('basic_category_id',$category_id)
                ->orderBy('id','Desc')
                ->simplePaginate(self::COUNT_ROWS);



            return $this->responseSuccess($category , $products);


        } // end if the categories exists


        return  $this->responseFail(); //  if not found Category

    }

    public function getProductsInChild($category_id){
        
        
        $category = $this->checkCategory($category_id); // Check from category in database

        if ($category) { // start if the categories exists

            $products = Product::where('category_id'  , $category->id)
                ->orderBy('id','Desc')
                ->simplePaginate(self::COUNT_ROWS);


            return $this->responseSuccess($category , $products);

        } // end if the categories exists


        return  $this->responseFail(); //  if not found Category
    }

    public function bestProducts($category_id){

        $category = $this->checkCategory($category_id); // Check from category in database

        if ($category) { // start if the categories exists


            $products = Product::whereHas('categories' , function ($q) use ($category){
                $q->where('categories.id' , $category->id);
            })
                ->inStock()
                ->customSelect(['is_best'])
                ->where('is_best' , 1)->where('appearance', 1)
                ->latest('id')
                ->simplePaginate(self::COUNT_ROWS);


            return $this->responseSuccess($category , $products);

        } // end if the categories exists


        return  $this->responseFail(); //  if not found Category
    }

    public function offerProducts($category_id){

        $category = $this->checkCategory($category_id); // Check from category in database

        if ($category) { // start if the categories exists


            $products = Product::whereHas('categories' , function ($q) use ($category){
                $q->where('categories.id' , $category->id);
            })
                ->inStock()
                ->where('in_sale' , 1)->where('appearance', 1)
                ->latest()
                ->simplePaginate(self::COUNT_ROWS);


            return $this->responseSuccess($category , $products);

        } // end if the categories exists


        return  $this->responseFail(); //  if not found Category
    }

    public function recommendedProducts($category_id){

        $category = $this->checkCategory($category_id); // Check from category in database

        if ($category) { // start if the categories exists


            $products = Product::whereHas('categories' , function ($q) use ($category){
                $q->where('categories.id' , $category->id);
            })
                ->inStock()
                ->customSelect(['is_recommended'])
                ->where('is_recommended' , 1)->where('appearance', 1)
                ->latest()
                ->simplePaginate(self::COUNT_ROWS);


            return $this->responseSuccess($category , $products);

        } // end if the categories exists


        return  $this->responseFail(); //  if not found Category
    }




    ///////////////////////////////////////////////////////
    ////                                               ////
    //// ..........  Methods Clean Code .............. ////
    ////                                               ////
    ///////////////////////////////////////////////////////


    private function checkCategory($category_id){

        $category = Category::where('id' , $category_id)
            ->first();

        return $category;
    }

    private function responseSuccess($category , $products){

        $productsCount = $products->count();
        return  response([
            'status'      => $productsCount > 0 ? Response_Success : Response_Fail,
            'countItems'  => $productsCount ,
            'data'        => [

                'category' => $category,
                'products' => $products->items(),
            ],
        ]);
    }


    public function responseFail(){

        return  response([
            'status'      => 0 ,
            'countItems'  => 0 ,
        ]);
    }
}