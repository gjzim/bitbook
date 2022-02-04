<?php

namespace App\Models;

use App\Services\CountriesListService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
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

        return asset("images/anonymous.jpg");

        return in_array($size, $avatarConversions)
        ? asset("images/anonymous-{$size}.jpg")
        : asset("images/anonymous.jpg");
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(255)
            ->height(255)
            ->performOnCollections('avatar');

        $this->addMediaConversion('small')
            ->width(50)
            ->height(50)
            ->performOnCollections('avatar');
    }

    public function getRouteKeyName()
    {
        return 'username';
    }
}
