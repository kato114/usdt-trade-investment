<?php

namespace App\Notifications;

use App\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class PendingInvoice extends Notification implements ShouldQueue
{
    use Queueable;
    public $invoice;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->invoice = $id;
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
        $invoice = Invoice::query()->findOrFail($this->invoice);
        $url = route('invoice', compact('invoice'));
        return (new MailMessage)
            ->cc($invoice->account->cc?: [])
            ->subject(Lang::getFromJson('You have a new invoice'))
            ->line('Hello ' . $notifiable->name .', your invoice from our club is ready!')
            ->action('View Invoice', $url)
            ->attachData($invoice->pdf, 'Invoice.pdf', ['mime' => 'application/pdf'])
            ->line('Thank you for using our services!');
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
