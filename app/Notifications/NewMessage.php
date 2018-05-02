<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewMessage extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message)
    {
      $this->message = $message;
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
      $message = $this->message;
      // $company = $notifiable->staff->company->Company;

        return (new MailMessage)
        ->subject('New Message from '.$message->sender->FullName)
        ->greeting('Hi, '.$notifiable->first_name)
        ->line($message->sender->first_name.' sent you a message on OfficeMate. Here\'s what they said:')
        ->line('**Subject: **'.$message->Subject)
        ->line('**Date: **'.$message->created_at)
        ->line('**Body: **'.$message->Body)
        // ->line('Use the button below to visit the project page on '.config('app.name').'.')
        // ->line('**Description: **'.str_limit(strip_tags($doc->Description), 200).'')
        ->action('View On OfficeMate', route('view_message', $message->MessageRef));
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
