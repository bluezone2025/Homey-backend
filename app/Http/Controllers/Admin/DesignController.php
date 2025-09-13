<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RatingRequest;
use App\Models\Product;
use App\Models\Design;
use App\MyDataTable\MDT_Method_Action;
use App\MyDataTable\MDT_Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class DesignController extends Controller
{


    use MDT_Method_Action, MDT_Query;

    public function __construct()
    {

        $this->middleware('haveRole:design.index')->only('index');
        $this->middleware('haveRole:design.create')->only(['create' , 'store']);
        $this->middleware('haveRole:design.update')->only('update');
        $this->middleware('haveRole:design.destroy')->only('destroy');
        $this->middleware('haveRole:design.restore')->only('restore');
        $this->middleware('haveRole:design.finalDelete')->only('finalDelete');

    }

    public function index($status)
    {

        $status = $status === 'active' ? 1 : 'pending';

        return  $this->MDT_Query_method(// Start Query
            Design::class ,
            'admin/pages/designs/index',
            false,
            [ // Other Options
                'condition' => ['where' , 'status' , '=' , $status],
                'with' => ['status' => $status , 'lang' => app()->getLocale()],
            ]

        ); // end query
    }
    public function show($id){

        $design = Design::findOrFail($id);




        return  view('admin.pages.designs.show', compact('design'));
    }

    public function reject($id){

        $rating = Design::findOrFail($id);

        $rating->delete();



        return 'Delete Success';
    }

    public function accept($id){

        $rating = Design::findOrFail($id);

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
