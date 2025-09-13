<?php

namespace App\Console\Commands;

use App\Models\Notification;
use App\Models\ScheduleNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendScheduledNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send scheduled notifications at their specified time.';



    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Send one-time notifications
        $this->sendOneTimeNotifications();

        // Send recurring daily notifications
        $this->sendRecurringDailyNotifications();
    }


    protected function sendOneTimeNotifications()
    {
        $notifications = ScheduleNotification::where('sent', false)
            ->where('send_at', '<=', Carbon::now())
            ->where('is_recurring', false)
            ->get();

        foreach ($notifications as $notification) {
            $this->sendNotification($notification);
        }
    }

    protected function sendRecurringDailyNotifications()
    {
        $now = Carbon::now();
        $notifications = ScheduleNotification::where('is_recurring', true)
            ->whereTime('recurring_time', '<=', $now->format('H:i:s'))
            ->get();

        foreach ($notifications as $notification) {
            $this->sendNotification($notification);
        }
    }

    protected function sendNotification($notification)
    {
        $notification->user->notify(new \App\Notifications\GeneralScheduleNotification($notification));
        // Mark one-time notifications as sent
        if (!$notification->is_recurring) {
            $notification->update(['sent' => true]);
        }
    }
}
