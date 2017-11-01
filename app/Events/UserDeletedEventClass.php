<?php

namespace App\Events;

//use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserDeletedEventClass
{
    use SerializesModels;

    public $deleted_user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($deleted_user)
    {
        //do all the stuff concerning this user
        $this->deleted_user = $deleted_user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    /*public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }*/
}
