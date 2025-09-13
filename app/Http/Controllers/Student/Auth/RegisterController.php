<?php

namespace App\Http\Controllers\Student\Auth;

use App\Models\Student;
use App\Http\Controllers\Controller;
use App\MyDataTable\MDT_UploadImag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use MDT_UploadImag;
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new admins as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect students after registration.
     *
     * @var string
     */
    protected $redirectTo = '/brand';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('student.guest:student');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'img'        => ['required', 'image', 'mimes:jpeg,jpg,png,gif'],
            'name'       => ['required', 'string', 'max:50'],
            'email'      => ['required', 'string', 'email', 'max:100', 'unique:students'],
            'phone'      => ['required', 'string', 'max:20', 'min:5'],
            'password'   => ['required', 'string'],
        ]);
    }

    /**
     * Create a new student instance after a valid registration.
     *
     * @param array $data
     *
     * @return \App\Models\Student
     */
    protected function create(array $data)
    {
        $img = $data['img'];

        $img = $this->MDT_saveImage($img , time().random_int(10000, 9000000) , 'assets/images/student/');

        return Student::create([
            'img' => $img,
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('student.auth.register');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('student');
    }
}
