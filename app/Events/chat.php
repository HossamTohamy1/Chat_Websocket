<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class chat implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
   public $username;
   public $message;
   public $groupName;

    /**
     * Create a new event instance.
     */
    public function __construct($username, $message , $groupName)
    {
        $this->username = $username;
        $this->message = $message;
        $this->groupName = $groupName;
    }
   

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return  new Channel('chatMessage');
        
    }

}
