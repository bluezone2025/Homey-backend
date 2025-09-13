<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
class FirebaseService
{
    protected $messaging;


    public function sendNotification($deviceToken, $title, $body,$imageUrl=null, $odata = [])
    {
        $data = [
            'title' => $title,
            'body'  => $body,
            'image' => $imageUrl
        ];

        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);
        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($data)
            ->setSound('default');
        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => null]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
        // dd($data);
        $token = $deviceToken;

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

        $downstreamResponse->numberSuccess();
        dd($downstreamResponse);

        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();
        // return Array - you must remove all this tokens in your database
        $downstreamResponse->tokensToDelete();
        // return Array (key : oldToken, value : new token - you must change the token in your database)
        $downstreamResponse->tokensToModify();
        // return Array - you should try to resend the message to the tokens in the array
        $downstreamResponse->tokensToRetry();
        // return Array (key:token, value:error) - in production you should remove from your database the tokens
        $downstreamResponse->tokensWithError();

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

        //try{

        /*
            $message = CloudMessage::withTarget('token', $deviceToken)
                ->withNotification($notification)
                ->withData($data);

            $messaging = app('firebase.messaging');

            $messaging->send($message);

            return true;*/
        /*}catch (\Exception $e){
            return true;
        }*/


        $serverKey = env('FCM_SERVER_KEY'); // Your Firebase server key
        $deviceToken = 'your_device_token_here'; // The recipient device's FCM token

// Notification data
        $notification = [
            'title' => 'Test Notification',
            'body' => 'This is a test message',
        ];

// Custom data
        $data = [
            'key1' => 'value1',
            'key2' => 'value2',
        ];

// Build the payload
        $payload = [
            'to' => $deviceToken, // Can be 'to' for single token or 'registration_ids' for multiple
            'notification' => $notification,
            'data' => $data,
        ];

        $headers = [
            'Authorization: key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

        $response = curl_exec($ch);

        if ($response === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }

        curl_close($ch);

// Handle the response
        $responseData = json_decode($response, true);
        dd($responseData);
        if (isset($responseData['success']) && $responseData['success'] == 1) {
            echo 'Notification sent successfully';
        } else {
            echo 'Failed to send notification: ' . $response;
        }
    }



    function base64UrlEncode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    function createJwt($audience) {
        $key = json_decode(file_get_contents(storage_path('bdinar-331ad-firebase-adminsdk-ku17n-f8368faa78.json')), true);

        // Header
        $header = [
            'alg' => 'RS256',
            'typ' => 'JWT',
        ];

        // Payload
        $now = time();
        $payload = [
            'iss' => $key['client_email'],
            'sub' => $key['client_email'],
            'aud' => $audience,
            'iat' => $now,
            'exp' => $now + 3600, // Token expiration time (1 hour)
        ];

        // Encode header and payload
        $headerEncoded = $this->base64UrlEncode(json_encode($header));
        $payloadEncoded = $this->base64UrlEncode(json_encode($payload));

        // Create signature
        $signature = '';
        openssl_sign("$headerEncoded.$payloadEncoded", $signature, $key['private_key'], OPENSSL_ALGO_SHA256);
        $signatureEncoded = $this->base64UrlEncode($signature);

        // Return the complete JWT
        return "$headerEncoded.$payloadEncoded.$signatureEncoded";
    }


    function sendFCMNotification($deviceToken, $title,$body, $image,$reference,$type) {
        // Create JWT
        $audience = 'https://fcm.googleapis.com/';
        $jwt = $this->createJwt($audience);

        // Prepare the FCM API URL (v1)
        $url = 'https://fcm.googleapis.com/v1/projects/bdinar-331ad/messages:send';

        // Prepare the notification payload
        $payload = [
            'message' => [
                'token' => $deviceToken,
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                ],
                'data' => [
                    'image' => $image,
                    'reference_id'  => $reference,
                    'type'          => $type
                ],
            ],
        ];

        // Use cURL to send the request
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $jwt,
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

        // Execute the request
        $response = curl_exec($ch);
        //dd($response);
        curl_close($ch);

        // Check the response
        return json_decode($response, true);
    }
}
