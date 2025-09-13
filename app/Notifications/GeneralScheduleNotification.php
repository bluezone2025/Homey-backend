<?php

namespace App\Notifications;

use App\Models\Challenge;
use App\Models\Expert;
use App\Models\GoodPractice;
use App\Models\Idea;
use App\Models\Improvement;
use App\Models\KnowledgeCafe;
use App\Models\KnowledgeLibrary;
use App\Models\QuickLesson;
use App\Models\QuickWin;
use App\Models\Solution;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;
use Illuminate\Support\Facades\Mail;

class GeneralScheduleNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $tries = 2;
    public $timeout = 10;
 
    public $type;
    public $reference_id;
    public $title_ar;
    public $title_en;
    public $details_ar;
    public $details_en;
    public $image;
    public $action_url;
    public $btn_text;
    public $methods;




    public function __construct($options=[]){

        $this->title_ar= $options['title_ar'];
        $this->title_en= $options['title_en'];
        $this->details_ar= $options['details_ar'];
        $this->details_en= $options['details_en'];
        $this->image= $options['image'];
        $this->methods=$options['methods'];
        $this->type = $options['type'];

        $this->reference_id = $options['reference_id'];
    }
 
    public function via($notifiable){
        return $this->methods;
    }
    public function toDatabase($notifiable){

        return [
            'group_type'=>$this->type,
            'id'=>$this->reference_id,
            'title_ar'=>$this->title_ar,
            'title_en'=>$this->title_en,
            'details_ar'=>$this->details_ar,
            'details_en'=>$this->details_en,
            'image'=>$this->image,
            'type'=>$this->type,
            'reference_id'=>$this->reference_id,
            #'url'=>$this->action_url
        ];
    } 
}
