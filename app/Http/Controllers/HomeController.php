<?php

namespace App\Http\Controllers;

use App\Country;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('rest','store' , 'adminLogin' , 'loginAdmin');
    }


    public function loginAdmin(Request $request){


        $messeges = [

            'email.required'=>"البريد الإلكتروني مطلوب",
            'password.required'=>"كلمة المرور مطلوبه",


        ];

        $validator =  Validator::make($request->all(), [

            'email' => ['required', 'string',],
            'password' => ['required', 'string'],

        ], $messeges);



        if ($validator->fails()) {
            Alert::error('خطأ', $validator->errors()->first());
            return back();
        }


        //TODO :: GET DATA

        $userdata = array(
            'email' => $request['email'] ,
            'password' => $request['password']
        );

        if (!Auth::attempt($userdata))
        {
            Alert::error('خطأ', 'Invalid Data !');
            return back();
        }

        Auth::login(User::where( 'email' ,$userdata['email'])->first());

        return redirect()->route('admin');

    }

    public function adminLogin(){
//        return 'hello';
        return view('dashboard.login');
    }

//    public function rest(){
//        $test = 'bluezo11_bluezo11_new_abati';
//        DB::statement("DROP DATABASE `{$test}`");
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        Alert::alert('Title', 'Message', 'Type');

        //TODO :: IF COOKIE IS NULL SET COOKIE NAME

//       TODO :: COOKIE VALE Country::first()

//        TODO :: UPDATE COUNTRY KUWAIT TO BE FIRST
        if (!Cookie::get('name') ){
            $country=Country::first();
            Cookie::queue('name', $country->id, 43829);
        }


        return view('home');
    }
}
