<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Category;
use App\BasicCategory;
use App\Models\Brand;
use App\Product;
use Illuminate\Http\Request;

class GetBrandsController extends Controller
{


    public function index(){


        $data=[];
        $discounts_brands = Brand::where('has_discount',1)->get();
        $brands = Brand::all();
        $data['discounts_brands']=$discounts_brands;
        $data['normal_brands']=$brands;

        return response([

            'status' => count($brands) > 0 ? Response_Success : Response_Fail,
            'data' => $data

        ]);
    }

    public function productsInBrand($brand_id){

        $brand = Brand::findOrFail($brand_id);
        if ($brand) {
                 $products = Product::where('brand_id',$brand_id)->get();

            return $this->responseSuccess($brand , $products);


        }
        else{
            return  $this->responseFail();

        }


    }

    public function productsInDiscountBrand($brand_id){

        $brand = Brand::findOrFail($brand_id);
        if ($brand) {
            if($brand->has_discount==1){
                 $products = Product::where('brand_id',$brand_id)
                                    ->where('has_offer', 1)
                                    ->get();
            }

            return $this->responseSuccess($brand , $products);


        }
        else{
            return  $this->responseFail();

        }


    }

    private function responseSuccess($brand, $products){

        $productsCount = $products->count();
        return  response([
            'status'      => Response_Success ,
            'countItems'  => $productsCount ,
            'data'        => [

                'brand' => $brand,
                'products' => $products,
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
