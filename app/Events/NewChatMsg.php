<?php

namespace Cavidel\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewChatMsg implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $data;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data)
    {
      $this->data = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('new-chat');
    }

    public function broadcastWith()
    {
      // return [
      //   'id' => $this->data['id'],
      //   'email' => $this->data['email'],
      //   'body' => $this->data['body'],
      //   'session' => $this->data['session'],
      //   'room' => $this->data['room'],
      //   'status' => $this->data['status'],
      //   'date' => $this->data['date'],
      //   'user_id' => $this->data['user_id'],
      //   'username' => $this->data['username'],
      // ];
      
      return $this->data->toArray();
    }
}
