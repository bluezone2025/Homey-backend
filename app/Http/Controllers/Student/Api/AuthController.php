<?php

namespace App\Http\Controllers\Student\Api;

use App\Http\Requests\Student\StudentRequest;
use App\Models\Student;
use App\MyDataTable\MDT_UploadImag;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use MDT_UploadImag;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {

        $this->middleware('auth.guard:student-api', ['except' => ['login', 'register' , 'forgotPassword', 'checkPhone']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){

        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth('student-api')->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }


    public function register(Request $request) {

        $validator = \Validator::make($request->all(), (new StudentRequest())->rules());

        if($validator->fails()){
            return response([
                'status'  => Response_Fail,
                'message' => $validator->errors()->all(),
            ]);
        }

//        $img = $request->img;
//        $img = $this->MDT_saveImage($img , time().random_int(10000, 9000000) , 'assets/images/student/');
//
//        $cover = $request->cover;
//        $cover = $this->MDT_saveImage($cover , time().random_int(10000, 90000) , 'assets/images/student/');

        Student::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));


        return response()->json([
            'message' => __('student registered'),
            'data' => [
                'status'  => Response_Success,
                'message' => __('The registration has been completed successfully and the data is being reviewed by the administrator'),
            ]
        ]);
    }


    /**
     * Log the student out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {

        auth('student-api')->logout();

        return response()->json(['message' => __('student logout')]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth('student-api')->refresh());
    }

    /**
     * Get the authenticated Student.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function studentProfile() {
        return response()->json(auth('student-api')->user());
    }

    public function editProfile(Request $request) {

        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:students,email,'.\auth('student-api')->id(),
        ]);

        if($validator->fails()){
            return response([
                'status'  => Response_Fail,
                'message' => $validator->errors()->all(),
            ]);
        }

        \auth('student-api')->user()->update( $validator->validated());

        return response()->json([
            'status' => Response_Success,
            'message' => __('student profile update'),
            'student' => \auth('student-api')->user()
        ]);
    }

    public function changePassword(Request $request) {

        $validator = \Validator::make($request->all(), [
            'old_password' => 'required|string|max:255',
            'new_password' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return response([
                'status'  => Response_Fail,
                'message' => $validator->errors()->all(),
            ]);
        }

        if (Hash::check($request->old_password , auth('student-api')->user()->getAuthPassword())) {

            \auth('student-api')->user()->update([
                'password' => bcrypt($request->new_password)
            ]);

            return response()->json([
                'status'  => Response_Success,
                'message' => __('password update'),
            ]);
        }

        return response([
            'status'  => Response_Fail,
            'message' => __('old password is incorrect')
        ]);

    }

    public function checkPhone(Request $request) {

        $student = Student::where('phone' , $request->phone)->first();

        return response()->json([
            'status'  => $student ? Response_Success : Response_Fail,
            'data' => $student,
        ]);
    }

    public function forgotPassword(Request $request) {

        $validator = \Validator::make($request->all(), [
            'student_id'  => 'required|integer|exists:students,id',
            'password' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return response([
                'status'  => Response_Fail,
                'message' => $validator->errors()->all(),
            ]);
        }

        Student::where('id' , 'student_id')->update([
            'password' => bcrypt($request->new_password)
        ]);

        return response()->json([
            'status'  => Response_Success,
            'message' => __('Password has been restored'),
        ]);

    }

    public function removeAccount(Request $request) {

        $validator = \Validator::make($request->all(), [
            'password' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return response([
                'status'  => Response_Fail,
                'message' => $validator->errors()->all(),
            ]);
        }

        if (Hash::check($request->password , auth('student-api')->user()->getAuthPassword())) {

            \auth('student-api')->user()->delete();
            \auth('student-api')->logout();

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
            'expires_in' => auth('student-api')->factory()->getTTL() * 60,
            'student' => auth('student-api')->user()
        ]);
    }

}

