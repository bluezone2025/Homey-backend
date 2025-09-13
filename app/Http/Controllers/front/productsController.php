<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Product;

use App\Models\Student;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;

class productsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */

    public function catProduct($cat_id)
    {
        $cats = SubCategory::all();

        $records = SubCategory::find($cat_id);
        //$populars = Item::where('subCategory_id', $cat_id)->paginate();
        $sub_sub_cat = SubSubCategory::where('subCategory_id', $cat_id)->get();
        $populars = $records->products()->paginate(15);
        return view('front.cat', compact('records', 'populars', 'sub_sub_cat', 'cats'));
    }

    public function subCatProduct($sub_cat_id)
    {
        $cats = SubCategory::all();
        $records_id = SubSubCategory::find($sub_cat_id)->subCategory_id;
      $records = SubCategory::find($records_id);

        $offers = $records->products()->paginate(15);
//        $sub_sub_cat = SubSubCategory::where('subCategory_id' , $cat_id)->get();
        return view('front.subcat', compact('records', 'offers', 'cats'));
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
      // dd(app()->getlocale());
         //dd($request->all());
        //        TODO :: MAKE SEARCH CAT = 1 OR SUB = 2  & NAME & ID (FOR SUB OR CAT)

        $id = intVal($request->id);
        $cat_or_sub = intVal($request->cat_or_sub);
        $search = $request->search;


         $perPage = 32; 
        $items = Product::where(function ($q) use ($search) {
            if ($search) {
                $q->where('name_ar', 'LIKE', '%' . $search . '%')->orWhere('name_en', 'LIKE', '%' . $search . '%');
            }
        })->orderBy("id", "desc");

        $students = Student::where(function ($q) use ($search) {
            if ($search) {
                $q->where('name_ar', 'LIKE', '%' . $search . '%')->orWhere('name_en', 'LIKE', '%' . $search . '%');
            }
        })->where('gender', '=', 3)->orderBy("id", "desc")->get();

       // إذا الطلب AJAX نرجع HTML فقط للمنتجات مع بيانات الصفحة
    if ($request->ajax()) {
        $products = $items->paginate($perPage);
        return response()->json([
            'html' => view('front.partials.products_items', ['populars' => $products])->render(),
            'next_page' => $products->nextPageUrl(),
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'students'=>$students,
      
        ]);
    }

    // الطلب الأساسي (غير AJAX)
    $products = $items->paginate($perPage);


    
    return view('front.search')->with([
        'populars' => $products,
         'students'=>$students,
        
    ]);

        //return response()->json($value);

    }

    public function searchAjax(Request $request)
{
    $search = $request->search;

    $items = Product::where(function ($q) use ($search) {
        if ($search) {
            $q->where('name_ar', 'LIKE', '%' . $search . '%')
              ->orWhere('name_en', 'LIKE', '%' . $search . '%');
        }
    })->orderBy("id", "desc")->take(30)->get();

    $items = $items->map(function($item) {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'image' => asset('assets/images/products/min/' . $item->img),
            'url' => route('product', $item->id),
        ];
    });

    $students = Student::where(function ($q) use ($search) {
        if ($search) {
            $q->where('name_ar', 'LIKE', '%' . $search . '%')
              ->orWhere('name_en', 'LIKE', '%' . $search . '%');
        }
    })->where('gender', '=', 3)->orderBy("id", "desc")->take(30)->get();

    $students = $students->map(function($item) {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'image' => asset('assets/images/student/' . $item->img),
            'url' => route('brand', $item->id),
        ];
    });

    return response([
        'status' => 'success',
        'products' => $items,
        'brands' => $students,
        'products_title'=>__('site.products'),
        'brands_title'=>__('site.brands'),
    ]);
}


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
