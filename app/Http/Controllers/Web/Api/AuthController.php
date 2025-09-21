<?php

namespace App\Http\Controllers\Web\Api;

use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Google_Client;
use Google_Service_Oauth2;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {

        $this->middleware('auth.guard:web-api', ['except' => 
        ['resendCodeForRegister','activeAccount','login', 'register' , 'forgotPassword', 'checkEmail' ,
        'checkCode', 'customRemoveAccount','googleLogin','appleLogin','challengeBiometric','verifyBiometric']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){

        $validator = \Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|string|min:6',
            // 'fcm_token' => 'required|string|max:350',
        ]);
        // dd('ddd');

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $loginField = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $user=User::where($loginField,$request->email)->first();
        // dd(  $user);
        if(!$user){
             return response([
                'status'  => Response_Fail,
                'message' => __('auth.dontHaveAcount'),
            ]);

        }

        if (! $token = auth()->attempt([$loginField => $request->email, 'password' => $request->password])) {
            return response([
                'status'  => Response_Fail,
                'message' => __('auth.password'),
            ]);
        }


        \auth()->user()->device_token =  (string)$request->device_token;
        
        \auth()->user()->save();

        return $this->createNewToken($token);
    }


    public function register(Request $request) {

        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email'=>[
                'sometimes',
                'email',
                Rule::unique('users', 'email')->whereNull('deleted_at'),
            ],
            'phone' => [
                'required',
                'filled',
                'numeric',
                Rule::unique('users', 'phone')->whereNull('deleted_at'),
            ],
            'password' => 'required|string|confirmed|min:6|max:255',
            // 'fcm_token' => 'required|string|max:350',
        ]);

        if($validator->fails()){
            // return response()->json($validator->errors(), 422);
            return response()->json([
                'status'  => Response_Fail,
                'message' => $validator->errors()->all(),
            ]);
        }

        $user = User::onlyTrashed()
            ->where(function ($query) use ($request) {
                $query->where('email', $request['email'])
                    ->orWhere('phone', $request->phone);
            })
            ->first();
        if ($user){
            // Restore the user if they were soft-deleted
            $user->restore();

            // Update the user's details
            $user->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'phone' => $request->phone,
                'password' => Hash::make($request['password']),
            ]);
        }else{

            $user = User::create(array_merge(
                $validator->validated(),
                ['password' => bcrypt($request->password),
                    #'activation_code'=> rand(1000,9999),
                    'activation_code'=> null,
                    #'email_verified_at' => null]
                    'email_verified_at' => Carbon::now()]
            ));
        }

        /*try{
            $from=env('MAIL_FROM_ADDRESS');
            $data=[];
            $data["subject"] = 'Active Account';
            $data["code"] = $user->activation_code;
            $data["name"] = $user->name;
            $data["email"] = $user->email;
            Mail::send('emails.activeAccount', $data, function ($message) use ($data, $from) {
                $message->from($from)->to($data["email"], $data["email"] )
                    ->subject($data["subject"]);
            });
        }catch (\Exception $e){

        }*/

        return response()->json([
            'message' => __('user registered'),
            'data' => [
                'status' => Response_Success,
                'user' => $user,
                'token' => auth()->attempt($request->only(['phone' , 'password']))
            ]
        ]);
    }



    public function googleLogin(Request $request)
    {
        $request->validate([
            'id_token' => 'required',
            'device_token' => 'nullable|string|max:350',
        ]);

        $client = new \Google\Client(['client_id' => env('GOOGLE_CLIENT_ID')]);
        $payload = $client->verifyIdToken($request->id_token);

        if (!$payload) {
            return response()->json([
                'status' => Response_Fail,
                'message' => 'Invalid Google token',
            ]);
        }

        $googleId = $payload['sub'];
        $email    = $payload['email'] ?? null;
        $name     = $payload['name'] ?? null;
        $picture  = $payload['picture'] ?? null;

    
        $user = User::where('google_id', $googleId)
                    ->orWhere('email', $email)
                    ->first();

        if (!$user) {
            $user = User::create([
                'name'  => $name,
                'email' => $email,
                'google_id' => $googleId,
                'avatar'=> $picture,
                'password' => bcrypt(str()->random(16)), 
                'email_verified_at' => \Carbon\Carbon::now(),
            ]);
        } else {
            $user->update([
                'google_id' => $googleId,
                'avatar'    => $picture,
            ]);
        }

        // save device_token
        if ($request->device_token) {
            $user->device_token = $request->device_token;
            $user->save();
        }

        // generate JWT token 
        $token = auth()->login($user);

        return response()->json([
            'status' => Response_Success,
            'user'   => $user,
            'token'  => $token,
        ]);
    }

   public function appleLogin(Request $request)
    {
        $request->validate([
            'id_token'     => 'required|string',
            'device_token' => 'nullable|string|max:350',
        ]);

        try {
            // 1)  separate the token (header.payload.signature)
            $tokenParts = explode('.', $request->id_token);
            $header     = json_decode(base64_decode($tokenParts[0]), true);

            if (!isset($header['kid'])) {
                return response()->json(['status' => 0, 'message' => 'Invalid Apple token header'], 401);
            }

            $kid = $header['kid'];

            // 2) get public keys from Apple.
            $appleKeys = json_decode(file_get_contents('https://appleid.apple.com/auth/keys'), true);

            $publicKeyData = null;
            foreach ($appleKeys['keys'] as $key) {
                if ($key['kid'] === $kid) {
                    $publicKeyData = $key;
                    break;
                }
            }

            if (!$publicKeyData) {
                return response()->json(['status' => 0, 'message' => 'No matching Apple public key'], 401);
            }

            // 3) build the PEM from the JWK
            $publicKey = $this->buildPublicKey($publicKeyData);

            // 4) Decode token
            $appleData = \Firebase\JWT\JWT::decode(
                $request->id_token,
                new \Firebase\JWT\Key($publicKey, 'RS256')
            );

            $appleId = $appleData->sub ?? null;
            $email   = $appleData->email ?? null;
            $name    = $request->name ?? 'Apple User';

            if (!$appleId) {
                return response()->json(['status' => 0, 'message' => 'Invalid Apple token'], 401);
            }

            // 5) find or create a user
            $user = User::where('apple_id', $appleId)->orWhere('email', $email)->first();

            if (!$user) {
                $user = User::create([
                    'name'              => $name,
                    'email'             => $email,
                    'apple_id'          => $appleId,
                    'password'          => bcrypt(Str::random(16)),
                    'email_verified_at' => Carbon::now(),
                ]);
            } else {
                $user->update(['apple_id' => $appleId]);
            }

            // 6) If there is a device_token, store it.
            if ($request->device_token) {
                $user->device_token = $request->device_token;
                $user->save();
            }

            // 7) Generate JWT for login
            $token = auth()->login($user);

            return response()->json([
                'status' => 1,
                'user'   => $user,
                'token'  => $token,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 0,
                'message' => 'Apple login failed: ' . $e->getMessage(),
            ], 401);
        }
    }


    private function buildPublicKey(array $keyData): string
    {
        $components = [
            'n' => $this->base64UrlDecode($keyData['n']),
            'e' => $this->base64UrlDecode($keyData['e']),
        ];

        $modulus  = $components['n'];
        $exponent = $components['e'];

        $modulus = pack('Ca*a*', 2, $this->encodeLength(strlen($modulus)), $modulus);
        $exponent = pack('Ca*a*', 2, $this->encodeLength(strlen($exponent)), $exponent);

        $rsaPublicKey = pack('Ca*a*a*', 48, $this->encodeLength(strlen($modulus . $exponent)), $modulus, $exponent);

        $bitString = pack('CCa*', 3, $this->encodeLength(strlen($rsaPublicKey) + 1), chr(0) . $rsaPublicKey);

        $seq = pack('Ca*a*', 48, $this->encodeLength(strlen($bitString) + 15),
            pack('H*', '300d06092a864886f70d0101010500') . $bitString);

        return "-----BEGIN PUBLIC KEY-----\r\n" .
            chunk_split(base64_encode($seq), 64) .
            "-----END PUBLIC KEY-----";
    }

    private function base64UrlDecode($data)
    {
        $remainder = strlen($data) % 4;
        if ($remainder) {
            $padlen = 4 - $remainder;
            $data .= str_repeat('=', $padlen);
        }
        return base64_decode(strtr($data, '-_', '+/'));
    }

    private function encodeLength($length)
    {
        if ($length <= 0x7F) {
            return chr($length);
        }

        $temp = ltrim(pack('N', $length), chr(0));
        return chr(0x80 | strlen($temp)) . $temp;
    }


   // 1) يعطي nonce (challenge) مرتبط بال device_id
    public function challengeBiometric(Request $request)
    {
        $v = Validator::make($request->all(), [
            'device_id' => 'required|string|max:255',
        ]);
        if ($v->fails()) return response()->json($v->errors(), 422);

        $deviceId = $request->device_id;
        $nonce = base64_encode(Str::random(40) . microtime());

        DB::table('biometric_challenges')->insert([
            'device_id' => $deviceId,
            'nonce' => $nonce,
            'expires_at' => Carbon::now()->addMinutes(5),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['nonce' => $nonce]);
    }

    // 2) يتحقق من التوقيع وينشئ / يدخل المستخدم ويصدر JWT
    public function verifyBiometric(Request $request)
    {
        $v = Validator::make($request->all(), [
            'device_id' => 'required|string',
            'signature' => 'required|string', // base64 signature
            'public_key' => 'required|string', // PEM أو base64
            'nonce' => 'required|string',
            'name' => 'sometimes|string',
            'email' => 'sometimes|email',
        ]);
        if ($v->fails()) return response()->json($v->errors(), 422);

        $deviceId = $request->device_id;
        $nonce = $request->nonce;
        $signature = base64_decode($request->signature);
        $publicKey = $request->public_key;

        // جلب التحدي والتأكد من صلاحيته
        $challenge = DB::table('biometric_challenges')
            ->where('device_id', $deviceId)
            ->where('nonce', $nonce)
            ->where('expires_at', '>', now())
            ->first();

        if (!$challenge) {
            return response()->json(['message'=>'Invalid or expired challenge'], 400);
        }

        // تحقق التوقيع: نفترض الـ public_key في صيغة PEM أو base64
        $pubKey = $publicKey;
        if (!str_contains($pubKey, '-----BEGIN')) {
            $pubKey = "-----BEGIN PUBLIC KEY-----\n" . chunk_split($pubKey, 64, "\n") . "-----END PUBLIC KEY-----\n";
        }

        $ok = openssl_verify($nonce, $signature, $pubKey, OPENSSL_ALGO_SHA256);

        if ($ok !== 1) {
            return response()->json(['message'=>'Signature verification failed'], 401);
        }

        // challenge خلص → نحذفه
        DB::table('biometric_challenges')->where('id', $challenge->id)->delete();

        // نجيب أو ننشئ user
        $user = null;
        if ($request->filled('email')) {
            $user = User::where('email', $request->email)->first();
        }
        if (!$user) {
            $user = User::where('device_id', $deviceId)->first();
        }

        if (!$user) {
            $user = User::create([
                'name' => $request->input('name', 'User'),
                'email' => $request->input('email', null),
                'password' => bcrypt(Str::random(12)), // نحط باسورد عشوائي عشان jwt-auth مايعلقش
                'device_id' => $deviceId,
                'public_key' => $pubKey,
            ]);
        } else {
            $user->update([
                'device_id' => $deviceId,
                'public_key' => $pubKey,
            ]);
        }

        $user->last_biometric_login_at = now();
        $user->save();

        // إصدار JWT بدلاً من Sanctum
        $token = auth()->login($user);

        return response()->json([
            'status' => true,
            'message' => 'Authenticated',
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => $user->only(['id','name','email']),
        ]);
    }

    public function resendCodeForRegister(Request $request) {

        $user = User::where('email' , $request->email_or_phone)->first();

        if($user){

            $user->activation_code= rand ( 1000 , 9999 );
            $user->save();
            $from=env('MAIL_FROM_ADDRESS');
            $data=[];
            $data["subject"] = 'Activation Code';
            $data["code"] = $user->activation_code;
            $data["name"] = $user->name;
            $data["email"] = $user->email;
            Mail::send('emails.activeAccount', $data, function ($message) use ($data, $from) {
                $message->from($from)->to($data["email"], $data["email"] )
                    ->subject($data["subject"]);
            });
        }else{
            $user = User::where('phone' , $request->email_or_phone)->first();
            if ($user){
                $user->activation_code= rand ( 1000 , 9999 );
                $user->save();
                $from=env('MAIL_FROM_ADDRESS');
                $data=[];
                $data["subject"] = 'Activation Code';
                $data["code"] = $user->activation_code;
                $data["name"] = $user->name;
                $data["email"] = $user->email;
                Mail::send('emails.activeAccount', $data, function ($message) use ($data, $from) {
                    $message->from($from)->to($data["email"], $data["email"] )
                        ->subject($data["subject"]);
                });
            }

        }
        return response()->json([
            'status'  => $user ? Response_Success : Response_Fail,
            'data' => $user ? $user->id : null ,
        ]);
    }



    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {

        auth()->logout();

        return response()->json(['message' => __('user logout')]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json(auth()->user());
    }

    public function editProfile(Request $request) {

        $validator = \Validator::make($request->all(), [
          'name' => 'required|string|between:2,100',
          'surname' => 'nullable|string|between:2,100',
          'birth_day' => 'nullable|date',
          'gender' => 'nullable|in:1,2',
          'email' => 'required|string|email|max:100|unique:users,email,'.\auth()->id(),
        ]);

        if($validator->fails()){
            return response([
                'status'  => Response_Fail,
                'message' => $validator->errors()->all(),
            ]);
        }

        \auth()->user()->update( $validator->validated());

        return response()->json([
            'status' => Response_Success,
            'message' => __('user profile update'),
            'user' => \auth()->user()
        ]);
    }

    public function changePassword(Request $request) {

        $validator = \Validator::make($request->all(), [
            //'old_password' => 'required|string|min:8|max:255',
            'new_password' => 'required|string|min:8|max:255',
        ]);

        if($validator->fails()){
            return response([
                'status'  => Response_Fail,
                'message' => $validator->errors()->all(),
            ]);
        }

        //if (Hash::check($request->old_password , auth()->user()->getAuthPassword())) {

        \auth()->user()->update([
            'password' => bcrypt($request->new_password)
        ]);

            return response()->json([
                'status'  => Response_Success,
                'message' => __('password update'),
            ]);
        //}

        /*
        return response([
            'status'  => Response_Fail,
            'message' => __('old password is incorrect')
        ]);*/

    }

    public function updateImage(Request $request) {

            $validator = \Validator::make($request->all(), [
                'image' => 'required|image|max:10000',
            ]);


            if($validator->fails()){
                return response([
                    'status'  => Response_Fail,
                    'message' => $validator->errors()->all(),
                ]);
            }

            $img = $request->file('image');


              $imgName = auth()->id().'_'.time().'.'.$img->getClientOriginalExtension();
                $img->move(public_path('assets/images/users') , $imgName);
                \auth()->user()->update([
                    'img' => 'public/assets/images/users/'.$imgName
                ]);



                return response()->json([
                    'status'  => Response_Success,
                    'message' => __('user profile update'),
                    'user' => \auth()->user()
                ]);



        }

    public function checkEmail(Request $request) {

        $user = User::where('email' , $request->email_or_phone)->first();

        if($user){
            
            $user->activation_code= rand ( 1000 , 9999 );
            $user->save();
            $from=env('MAIL_FROM_ADDRESS');
            $data=[];
            $data["subject"] = 'Reset Password';
            $data["code"] = $user->activation_code;
            $data["name"] = $user->name;
            $data["email"] = $user->email;
            \Mail::send('emails.resetPassword', $data, function ($message) use ($data, $from) {
                $message->from($from)->to($data["email"], $data["email"] )
                    ->subject($data["subject"]);
            });

             /*Mail::send('emails.resetPassword', $data, function ($message) use ($data, $from) {
            $message->from($from)->to($data["email"], $data["email"] )
                ->subject($data["subject"]);
             });*/

        }else{
            $user = User::where('phone' , $request->email_or_phone)->first();
            if ($user){
                $user->activation_code= rand ( 1000 , 9999 );
                $user->save();
                $from=env('MAIL_FROM_ADDRESS');
                $data=[];
                $data["subject"] = 'Reset Password';
                $data["code"] = $user->activation_code;
                $data["name"] = $user->name;
                $data["email"] = $user->email;
                \Mail::send('emails.resetPassword', $data, function ($message) use ($data, $from) {
                    $message->from($from)->to($data["email"], $data["email"] )
                        ->subject($data["subject"]);
                });
            }

        }
        return response()->json([
            'status'  => $user ? Response_Success : Response_Fail,
            'data' => $user ? $user->id : null ,
        ]);
    }

    public function checkCode(Request $request)
    {
         $validator = validator($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'code' => 'required|max:4',
        ]);

        if ($validator->fails()){
             return response([
                    'status'  => Response_Fail,
                    'message' => $validator->errors()->all(),
                ]);
        }

        $user = User::where('id', $request->user_id)->first();
        
        
        if($user->activation_code ==  $request->code){
            return response()->json([
                'status'  => Response_Success,
                'data' => $user->id
            ]);
        }
        return response([
            'status'  => Response_Fail,
            'message' => __('api.activation code is incorrect'),
        ]);
    }
    public function forgotPassword(Request $request) {

        $validator = \Validator::make($request->all(), [
            'user_id'  => 'required|integer|exists:users,id',
            'password' => 'required|string|min:6|max:255',
        ]);

        if($validator->fails()){
            return response([
                'status'  => Response_Fail,
                'message' => $validator->errors()->all(),
            ]);
        }

        User::where('id' , $request->user_id)->update([
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'status'  => Response_Success,
            'message' => __('Password has been restored'),
        ]);

    }


    public function activeAccount(Request $request) {

        $validator = \Validator::make($request->all(), [
            'user_id'  => 'required|integer|exists:users,id',
        ]);

        if($validator->fails()){
            return response([
                'status'  => Response_Fail,
                'message' => $validator->errors()->all(),
            ]);
        }

        User::where('id' , $request->user_id)->update([
            'activation_code' => null,
            'email_verified_at' => Carbon::now()
        ]);

        return response()->json([
            'status'  => Response_Success,
            'message' => __('Account Activated'),
        ]);

    }

    public function removeAccount(Request $request) {

        $validator = \Validator::make($request->all(), [
            'password' => 'required|string|min:8|max:255',
        ]);

        if($validator->fails()){
            return response([
                'status'  => Response_Fail,
                'message' => $validator->errors()->all(),
            ]);
        }

        if (Hash::check($request->password , auth()->user()->getAuthPassword())) {

            \auth()->user()->delete();
            \auth()->logout();

            return response()->json([
                'status' => Response_Success,
                'message' => __('Account deleted'),
            ]);
        }

        return response([
            'status'  => Response_Fail,
            'message' => __('password is incorrect')
        ]);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            #'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }


    public function customRemoveAccount(){

        User::where('phone' , \request('phone'))->delete();

        return response([
            'status'  => Response_Success,
            'message' => __('delete success')
        ]);
    }

    public function wallets(){

        $wallets = Wallet::where('user_id',\auth()->id())->orderBy('id','desc')->with(['order','user'])->get();
        return response()->json([
            'status' => Response_Success,
            'total_wallets' => \auth()->user()->total_wallet,
            'wallets' => $wallets,
        ]);
    }
}
