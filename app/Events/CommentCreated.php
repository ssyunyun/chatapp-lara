<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CommentCreated implements ShouldBroadcast
{
    public $groupId;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    
    public function __construct($data)
    {
        $this->groupId = $data;
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel($this->groupId);
    }

    public function broadcastAs()
    {
        return 'chat';
    }

}
