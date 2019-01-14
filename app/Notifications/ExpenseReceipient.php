<?php

namespace MESL\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ExpenseReceipient extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($exp)
    {
        $this->exp = $exp;
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
        $exp = $this->exp;

        return (new MailMessage)
            ->subject('Approved Expense Request Needs Your Action')
            ->greeting('Hi, ' . $notifiable->first_name)
            ->line('**Expense Request Subject: **' . $exp->subject)
            ->line('**Date Created: **' . $exp->created_at)
            ->line('**Created By: **' . $exp->initiator->FullName)
            ->line('Use the button below to visit the approval page and Navigate to your Expense Request Inbox Tab ' . config('app.name') . '.')
            // ->line('**Description: **'.str_limit(strip_tags($doc->Description), 200).'')
            ->action('Go to Expense Request Inbox', route('expense_approvallist'));
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
