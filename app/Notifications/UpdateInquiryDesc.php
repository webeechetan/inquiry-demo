<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdateInquiryDesc extends Notification implements ShouldQueue
{
    use Queueable;
    public $inquiry;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($inquiry)
    {
        $this->inquiry = $inquiry;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)


        ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
        ->greeting("Hello {$notifiable->name},")
        ->subject('Inquiry Description updated.')
        ->line('A new lead has been assigned to you for action')
        ->line('Name: ' . $this->inquiry->first_name . ' ' . $this->inquiry->last_name)
        ->line('Company Neame: ' . $this->inquiry->company_name)
        ->line(' Please visit the inquiry portal and update the details after the first level call.')
        ->action('View Inquiry', url('/admin/inquiries'));    
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
