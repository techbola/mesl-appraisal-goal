<?php

namespace Cavidel\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TodoAssigned extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($todo)
    {
      $this->todo = $todo;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
      $todo = $this->todo;
      $company = $notifiable->staff->company->Company;
      $initiator = $todo->initiator->FullName;

        return (new MailMessage)
            ->subject('New To-Do Item at '.$company)
            ->greeting('Hi, '.$notifiable->first_name)
            ->line($initiator.' has assigned a new to-do item to you. Here\'s what they said:')
            ->line('**To-Do Item: **'.$todo->Todo)
            ->line('**Due Date: **'.$todo->DueDate)
            ->line('Use the button below to see your to-dos list on '.config('app.name').'.')
            // ->line('**Description: **'.str_limit(strip_tags($doc->Description), 200).'')
            ->action('View To-Dos List', route('todos'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
      $todo = $this->todo;

      return [
        'body' => $chat->Body,
        'project_id' => $chat->ProjectID,
        'project' => $chat->project->Project,
        'sender' => $chat->staff->user->FullName,
        'sender_id' => $chat->StaffID,
        'date' => $chat->created_at->format('jS M, Y g:ia'),
        'link' => route('view_project', $chat->ProjectID),
        'text' => 'New chat message in "'.$chat->project->Project.'" by '.$chat->staff->user->FullName
      ];

    }
}
