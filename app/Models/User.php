<?php

namespace App\Models;

use App\Services\CountriesListService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'username',
        'sex',
        'email',
        'tagline',
        'birthdate',
        'country',
        'city',
        'about',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthdate' => 'datetime',
    ];

    public function getUsernamePrefixedAttribute()
    {
        return "@{$this->username}";
    }

    public function getCountryNameAttribute()
    {
        return CountriesListService::getCountryName($this->attributes['country']);
    }

    public function getUrlAttribute()
    {
        return route('users.show', ['user' => $this]);
    }

    public function getAvatarUrl($size = '')
    {
        return $this->getMedia('avatar')->isNotEmpty()
            ? $this->getMedia('avatar')->last()->getUrl($size)
            : $this->getFallbackAvatarUrl($size);
    }

    public function getFallbackAvatarUrl(string $size = '')
    {
        $avatarConversions = ['thumb', 'small'];

        return in_array($size, $avatarConversions)
            ? asset("images/anonymous-{$size}.jpg")
            : asset("images/anonymous.jpg");
    }

    /**
     * Get a query builder instace to find the friendship model between
     * this user and another user.
     *
     * @param User $user
     * @return Illuminate\Database\Query\Builder
     */
    public function friendshipWith(User $user)
    {
        return Friendship::where([
            ['sender_id', $this->id],
            ['receiver_id', $user->id],
        ])->orWhere([
            ['sender_id', $user->id],
            ['receiver_id', $this->id],
        ]);
    }

    /**
     * Get the friendship status of this user and another user.
     *
     * @param User $user
     * @return string
     */
    public function getFriendshipStatusWith(User $user)
    {
        $friendship = $this->friendshipWith($user)->first();

        return $friendship ? $friendship->statusOf($this) : 'none';
    }

    /**
     * Relationship between this user and the ones it sent friend requests to.
     */
    public function sentFriendRequestsTo()
    {
        return $this->belongsToMany(User::class, 'friendships', 'sender_id', 'receiver_id')
            ->as('friendship')
            ->withTimestamps()
            ->withPivot(['status', 'accepted_at'])
            ->using(Friendship::class);
    }

    /**
     * Relationship between this user and the ones it received friend requests from.
     */
    public function receivedFriendRequestsFrom()
    {
        return $this->belongsToMany(User::class, 'friendships', 'receiver_id', 'sender_id')
            ->as('friendship')
            ->withTimestamps()
            ->withPivot(['status', 'accepted_at'])
            ->using(Friendship::class);
    }

    /**
     * Pending relationships between this user and the ones it received friend requests from.
     */
    public function pendingFriendRequestsFrom()
    {
        return $this->belongsToMany(User::class, 'friendships', 'receiver_id', 'sender_id')
            ->as('friendship')
            ->wherePivot('status', 'pending')
            ->withTimestamps()
            ->withPivot(['status', 'accepted_at'])
            ->using(Friendship::class);
    }

    public function pendingFriendRequestsCount()
    {
        return $this->pendingFriendRequestsFrom->count();
    }

    /**
     * Get a collection of the ids of the users that are
     * friends with this user.
     *
     * @return Illuminate\Support\Collection
     */
    public function getFriendsIds()
    {
        return $this->getRelatedUsersIds('accepted');
    }

    /**
     * Get a collection of the ids of the users that have
     * friendships(accepted, pending) with this user.
     *
     * @param string status
     * @return Illuminate\Support\Collection
     */
    protected function getRelatedUsersIds($friendshipStatus = '')
    {
        return Friendship::select('sender_id', 'receiver_id')
            ->where(function ($query) {
                $query->where('sender_id', $this->id)
                    ->orWhere('receiver_id', $this->id);
            })
            ->when($friendshipStatus, function ($query, $friendshipStatus) {
                $query->where('status', $friendshipStatus);
            })
            ->get()
            ->map(function ($friendship) {
                return $friendship->sender_id !== $this->id
                    ? $friendship->sender_id
                    : $friendship->receiver_id;
            });
    }

    /**
     * Get a collection of suggested friends for this user.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getSuggestedFriends()
    {
        $count = 20;
        $releatedUsersIds = $this->getRelatedUsersIds();

        if ($releatedUsersIds->isEmpty()) {
            return User::inRandomOrder()
                ->where('id', '!=', $this->id)
                ->take($count)
                ->get();
        }

        $suggestedFriendsIds = Friendship::select('sender_id', 'receiver_id')
            ->where('status', 'accepted')
            ->where(function ($query) use ($releatedUsersIds) {
                $query->whereIn('sender_id', $releatedUsersIds)
                    ->orWhereIn('receiver_id', $releatedUsersIds);
            })
            ->get()
            ->map(fn ($row) => [$row->sender_id, $row->receiver_id])
            ->flatten()
            ->reject(fn ($id) => $id === $this->id || $releatedUsersIds->contains($id))
            ->unique();

        return User::with('media')
            ->whereIn('id', $suggestedFriendsIds)
            ->take($count)
            ->get();
    }

    public function getFriendsAttribute()
    {
        if (!$this->relationLoaded('friends')) {
            $this->setRelation('friends', $this->getAllFriends());
        }

        return $this->getRelation('friends');
    }

    private function getAllFriends()
    {
        if ($friendsOfThisUser = $this->friendsOfThisUser) {
            return $friendsOfThisUser->merge($this->thisUserFriendOf);
        }

        return $this->thisUserFriendOf;
    }

    /**
     * Friendships that this user started
     */
    protected function friendsOfThisUser()
    {
        return $this->belongsToMany(User::class, 'friendships', 'sender_id', 'receiver_id')
            ->as('friendship')
            ->wherePivot('status', 'accepted')
            ->withTimestamps()
            ->withPivot(['status', 'accepted_at'])
            ->using(Friendship::class);
    }

    /**
     * Friendships that this user was asked for
     */
    protected function thisUserFriendOf()
    {
        return $this->belongsToMany(User::class, 'friendships', 'receiver_id', 'sender_id')
            ->as('friendship')
            ->wherePivot('status', 'accepted')
            ->withTimestamps()
            ->withPivot(['status', 'accepted_at'])
            ->using(Friendship::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function unreadNotifications()
    {
        return $this->hasMany(Notification::class)
            ->where('checked', false);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(255)
            ->height(255)
            ->fit(Manipulations::FIT_MAX, 255, 255)
            ->performOnCollections('avatar');

        $this->addMediaConversion('small')
            ->width(50)
            ->height(50)
            ->fit(Manipulations::FIT_MAX, 50, 50)
            ->performOnCollections('avatar');
    }

    public function getRouteKeyName()
    {
        return 'username';
    }
}
