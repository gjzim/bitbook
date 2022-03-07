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
            ->tap('add_liked_by_logged_in_user_attribute');

        return PostResource::Collection($posts);
    }
}
