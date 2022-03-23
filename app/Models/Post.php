<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'content',
        'user_id',
        'visibility',
    ];

    public function getImageUrl($size = '')
    {
        return $this->getMedia('images')->isNotEmpty()
            ? $this->getMedia('images')->last()->getUrl($size)
            : '';
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function commenters()
    {
        $commenterIds = Comment::select('user_id')
            ->where('post_id', $this->id)
            ->distinct();

        return User::whereIn('id', $commenterIds)
            ->get();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('large')
            ->width(1000)
            ->height(1000)
            ->fit(Manipulations::FIT_MAX, 1000, 1000)
            ->performOnCollections('images');
    }
}
