<?php

namespace Cavidel\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewTask extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($task)
    {
      $this->task = $task;
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
      $task = $this->task;
      $company = $notifiable->staff->company->Company;

        return (new MailMessage)
            ->subject('New Task at '.$company)
            ->greeting('Hi, '.$notifiable->first_name)
            ->line('You have been assigned a new task on the **"'. $task->project->Project .'"** project, here are the details of the task:')
            ->line('**Task Title: **'.$task->Task)
            ->line('**Due Date: **'.$task->EndDate)
            ->line('**Created By: **'.$task->poster->FullName)
            ->line('Use the button below to visit the project page on '.config('app.name').'.')
            // ->line('**Description: **'.str_limit(strip_tags($doc->Description), 200).'')
            ->action('Open Project Page', route('view_project', $task->project->ProjectRef));
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
