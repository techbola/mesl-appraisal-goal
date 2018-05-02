<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewDocument extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($doc)
    {
        $this->doc = $doc;
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
      $doc = $this->doc;
        return (new MailMessage)
              ->subject('A New Document Was Posted')
              ->greeting('Hi '.$notifiable->first_name)
              ->line($doc->poster->FullName.' has posted a new document. Here\'s a preview and a button to read the full thing.')
              ->line('**Title: **'.$doc->Title)
              ->line('**Description: **'.str_limit(strip_tags($doc->Description), 200).'')
              ->action('View Document', route('view_doc', $doc->DocRef));
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
