<?php

namespace MESL\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MemoApproval extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($memo)
    {
        $this->memo = $memo;
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
        $memo = $this->memo;

        return (new MailMessage)
            ->subject('Memo Approval Request')
            ->line('<p class="title-bg" style="text-align: center; padding: 3rem; font-size: 27px; background-color: #e1393b; color:#fff; font-weight: bold">' . 'Internal Memo' . '</p>')
            ->greeting('Dear ' . $notifiable->first_name . ',')
            ->line('----------------------------------------------------------------')
            ->line('**Memo Subject: **' . $memo->subject)
            ->line('**Memo Purpose: **' . $memo->purpose)
            ->line('**Memo Body: **' . $memo->body)
            ->line('**Comment: **' . $memo->ApproverComment)
            ->line('**Date Created: **' . $memo->created_at->toFormattedDateString())
            ->line('**Created By: **' . $memo->initiator->FullName)
            ->line('Use the button below to visit the approval page ' . config('app.name') . '.')
            // ->line('**Description: **'.str_limit(strip_tags($doc->Description), 200).'')
            ->action('Open Memo Approval Page', route('memos_approvallist'));
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
