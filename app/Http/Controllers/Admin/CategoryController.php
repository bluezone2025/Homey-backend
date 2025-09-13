<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\MyDataTable\MDT_Method_Action;
use App\MyDataTable\MDT_Query;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    use MDT_Query , MDT_Method_Action;

    protected $lang;

    public function __construct()
    {
        $this->lang = app()->getLocale();

        $this->middleware('haveRole:category.index')->only('index');
        $this->middleware('haveRole:category.create')->only(['create' , 'store']);
        $this->middleware('haveRole:category.update')->only('update');
        $this->middleware('haveRole:category.destroy')->only('destroy');
        $this->middleware('haveRole:category.restore')->only('restore');
        $this->middleware('haveRole:category.finalDelete')->only('finalDelete');

    }

    public function index()
    {
        $is_trash  = \request()->segment(2) === 'trash';

        $sections = Category::parentCategories()
            ->get(['id' , "name_$this->lang"])
            ->pluck("name_$this->lang" , 'id')->all();

        return  $this->MDT_Query_method(// Start Query
            Category::class ,
            'admin/pages/categories/index',
            $is_trash, // Soft Delete
            [ // Other Options
                'condition' => ['where' , 'parent_id' , '!=' , 0],
                'with'      => ['sections' => $sections, 'is_trash' => $is_trash],
                'with_count' => ['products'],
            ]

        ); // end query

    }


    public function create()
    {

        $sections = Category::parentCategories()
            ->get(['id' , "name_$this->lang"]);

        return view('admin.pages.categories.create')->with([
            'sections' => $sections,
            'lang' => $this->lang
        ]);

    }


    public function store(CategoryRequest $request)
    {

        Category::create($this->columnsDB($request));

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


    public function update(CategoryRequest $request, $id)
    {

        $category = Category::withTrashed()
            ->categories()
            ->findOrFail($id);

        $category->update($this->columnsDB($request , $category->img));

        return response([
            'status' => 'success' ,
            'message' => __('form.response.update category'),
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

        $sections = Category::with(["subCategories" => function($q){

            $q->select(['id', "parent_id", "name_$this->lang"])
                ->orderBy('sort' , 'desc')
                ->withCount('products');
        }])
            ->parentCategories()
            ->get(['id' , "name_$this->lang" , 'parent_id']);


        return view('admin.pages.categories.sort')->with([
            'sections' => $sections,
            'lang'     => $this->lang,
        ]);

    }

    public function sortSave(){

        foreach (\request('sections') as $section):

            $this->sortCategoriesInTisSection($section);

        endforeach;

        return back();
    }



      ///////////////////////////////////////////////////////
     ////                                               ////
    //// ..........  Methods Clean Code .............. ////
   ////                                               ////
  ///////////////////////////////////////////////////////


    public function columnsDB($request , $oldImage = 'default.svg'){

        $imgName = null;

        $img = $request->file('img');

        if ($img) {

          $imgName = $request->name_en.time().'.'.$img->getClientOriginalExtension();
            $img->move(public_path('assets/images/categories') , $imgName);
        }

        return [
            'name_ar'   => $request->name_ar,
            'name_en'   => $request->name_en,
            'parent_id' => $request->parent_id,
            'img'       => $imgName ?? $oldImage,
            'slug'      => strlen($request->slug) > 0
                ? $request->slug
                : \Str::slug($request->name_ar),
        ];
    }

    private function sortCategoriesInTisSection($section){

        $sort = 1;

        foreach (array_reverse($section) as $cat_id):

            Category::where('id' , $cat_id)->update([
                'sort' => $sort
            ]);

            $sort++;
        endforeach;
    }
}
