<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RatingRequest;
use App\Models\Product;
use App\Models\DesignRating;
use App\MyDataTable\MDT_Method_Action;
use App\MyDataTable\MDT_Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class DesignRatingController extends Controller
{


    use MDT_Method_Action, MDT_Query;

    public function __construct()
    {

        $this->middleware('haveRole:design.rating.index')->only('index');
        $this->middleware('haveRole:design.rating.create')->only(['create' , 'store']);
        $this->middleware('haveRole:design.rating.update')->only('update');
        $this->middleware('haveRole:design.rating.destroy')->only('destroy');
        $this->middleware('haveRole:design.rating.restore')->only('restore');
        $this->middleware('haveRole:design.rating.finalDelete')->only('finalDelete');

    }

    public function index($status)
    {

        $status = $status === 'active' ? 1 : 'pending';

        return  $this->MDT_Query_method(// Start Query
            DesignRating::class ,
            'admin/pages/designs/ratings/index',
            false,
            [ // Other Options
                'condition' => ['where' , 'status' , '=' , $status],
                'with_RS' => ['design:id,design_name'],
                'with' => ['status' => $status , 'lang' => app()->getLocale()],
            ]

        ); // end query
    }


    public function reject($id){

        $rating = DesignRating::findOrFail($id);

        $rating->delete();



        return 'Delete Success';
    }

    public function accept($id){

        $rating = DesignRating::findOrFail($id);

        $rating->status = 1;

        $rating->save();


        return 'accept Success';
    }



    ///////////////////////////////////////////////////////
    ////                                               ////
    //// ..........  Methods Clean Code .............. ////
    ////                                               ////
    ///////////////////////////////////////////////////////




}
