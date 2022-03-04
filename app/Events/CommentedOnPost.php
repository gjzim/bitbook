<?php

namespace App\Events;

use App\Models\Post;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentedOnPost
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The post instance.
     *
     * @var \App\Models\Post
     */
    public $post;

    /**
     * The actor user instance.
     *
     * @var \App\Models\User
     */
    public $actor;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Post  $post
     * @param  \App\Models\User  $actor
     * @return void
     */
    public function __construct(Post $post, User $actor)
    {
        $this->post = $post;
        $this->actor = $actor;
    }
}
