<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\MyDataTable\MDT_Method_Action;
use App\MyDataTable\MDT_Query;
use Illuminate\Http\Request;

class SectionController extends Controller
{

    use MDT_Query , MDT_Method_Action;

    protected $lang;

    public function __construct()
    {
        $this->lang = app()->getLocale();

        $this->middleware('haveRole:section.index')->only('index');
        $this->middleware('haveRole:section.create')->only(['create' , 'store']);
        $this->middleware('haveRole:section.update')->only('update');
        $this->middleware('haveRole:section.destroy')->only('destroy');
        $this->middleware('haveRole:section.restore')->only('restore');
        $this->middleware('haveRole:section.finalDelete')->only('finalDelete');

    }

    public function index()
    {
        $is_trash  = \request()->segment(2) === 'trash';

        return  $this->MDT_Query_method(// Start Query
            Category::class ,
            'admin/pages/sections/index',
            $is_trash, // Soft Delete
            [ // Other Options
                'condition'  => ['where' , 'parent_id' , '=' , 0],
                'with'       => ['is_trash' => $is_trash],
                'with_count' => ['subCategories'],
            ]

        ); // end query

    }


    public function create()
    {

        return view('admin.pages.sections.create');

    }


    public function store(CategoryRequest $request)
    {

        Category::create($this->columnsDB($request));

        return back()->with('success' , __('form.response.create section'));

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(CategoryRequest $request, $id)
    {

        $category = Category::withTrashed()
            ->where('id' , $id)
            ->parentCategories()
            ->firstOrFail();

        $category->update($this->columnsDB($request,$category->img));

        return response(['status' => 'success' ,
         'message' => __('form.response.update section'),
         'url' => [
             'img' => asset("assets/images/categories/$category->img")
         ]
       ]);
    }

    public function destroy($id)
    {
        return $this->MDT_delete(Category::class , $id);
    }

    public function restore($id)
    {

        return $this->MDT_restore(Category::class , $id);
    }

    public function finalDelete($id)
    {
        return $this->MDT_finalDelete(Category::class , $id);
    }


    public function sortShow(){

        $sections = Category::parentCategories()
            ->withCount('subCategories')
            ->orderBy('sort' , 'desc')
            ->get(['id' , "name_$this->lang"]);

        return view('admin.pages.sections.sort')->with([
            'sections' => $sections,
            'lang'     => $this->lang,
        ]);

    }

    public function sortSave(){

        $sort = 1;

        foreach (array_reverse(\request('sections')) as $section_id):


            Category::where('id' , $section_id)->update([
                'sort' => $sort
            ]);

            $sort++;
        endforeach;

        return back();
    }



      ///////////////////////////////////////////////////////
     ////                                               ////
    //// ..........  Methods Clean Code .............. ////
   ////                                               ////
  ///////////////////////////////////////////////////////


    public function columnsDB($request, $oldImage = 'default.svg'){

        $imgName = null;

        $img = $request->file('img');

        if ($img) {

          $imgName = $request->name_en.time().'.'.$img->getClientOriginalExtension();
            $img->move(public_path('assets/images/categories') , $imgName);
        }
        return [
            'name_ar'   => $request->name_ar,
            'name_en'   => $request->name_en,
            'img'       => $imgName ?? $oldImage,

            'slug'      => strlen($request->slug) > 0
                ? $request->slug
                : \Str::slug($request->name_ar),
        ];
    }

}
