<?php

namespace App\Http\Controllers\Backend;

use App\ContactUs;
use App\Country;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ContactUs::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
//                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.contact_us.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('dashboard.contact_us.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $messeges = [

            'email.required'=>"البريد الالكتروني مطلوب",
            'phone.required'=>"رقم الهاتف مطلوب",
            'body.required'=>"برجاء إدخال محتوي البريد",

        ];

        $validator =  Validator::make($request->all(), [

            'email' => ['required'],
            'phone' => ['required'],
            'body' => ['required'],

        ], $messeges);



        if ($validator->fails()) {
            Alert::error('خطأ', $validator->errors()->first());
            return back();
        }


        $msg = ContactUs::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' =>$request['phone'],
            'subject' =>$request['subject'],
            'body' =>$request['body'],
        ]);

        if ($msg){

            session()->flash('success', "success");
            if(session()->has("success")){
                Alert::success('نجح', 'تم الأرسال');
            }

        }

        return redirect()->route('contact_us.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
