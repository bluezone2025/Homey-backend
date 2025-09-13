<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Order;
use App\Models\Address;
use Illuminate\Support\Facades\DB;
use App\Models\VerifyUser;
use App\Models\ProductOrder;
use App\Models\Attribute;
use App\Models\Option;

use Carbon\Carbon;
use App\Models\Country;
use App\Mail\VerifyMail;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;


use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;


class ClientAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:web')->except('logout','account','orders','address_store','address_view','address_index','address_delete','address_edit','address_update','account_update','account_edit','order_view');
    }
 public function de ()
    {
        session_cache_expire(1800);
session_start();
header("content-type:text/html; charset=utf-8");
putenv("NLS_LANG=American_America.UTF8");
error_reporting(E_ALL);
ini_set("display_errors", 1);
        $setUserID = "eresitrade";
$setAESsnKey="LJt3r5vzkqBX8uIVROwvDoADLcwNWBqU";

$setShipperAddr1=APIEncrypt($setAESsnKey,'서울시 강서구 외발산동');
$setShipperAddr2=APIEncrypt($setAESsnKey,'217-1 ACI 빌딩');
$setShipperTel=APIEncrypt($setAESsnKey,'010-1234-69510');
$setReceiverName=APIEncrypt($setAESsnKey,'neodong jung');
$setReceiverAddr=APIEncrypt($setAESsnKey,'13126 S. BROADWAY. LOS ANGELES, CA 90061 U.S.A');
$setReceiverTel=APIEncrypt($setAESsnKey,'310-965-9009');

$resultArray = array();
$arrayMiddle = array(
		"Departure_Station"=>'SEL',
		"Arrival_Nation"=>'US',
		"Transfer_Company_Code"=>'',
		"Order_Date"=>'2020717',
		"Order_Number"=>"20201117101503",
		"Hawb_No"=>"",
		"Shipper_Name"=>"ACI EXPRESSFF (U.K) LTD.",
		"Shipper_Country"=>"KR",
		"Shipper_State"=>"",
		"Shipper_City"=>"SEL",
		"Shipper_Zip"=>"07641",
		"Shipper_Address"=>$setShipperAddr1,
		"Shipper_Address_Detail"=>$setShipperAddr2,
		"Shipper_Tel"=>$setShipperTel,
		"Shipper_Hp"=>"",
		"Shipper_Email"=>"",
		"Receiver_Country"=>"US",
		"Receiver_State"=>"TEST",
		"Receiver_City"=>"TEST",
		"Receiver_District"=>"",
		"Receiver_Zip"=>"9006",
		"Receiver_Name"=>"Hong HilDong",
		"Native_Receiver_Name"=>$setReceiverName,
		"Native_Receiver_Address"=>$setReceiverAddr,
		"Receiver_Address"=>$setReceiverAddr,
		"Native_Receiver_Address_Detail"=>"",
		"Receiver_Address_Detail"=>"",
		"Receiver_Tel"=>$setReceiverTel,
		"Receiver_Hp"=>"",
		"Receiver_Email"=>"",
		"Box_Count"=>"1",
		"Actual_Weight"=>"2.6",
		"Volume_Weight"=>"",
		"Volume_Length"=>"",
		"Volume_Width"=>"",
		"Volume_Height"=>"",
		"Custom_Clearance_ID"=>"",
		"Buy_Site"=>"http://test.com",
		"Size_Unit"=>"CM",
		"Weight_Unit"=>"KG",
		"Get_Buy"=>"1",
		"Mall_Type"=>"A",
		"Warehouse_Msg"=>"",
		"Delivery_Msg"=>"Call M",
		"GoodsInfo"=>array()
);


$arrGoods = array(
		'Customer_Item_Code' => 'ITEM2',
		'Hs_Code' =>'',
		'Brand' => 'Handcraft Vietnam1',
		'Item_Detail' =>'(Handcraft Vietnam) Straw Tote Bag',
		'Native_Item_Detail' =>'75301-6-1 VOGACORTE 70',
		'Item_Cnt' => '1',
		'Unit_Value' => '20.5',
		'Make_Country' =>'GB',
		'Make_Company' => '',
		'Item_Div' => '',
		'Qty_Unit' => 'EA',
		'Item_Url' => 'TESTURL.COM',
		'Item_Img_Url' => '',
		'Trking_Company' => 'EPOST',
		'Trking_Number' => '6063412344789',
		'Trking_Date' => '20200217',
		'Chg_Currency' => 'USD',
		'Item_Material'=>''

);
array_push($arrayMiddle['GoodsInfo'], $arrGoods );
array_push($resultArray, $arrayMiddle);
$json_result =  json_encode($resultArray);


$setSendDate=date("YmdHis");//KST
$setTokenKey=APIEncrypt($setAESsnKey,$setSendDate."|".$setUserID);

$headers[] = 'Content-Type: application/json';
$headers[] = 'UserID: '.$setUserID;
$headers[] = 'APIkey: '.$setTokenKey;


$ch = curl_init();
$url = "https://wms.acieshop.com/api/orderNomalRegist";
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch,CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch,CURLOPT_POST, 1);
curl_setopt($ch,CURLOPT_POSTFIELDS,$json_result);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
curl_setopt($ch,CURLOPT_TIMEOUT, 20);
$response = curl_exec($ch);

$response = urldecode($response);

print_r($response);
curl_close ($ch);
    }

    public function showClientLoginForm()
    {
        $countries=Country::all();

        return view('front.login', ['url' => 'client','countries'=>$countries]);
    }

    public function clientLogin(Request $request)
{
    $this->validate($request, [
        'phone' => 'required', // هذا الحقل يمكن أن يحتوي على إيميل أو رقم
        'password' => 'required|min:6'
    ]);

    $loginField = filter_var($request->phone, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

    // محاولة تسجيل الدخول
    if (Auth::guard('web')->attempt([$loginField => $request->phone, 'password' => $request->password], $request->get('remember'))) {
        Alert::success('success', "");
        session()->flash('success_login', trans('auth.success_login'));
        return redirect()->back();
    }

    // التحقق مما إذا كان المستخدم موجوداً
    $user = User::where($loginField, $request->phone)->first();
    
    if (!$user) {
        session()->flash('error_login', __("auth.dontHaveAcount"));
        return back()->with('error_login', __("auth.dontHaveAcount"))
                     ->withInput($request->only('phone', 'remember'));
    }

    // المستخدم موجود لكن كلمة المرور خاطئة
    session()->flash('open', true);
    session()->flash('error_login', __("auth.password"));
    return back()->with('error_login', __("auth.password"))
                 ->withInput($request->only('phone', 'remember'));
}


    public function showClientRegisterForm()
    {
        $countries=Country::all();

        return view('front.register', ['url' => 'client','countries'=>$countries]);
    }

    private function validator(Request $request)
    {
        //validation rules.
        $rules = [
            'email'    => 'required|email|exists:users|min:5|max:191',
            'password' => 'required|string|min:4|max:255',
        ];

        //custom validation error messages.
        $messages = [
            'email.exists' => 'These credentials do not match our records.',
        ];

        //validate the request.
        $request->validate($rules,$messages);
    }


    protected function createClient(Request $request)
    {
        // $this->validator($request->all())->validate();
         //dd($request->all());
        $rules = array(
            'email'=>[
                'sometimes',
                'email',
                Rule::unique('users', 'email')->whereNull('deleted_at'),
            ],
            'name'=>'required|Filled|string',
            'country'=>'required|Filled|numeric',
            'password'=>'required|Filled|string|min:6',
            'phone' => [
                'required',
                'filled',
                'numeric',
                'min:8',
                Rule::unique('users', 'phone')->whereNull('deleted_at'),
            ],

        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // Validation failed
            session()->flash('open', true);

        }
        $this->validate( $request , $rules);

        $deletedUser = User::onlyTrashed()
            ->where(function ($query) use ($request) {
                $query->where('email', $request['email'])
                    ->orWhere('phone', $request->phone);
            })
            ->first();

        if ($deletedUser) {
            // Restore the user if they were soft-deleted
            $deletedUser->restore();

            // Update the user's details
            $deletedUser->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'country_id' => $request['country'],
                'phone' => $request->phone,
                #'api_token' => Str::random(80),
                'password' => Hash::make($request['password']),
            ]);

            $client = $deletedUser;
        } else {
            // Create a new user if no soft-deleted user exists
            $client = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'country_id' => $request['country'],
                'phone' => $request->phone,
                #'api_token' => Str::random(80),
                'password' => Hash::make($request['password']),
            ]);
        }


        /*$client = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'country_id' => $request['country'],
            'phone' => $request->phone ,
            'api_token' => $request->_token,
            'password' => Hash::make($request['password']),
        ]);*/

            Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password]);
            return redirect()->route('home');
        // return redirect(app()->getLocale().'/login/client')->with('status', "");
    }

     public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->client;
            if(!$user->activity) {
                $verifyUser->client->activity = 1;
                $verifyUser->client->save();
                $status = "Your e-mail is verified. You can now login.";
            } else {
                $status = "Your e-mail is already verified. You can now login.";
            }
        } else {
            return redirect('/login/client')->with('warning', "Sorry your email cannot be identified.");
        }
        return redirect('/login/client')->with('status', $status);
    }

    public function showForgetPasswordForm()
    {
        //        dd('ok');
        return view('front.forgetPassword');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = sha1(time());

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('emails.forgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', __('site.We have e-mailed your password reset link!'));
    }


    public function showResetPasswordForm($token) {
        return view('front.forgetPasswordLink', ['token' => $token]);
    }


    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $client = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect('/login/client')->with('status', __('site.Your password has been changed!'));
    }


     public function account($has_wishlist=false){//Islam 23July
//        dd($wishlist);
        if($this->middleware('guest:web')){
            $account=User::where('id', auth('web')->id())->first();
            $countries=Country::all();
            $orders=Order::where('user_id', auth('web')->id())->orderBy('created_at','desc')->get();
            $wishlists = Auth::guard('web')->user()->wishlist()->latest()->get();
//            dd(Auth::guard('web')->user()->wishlist());

            return view('front.account', compact('account', 'countries','orders','wishlists','has_wishlist'));

        }
        else{
             return redirect()->route('login/client');
            }
            }

    public function orders($id){//Islam 23July

        if($this->middleware('guest:web')){
            $orders=Order::where('user_id', $id)->get();
            return view('front.order',compact("orders"));
        }
        else{
            return redirect()->route('login/client');
        }
    }

    public function order_view(Request $request,$id)//islam 23 august
    {


         $order = Order::with('products')->find($id);
       // $attributes= json_decode($order->products->first()->pivot->attributes, true);//  explode(',', $order->products->first()->pivot->attributes);
       //   foreach ($attributes as $key => $value) {
       //     $att=Attribute::whereId($key)->first()->name;
       //     dd($order->products->first()->options->where('id',$value)->first()->option->name);
       //     $val=Option::whereId($value)->first()->name;
       //      dd($att.' '.$val);
       //   }

        return view("front.orderDetails",["order"=>$order]);
    }



      public function address_view(){
              return view('front.address');
      }

      public function address_store(Request $request){
          $rules = array(
              'street'=>'required',
              'city'=>'required',
              'gover'=>'required',
              'plot'=>'required',
              'building_number'=>'required',
              'role'=>'required',

          );
          $this->validate( $request , $rules);
          // dd($request->all());
          $address = Address::create([
              'street' => $request->street,
              'city' => $request->city,

              'gover' => $request->gover ,
               'plot'=>$request->plot,
              'building_number'=>$request->building_number,
              'role'=>$request->role,
              'additionaltips'=>$request->additionaltips,

              'client_id' => $request->client_id ,

          ]);
          return redirect()->route('account.index');
      }

      public function address_index($id){
          if($this->middleware('guest:web')){
              $address=Address::where('client_id', $id)->get();
              return view('front.address_show',compact("address"));


          }
          else{
              return redirect()->route('login/client');
          }
      }


    public function address_edit($id)
    {
        $address=Address::where('id', $id)->first();
        return view('front.address_edit',compact('address'));
    }

    public function address_delete($id){
        DB::delete('delete from client_address where id = ?',[$id]);
        return redirect()->route('account.index');
    }
    public function address_update(Request $request,$id){
        //        dd($id);
        $rules = array(
            'street'=>'required',
            'city'=>'required',
            'gover'=>'required',
            'plot'=>'required',
            'building_number'=>'required',
            'role'=>'required',

        );
        $this->validate( $request , $rules);



        $address = Address::find($id);

        $address->street = $request->street;
        $address->city = $request->city;
        $address->gover = $request->gover;
        $address->plot = $request->plot;
        $address->building_number = $request->building_number;
        $address->role = $request->role;
        $address->additionaltips = $request->additionaltips;

        $address->save();
        return redirect()->route('account.index');


    }

    public function account_edit($id)
    {
        $account=User::where('id', $id)->first();
        $countries=Country::all();
        return view('front.account_edit',compact('account','countries'));
    }

    public function account_update(Request $request,$id){
      //        dd($id);
        $rules = array(
            'email'=>'sometimes|email',
            'name'=>'required|Filled|string',
            'phone'=>'required|Filled|numeric',
            'country'=>'required|Filled|numeric',

        );

        $this->validate( $request , $rules);

        $client= User::find($id);

        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->country_id = $request->country;
        if ($request->password){
            $client->password = Hash::make($request->password);
        }
        $client->save();
        session()->flash('success-reg',trans('site.Data updated'));
        return redirect()->route('account.index');
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect(route("home"));
    }





}
