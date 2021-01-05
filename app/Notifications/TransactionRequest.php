<?php

namespace App\Notifications;

use App\Foundation\SmsChannel;
use App\Foundation\SmsMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TransactionRequest extends Notification
{
    use Queueable;

    public $transaction;
    public $type;
    public $amount;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($transaction, $type, $amount)
    {
        $this->transaction = $transaction;
        $this->type = $type;
        $this->amount = $amount;
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
        $url = array(
            "Withdraw" => '25-percent.com/public/reports/pending_withdraw',
            "Deposit" => '25-percent.com/public/reports/pending_deposit'
        );
        return (new MailMessage)
            ->line(sprintf('Howdy %s, we have a new %s transaction request from %s of %s %s',
                explode(' ', $notifiable->name)[0], $this->type, $this->transaction->client->name, currency($this->amount, true, 2), $this->transaction->item))
            ->action(sprintf('Go to %s', config('app.name')), $url[$this->type])
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
