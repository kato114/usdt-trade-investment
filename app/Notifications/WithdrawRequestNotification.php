<?php

namespace App\Notifications;

use App\Foundation\SmsChannel;
use App\Foundation\SmsMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WithdrawRequestNotification extends Notification
{
    use Queueable;

    public $amount;
    public $address;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($amount, $address)
    {
        $this->amount = $amount;
        $this->address = $address;
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
        $msg = sprintf('Howdy %s, your withdraw request has been approved. We sent $%s to %s successfully.',
            explode(' ', $notifiable->name)[0], $this->amount, $this->address);

        return (new MailMessage)
            ->line($msg)
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
