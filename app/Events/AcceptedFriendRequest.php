<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AcceptedFriendRequest
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The sender user instance.
     *
     * @var \App\Models\User
     */
    public $sender;

    /**
     * The receiver user instance.
     *
     * @var \App\Models\User
     */
    public $receiver;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\User  $sender
     * @param  \App\Models\User  $receiver
     * @return void
     */
    public function __construct(User $sender, User $receiver)
    {
        $this->sender = $sender;
        $this->receiver = $receiver;
    }
}
