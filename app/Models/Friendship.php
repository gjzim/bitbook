<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Friendship extends Pivot
{
    protected $table = 'friendships';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'accepted_at',
        'status',
    ];

    /**
     * Get the friendship status of a user of this friendship.
     *
     * @param User $user
     * @return string
     */
    public function statusOf(User $user)
    {
        if ($this->status == 'accepted') {
            return 'friends';
        } else if ($this->status == 'pending') {
            return  $user->id === $this->sender_id
                ? 'request_sent'
                : 'request_recieved';
        }

        return 'none';
    }
}
