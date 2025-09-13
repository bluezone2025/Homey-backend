<?php

namespace App\Http\Controllers\Web\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ContactRequest;
use App\Models\Contact;
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

        $contact = Contact::create($validator->validated());

        // send email here
        $from=env('MAIL_FROM_ADDRESS');
        $data["subject"]= 'رسالة جديدة';
        $data["contact"]= $contact;
        try{
            \Mail::send('emails.new-message', $data, function ($message) use ($data, $from) {
                $message->from($from)->to("support@trendatt.com", "support@trendatt.com" )
                    ->subject($data["subject"]);
            });
        }catch (\Exception $e){

        }
        // end send email here

        return response([
            'status' => Response_Success,
        ]);

    }


}
