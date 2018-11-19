<?php

namespace Cavi\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProjectChatNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($chat)
    {
      $this->chat = $chat;
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

      $chat = $this->chat;
      $company = $notifiable->staff->company->Company;
      $sender = $chat->staff->user->FullName;
      $project = $chat->project->Project;
      $date = $chat->created_at->format('jS M, Y g:ia');

        return (new MailMessage)
            ->subject('New Project Chat from '.$sender)
            ->greeting('Hi, '.$notifiable->first_name)
            ->line('A new chat message has been posted on the project - **"'. $project .'"**, by '. $sender)
            ->line('**Project: **'.$project)
            ->line('**Posted on: **'.$date)
            ->line('Use the button below to visit the project page on '.config('app.name').'.')
            // ->line('**Description: **'.str_limit(strip_tags($doc->Description), 200).'')
            ->action('Open Project Page', route('view_project', $chat->ProjectID));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
      $chat = $this->chat;

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
      return [
        // 'ref' => $this->trade->FCYTradeRef,
        //
        // 'customer'=>$this->customer,
        // 'amount'=>$this->amount,
        // 'currency'=>$this->currency,
        // 'rate'=>$this->rate,
        // 'type'=>$this->type,
        // 'naira'=>$this->naira,
        // 'trade_date'=>$this->trade_date,
        // 'poster'=>$this->trade->poster->name,
        //
        // 'body' => 'A pending trade is awaiting approval -- '.$this->trade->notif_summary,
        // 'link' => route('pending_trades'),
        // 'created'=> Carbon::parse($this->trade->InputDatetime)->format('jS M, Y - g:ia'),
        // 'notif_type'=>'Pending Trade',
      ];


    }
}
