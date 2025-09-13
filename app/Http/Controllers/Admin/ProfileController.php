<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show(){

        $auth = auth('admin')->user();

        return view('admin.pages.profile.show' , compact('auth'));

    }

    public function updateInfo(AdminRequest $request)
    {

        auth('admin')->user()->update([

            'name' => $request->name,
            'email' => $request->email,

        ]);

        return back()->with('success', __('form.response.update data'));

    }


    public function updatePassword(Request $request){

        $user = auth('admin')->user();

        if (Hash::check($request->oldPassword == $user->getAuthPassword())) {


            $user->password       = bcrypt($request->newPassword);
            $user->remember_token = '';
            $user->save();


            auth('admin')->login($user);

            return back()->with('success', __('form.response.update password'));

        }


        return back()->withErrors(__('form.response.password false'));

    }

}
