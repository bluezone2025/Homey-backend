<?php

namespace App\Listeners;


use App\Events\NewNotification;
use App\Helpers\GeneralNotification;
use App\Models\User;
use App\Services\FirebaseService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class SendNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    public function handle(NewNotification $event)
    {
        $notification = $event->notification;

        //dd($notification);
        foreach (User::all() as $user) {
            (new GeneralNotification())
                ->notify_user(
                    $user->id,
                    $notification['title_ar'],
                    $notification['title_en'],
                    $notification['details_ar'],
                    $notification['details_en'],
                    $notification['image'],
                    $notification['reference_id'],
                    $notification['type'] // default general
                );
        }

        // get user token from db
        $tokens = DB::table('fcm_tokens')->get();

        foreach ($tokens as $item){
            (new FirebaseService())
                ->sendFCMNotification($item->token, $notification['title_ar'], $notification['details_ar'] , $notification['image'],$notification['reference_id'],$notification['type']);

        }
    }
}
