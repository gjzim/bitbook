<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Http\Resources\PostResource;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('layouts.home');
    }

    /**
     * Return home feed posts of the currently logged in user.
     */
    public function postsIndex()
    {
        $posts = Post::with(['author', 'author.media', 'media'])
            ->withCount(['likes', 'comments'])
            ->whereIn('user_id', [auth()->user()->id, ...auth()->user()->getFriendsIds()])
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->tap([$this, 'addLikedByLoggedInUserAttribute']);

        return PostResource::Collection($posts);
    }

    /**
     * Loop through each post in posts and add an extra attribute likedByLoggedInUser
     */
    public function addLikedByLoggedInUserAttribute($posts)
    {
        if (!auth()->check()) {
            return;
        }

        $postIds = $posts->pluck('id');
        $postsLikedByLoggedInUser = Like::select('post_id')
            ->where('user_id', auth()->user()->id)
            ->whereIn('post_id', $postIds)
            ->get()
            ->pluck('post_id');

        $posts->each(function ($post) use ($postsLikedByLoggedInUser) {
            $post->likedByLoggedInUser = $postsLikedByLoggedInUser->contains($post->id);
        });
    }
}
