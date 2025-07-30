<?php

namespace App\Http\Controllers\Backend;

use App\City;
use App\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function create(){
        $countries = Country::all();
        return view('dashboard.cities.create' , compact('countries') );
    }

    public function store(Request $request)
    {


        $messeges = [

            'name_ar.required'=>"اسم المدينه باللغه العربيه مطلوب",
            'name_en.required'=>"اسم المدينه باللغه الانجليزيه مطلوب",
            'country_id.required'=>"يرجي اختيار الدوله",
            'delivery.required'=>"تكلفة الشحن مطلوب",
            'delivery_period.required'=>"مدة التوصيل مطلوبه",

        ];


        $validator =  Validator::make($request->all(), [

            'name_ar' => ['required'],

            'name_en' => ['required'],

            'country_id' => ['required'],

            'delivery' => ['required'],

            'delivery_period' => ['required'],



        ], $messeges);


        if ($validator->fails()) {
            Alert::error('خطأ', $validator->errors()->first());
            return back();
        }

        $city = City::create([
            'name_ar' => $request['name_ar'],
            'name_en' => $request['name_en'],
            'country_id' => $request['country_id'],
            'delivery' => $request['delivery'],
            'delivery_period' => $request['delivery_period'],


        ]);

        if ($city){

            session()->flash('success', "success");
            if(session()->has("success")){
                Alert::success('نجح', 'تم إضافة مدينه');
            }

        }

        return redirect()->route('cities.view' , $request['country_id']);

//        $uId = $request->user_id;
//        User::updateOrCreate(['id' => $uId],['name' => $request->name, 'email' => $request->email]);
//        if(empty($request->user_id))
//            $msg = 'User created successfully.';
//        else
//            $msg = 'User data is updated successfully';
//        return redirect()->route('users.index')->with('success',$msg);
    }




    public function updateCity(Request $request ,$id){


        $messeges = [

            'name_ar.required'=>"اسم المدينه باللغه العربيه مطلوب",
            'name_en.required'=>"اسم المدينه باللغه الانجليزيه مطلوب",
            'country_id.required'=>"يرجي اختيار الدوله",
            'delivery.required'=>"تكلفة الشحن مطلوب",
            'delivery_period.required'=>"مدة التوصيل مطلوبه",



        ];

        $validator =  Validator::make($request->all(), [

            'name_ar' => ['required'],

            'name_en' => ['required'],

            'country_id' => ['required'],

            'delivery' => ['required'],
            'delivery_period' => ['required'],



        ], $messeges);


        if ($validator->fails()) {
            Alert::error('خطأ', $validator->errors()->first());
            return back();
        }

        $city = City::find($id);


        if(!$city){
            Alert::error('خطأ', 'المدينه غير موجوده');
            return back();
        }


        $city = $city->update([
            'name_ar' => $request['name_ar'],
            'name_en' => $request['name_en'],
            'country_id' => $request['country_id'],
            'delivery' => $request['delivery'],
            'delivery_period' => $request['delivery_period'],

        ]);


        if($city){
            session()->flash('success', "success");
            if(session()->has("success")){
                Alert::success('نجح', 'تم تعديل بيانات المدينه');
            }
        }

        return redirect()->route('cities.view' , $request['country_id']);


//        $uId = $request->user_id;
//        User::updateOrCreate(['id' => $uId],['name' => $request->name, 'email' => $request->email]);
//        if(empty($request->user_id))
//            $msg = 'User created successfully.';
//        else
//            $msg = 'User data is updated successfully';
//        return redirect()->route('users.index')->with('success',$msg);


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

//    public function show($id)
//    {
//        $where = array('id' => $id);
//        $user = User::where($where)->first();
//        return Response::json($user);
////return view('users.show',compact('user'));
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */

    public function edit($id)
    {
        $where = array('id' => $id);
        $city = City::where($where)->first();
        if(!$city){
            Alert::error('خطأ', 'المدينه غير موجوده بالنظام');
            return back();
        }

        $countries = Country::all();

        return view('dashboard.cities.edit' , compact('city' ,'countries'));

    }
    public function destroy($id)
    {
        $city = City::where('id',$id)->first();

        if($city){

            $city->delete();
            session()->flash('success', "success");
            if(session()->has("success")){
                Alert::success('نجح', ' تم حذف المدينه');
            }

        }

//        return Response::json($user);
        return back();
    }

}
