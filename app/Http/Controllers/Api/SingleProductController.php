<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RatingRequest;
use App\Category;
use App\Product;
use App\Rating;
use App\BasicCategory;
use App\ProdHeight;
use App\Height;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
class SingleProductController extends Controller
{

    public function getProduct($product_id){

        $product = Product::with([
            'category' ,
            'images',
            'sizes'=>function ($q1) use ($product_id){
                $q1->wherehas('colors',function ($q2) use ($product_id) {
                    $q2->where('prod_heights.product_id',$product_id)->where('prod_heights.quantity','>=',1);
                });
            } ,
        ])
            ->where('id' , $product_id)
            ->first();
            // $product->
            // dd($product->sizes->first()->colors->first());
        if($product){

            
             $product ->related_products = Product::where('id' ,'!=', $product_id)->where('basic_category_id',$product->basic_category_id)->where('appearance',1)->limit(10)->get();

        }

        return  response([
            'status'      => $product ? Response_Success : Response_Fail,
            'data'        => $product,
        ]);

    }

    public function getProductColors($product_id,$size_id){

        // $colors= ProdHeight::
        //     where('product_id' , $product_id)
        //     ->where('size_id' , $size_id)
        //     ->where('quantity','>=',1)->with('height')->get();
            // ->pluck('height_id')->toarray();
            
            $colors=DB::table('prod_heights')
                    ->join('heights','heights.id','prod_heights.height_id')
                    ->where('prod_heights.product_id' , $product_id)
                    ->where('prod_heights.size_id' , $size_id)
                    ->where('prod_heights.quantity','>=',1)
            ->select("prod_heights.id",'prod_heights.height_id',
            "prod_heights.quantity","heights.name")->get();
    //   $colors=  Height::wherein('id',$ids)->get();
            



        return  response([
            'status'      => $colors ? Response_Success : Response_Fail,
            'data'        => $colors,
        ]);

    }
    
    
     public function check_quantity(Request $request){

        $check = ProdHeight::
            where('product_id' , $request->product_id)
            ->where('size_id' , $request->size_id)
            ->where('height_id' , $request->color_id)
            // ->where('quantity','>=',$request->quantity)
            ->first();
        if( !$check ){
             return  response([
            'status'      => Response_Fail,
            'data'  => 'product not found ' ,
        ]);
        }

        return  response([
            'status'      => $check->quantity >=  $request->quantity ? Response_Success : Response_Fail,
            'data'  => $check->quantity ,
        ]);
    }

    public function getRatings(Request $request){

        $ratings = Rating::where('product_id' , $request->product_id)
            ->where('status' , 1)
            ->latest()
            ->simplePaginate(10);

        $ratingsCount = $ratings->count();

        return  response([
            'status'      => $ratingsCount > 0 ? Response_Success : Response_Fail,
            'countItems'  => $ratingsCount ,
            'data'        =>  $ratings->items(),
        ]);
    }
}
