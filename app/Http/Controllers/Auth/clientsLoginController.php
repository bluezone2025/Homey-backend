<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Auth;
use Illuminate\Support\Facades\Auth;
use Route;
use Illuminate\Support\Facades\Validator;
use App\Models\Client;
use  App\Models\Token;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\reset_password;
use App\Models\Govern;
use RealRashid\SweetAlert\Facades\Alert;
class clientsLoginController extends Controller
{

    public function __construct()
    {
     $this->middleware('guest:web', ['except' => ['logout',"profile","profile_save"]]);

    }

    public function showRegisterForm(){
        return view('front.register'); //s
    }

    public function client_register(Request $request){
//        return view('front.register'); //s
//        dd($request->all());


        $valid=Validator::make($request->all(),[
            'email'=>'sometimes|email|unique:users,email',
            'name'=>'required|Filled|string',
            'password'=>'required|Filled|string|min:6',
            'phone'=>'required|Filled|string',
            'country'=>'required',
            'phone_code'=>'required'
        ], [
            'email.required'  => 'Please enter the E-mail',
            'email.unique'  => 'This email is already used',
            'name.required'  => 'Please enter the name',
            'name.unique'  => 'Username already used',
            'email.email'  => 'Please enter a valid email',
            'password.required'  => 'Please enter the password',
            'mobile.required'  => 'Please enter the phone',
            'country.required'  => 'Please enter the country',
            'phone_code.required'  => 'Please enter the country code',


        ]);
        if($valid->fails()){
            $arr = array('errors'=>$valid->errors()->all() , 'status' => false);
// return Response()->json($arr);
            return redirect()->back()->with(['fail-reg'=>'test22'])->withErrors($valid)->withInput();
//            return Redirect::back()->with('error_code', 5);
        }


        $tokenCreatedAt = Carbon::now();
        $tokenCreatedAt->toDateTimeString();
        $client=new Client();
        $client->email = $request->email ;
        $client->country = $request->country ;
        $client->name = $request->name ;
        $client->phone = $request->phone ;
        $client->api_token = $request->_token;

        $client->phone_code = $request->phone_code ;
        $client->password = $request->password ;
//$user->token = Str::random(32);
        if($client->save())
        {
//return redirect()->back()->with('success-reg', 'Registered successfully ... You can now log in');
            $user=Auth::user();

            return redirect()->route('client-login');
        }


    }
    //start
    private function validator(Request $request)
    {
        //validation rules.
        $rules = [
            'email'    => 'required|email|exists:clients|min:5|max:191',
            'password' => 'required|string|min:4|max:255',
        ];

        //custom validation error messages.
        $messages = [
            'email.exists' => 'These credentials do not match our records.',
        ];

        //validate the request.
        $request->validate($rules,$messages);
    }


    private function loginFailed(){
        return redirect()
            ->back()
            ->withInput()
            ->with('error','Login failed, please try again!');
    }

    public function check(Request $request)
    {
        dd(Auth::guard('clients')->phone);
    }

    public function client_login(Request $request)
    {

        $this->validator($request);


        if (Auth::guard('clients')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // if successful, then redirect to their intended location

          return redirect()->intended(route('home'));
            //dd(Auth::guard('clients')->id);

        }

//        if (Auth::guard('clients')->attempt(['email' => $request->email, 'password' => $request->password])) {
//            // if successful, then redirect to their intended location
//            dd('yes');
//            return redirect()->intended(route('home'));
//
//        }

        dd('No');

//        Authentication failed...
        return $this->loginFailed();
    }

    //end
//
//    public function client_login(Request $request){
//
////        $client = Client::where('email', $request->email)->get();
////        dd($client->name);
////        $data= $request->input(); //s
////        $request->session()->put('client',$data['email']);
////
////        echo session('token');
//
////
////        if (session()->has('client')){
////            session()->pull('client');
////        }
//
////        dd(Auth::attempt(['email'=>$request->email,'password'=>$request->password]));
////        if (Auth::guard('clients')->attempt(['email' => $request->email, 'password' => $request->password])) {
//            // if successful, then redirect to their intended location
////            return redirect()->intended(route('home'));
////            dd('ok');
//
////        }
//
//
//        // Validate the form data
//        $this->validate($request, [
//            'email'   => 'required',
//            'password' => 'required|min:6'
//        ]);
//
//        // Attempt to log the user in
//

//
//        // if unsuccessful, then redirect back to the login with the form data
//        Alert::error('error', "تاكد من بيانات حسابك");
//        return redirect()->back()->withInput($request->only('email'));
//    }



    public function showLoginForm()
    {
        return view('front.login');
    }

    public function login(Request $request)
    {

      // Validate the form data
      $this->validate($request, [
        'email'   => 'required',
        'password' => 'required|min:6'
      ]);

      // Attempt to log the user inz

      if (Auth::guard('clients')->attempt(['email' => $request->email, 'password' => $request->password])) {
        // if successful, then redirect to their intended location
        return redirect()->intended(route('home'));

      }

      // if unsuccessful, then redirect back to the login with the form data
      Alert::error('error', "تاكد من بيانات حسابك");
      return redirect()->back()->withInput($request->only('email'));
    }

    public function logout()
    {
        Auth::guard('clients')->logout();
        return redirect(route("home"));
    }



    public function reset()
    {

        return view('front.reset');
    }


    public function pin_code(Request $request)
    {
        $messeges = [

            'password.required'=>"حقل كلمة المرور مطلوب",
            'password.min'=>"كلمة المرور لا تقبل اقل من 6 علامات",
            'password.confirmed'=>"كلمة المرور غير متطابقة",

            'pin_code.required'=>"كود التحقق مطلوب",

           ];


        $validator =  Validator::make($request->all(), [

            'pin_code' => 'required',
            'password' => 'required|confirmed|min:6',

        ], $messeges);



        if ($validator->fails()) {

            Alert::error('error Title', $validator->errors());
            return back();
        }



        $client =  Client::where("pin_code", $request->pin_code)->first();

        if ($client) {
            $phone =  $client->phone;
            $client->password =  bcrypt($request->password);
            $client->pin_code = null;
            $client->save();


            Alert::success('success Title', 'تمت العملية بنجاح قم بتسجيل الدخول ');
            return view('front.login');




        } else {
            Alert::error('error Title', "كود التفعيل غير صالح");
            return back();

        }
    }



    public function profile()
    {

     $client= Auth::guard('clients')->user();
     $countryArray = $this->countryArray;


        return view('front.profile',["client"=>$client,"countryArray"=>$countryArray]);
    }

    public function profile_save(Request $request)
    {

        $messeges = [
            'name.required'=>"حقل الاسم مطلوب",
            'name.max'=>"عدد احرف الاسم اكبر من 60 حرف",
            'name.min'=>"عدد احرف الاسم اقل من 4 احرف",
            'password.required'=>"حقل كلمة المرور مطلوب",
            'password.min'=>"كلمة المرور لا تقبل اقل من 6 علامات",
            'password.confirmed'=>"كلمة المرور غير متطابقة",
            'email.required'=>"حقل الايميل مطلوب",
            'email.email'=>"الايميل غير صالح",
            'email.unique'=>"الايميل موجود من قبل",
            'phone.required'=>"حقل رقم التليفون فارغ ",
            'phone.unique'=>"رقم التليفون موجود من قبل",
            'name.unique'=>"الاسم موجود من قيل اضف اسم العائلة او علامة مميزة",

           ];


           if ($request->password !="" or $request->password_old !="" ){


            $password=Auth::guard('clients')->user()->password;

             if( !Hash::check($request->password_old, $password))
             {
                Alert::error('error', "كلمة المرور القديمة غير صحيحة");

                return back();
             }

        $validator =  Validator::make($request->all(), [
            'name' => 'required|max:60|min:4|unique:clients,name,' . $request->user()->id,
            'password' => 'confirmed|min:6|required_with:password_old',
            'email' => 'required|email|unique:clients,email,' . $request->user()->id,
            'phone' => 'required|unique:clients,phone,' . $request->user()->id,

            'password_old'=>"required_with:password",

        ], $messeges);




           }else{

            $validator =  Validator::make($request->all(), [

                'name' => 'required|max:60|min:4|unique:clients,name,' . $request->user()->id,


                "phone" => 'unique:clients,phone,' . $request->user()->id,
                "email" => 'email|unique:clients,email,' . $request->user()->id,
            ], $messeges);

         }

        if ($validator->fails()) {

            Alert::error('error', $validator->errors()->first());

            return back();
        }


        $loginuser = $request->user();
        $save1=$loginuser->update($request->except(['password_old',"password","password_confirmation"]));
        if ($request->has("password") and $request->password != "") {
            $loginuser->password = bcrypt($request->password);
        }
        $save2=  $loginuser->save();
        if($save1 and $save2){
            Alert::success('success', 'success');

            return back();
        }else{
            Alert::error('error', 'خطأ غير متوقع حاول مرة اخري');

            return back();
        }


    }



    public function forget()
    {

        return view('front.forget');
    }




    public function send(Request $request)
    {
        $messeges = [
            'email.required'=>"حقل  البريد الالكتروني فارغ ",

           ];


        $validator =  Validator::make($request->all(), [

            'email' => 'required',
        ],$messeges);



        if ($validator->fails()) {

            Alert::error('error Title', 'حاول مرة اخري ');
            return back();
        }



        $client =  Client::where("email", $request->email)->first();


        if ($client) {
            $pin_code = rand("1111", "9999");

            $client->pin_code = $pin_code;

            $update =  $client->save();


            if ($update == true) {



try {
    Mail::to($client->email)

    ->bcc("moha228830@gmail.com")
    ->send(new reset_password($pin_code));
    Alert::success('success Title', 'ادخل كلمة مرور جديدة ');
    return view('front.reset');
} catch (\Throwable $th) {
    Alert::error('error Title', '1حاول مرة اخري ');
    return back();
}





            } else {

                Alert::error('error Title', '2حاول مرة اخري ');
                return back();
            }
        } else {


            Alert::error('error Title', '3حاول مرة اخري ');
            return back();
        }
    }


    //////////////////////////////////////////////////////////////////////////////

    public function register()
    {
        $countryArray = $this->countryArray;
        return view('front.register',compact("countryArray"));
    }

    public function  register_submit(Request $request)
    {
        $messeges = [
            'name.required'=>"حقل الاسم مطلوب",
            'name.max'=>"عدد احرف الاسم اكبر من 60 حرف",
            'name.min'=>"عدد احرف الاسم اقل من 4 احرف",
            'password.required'=>"حقل كلمة المرور مطلوب",
            'password.min'=>"كلمة المرور لا تقبل اقل من 6 علامات",
            'password.confirmed'=>"كلمة المرور غير متطابقة",
            'email.required'=>"حقل الايميل مطلوب",
            'email.email'=>"الايميل غير صالح",
            'email.unique'=>"الايميل موجود من قبل",
            'phone.required'=>"حقل رقم التليفون فارغ ",
            'phone.unique'=>"رقم التليفون موجود من قبل",
            'name.unique'=>"الاسم موجود من قيل اضف اسم العائلة او علامة مميزة",

           ];

        $validator =  Validator::make($request->all(), [
            'name' => 'required|max:60|min:4|unique:clients',
            'password' => 'required|confirmed|min:6',
            'email' => 'required|email|unique:clients',

            'phone' => 'required|unique:clients',
        ], $messeges);


        if ($validator->fails()) {
            Alert::error('error Title',$validator->errors()->first());

            return back();
        }

       $array = explode("-",$request->country);
       $code_phone= $array[1];
       $code = $array[0];
       if($code_phone=="20"){
        $code_phone= trim($code_phone,"0");
       }
        $request->merge(["password" => bcrypt($request->password)]);
        $client = Client::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "phone"=> $code_phone.$request->phone,
            "password"=>$request->password,
            "country"=>  $code,


        ]);
        $client->api_token =  $var = Str::random(60);
        $save=$client->save();
        if($save){
            Alert::success('Success Title', 'تم التسجيل بنجاح قم بتسجيل الدخول');
            return back();
        }
        Alert::error('error Title', 'حاول مرة اخري ');
        return back();

    }

    /*public function logout()
    {
        Auth::guard('client')->logout();
        return redirect(route("home"));
    }*/

}
