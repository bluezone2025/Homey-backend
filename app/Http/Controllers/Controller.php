<?php

namespace App\Http\Controllers;

use App\FcmTokenModel;
use App\Notification;
use App\Services\FirebaseService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $firebaseService;

    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }

    static function send_notf($fcm_token , $data,$app_name,$not = null ){

        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);
        $notificationBuilder = new PayloadNotificationBuilder($app_name);
        $notificationBuilder->setBody($data)
            ->setSound('default');
        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => $not]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
        // dd($data);
        $token = $fcm_token;

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

        $downstreamResponse->numberSuccess();
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
    }

    static function send_notf_array($fcm_tokens , $data,$app_name,$not = null){
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder($app_name);
        $notificationBuilder->setBody($data)
            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData($not->toarray());
        // dd($dataBuilder);
        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
        // dd($data);

        // You must change it to get your tokens

        //dd($fcm_tokens,$option,$notification,$data);
        if (!empty($fcm_tokens)){

            $downstreamResponse = FCM::sendTo($fcm_tokens, $option, $notification, $data);

            $downstreamResponse->numberSuccess();
            $downstreamResponse->numberFailure();
            $downstreamResponse->numberModification();

            // return Array - you must remove all this tokens in your database
            $downstreamResponse->tokensToDelete();

            // return Array (key : oldToken, value : new token - you must change the token in your database)
            $downstreamResponse->tokensToModify();

            // return Array - you should try to resend the message to the tokens in the array
            $downstreamResponse->tokensToRetry();

            // return Array (key:token, value:error) - in production you should remove from your database the tokens present in this array
            $downstreamResponse->tokensWithError();
        }

    }

    public function save_notf($fcm_token , $is_all ,$type ,$type_id,$step=null,$type_model=null,$user_id_model=null){

        switch($type){
            case 'Order' :
                $title_ar=__('site.notifi_order_step'.$step.'_title',[],'ar');
                $body_ar=__('site.notifi_order_step'.$step.'_body',[],'ar');
                $title_en =__('site.notifi_order_step'.$step.'_title',[],'en');
                $body_en =__('site.notifi_order_step'.$step.'_body',[],'en');
                $image=null;
                $title=(App::getLocale()=='ar')?$title_ar:$title_en;
                $body=(App::getLocale()=='ar')?$body_ar:$body_en;
                $notifi=__('site.notifi_order_step'.$step.'_body',[],'ar') . ' ' . __('site.notifi_order_step'.$step.'_body',[],'en');
                break;
            case 'Product' :
                $title_ar=__('site.notifi_product_title',[],'ar');
                $body_ar=__('site.notifi_product_body',['productName'=>$type_model->title_ar],'ar');
                $title_en=__('site.notifi_product_title',[],'en');
                $body_en=__('site.notifi_product_body',['productName'=>$type_model->title_en],'en');
                $productNameAr=$type_model->title_ar;
                $productNameEn=$type_model->title_en ;
                $title=(App::getLocale()=='ar')?$title_ar:$title_en;
                $body=(App::getLocale()=='ar')?$body_ar:$body_en;
                $notifi=__('site.notifi_product_body',['productName'=>$productNameAr],'ar') . ' ' .__('site.notifi_product_body',['productName'=>$productNameEn],'en');
                $image=null;
                break;

            case 'Info' :
                if($type_model != null && $step==1){
                    if($type_model->type_discount == "price"){
                        $descount_ar= $type_model->discount .' '. __('site.KWD',[],'ar');
                        $descount_en= $type_model->discount .' '. __('site.KWD',[],'en');
                    }else{
                        $descount_ar= $type_model->discount .' %';
                        $descount_en= $type_model->discount .' %';
                    }
                    $title_ar=__('site.notifi_copoun_des_title',[],'ar');
                    $body_ar=__('site.notifi_copoun_des_body',['descount'=>$descount_ar,'code'=>$type_model->code],'ar');
                    $title_en=__('site.notifi_copoun_des_title',[],'en');
                    $body_en=__('site.notifi_copoun_des_body',['descount'=>$descount_en,'code'=>$type_model->code],'en');
                    $descount=app()->getLocale()== 'ar'? $descount_ar:$descount_en ;
                    $notifi=__('site.notifi_copoun_des_body',['descount'=>$descount,'code'=>$type_model->code]);
                    $image=null;
                }elseif($step==2){
                    $imgName = null;
                    $img = $type_model->file('img');
                    if ($img) {
                        $path = 'upload/notifications/';

                        if (!Storage::exists($path)) {
                            Storage::disk('public')->makeDirectory($path);
                        }
                        $imgName = time().'.'.$img->getClientOriginalExtension();
                        $img->move(public_path('upload/notifications/') , $imgName);
                    }
                    $title_ar=$type_model->title_ar;
                    $body_ar=$type_model->body_ar;
                    $title_en=$type_model->title_en;
                    $body_en=$type_model->body_en;
                    $title=(App::getLocale()=='ar')?$title_ar:$title_en;
                    $body=(App::getLocale()=='ar')?$body_ar:$body_en;
                    $notifi= $type_model->note_ar;
                    $image= $imgName? asset('upload/notifications/' . $imgName) : null;
                }

                $notify_url = $type_model->notify_url ? $type_model->notify_url : null;

                break;

        }
        // dd($body_en);
        $app=__('site.app_name',[],'ar') . ' ' . __('site.app_name',[],'en');
        if(!$is_all){
            $user_token=FcmTokenModel::where('token',$fcm_token)->first();

            if(!$user_token)
            {
                if($user_id_model)
                {
                    $user_token=FcmTokenModel::where('user_id',$user_id_model)->first();
                    if($user_token)
                    {
                        if($user_token->token != $fcm_token && $fcm_token != null ){
                            $user_token->token = $fcm_token;
                            $user_token->save();
                        }
                    }
                    else{
                        $user_token=   FcmTokenModel::create([
                            'token'=>$fcm_token,
                            'user_id'=>$user_id_model,
                        ]);
                    }
                }
                else{
                    // dd('$user_id_model');
                    $user_token=    FcmTokenModel::create([
                        'token'=>$fcm_token,
                    ]);
                }
            }

            if($user_token->user_id == null){
                $token=[$user_token->token];
                $user_id=[];
            }
            else{
                // dd($user_token->user_id);
                $token=[];
                $user_id=[$user_id_model];
            }


            $not= Notification::create([
                'fcm_token'=>$token,
                'user_id'=>$user_id,
                'type'=>$type,
                'type_id'=>$type_id,
                'title_ar'=>$title_ar,
                'title_en'=>$title_en,
                'body_ar'=>$body_ar,
                'body_en'=>$body_en,
                'image'=>$image,
            ]);

            $data=[];
            $data[]=$notifi;
            $this->firebaseService->sendNotification($user_token->token, $title, $body, $data);
//            self::send_notf($user_token->token,$notifi,$app,$not);
        }
        else{
            $user_tokens=FcmTokenModel::get();
            $tokens = $user_tokens->pluck('token')->toArray();
            $user_ids = $user_tokens->whereNotNull('user_id')->pluck('user_id')->toArray();
            $not=  Notification::create([
                'fcm_token'=>$tokens,
                'user_id'=>$user_ids,
                'type'=>$type,
                'type_id'=>$type_id,
                'title_ar'=>$title_ar,
                'title_en'=>$title_en,
                'body_ar'=>$body_ar,
                'body_en'=>$body_en,
                'image'=>$image,
            ]);
            //dd($tokens);
            $data=[];
            $data[]=$notifi;
            foreach ($tokens as $token){
                $this->firebaseService->sendNotification($token, $title, $body,$image, $data);
            }

//            self::send_notf_array($tokens,$notifi,$app,$not);

        }



    }
}
