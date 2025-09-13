<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BoxCategoryRequest;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\BoxCategory;
use App\Models\Category;
use App\MyDataTable\MDT_Method_Action;
use App\MyDataTable\MDT_Query;
use Illuminate\Http\Request;

class BoxCategoryController extends Controller
{

    use MDT_Query , MDT_Method_Action;

    protected $lang;

    public function __construct()
    {
        $this->lang = app()->getLocale();

        $this->middleware('haveRole:box_category.index')->only('index');
        $this->middleware('haveRole:box_category.create')->only(['create' , 'store']);
        $this->middleware('haveRole:box_category.update')->only('update');
        $this->middleware('haveRole:box_category.destroy')->only('destroy');
        $this->middleware('haveRole:box_category.restore')->only('restore');
        $this->middleware('haveRole:box_category.finalDelete')->only('finalDelete');

    }

    public function index()
    {
        $is_trash  = \request()->segment(2) === 'trash';


        return  $this->MDT_Query_method(// Start Query
            BoxCategory::class ,
            'admin/pages/box_categories/index',
            $is_trash, // Soft Delete
            [ // Other Options
                'with'      => ['is_trash' => $is_trash],
            ]

        ); // end query

    }


    public function create()
    {

        return view('admin.pages.box_categories.create')->with([
            'lang' => $this->lang
        ]);

    }


    public function store(BoxCategoryRequest $request)
    {


        BoxCategory::create($this->columnsDB($request));

        return back()->with('success' , __('form.response.create category'));

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(BoxCategoryRequest $request, $id)
    {

        $category = BoxCategory::findOrFail($id);

        if ($request->get('canbm') == "Yes"){
            $request->request->add(['can_by_multiple'=>1]);
        }else{
            $request->request->add(['can_by_multiple'=>0]);
        }

        $category->update($this->columnsDB($request ));

        return response([
            'status' => 'success' ,
            'message' => __('form.response.update category')
        ]);
    }

    public function destroy($id)
    {
        return $this->MDT_delete(BoxCategory::class , $id);
    }

    public function restore($id)
    {

        return $this->MDT_restore(BoxCategory::class , $id);
    }

    public function finalDelete($id)
    {
        return $this->MDT_finalDelete(BoxCategory::class , $id);
    }





      ///////////////////////////////////////////////////////
     ////                                               ////
    //// ..........  Methods Clean Code .............. ////
   ////                                               ////
  ///////////////////////////////////////////////////////


    public function columnsDB($request , $oldImage = 'default.svg'){


        return [
            'title_ar'   => $request->title_ar,
            'title_en'   => $request->title_en,
            'can_by_multiple' => $request->can_by_multiple ?? 0
        ];
    }

}
