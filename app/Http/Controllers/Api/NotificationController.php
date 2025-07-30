<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Notification;
use App\ShowNotification;

use App\FcmTokenModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
     public function __construct()
    {
        if(request()->header('auth-token')){

            $this->middleware('auth.guard:web-api')->only('index','count','show','save_token');

        }
    }

    public function index(Request $request)
    {


        if(auth()->user()){
            $culom="user_id";
            $value=auth()->user()->id;
        }else{
           $culom="fcm_token";
            $value=$request->fcm_token; 
        }
        // dd($culom);
        $notifications_m= Notification::where($culom,'like','%'.$value.'%')->latest()->get();
        $notifications=[];
        foreach($notifications_m as $notification){
            if(in_array($value,$notification->$culom)){
                array_push($notifications,[
                    'id'    => $notification->id,
                    'type'    => $notification->type,
                    'type_id'    => $notification->type_id,
                    'title_ar'    => $notification->title_ar,
                    'title_en'    => $notification->title_en,
                    'body_ar'    => $notification->body_ar,
                    'body_en'    => $notification->body_en,
                    'image'    => $notification->image,
                    'created_at'    => $notification->created_at,
                ]);

            }
        }
        
        return response([
            'status' => Response_Success,
            'data' => $notifications,
        ]);
    }
     public function count(Request $request)
    {
        if(auth()->user()){
            $culom="user_id";
            $value=auth()->user()->id;
        }else{
           $culom="fcm_token";
            $value=$request->fcm_token; 
        }
        
        $notifications_m= Notification::where($culom,'like','%'.$value.'%')->get();
        $notifications=[];
        foreach($notifications_m as $notification){
            if(in_array($value,$notification->$culom)){
                if(!$notification->is_read($value)){
                    array_push($notifications,$notification);
 
                }
            }
        }
        return response([
            'status' => Response_Success,
            'data' => count($notifications),
        ]);
    }
     public function show(Request $request)
    {
        if(auth()->user()){
            $culom="user_id";
            $value=auth()->user()->id;
        }else{
            $culom="fcm_token";
            $value=$request->fcm_token;
        }

        $notifications_m= Notification::where($culom,'like','%'.$value.'%')->get();

        foreach ($notifications_m as $item){

            $old_notifications= ShowNotification::where([
                'notification_id'=>$item->id,
                'user_id'=>$value
            ])->first();

            if (!$old_notifications){

                $notifications= ShowNotification::create([
                    'notification_id'=>$item->id,
                    'user_id'=>$value
                ]);
            }
        }

        return response([
            'status' => Response_Success,
            'data' => 1,
        ]);
        
    }
    public function save_token(Request $request)
    {

        $notifications= FcmTokenModel::where('token',$request->fcm_token)->first();
        if(!$notifications){
          $notifications=  FcmTokenModel::create([
                                "token"=>$request->fcm_token,
                              ]);
                              
            if(auth()->user()){
                $notificationsauth= FcmTokenModel::where('user_id',auth()->user()->id)->delete();
                $notifications->user_id = auth()->user()->id;
                $notifications->save();
             
            }
        }else{
            if(auth()->user()){
                $notificationsauth= FcmTokenModel::where('user_id',auth()->user()->id)->first();
                if($notificationsauth){
                    $notificationsauth->token =$request->fcm_token;
                    $notificationsauth->save();
                }else{
                    $notifications->user_id = auth()->user()->id;
                    $notifications->save();
                }
                
             
            }
        }
        return response([
            'status' => Response_Success,
            'data' => $notifications,
        ]);
    }
}
