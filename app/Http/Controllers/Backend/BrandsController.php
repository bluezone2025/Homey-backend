<?php

namespace App\Http\Controllers\Backend;

use App\BasicCategory;
use App\Category;
use App\Models\Brand;
use App\Models\ProductBrand;
use App\Product;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Brand::latest()->get();
            return Datatables::of($data)
                ->addColumn('logo', function ($artist) {
                    $url = asset('/storage/' . $artist->logo);
                    return $url;
                })
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $action = '
<a class="btn btn-success "  href="' . route('brands.edit', $row->id) . '" id="edit-user" >'.\Lang::get('site.edit').' </a>
<meta name="csrf-token" content="{{ csrf_token() }}">
';
$action.=' <a href="' . url('brands/destroy', $row->id) . '" class="btn btn-danger test-form">'.\Lang::get('site.delete').'</a>';


                    return $action;

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.brands.index');
    }

    public function create()
    {
        return view('dashboard.brands.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());


        $messeges = [

            'name_ar.required' => "اسم البراند باللغه العربيه مطلوب",
            'email.required' => "البريد الالكترونى للبراند باللغه العربيه مطلوب",
            'phone.required' => "رقم الهاتف للبراند باللغه العربيه مطلوب",

            'name_en.required' => "اسم البراند باللغه الانجليزيه مطلوب",
            'logo.required' => "صورة البراند مطلوب",
            'arkan_percentage.required' => "نسبة اركان مطلوبة",
            'brand_percentage.required' => "نسبة البراند مطلوبة",
            'products_count.required' => "عدد منتجات البراند مطلوب",

            'logo.mimes'=>" يجب ان تكون الصورة jpg او jpeg او png  ",
            'logo.max'=>" الحد الاقصي للصورة 4 ميجا ",

        ];

        $request->validate([

            'name_ar' => ['required'],
            'name_en' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
            'arkan_percentage' => ['required'],
            'brand_percentage' => ['required'],
            'products_count' => ['required'],

            'logo' =>  'required|max:4100',

        ], $messeges);


//        if ($validator->fails()) {
//            Alert::error('خطأ', $validator->errors()->first());
//            return back()->withInput();;
//        }

        $cat = null;

        if ($request->hasfile('logo')) {
            // $images .= 'yes';

            $image = $request->file('logo');
            $original_name = strtolower(trim($image->getClientOriginalName()));
            $file_name = time() . rand(100, 999) . $original_name;
            $path = 'uploads/brands/images/';


            if (!Storage::exists($path)) {
                Storage::disk('public')->makeDirectory($path);
            }
            // dd(storage_path($path.$file_name));
            // dd(public_path('storage/'.$path.$file_name));
            // dd($path.$file_name);
            $img = \Image::make($image)->resize(512,640);
            $img->save(public_path('storage/'.$path.$file_name),60);
            // dd(public_path('storage/'.$path.$file_name));

            // $image->storeAs($path, $file_name, 'public');

//
//            if(file_exists(storage_path('app/public/'.$path.$file_name)))
//            {
//                unlink(storage_path('app/public/'.$path.$file_name));
//            }


            $brand = Brand::create([
                'name_ar' => $request['name_ar'],
                'name_en' => $request['name_en'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'arkan_percentage' => $request['arkan_percentage'],
                'brand_percentage' => $request['brand_percentage'],
                'products_count' => $request['products_count'],
                'logo' => $path.$file_name,
                'has_discount' => $request['has_discount'] ?: 0,
                'discount_percentage' =>
                 ($request['has_discount']&&$request['discount_type']=='percentage') ?$request['discount_percentage']: 0,
                'start_discount_range' =>
                ($request['has_discount']&&$request['discount_type']=='range') ?$request['start_discount_range']: 0,
                'end_discount_range' => 
                ($request['has_discount']&&$request['discount_type']=='range') ?$request['end_discount_range']: 0,

            ]);

        }
        else {
            Alert::error('خطأ', 'برجاء اختيار صورة البراند');
            return back()->withInput();;
        }

        if ($cat) {

            session()->flash('success', "success");
            if (session()->has("success")) {
                Alert::success('نجح', 'تمت إضافة براند');
            }

        }

        return redirect()->route('brands.index');

//        $uId = $request->user_id;
//        User::updateOrCreate(['id' => $uId],['name' => $request->name, 'email' => $request->email]);
//        if(empty($request->user_id))
//            $msg = 'User created successfully.';
//        else
//            $msg = 'User data is updated successfully';
//        return redirect()->route('users.index')->with('success',$msg);
    }


    public function updateBrand(Request $request , $id)
    {

//        dd($reques->all());

        $messeges = [

            'name_ar.required' => "اسم البراند باللغه العربيه مطلوب",
            'name_en.required' => "اسم البراند باللغه الانجليزيه مطلوب",
            'email.required' => "البريد الالكترونى للبراند باللغه العربيه مطلوب",
            'phone.required' => "رقم الهاتف للبراند باللغه العربيه مطلوب",
            'arkan_percentage.required' => "نسبة اركان مطلوبة",
            'brand_percentage.required' => "نسبة البراند مطلوبة",
            'products_count.required' => "عدد منتجات البراند مطلوب",

//            'logo.required' => "صورة البراند مطلوب",
//            'logo.mimes'=>" يجب ان تكون الصورة jpg او jpeg او png  ",
//            'logo.max'=>" الحد الاقصي للصورة 4 ميجا "

        ];

        $request->validate([

            'name_ar' => ['required'],
            'name_en' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
            'arkan_percentage' => ['required'],
            'brand_percentage' => ['required'],
            'products_count' => ['required'],
//            'logo' => ['required'],

        ], $messeges);


//        if ($validator->fails()) {
//            Alert::error('خطأ', $validator->errors()->first());
//            return back();
//        }

        $brand = Brand::findOrFail($id);


        if ($request->hasfile('logo')) {
            // $images .= 'yes';

            $image = $request->file('logo');
            $original_name = strtolower(trim($image->getClientOriginalName()));
            $file_name = time() . rand(100, 999) . $original_name;
            $path = 'uploads/brands/images/';

            if (!Storage::exists($path)) {
                Storage::disk('public')->makeDirectory($path);
            }

//            return (storage_path('app/public/'.$cat->image_url));

            if(file_exists(storage_path('app/public/'.$brand->logo)))
            {
                unlink(storage_path('app/public/'.$brand->logo));
            }
            $img = \Image::make($image)->resize(512,640);
            $img->save(public_path('storage/'.$path.$file_name),60);


            $brand = $brand->update([
                'name_ar' => $request['name_ar'],
                'name_en' => $request['name_en'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'arkan_percentage' => $request['arkan_percentage'],
                'brand_percentage' => $request['brand_percentage'],
                'products_count' => $request['products_count'],
                'logo' => $path.$file_name,
                'has_discount' => $request['has_discount'] ?: 0,
                'discount_type' => 
                ($request['has_discount']&&$request['discount_type']) ?$request['discount_type']: null,

                 'discount_percentage' =>
                 ($request['has_discount']&&$request['discount_type']=='percentage') ?$request['discount_percentage']: 0,
                'start_discount_range' =>
                ($request['has_discount']&&$request['discount_type']=='range') ?$request['start_discount_range']: 0,
                'end_discount_range' => 
                ($request['has_discount']&&$request['discount_type']=='range') ?$request['end_discount_range']: 0,


            ]);

        } else {

            $brand = $brand->update([
                'name_ar' => $request['name_ar'],
                'name_en' => $request['name_en'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'arkan_percentage' => $request['arkan_percentage'],
                'brand_percentage' => $request['brand_percentage'],
                'products_count' => $request['products_count'],
                'has_discount' => $request['has_discount'] ?: 0,
                'discount_type' => 
                ($request['has_discount']&&$request['discount_type']) ?$request['discount_type']: null,

                 'discount_percentage' =>
                 ($request['has_discount']&&$request['discount_type']=='percentage') ?$request['discount_percentage']: 0,
                'start_discount_range' =>
                ($request['has_discount']&&$request['discount_type']=='range') ?$request['start_discount_range']: 0,
                'end_discount_range' => 
                ($request['has_discount']&&$request['discount_type']=='range') ?$request['end_discount_range']: 0,

            ]);
        }

        if ($brand) {

            session()->flash('success', "success");
            if (session()->has("success")) {
                Alert::success('نجح', 'تم تعديل البراند');
            }

        }

        return redirect()->route('brands.index');


//        $uId = $request->user_id;
//        User::updateOrCreate(['id' => $uId],['name' => $request->name, 'email' => $request->email]);
//        if(empty($request->user_id))
//            $msg = 'User created successfully.';
//        else
//            $msg = 'User data is updated successfully';
//        return redirect()->route('users.index')->with('success',$msg);


    }




    public function edit($id)
    {
        $where = array('id' => $id);
        $brand = Brand::where($where)->first();
        if(!$brand){
            Alert::error('خطأ', 'البراند غير موجود بالنظام');
            return back();
        }

        return view('dashboard.brands.edit' , compact('brand'));

    }


    public function show( Request $request,$id){
        return 'show';
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {

        $brand = Brand::findOrFail($id);
        $prod_brands=ProductBrand::where('brand_id',$id)->get();
        // dd($products);
        if($prod_brands){
            foreach($prod_brands as $prod_brand){
                $prod_brand->delete();
            }
        }


        if($brand){

            if(file_exists(storage_path('app/public/'.$brand->logo)))
            {
                unlink(storage_path('app/public/'.$brand->logo));
            }


            $brand->delete();


            session()->flash('success', "success");
            if (session()->has("success")) {
                Alert::success('نجح', 'تم حذف البراند');
            }
        }
        return redirect()->route('brands.index');

    }
}
