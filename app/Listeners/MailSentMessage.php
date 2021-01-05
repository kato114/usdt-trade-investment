<?php

namespace App\Listeners;

use App\MailLog;
use Illuminate\Mail\Events\MessageSending;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailSentMessage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MessageSending  $event
     * @return void
     */
    public function handle(MessageSending $event)
    {
        $mail_log = new MailLog();
        $mail_log->to = @array_keys($event->message->getTo())[0];
        $mail_log->from = @array_key_first($event->message->getFrom());
        $mail_log->subject =  @$event->message->getSubject();
        $mail_log->body = @$event->message->getBody();
        $mail_log->save();
    }
}
