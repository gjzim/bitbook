<?php

namespace App\Http\Controllers;

use App\Events\LikedPost;
use App\Models\Like;
use App\Models\Post;

class LikeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function store(Post $post)
    {
        Like::create([
            'post_id' => $post->id,
            'user_id' => auth()->user()->id,
        ]);

        event(new LikedPost($post, auth()->user()));

        return response()->json([
            'success' => true,
            'message' => 'Successfully liked the post',
            'data' => []
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Like::where([
            'post_id' => $post->id,
            'user_id' => auth()->user()->id,
        ])->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully unliked the post',
            'data' => []
        ]);
    }
}
