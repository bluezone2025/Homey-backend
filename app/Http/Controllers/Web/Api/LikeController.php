<?php

namespace App\Http\Controllers\Web\Api;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth.guard:web-api');
    }

    public function getMyProductsLikes(){


        $products = Product::whereRelation('likes' , 'user_id' , '=' , auth()->id())
            ->with('likes:brand_id,product_id')->latest()
            ->customSelect()
            ->simplePaginate(20);

        $productsCount = $products->count();

        return  response([
            'status'      => $productsCount > 0 ? Response_Success : Response_Success,
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

        $like = Like::where('product_id' , $request->product_id)
            ->where('user_id' , auth()->id())
            ->where('brand_id', $request->brand_id)
            ->first();

        if ($like) { //  if  found like delete

            $like->delete();

            Product::where('id', $request->product_id)
                ->update([
                    'likes_count'=> \DB::raw('likes_count-1'),
                    'updated_at' => Carbon::now()
                ]);

            return response([
                'status' => Response_Success,
                'type'   => 'delete',
            ]);

        } else {  //  if  not found like create


            Like::create([
                'product_id' => $request->product_id,
                'brand_id'=>  $request->brand_id,
                'user_id' => auth()->id(),
            ]);

            Product::where('id', $request->product_id)
                ->update([
                    'likes_count' => \DB::raw('likes_count+1'),
                    'updated_at' => Carbon::now()
                ]);

            return response([
                'status' => Response_Success,
                'type'   => 'create',
            ]);

        }

    }



}
