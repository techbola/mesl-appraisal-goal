<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class StaffInvitation extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
      $user = $notifiable;
      $company = $notifiable->staff->company->Company;

        return (new MailMessage)
                    ->subject('Invitation to Join '.$company)
                    ->greeting('Hi, '.$notifiable->FullName)
                    ->line('You have been invited to join '.$company.' on '.config('app.name').'. Use the button below to accept the invitation and activate your account.')
                    ->line('Login Email: '.$notifiable->email)
                    ->line('Password: '.substr($user->code, -5) )
                    ->action('Accept Invitation', route('activate', ['id'=>$notifiable->id, 'code'=>$notifiable->code]));
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
