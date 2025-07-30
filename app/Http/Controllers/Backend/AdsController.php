<?php

namespace App\Http\Controllers\Backend;

use App\BasicCategory;
use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Brand;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        dd('ads');

        if ($request->ajax()) {
            $data =  Ads::latest()->get();

            return Datatables::of($data)
                ->addColumn('image', function ($artist) {
                    $url = asset('/storage/' . $artist->image);
                    return $url;
                })
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = '
                        <a class="btn btn-success"  href="'.route('ads.edit' , $row->id).'" >'.\Lang::get('site.edit').' </a>
                        <meta name="csrf-token" content="{{ csrf_token() }}">

                       <a  href="'.route('ads.destroy' , $row->id).'" class="btn btn-danger">'.\Lang::get('site.delete').'</a>';
                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.ads.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $basic_categories= BasicCategory::all();
        $brands= Brand::all();
        $products= Product::all();


        return view('dashboard.ads.create' , compact('basic_categories','brands','products'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messeges = [

            'type.required'=>"عنوان الاعلان مطلوب",
            'image.required'=>"صورة الاعلان مطلوب",
             'position.required'=>"موضع الاعلان مطلوب",
            'sort.required'=>"ترتيب ظهور الاعلان مطلوب",
        ];

        $validator =  Validator::make($request->all(), [
            'type' => ['required'],
            'image' => ['required'],
            'position' => ['required'],
            'sort' => ['required'],
            ], $messeges);



        if ($validator->fails()) {
            Alert::error('خطأ', $validator->errors()->first());
            return back()->withInput();;
        }

        if ($request->hasfile('image')) {
            // $images .= 'yes';

            $image = $request->file('image');
            $original_name = strtolower(trim($image->getClientOriginalName()));
            $file_name = time() . rand(100, 999) . $original_name;

            $parentPath = 'uploads/ads/';

            $path = 'uploads/ads/images/';

            if (!Storage::exists($parentPath)) {
                Storage::disk('public')->makeDirectory($parentPath);
            }


            if (!Storage::exists($path)) {
                Storage::disk('public')->makeDirectory($path);
            }
            // dd(storage_path($path.$file_name));
            // dd(public_path('storage/'.$path.$file_name));
            // dd($path.$file_name);
            $img = \Image::make($image)->resize(512,640);
            $img->save(public_path('storage/'.$path.$file_name),60);


            $ad = Ads::create([
                'type'=>$request->type,
                'product_id'=>($request->type=="product")?$request->product_id:null,
                'category_id'=>($request->type=="category")?$request->category_id:null,
                'brand_id'=>($request->type=="brand")?$request->brand_id:null,
                'position'=>$request->position,
                'sort'=>$request->sort,

                'image' => $path.$file_name,
            ]);

        }
        else {
            Alert::error('خطأ', 'برجاء اختيار صورة الاعلان');
            return back()->withInput();;
        }

        if ($ad){

            session()->flash('success', "success");
            if(session()->has("success")){
                Alert::success('نجح', 'تمت إضافة اعلان بنجاح');
            }

        }

        return redirect()->route('ads.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ad = Ads::where('id',$id)->first();


        if($ad){
            $ad->delete();
            session()->flash('success', "success");
            if(session()->has("success")){
                Alert::success('نجح', 'تم حذف الاعلان');
            }

        }

//        return Response::json($user);
        return redirect()->route('ads.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $ad = Ads::where($where)->first();
        if(!$ad){
            Alert::error('خطأ', 'الاعلان غير موجوده بالنظام');
            return back();
        }

        $basic_categories = BasicCategory::all();
        $brands= Brand::all();
        $products= Product::all();
        return view('dashboard.ads.edit' , compact('ad' ,
            'basic_categories','products','brands'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAd(Request $request ,$id){


        $messeges = [

            'type.required'=>"عنوان الاعلان مطلوب",
             'position.required'=>"موضع الاعلان مطلوب",
            'sort.required'=>"ترتيب ظهور الاعلان مطلوب",
        ];

        $validator =  Validator::make($request->all(), [
            'type' => ['required'],
            'position' => ['required'],
            'sort' => ['required'],
            ], $messeges);


        if ($validator->fails()) {
            Alert::error('خطأ', $validator->errors()->first());
            return back();
        }


        $ad = Ads::find($id);


        if(!$ad){
            Alert::error('خطأ', 'الاعلان غير موجود');
            return back();
        }


        if ($request->hasfile('image')) {
            // $images .= 'yes';

            $image = $request->file('image');
            $original_name = strtolower(trim($image->getClientOriginalName()));
            $file_name = time() . rand(100, 999) . $original_name;
            $parentPath = 'uploads/ads/';

            $path = 'uploads/ads/images/';

            if (!Storage::exists($parentPath)) {
                Storage::disk('public')->makeDirectory($parentPath);
            }


            if (!Storage::exists($path)) {
                Storage::disk('public')->makeDirectory($path);
            }

//            return (storage_path('app/public/'.$cat->image_url));

            if(file_exists(storage_path('app/public/'.$ad->image)))
            {
                unlink(storage_path('app/public/'.$ad->image));
            }
            $img = \Image::make($image)->resize(512,640);
            $img->save(public_path('storage/'.$path.$file_name),60);


            $ad = $ad->update([
                'type'=>$request->type,
                'product_id'=>($request->type=="product")?$request->product_id:null,
                'category_id'=>($request->type=="category")?$request->category_id:null,
                'brand_id'=>($request->type=="brand")?$request->brand_id:null,
                'position'=>$request->position,
                'sort'=>$request->sort,
                'image' => $path.$file_name,
            ]);

        } else {

            $ad = $ad->update([
                'type'=>$request->type,
                'product_id'=>($request->type=="product")?$request->product_id:null,
                'category_id'=>($request->type=="category")?$request->category_id:null,
                'brand_id'=>($request->type=="brand")?$request->brand_id:null,
                'position'=>$request->position,
                'sort'=>$request->sort,
            ]);
        }

        if($ad){
            session()->flash('success', "success");
            if(session()->has("success")){
                Alert::success('نجح', 'تم تعديل بيانات القسم');
            }
        }

        return redirect()->route('ads.index');



//        $uId = $request->user_id;
//        User::updateOrCreate(['id' => $uId],['name' => $request->name, 'email' => $request->email]);
//        if(empty($request->user_id))
//            $msg = 'User created successfully.';
//        else
//            $msg = 'User data is updated successfully';
//        return redirect()->route('users.index')->with('success',$msg);


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ad = Ads::where('id',$id)->first();

        if($ad){
            $ad->delete();
            session()->flash('success', "success");
            if(session()->has("success")){
                Alert::success('نجح', 'تم حذف الاعلان');
            }

        }

//        return Response::json($user);
        return redirect()->route('ads.index');
    }

}
