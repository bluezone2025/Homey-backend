<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatusOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    private $oldStatus;
    private $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order , $oldStatus)
    {
        $this->order = $order;
        $this->oldStatus = $oldStatus;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.StatusOrderMail')->with([
            'oldStatus' => $this->oldStatus,
            'order' => $this->order
        ]);
    }
}
