<?php

namespace App\Http\Controllers\Web\Api;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
class ProductInCategoriesController extends Controller
{
    const COUNT_ROWS = 20;


    public function productsInParentCategory($category_id){

        $category = Category::with('subCategories:id,parent_id')  // ge all sub Category for that parent
            ->where('id' , $category_id)  // Check from category in database
            ->where('parent_id' , '=' , 0)
            ->first();


        if ($category) { // start if the categories exists

            $subCategories = $category->subCategories->map->id->all();

            $allCategories = array_merge($subCategories , [$category_id]); // merge parent categories with sub categories

            $products = Product::whereHas('categories' , function ($q) use ($allCategories){
                $q->whereIn('categories.id' , $allCategories);
            })
                //->inStock()
                ->customSelect()
                ->latest()
                ->simplePaginate(self::COUNT_ROWS);



            return $this->responseSuccess($category , $products);


        } // end if the categories exists


        return  $this->responseFail(); //  if not found Category

    }

    public function newProducts($category_id){

        $category = $this->checkCategory($category_id); // Check from category in database
        $sort=request()->sort?:'random';//highestPrice,lowestPrice,bestSeller
        // dd( $sort);
        if ($category) { // start if the categories exists


            $products = Product::withCount('likes')->whereHas('categories' , function ($q) use ($category){
                $q->where('categories.id' , $category->id);
            })
                //->inStock()
                #->where('is_brand',0)
                ->customSelect();
                switch ($sort) {
                  case 'highestPrice':
                  $products=$products->orderBy('regular_price','DESC')->inRandomOrder()->simplePaginate(self::COUNT_ROWS);

                    break;
                  case 'lowestPrice':
                        $products=$products->orderBy('regular_price','asc')->inRandomOrder()->simplePaginate(self::COUNT_ROWS);

                    break;
                  case 'bestSeller':
                      $products=$products->orderBy('likes_count')->inRandomOrder()->simplePaginate(self::COUNT_ROWS);
                    break;
                  default:
                  $products=$products->inRandomOrder()->simplePaginate(self::COUNT_ROWS);
                    break;
                }






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
                //->inStock()
                ->customSelect(['is_best'])
                ->where('is_best' , 1)
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
                //->inStock()
                ->where('in_sale' , 1)
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
                //->inStock()
                ->customSelect(['is_recommended'])
                ->where('is_recommended' , 1)
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
            ->where('parent_id' , '!=' , 0)
            ->first();

        return $category;
    }

    private function responseSuccess($category , $products){

        $productsCount = $products->count();

        $ads = Ad::where('position' , 11)->first();

        return  response([
            'status'      => $productsCount > 0 ? Response_Success : Response_Fail,
            'countItems'  => $productsCount ,
            'data'        => [

                'category' => $category,
                'products' => $products->items(),
                'ads'      => $ads
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
