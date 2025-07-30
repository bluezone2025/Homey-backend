<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\WishList;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth.guard:web-api');
    }

    public function getMyProductsLikes(){


        $products = Product::wherehas('likes' , function($q){
                                $q->where('user_id' , '=' , auth()->id());
                            })
                            ->latest()->simplePaginate(10);

        $productsCount = $products->count();

        return  response([
            'status'      => $productsCount > 0 ? Response_Success : Response_Fail,
            'countItems'  => $productsCount ,
            'data'        =>  $products->items(),
        ]);

    }

    public function saveOrRemove(Request $request){

        $product = Product::where('id' , $request->product_id)->first();

        if (!$product) {

            return response([
                'status' => Response_Fail,
                'message'   => 'product not found',
            ]);
        }

        $like = WishList::where('product_id' , $request->product_id)
            ->where('user_id' , auth()->id())
            ->first();

        if ($like) { //  if  found like delete

            $like->delete();

           
           
            return response([
                'status' => Response_Success,
                'type'   => 'delete',
            ]);

        } else {  //  if  not found like create


            WishList::create([
                'product_id' => $request->product_id,
                'user_id' => auth()->id(),
            ]);

            
            return response([
                'status' => Response_Success,
                'type'   => 'create',
            ]);

        }

    }



}
