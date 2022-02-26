<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;

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
            ->whereIn('user_id', [auth()->user()->id, ...auth()->user()->getFriendsIds()])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return PostResource::collection($posts);
    }
}
