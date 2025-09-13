<?php
// This class file to define all general functions
namespace App\Helpers;

use App\Models\User;

class GeneralNotification {

    public function notify_user($user_id=1, $title_ar,$title_en, $details_ar,$details_en,$image, $reference_id, $reference_type, $methods=['database']){
        $user = User::where('id',$user_id)->first();

        if($user!=null){
            $user->notify(
                new \App\Notifications\GeneralNotification([
                    'title_ar'=>$title_ar,
                    'title_en'=>$title_en,
                    'details_ar'=>$details_ar,
                    'details_en'=>$details_en,
                    'image'=>$image,
                    'type'=>$reference_type,
                    'reference_id'=>$reference_id,
                    'methods'=>$methods
                ])
            );
        }
    }
}