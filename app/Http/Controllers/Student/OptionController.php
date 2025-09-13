<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OptionRequest;
use App\Models\Attribute;
use App\Models\Option;
use App\MyDataTable\MDT_Method_Action;
use App\MyDataTable\MDT_Query;

class OptionController extends Controller
{

    use MDT_Query , MDT_Method_Action;

    protected $lang;

    public function __construct()
    {
        $this->lang = app()->getLocale();


    }





    public function store(OptionRequest $request)
    {

        $option = Option::create($this->columnsDB($request));

        if ($request->ajax()) {

            return  response($option);
        }
        return back()->with('success' , __('form.response.create option'));

    }



      ///////////////////////////////////////////////////////
     ////                                               ////
    //// ..........  Methods Clean Code .............. ////
   ////                                               ////
  ///////////////////////////////////////////////////////


    public function columnsDB($request){

        return [
            'name_ar'      => $request->name_ar,
            'name_en'      => $request->name_en,
            'attribute_id' => $request->attribute_id
        ];
    }

}
