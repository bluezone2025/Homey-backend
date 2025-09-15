<?php

namespace App\Http\Controllers\Web\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class TapProductController extends Controller
{
    const COUNT_ROWS = 20;


    public function newProducts(){

        $products = Product::customSelect();
            //->inStock();
            $products=$this->ProductSort($products);
        return $this->responseSuccess($products);
    }

    public function newProducts2(){

        $products = Product::customSelect()
            //->inStock()
            #->where('is_brand',0)
            ->orderBy('id','DESC');
        $products=$this->ProductSort2($products);

            //->simplePaginate(self::COUNT_ROWS);
        return $this->responseSuccess($products);
    }


    public function bdinarProducts(){

        $products = Product::customSelect()
            //->inStock()
            ->where('regular_price','<=',1);
        $products=$this->ProductSort($products);

        return $this->responseSuccess($products);
    }

    public function storeProducts(){

        $products = Product::customSelect()->where('is_brand',1);
            //->inStock();
        $products=$this->ProductBrandSort($products);

        return $this->responseSuccess($products);
    }

    public function bestProducts(){

        $products = Product::customSelect(['is_best'])
            //->inStock()
            ->where('is_best' , 1);
            $products=$this->ProductSort($products);

        return $this->responseSuccess($products);
    }


    public function offerProducts(){

        $products = Product::customSelect()
            //->inStock()
            ->where('sale_price' , '>',0);
            $products=$this->ProductSort($products);

        return $this->responseSuccess($products);
    }


    public function recommendedProducts(){

        $products = Product::customSelect(['is_recommended'])
            //->inStock()
            ->where('is_recommended' , 1);
            $products=$this->ProductSort($products);

        return $this->responseSuccess($products);

    }

    public function topLikesProducts(){

        $products = Product::customSelect(['likes_count'])
            //->inStock()
            ->orderBy('likes_count', 'desc');
            $products=$this->ProductSort($products);

        return $this->responseSuccess($products);

    }

    public function topRatingProducts(){

        $products = Product::customSelect(['ratings'])
            //->inStock()
            ->orderBy('ratings', 'desc');
        $products=$this->ProductSort($products);
        return $this->responseSuccess($products);

    }

     public function indoorDecorProducts(){

        $products = Product::customSelect()->where('indoor' ,1);
        $products=$this->ProductSort($products);

        return $this->responseSuccess($products);
    }

     public function outdoorDecorProducts(){

        $products = Product::customSelect()->where('outdoor' ,1);
        $products=$this->ProductSort($products);

        return $this->responseSuccess($products);
    }

     public function uniquePiecesProducts(){

        $products = Product::customSelect()->where('unique' ,1);
        $products=$this->ProductSort($products);

        return $this->responseSuccess($products);
    }



    ///////////////////////////////////////////////////////
    ////                                               ////
    //// ............  Methods Clean Code ............ ////
    ////                                               ////
    ///////////////////////////////////////////////////////


      private function ProductSort($products){
          $sort=request()->sort ? :'random';//highestPrice,lowestPrice,bestSeller
          switch ($sort) {
            case 'highestPrice':
            $products=$products
                  #->where('is_brand',0)
                ->orderBy('regular_price','DESC')->simplePaginate(self::COUNT_ROWS);

              break;
            case 'lowestPrice':
                  $products=$products
                        #->where('is_brand',0)
                      ->orderBy('regular_price','asc')->simplePaginate(self::COUNT_ROWS);

              break;
            case 'bestSeller':
                $products=$products
                            #->where('is_brand',0)
                    ->orderBy('likes_count')->simplePaginate(self::COUNT_ROWS);

              break;
            default:
            $products=$products
                #->where('is_brand',0)
                ->orderByRaw('RAND()')
              ->simplePaginate(self::COUNT_ROWS);
              break;
          }
          return $products;
        }






    private function ProductSort2($products){
        $sort=request()->sort ? :'random';//highestPrice,lowestPrice,bestSeller
        switch ($sort) {
            case 'highestPrice':
                $products=$products
                    #->where('is_brand',0)
                    ->orderBy('regular_price','DESC')->simplePaginate(self::COUNT_ROWS);

                break;
            case 'lowestPrice':
                $products=$products
                    #->where('is_brand',0)
                    ->orderBy('regular_price','asc')->simplePaginate(self::COUNT_ROWS);

                break;
            case 'bestSeller':
                $products=$products
                    #->where('is_brand',0)
                    ->orderBy('likes_count')->simplePaginate(self::COUNT_ROWS);

                break;
            default:
                $products=$products
                    #->where('is_brand',0)
                    ->orderBy('id','DESC')
                    ->simplePaginate(self::COUNT_ROWS);
                break;
        }
        return $products;
    }


    private function ProductBrandSort($products){
        $sort=request()->sort ? :'random';//highestPrice,lowestPrice,bestSeller
        switch ($sort) {
            case 'highestPrice':
                $products=$products
                    ->orderBy('regular_price','DESC')->simplePaginate(self::COUNT_ROWS);

                break;
            case 'lowestPrice':
                $products=$products
                    ->orderBy('regular_price','asc')->simplePaginate(self::COUNT_ROWS);

                break;
            case 'bestSeller':
                $products=$products
                   ->orderBy('likes_count')->simplePaginate(self::COUNT_ROWS);

                break;
            default:
                $products=$products->orderByRaw('RAND()')->simplePaginate(self::COUNT_ROWS);
                break;
        }
        return $products;
    }

    private function responseSuccess($products){

        $productsCount = $products->count();

        return  response([
            'status'      => $productsCount > 0 ? Response_Success : Response_Fail,
            'countItems'  => $productsCount ,
            'data'        => $products->items() ,
        ]);
    }

}
