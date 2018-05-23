<?php

namespace Cavidel\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewMessageEvent implements ShouldBroadcast
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
         return new Channel('officemate');
     }

     public function broadcastWith() {
       foreach ($this->data['recipients'] as $key => $value) {
         $this->data['recipients'][$key] = (string)$value;
       }
       return $this->data;
     }

}
