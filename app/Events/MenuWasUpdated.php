<?php

namespace Cavidel\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MenuWasUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $menu;
    public function __construct($menu)
    {
        $this->menu = $menu;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('menus');
    }

    public function broadcastWith()
    {
        return [
            'id'          => $this->menu->id,
            'name'        => $this->menu->name,
            'route'       => $this->menu->route,
            'description' => $this->menu->description,
        ];
    }
}
