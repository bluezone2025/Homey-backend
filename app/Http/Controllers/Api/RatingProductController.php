<?php

namespace App\Http\Controllers\Web\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RatingRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RatingProductController extends Controller
{


    private $product;

    public function __construct()
    {
        $this->middleware('auth.guard:web-api');
    }

    public function getMyRating(){

        $ratings = Rating::with(['product' => function ($q){

            return $q->customSelect();

        }])->where('user_id' , auth()->id())
            ->latest()
            ->simplePaginate(10);

        $ratingsCount = $ratings->count();

        return  response([
            'status'      => $ratingsCount > 0 ? Response_Success : Response_Fail,
            'countItems'  => $ratingsCount ,
            'data'        =>  $ratings->items(),
        ]);
    }


    public function saveRating(Request $request){

        // start  validator

        $validator = $this->ValidatorRating($request);

        $product = $this->product;

        $errors = $validator->errors()->all();

        if (count($errors) > 0 || !$product) {

            return response([
                'status'  => Response_Fail,
                'message' => $errors,
            ]);
        }

        // end  validator

        $this->insertRatingInDB($request , $product); // insert rating

        return response([
            'status'  => Response_Success,
        ]);

    }



    ///////////////////////////////////////////////////////
    ////                                               ////
    //// ..........  Methods Clean Code .............. ////
    ////                                               ////
    ///////////////////////////////////////////////////////


    private function ValidatorRating($request){

        $this->product = Product::where('id' , $request->product_id)->first();

        $rules = (new RatingRequest())->rules();

        return Validator::make($request->all() , $rules);

    }


    private function insertRatingInDB($request , $product){

        $columnsDB = [
            'rating'  => $request->rating,
            'comment' => $request->comment,
            'status'  => 0,
            'user_id' => auth()->id(),
        ];

        $rating = $product->ratings()
            ->where('user_id' , 1)
            ->first();

        if ($rating) {

            $rating->update($columnsDB);

        }else{

            $product->ratings()->create($columnsDB);
        }


    }


}
