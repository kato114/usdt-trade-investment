<?php

namespace App\Notifications;

use App\Foundation\SmsChannel;
use App\Foundation\SmsMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DepositRequestNotification extends Notification
{
    use Queueable;

    public $url;
    public $type;
    public $amount;
    public $address;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($type, $amount, $address, $url)
    {
        $this->type = $type;
        $this->url = $url;
        $this->address = $address;
        $this->amount = $amount;
        $this->outamount = $amount;
        
        if(is_array($this->amount)) {
            $this->amount = $amount[0];
            $this->outamount = $amount[1];
        }
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
        if($this->type == 0) {
            return (new MailMessage)
                ->line(sprintf('Howdy %s, your deposit request is pending.', explode(' ', $notifiable->name)[0]))
                ->line('Please click the button below to check the status of your deposit.')
                ->action('Check your Deposit here', $this->url)
                ->line(sprintf('Thank you for using %s!', config('app.name')));
        } else if($this->type == 1) {
            return (new MailMessage)
                ->line(sprintf('Howdy %s, your deposit request has been confirmed.', explode(' ', $notifiable->name)[0]))
                ->line('This deposit will become active on Sunday.')
                ->line('Your 1st profits from this deposit will on Monday.')
                ->line('You will see the profit on Tuesday as we work one day in arrears.')
                ->action('Check your Deposit here', $this->url)
                ->line(sprintf('Thank you for using %s!', config('app.name')));
        } else if($this->type == 2) {
            return (new MailMessage)
                ->line(sprintf('Howdy %s, your deposit request is time out.', explode(' ', $notifiable->name)[0]))
                ->action('Check your Deposit here', $this->url)
                ->line(sprintf('Thank you for using %s!', config('app.name')));
        } else if($this->type == 3) {
            return (new MailMessage)
                ->line(sprintf('Howdy %s, your deposit request is still pending.', explode(' ', $notifiable->name)[0]))
                ->line('Please send the remaining amount to the same address.')
                ->line(sprintf('Amount Received    BTC: %s', number_format($this->amount,8)))
                ->line(sprintf('Amount Outstanding BTC: %s', number_format($this->outamount,8)))
                ->line(sprintf('Address : %s', $this->address))
                ->action('Check your Deposit here', $this->url)
                ->line(sprintf('Thank you for using %s!', config('app.name')));
        } else if($this->type == 4) {
            return (new MailMessage)
                ->line(sprintf('Howdy %s, 25% has received a successful Bitcoin Deposit.', explode(' ', $notifiable->name)[0]))
                ->line(sprintf('Sender     Name: %s', $this->address))
                ->line(sprintf('Received Amount: %s', number_format($this->amount,8)))
                ->action('Check Its status here', $this->url)
                ->line(sprintf('Thank you for using %s!', config('app.name')));
        }
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
