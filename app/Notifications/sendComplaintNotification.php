<?php

namespace MESL\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class sendComplaintNotification extends Notification
{
    use Queueable;

    public function __construct($complaint)
    {
        $this->complaint = $complaint;
    }

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
        $complaint = $this->complaint;
        return (new MailMessage)
            ->greeting('Dear ' . $notifiable->staff->fullName . ',')
            ->line($complaint->user->fullName . ' Sent a complaint to your department')
            ->line('**Category: **' . $complaint->category->name)

            ->line('**Location: **' . $complaint->location->Location)

            ->line('**Content: **' . $complaint->complaints)

            ->line('**Date Created: **' . $complaint->created_at->toFormattedDateString())

            ->action('View Complaints', url('/facility-management/complaints'))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
