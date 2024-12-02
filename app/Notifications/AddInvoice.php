<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddInvoice extends Notification
{
    use Queueable;
    private $invoice_id;

 
    public function __construct($invoice_id)
    {
        $this->invoice_id = $invoice_id;

    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }


    public function toMail(object $notifiable): MailMessage
    {
        $url = 'http://127.0.0.1:8000/InvoicesDetails/'.$this->invoice_id;

        return (new MailMessage)
                ->subject('اضافة فاتورة جديدة')
                ->line('اضافة فاتورة جديدة')
                ->action('عرض الفاتورة', $url)
                ->line('شكرا لاستخدامك Invoicely لادارة الفواتير');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
