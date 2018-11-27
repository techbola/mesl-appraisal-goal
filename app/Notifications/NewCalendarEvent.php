<?php

namespace MESL\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewCalendarEvent extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($event)
    {
        $this->event = $event;
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
      $event = $this->event;
        return (new MailMessage)
              ->subject('A New Event Was Posted')
              ->greeting('Hi '.$notifiable->first_name)
              ->line($event->poster->FullName.' has posted a new event on the events scheduler. Here\'s a preview and a button to read the full thing.')
              ->line('**Title: **'.$event->Title)
              ->line('**Description: **'.str_limit(strip_tags($event->Description), 200).'')
              ->action('View Event', route('view_event', $event->EventRef));
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
