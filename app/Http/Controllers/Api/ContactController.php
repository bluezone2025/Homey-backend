<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\ContactUs;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function save(Request $request){

        $validator = \Validator::make($request->all(), (new ContactRequest())->rules());

        if ($validator->fails()) {

            return response([
                'status' => Response_Fail,
                'message' => $validator->errors()->all(),
            ]);
        }
        ContactUs::create([

            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'subject'=>$request->title,
            'body'=>$request->message,
            ]);

        return response([
            'status' => Response_Success,
        ]);

    }
}
