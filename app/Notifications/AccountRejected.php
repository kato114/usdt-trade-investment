<?php

namespace App\Notifications;

use App\Foundation\SmsChannel;
use App\Foundation\SmsMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountRejected extends Notification
{
    use Queueable;

    public $request;
    public $reason;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($request, $reason)
    {
        $this->request = $request;
        $this->reason = $reason;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line(sprintf('Howdy %s, your %s account has been rejected, Reason: %s',
                explode(' ', $notifiable->name)[0],
                config('app.name'),
                $this->reason))
            ->action(sprintf('Go to %s', config('app.name')), url('/home'))
            ->line(sprintf('Thank you for using %s!', config('app.name')));
    }


    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
