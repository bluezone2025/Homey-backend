<?php

namespace App\Http\Controllers\Admin;

use App\Models\Currency;
use App\Http\Controllers\Controller;
//use App\User;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
//use Illuminate\Support\Facades\Validator;
//use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use App\MyDataTable\MDT_Method_Action;
use App\MyDataTable\MDT_Query;
use App\MyDataTable\MDT_UploadImag;

class CurrencyController extends Controller
{

      use MDT_Method_Action , MDT_Query , MDT_UploadImag;


      public function __construct()
      {

          $this->middleware('haveRole:currency.index')->only('index');
          $this->middleware('haveRole:currency.create')->only(['create' , 'store']);
          $this->middleware('haveRole:currency.update')->only('update');
          $this->middleware('haveRole:currency.destroy')->only('destroy');
          $this->middleware('haveRole:currency.restore')->only('restore');
          $this->middleware('haveRole:currency.finalDelete')->only('finalDelete');

      }

      public function index()
      {

          $is_trash  = \request()->segment(2) === 'trash';

          return  $this->MDT_Query_method(// Start Query
              Currency::class ,
              'admin/pages/currencies/index',
              $is_trash, // Soft Delete
              [ // Other Options
                  'with'    => ['is_trash' => $is_trash],
              ]

          ); // end query
      }


      public function create()
      {

          return  view('admin.pages.currencies.create');
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

            'name.required'=>"اسم العمله مطلوب",
            'rate.required'=>"النسبه مطلوبه",
            'code_en.required'=>"كود العمله مطلوب",
            'code_en.unique' => "يرجي تغيير كود العمله لانه مستخدم بالفعل لعمله اخري",
            'code_ar.required'=>"كود العمله مطلوب",
            'code_ar.unique' => "يرجي تغيير كود العمله لانه مستخدم بالفعل لعمله اخري"

        ];

        $validator =  Validator::make($request->all(), [

            'name' => 'required',
            'rate' => 'required',
            'code_ar' => ['required' , 'unique:currencies,code_ar'],
            'code_en' => ['required' , 'unique:currencies,code_en'],

        ], $messeges);



        if ($validator->fails()) {
            Alert::error('خطأ', $validator->errors()->first());
            return back();
        }


        $currency = Currency::create([
            'name' => $request['name'],
            'rate' => $request['rate'],
            'code_ar' => $request['code_ar'],
            'code_en' => $request['code_en'],
        ]);

        if ($currency){

          return  back()->with('success' ,  __('form.response.create currency'));


        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $currency = Currency::where('id',$id)->first();

        if($currency){
            $currency->delete();
            session()->flash('success', "success");
            if(session()->has("success")){
                Alert::success('نجح', 'تم حذف العمله');
            }

        }

//        return Response::json($user);
        return redirect()->route('currencies.index');

    }

    public function update(Request $request){

        $messeges = [

                      'name.required'=>"اسم العمله مطلوب",
                      'rate.required'=>"النسبه مطلوبه",
                      'code_en.required'=>"كود العمله مطلوب",
                      'code_en.unique' => "يرجي تغيير كود العمله لانه مستخدم بالفعل لعمله اخري",
                      'code_ar.required'=>"كود العمله مطلوب",
                      'code_ar.unique' => "يرجي تغيير كود العمله لانه مستخدم بالفعل لعمله اخري"

        ];

        $validator =  Validator::make($request->all(), [

            'name' => 'required',
            'rate' => 'required',
            'code_ar' => ['required' ,'unique:currencies,code_ar,' .$request['id']],
            'code_en' => ['required' ,'unique:currencies,code_en,' .$request['id']],

        ], $messeges);



        if ($validator->fails()) {
            Alert::error('خطأ', $validator->errors()->first());
            return back();
        }

        $currency= Currency::findOrFail($request['id']);

        $currency= $currency->update([
            'name' => $request['name'],
            'rate' => $request['rate'],
            'code_ar' => $request['code_ar'],
            'code_en' => $request['code_en'],

        ]);

        if($currency){
          return response([
              'status' => 'success' ,
              'message' =>  __('form.response.update country'),
          ]);
        }

        return redirect()->route('currencies.index');



//        $uId = $request->user_id;
//        User::updateOrCreate(['id' => $uId],['name' => $request->name, 'email' => $request->email]);
//        if(empty($request->user_id))
//            $msg = 'User created successfully.';
//        else
//            $msg = 'User data is updated successfully';
//        return redirect()->route('users.index')->with('success',$msg);


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
        $currency = Currency::where($where)->first();
        if(!$currency){
            Alert::error('خطأ', 'العمله غير موجوده بالنظام');
            return back();
        }

        return view('dashboard.currencies.edit' , compact('currency'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currency = Currency::where('id',$id)->first();

        if($currency){
            $currency->delete();
            session()->flash('success', "success");
            if(session()->has("success")){
                Alert::success('نجح', 'تم حذف العمله');
            }

        }

//        return Response::json($user);
        return redirect()->route('currencies.index');
    }

}
