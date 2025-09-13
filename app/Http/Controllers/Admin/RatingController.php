<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RatingRequest;
use App\Models\Product;
use App\Models\Rating;
use App\MyDataTable\MDT_Method_Action;
use App\MyDataTable\MDT_Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RatingController extends Controller
{


    use MDT_Method_Action, MDT_Query;

    public function __construct()
    {

        $this->middleware('haveRole:rating.index')->only('index');
        $this->middleware('haveRole:rating.create')->only(['create' , 'store']);
        $this->middleware('haveRole:rating.update')->only('update');
        $this->middleware('haveRole:rating.destroy')->only('destroy');
        $this->middleware('haveRole:rating.restore')->only('restore');
        $this->middleware('haveRole:rating.finalDelete')->only('finalDelete');

    }

    public function index($status)
    {

        $status = $status === 'active' ? 1 : 'pending';

        return  $this->MDT_Query_method(// Start Query
            Rating::class ,
            'admin/pages/ratings/index',
            false,
            [ // Other Options
                'condition' => ['where' , 'status' , '=' , $status],
                'with_RS' => ['product:id,name_ar,name_en,img'],
                'with' => ['status' => $status , 'lang' => app()->getLocale()],
            ]

        ); // end query
    }


    public function reject($id){

        $rating = Rating::findOrFail($id);

        $rating->delete();

        if ($rating->status == 1) {

            $this->updateFiledRatingInProduct($rating->product_id); // update avg rating in product
        }

        return 'Delete Success';
    }

    public function accept($id){

        $rating = Rating::findOrFail($id);

        $rating->status = 1;

        $rating->save();

        $this->updateFiledRatingInProduct($rating->product_id); // update avg rating in product

        return 'accept Success';
    }



    ///////////////////////////////////////////////////////
    ////                                               ////
    //// ..........  Methods Clean Code .............. ////
    ////                                               ////
    ///////////////////////////////////////////////////////


    private function updateFiledRatingInProduct($product_id){

        $ratingAvg = \DB::table('ratings')
            ->where('product_id' , $product_id)
            ->where('status' , 1)
            ->avg('rating');

        Product::where('id' , $product_id)->update([

            'rating' => $ratingAvg
        ]);

        return $ratingAvg;
    }


}
