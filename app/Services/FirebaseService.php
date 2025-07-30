<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FirebaseService
{
    protected $messaging;

    public function __construct()
    {
        try{

            $factory = (new Factory)
                ->withServiceAccount(config('services.firebase.credentials'));

            $this->messaging = $factory->createMessaging();

        }catch (\Exception $e){

            dd($e);
        }
    }

    public function sendNotification($deviceToken, $title, $body,$imageUrl=null, $data = [])
    {
        #Notification::create($title, $body,$imageUrl);

        $notification = array('title' => $title,
            'text' => $body,
            'body' => $body,
            'sound' => 'default', 'badge' => '1');

        $data = array(
            'title'             => $title,
            'text'              => $body,
            'image'              => $imageUrl
        );

        try{

            $message = CloudMessage::withTarget('token', $deviceToken)
                ->withNotification($notification)
                ->withData($data);

            $messaging = app('firebase.messaging');

            $messaging->send($message);

            return true;
        }catch (\Exception $e){
            return true;
        }
    }
}
