<?php

namespace App\Models;

use App\Services\CountriesListService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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

    public function getUsernamePrefixedAttribute($value)
    {
        return "@{$this->username}";
    }

    public function getSexAttribute($value)
    {
        return ucfirst($value);
    }

    public function getCountryAttribute($value)
    {
        return CountriesListService::getCountryName($value);
    }

    public function getUrlAttribute()
    {
        return route('users.show', ['user' => $this]);
    }

    public function getRouteKeyName()
    {
        return 'username';
    }
}
