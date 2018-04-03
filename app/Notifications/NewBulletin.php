<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewBulletin extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($bulletin)
    {
        $this->bulletin = $bulletin;
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
      $bulletin = $this->bulletin;
        return (new MailMessage)
                    ->subject('New Bulletin Board Announcement')
                    ->greeting('Hi '.$notifiable->first_name)
                    ->line($bulletin->poster->FullName.' has posted a new bulletin board announcement. Here\'s a preview and a button to read the full thing.')
                    ->line('**Title: **'.$bulletin->Title)
                    ->line('**Body: **'.str_limit(strip_tags($bulletin->Body), 200).'')
                    ->action('Read Full Content', route('view_bulletin', $bulletin->BulletinRef));
                    // ->line('Thank you for using our application!');
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
