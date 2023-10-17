<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InquiryUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    public $inquiry;
    public $log;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($inquiry, $log)
    {
        $this->inquiry = $inquiry;
        $this->log = $log;
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
                    ->subject('Hi there! A lead you are managing has a status change.')
                    ->greeting("Hello {$notifiable->name},")
                    ->line('The lead ' . $this->inquiry->first_name . ' ' . $this->inquiry->last_name . ' from ' . $this->inquiry->company_name . ' had an update.')
                    ->line($this->log)
                    ->line('Please visit the inquiry portal and review if needed.')
                    ->action('View Inquiry', url('/admin/inquiries'))
                    ->salutation('Best regards,WeBeeSocial');
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
