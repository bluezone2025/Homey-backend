<?php

namespace App\Http\Controllers\Web\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Http\Traits\ApiResponses;
use App\Models\Notification;
use App\Models\ShowNotification;

use App\Models\FcmTokenModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // New Notification Here

    use ApiResponses;
     public function __construct()
    {
        if(request()->header('auth-token')){

            $this->middleware('auth.guard:web-api')->only('index','count','show');

        }
    }

    public function index(Request $request)
    {

        // update here get all notifications

        /*
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
                    'notify_url'    => $notification->notify_url,
                    'created_at'    => $notification->created_at,
                ]);

            }
        }*/

        $readNotifications = \DB::table('notifications')
            ->where('notifiable_id',auth()->id())->orderBy('created_at','desc')->take(100)->get();
        if (count($readNotifications) > 0){
            \DB::table('notifications')
                ->where('notifiable_id',auth()->id())
                ->update(['read_at'=>Carbon::now()]);
        }

        $notifications  = \DB::table('notifications')
            ->where('notifiable_id',auth()->id())->select('id','data','read_at','created_at')
            ->orderBy('created_at','desc')
            ->take(100)->get();

        $notifications = NotificationResource::collection($notifications);
        return $this->apiResponse($notifications,null,200);


        /*
        return response([
            'status' => Response_Success,
            'data' => '',//$notifications,
        ]);*/
    }
     public function count(Request $request)
    {
        $notifications = \DB::table('notifications')
            ->where('notifiable_id',auth()->id())->whereNull('read_at')->count();

        /*
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
        }*/
        return response([
            'status' => Response_Success,
            'data' => $notifications,
        ]);
    }
     public function show(Request $request)
    {

        /*if(auth()->user()){
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
        }*/

        return response([
            'status' => Response_Success,
            'data' => 1,
        ]);
        
    }
    public function save_token(Request $request)
    {

        // update fcm token

        if (auth()->check()){

            $notificationsauth= FcmTokenModel::where('user_id',auth()->user()->id)->delete();

            $notifications= FcmTokenModel::where('token',$request->fcm_token)->first();
            if ($notifications){
                $notifications->update([
                    'user_id'   => auth()->id()
                ]);
            }else{
                FcmTokenModel::create([
                    "token"=>$request->fcm_token,
                    'user_id'   => auth()->id()
                ]);
            }

        }else{
            $notifications= FcmTokenModel::where('token',$request->fcm_token)->first();

            if (!$notifications){
                FcmTokenModel::create([
                    "token"=>$request->fcm_token
                ]);
            }
        }
        /*
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
        }*/
        return response([
            'status' => Response_Success,
            'data' => $notifications,
        ]);
    }
}
