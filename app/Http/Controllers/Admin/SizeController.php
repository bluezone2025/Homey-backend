<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AttributeRequest;
use App\Http\Requests\Admin\OptionRequest;
use App\Models\Attribute;
use App\Models\Option;
use App\MyDataTable\MDT_Method_Action;
use App\MyDataTable\MDT_Query;

class SizeController extends Controller
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
        $attributes = Attribute::get(['id' , "name_$this->lang"])
        ->pluck("name_$this->lang" , 'id')->all();

        return  $this->MDT_Query_method(// Start Query
            Option::class ,
            'admin/pages/sizes/index',
            $is_trash, // Soft Delete
            [ // Other Options
                'condition' => ['where' , 'attribute_id' , '=' , 6],
                'with'       => ['is_trash' => $is_trash,'attributes' => $attributes],
                'orderBy' => ['attribute_id' , 'desc']
            ]

        ); // end query

    }



    public function create()
    {
        return view('admin.pages.sizes.create');
    }


    public function store(OptionRequest $request)
    {
        //dd($request->all() , $this->columnsDB($request));
        Option::create($this->columnsDB($request));

        return back()->with('success' ,  __('form.response.create size'));

    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(OptionRequest $request, $id)
    {

        $category = Option::withTrashed()
            ->where('id' , $id)
            ->firstOrFail();

        $category->update($this->columnsDB($request));

        return response(['status' => 'success' , 'message' => __('form.response.update size')]);
    }

    public function destroy($id)
    {
        return $this->MDT_delete(Option::class , $id);
    }

    public function restore($id)
    {

        return $this->MDT_restore(Option::class , $id);
    }

    public function finalDelete($id)
    {
        return $this->MDT_finalDelete(Option::class , $id);
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
            'attribute_id'   => $request->attribute_id,
        ];
    }

}
