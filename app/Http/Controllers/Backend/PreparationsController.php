<?php

namespace App\Http\Controllers\Backend;

use App\BasicCategory;
use App\Category;
use App\Height;
use App\Http\Controllers\Controller;
use App\Models\PreparationImg;
use App\Models\Preparations;
use App\ProdHeight;
use App\ProdImg;
use App\ProdSize;
use App\Product;
use App\Size;
use App\SizeGuide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class PreparationsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Preparations::latest()->get();
            return Datatables::of($data)
                ->addColumn('image', function ($artist) {
                    $url = asset('/storage/' . $artist->img);
                    return $url;
                })
                ->addIndexColumn()
                ->addColumn('action', function ($row) {


                    $action = '
                    <a class="btn btn-success"  href="' . route('preparations.edit', $row->id) . '" >' . \Lang::get('site.edit') . ' </a>

                        <a class="btn btn-outline-dark"  href="' . route('preparation_galaries.index', $row->id) . '" >' . \Lang::get('site.images') . ' </a>
                      <meta name="csrf-token" content="{{ csrf_token() }}">
                         <a  href="' . route('preparations.destroy', $row->id) . '" class="btn btn-danger">' . \Lang::get('site.delete') . '</a>';
                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.preparations.index');
    }
    public function create()
    {
        $basic_categories = BasicCategory::all();

        return view('dashboard.preparations.create', compact('basic_categories'));
    }

    public function ajaxcat(Request $request)
    {
        $cat_id = $request->get('cat_id');
        $categories = Category::where('basic_category_id', '=', $cat_id)->get();
        return response()->json($categories);
    }

    public function store(Request $request)
    {


        $messeges = [
            'photo.required' => "صورة التجهيزة مطلوبة",
            'photo.mimes' => " يجب ان تكون الصورة jpg او jpeg او png  ",
            'photo.max' => " الحد الاقصي للصورة 4 ميجا ",
        ];
        $validator = Validator::make($request->all(), [
            "price" => "required|Numeric|between:0.1,999.99",
            'photo' => 'required|mimes:jpg,jpeg,png|max:4100',

        ], $messeges);


        if ($validator->fails()) {
            Alert::error('error', $validator->errors()->first());
            return back()->withInput();
        }


        $image = $request->photo;
        $original_name = strtolower(trim($image->getClientOriginalName()));
        $file_name = time() . rand(100, 999) . $original_name;
        $path = 'uploads/preparations/images/';

        if (!Storage::exists($path)) {
            Storage::disk('public')->makeDirectory($path);
        }
        $img = \Image::make($image)->resize(640 , 690);
        $img->save(public_path('storage/' . $path . $file_name), 80);
        $preparation = Preparations::create([
            'has_offer' => $request['has_offer'] ?: 0,
            'basic_category_id' => $request['basic_category_id']?: 0,
            'category_id' => $request['category_id'] ?: 0,
            'title_ar' => $request['title_ar'] ?: '',
            'title_en' => $request['title_en'] ?: '',
            'description_en' => $request['description_en'] ?: '',
            'description_ar' => $request['description_ar'] ?: '',
            'before_price' => $request['before_price'] ?: $request['price'],
            'price' => $request['price'],
            'img' => $path . $file_name,
        ]);


        if($request->send_notifi_pro){
            self::save_notf(null,true ,'Preparations',$preparation->id ,1,$preparation);
        }

        if (session()->has("success")) {
            Alert::success('Success ', 'Success Message');
        }

        return redirect()->route('preparations.index');
    }
    public function show($id)
    {
        $product = Product::where('id', $id)->first();

        if ($product) {
            if (file_exists(storage_path('app/public/' . $product->img))) {
                unlink(storage_path('app/public/' . $product->img));
            }
            //            if (file_exists(storage_path('app/public/' . $product->height_img))) {
            //                unlink(storage_path('app/public/' . $product->height_img));
            //            }


            if ($product->cities) {
                if ($product->cities->count() > 0) {
                    foreach ($product->cities as $city) {
                        $city->delete();
                    }
                }
            }
            $product->delete();


            $size = ProdSize::where("product_id", $id)->get();
            $height = ProdHeight::where("product_id", $id)->get();
            $img = ProdImg::where("product_id", $id)->get();
            if ($size) {
                foreach ($size as $one) {
                    $one->delete();
                }
            }

            if ($height) {
                foreach ($height as $one) {
                    $one->delete();
                }
            }

            if ($img) {
                foreach ($img as $one) {
                    if (file_exists(public_path($one->img))) {
                        unlink(public_path($one->img));
                    }
                    $one->delete();
                }
            }


            $product->delete();
            session()->flash('success', "success");
            if (session()->has("success")) {
                Alert::success('نجح', ' تم حذف المنتج');
            }
        }

        //        return Response::json($user);
        return redirect()->route('products.index');
    }
    public function edit($id)
    {
        $categories = Category::all();
        $basic_categories = BasicCategory::all();
        $preparation = Preparations::findOrFail($id);

        return view('/dashboard/preparations/edit', compact(
            'basic_categories',
            'preparation',
            'categories'

        ));
    }

    public function updatePreparation(Request $request, $id)
    {
        //   dd($request->all());
        $messeges = [

            'photo.mimes' => " يجب ان تكون الصورة jpg او jpeg او png  ",
            'photo.max' => " الحد الاقصي للصورة 4 ميجا ",
        ];





        $validator = Validator::make($request->all(), [

            "price" => "required|Numeric",

        ], $messeges);


        if ($validator->fails()) {
            Alert::error('error', $validator->errors()->first());
            return back();
        }

        $preparation = Preparations::findOrFail($id);
        if (!$preparation) {
            Alert::error('error', 'هذه التجهيزة غير مسجلة بالنظام');
            return back();
        }

        if ($request->hasFile('photo')) {

            $image = $request->file('photo');
            $original_name = strtolower(trim($image->getClientOriginalName()));
            $file_name = time() . rand(100, 999) . $original_name;
            $path = 'uploads/preparations/images/';

            if (!Storage::exists($path)) {
                Storage::disk('public')->makeDirectory($path);
            }

            if (file_exists(storage_path('app/public/' . $preparation->img))) {
                unlink(storage_path('app/public/' . $preparation->img));
            }
            $img = \Image::make($image)->resize(640,690);
            $img->save(public_path('storage/' . $path . $file_name), 80);



            $preparation = $preparation->update([
                'has_offer' => $request['has_offer'] ?: 0,
                'basic_category_id' => $request['basic_category_id'] ?: 0,
                'category_id' => $request['category_id'] ?: 0,
                'title_ar' => $request['title_ar'] ?: '',
                'title_en' => $request['title_en'] ?: '',
                'description_en' => $request['description_en'] ?: '',
                'description_ar' => $request['description_ar'] ?: '',
                'price' => $request['price'],
                'before_price' => $request['before_price'] ?: $request['price'],
                'img' => $path . $file_name,

            ]);
        }


        else {
            //dd($request->all());
            $preparation = $preparation->update([
                'has_offer' => $request['has_offer'] ?: 0,
                'basic_category_id' => $request['basic_category_id']?:0,
                'category_id' => $request['category_id'] ?: 0,
                'title_ar' => $request['title_ar'] ?: '',
                'title_en' => $request['title_en'] ?: '',
                'description_en' => $request['description_en'] ?: '',
                'description_ar' => $request['description_ar'] ?: '',
                'before_price' => $request['before_price'] ?: $request['price'],
                'price' => $request['price'],

            ]);
        }


        session()->flash('success', "success");
        if (session()->has("success")) {
            Alert::success('Success ', 'Success Message');
        }

        return redirect()->route('preparations.index', $id);
    }

    public function destroy($id)
    {
        $preparation = Preparations::where('id', $id)->first();

        if ($preparation) {
            if (file_exists(storage_path('app/public/' . $preparation->img))) {
                unlink(storage_path('app/public/' . $preparation->img));
            }

            $img = PreparationImg::where("preparation_id", $id)->get();

            if ($img) {
                foreach ($img as $one) {
                    if (file_exists(public_path($one->img))) {
                        unlink(public_path($one->img));
                    }
                    $one->delete();
                }
            }
            $preparation->delete();
            session()->flash('success', "success");
            if (session()->has("success")) {
                Alert::success('نجح', ' تم حذف التجهيزة');
            }
        }
        return redirect()->route('preparations.index');
    }
}
