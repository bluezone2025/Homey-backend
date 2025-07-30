<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
//    protected $firebaseService;
//
//    public function __construct(FirebaseService $firebaseService)
//    {
//        $this->firebaseService = $firebaseService;
//    }

    public function sendNotification(Request $request)
    {
        $deviceToken = $request->input('device_token');
        $title = $request->input('title');
        $body = $request->input('body');
        $data = $request->input('data', []);

        $this->firebaseService->sendNotification($deviceToken, $title, $body, $data);

        return response()->json(['success' => true]);
    }

}
