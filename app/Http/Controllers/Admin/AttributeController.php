<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AttributeRequest;
use App\Models\Attribute;
use App\Models\Option;
use App\MyDataTable\MDT_Method_Action;
use App\MyDataTable\MDT_Query;

class AttributeController extends Controller
{

    use MDT_Query , MDT_Method_Action;

    protected $lang;

    public function __construct()
    {
        $this->lang = app()->getLocale();

        $this->middleware('haveRole:attribute.index')->only('index');
        $this->middleware('haveRole:attribute.create')->only(['create' , 'store']);
        $this->middleware('haveRole:attribute.update')->only('update');
        $this->middleware('haveRole:attribute.destroy')->only('destroy');
        $this->middleware('haveRole:attribute.restore')->only('restore');
        $this->middleware('haveRole:attribute.finalDelete')->only('finalDelete');

    }

    public function index()
    {
        $is_trash  = \request()->segment(2) === 'trash';

        return  $this->MDT_Query_method(// Start Query
            Attribute::class ,
            'admin/pages/attributes/index',
            $is_trash, // Soft Delete
            [ // Other Options
                'with'       => ['is_trash' => $is_trash]

            ]

        ); // end query

    }


    public function create()
    {

        return view('admin.pages.attributes.create');

    }


    public function store(AttributeRequest $request)
    {


        Attribute::create($this->columnsDB($request));

        return back()->with('success' ,  __('form.response.create attribute'));

    }


    public function show($attr_id)
    {

        $attribute = Attribute::withTrashed()->findOrFail($attr_id);


        return  $this->MDT_Query_method(// Start Query
            Option::class ,
            'admin/pages/attributes/options',
            false,
            [ // Other Options
                'condition' => ['where' , 'attribute_id' , '=' , $attribute->id],
                'with'      => ['attribute' => $attribute],
            ]

        ); // end query
    }


    public function edit($id)
    {
        //
    }


    public function update(AttributeRequest $request, $id)
    {

        $category = Attribute::withTrashed()
            ->where('id' , $id)
            ->firstOrFail();

        $category->update($this->columnsDB($request));

        return response(['status' => 'success' , 'message' => __('form.response.update attribute')]);
    }

    public function destroy($id)
    {
        return $this->MDT_delete(Attribute::class , $id);
    }

    public function restore($id)
    {

        return $this->MDT_restore(Attribute::class , $id);
    }

    public function finalDelete($id)
    {
        return $this->MDT_finalDelete(Attribute::class , $id);
    }





      ///////////////////////////////////////////////////////
     ////                                               ////
    //// ..........  Methods Clean Code .............. ////
   ////                                               ////
  ///////////////////////////////////////////////////////


    public function columnsDB($request){

        return [
            'name_ar'   => $request->name_ar,
            'name_en'   => $request->name_en,
            'is_free'   => $request->is_free
        ];
    }

}
