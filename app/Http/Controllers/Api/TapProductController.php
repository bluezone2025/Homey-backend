<?php

namespace App\Http\Controllers\Web\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class TapProductController extends Controller
{
    const COUNT_ROWS = 10;


    public function newProducts(){

        $products = Product::customSelect()
            ->inStock()
            ->latest()
            ->simplePaginate(self::COUNT_ROWS);

        return $this->responseSuccess($products);
    }


    public function bestProducts(){

        $products = Product::customSelect(['is_best'])
            ->inStock()
            ->where('is_best' , 1)
            ->latest()
            ->simplePaginate(self::COUNT_ROWS);

        return $this->responseSuccess($products);
    }


    public function offerProducts(){

        $products = Product::customSelect()
            ->inStock()
            ->where('in_sale' , 1)
            ->latest()
            ->simplePaginate(self::COUNT_ROWS);

        return $this->responseSuccess($products);
    }


    public function recommendedProducts(){

        $products = Product::customSelect(['is_recommended'])
            ->inStock()
            ->where('is_recommended' , 1)
            ->latest()
            ->simplePaginate(self::COUNT_ROWS);

        return $this->responseSuccess($products);

    }

    public function topLikesProducts(){

        $products = Product::customSelect(['likes_count'])
            ->inStock()
            ->orderBy('likes_count', 'desc')
            ->simplePaginate(self::COUNT_ROWS);

        return $this->responseSuccess($products);

    }

    public function topRatingProducts(){

        $products = Product::customSelect(['ratings'])
            ->inStock()
            ->orderBy('ratings', 'desc')
            ->simplePaginate(self::COUNT_ROWS);

        return $this->responseSuccess($products);

    }

    ///////////////////////////////////////////////////////
    ////                                               ////
    //// ............  Methods Clean Code ............ ////
    ////                                               ////
    ///////////////////////////////////////////////////////


    private function responseSuccess($products){

        $productsCount = $products->count();

        return  response([
            'status'      => $productsCount > 0 ? Response_Success : Response_Fail,
            'countItems'  => $productsCount ,
            'data'        => $products->items() ,
        ]);
    }

}
