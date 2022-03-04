<?php

namespace App\Http\Controllers;

use App\Events\CommentedOnPost;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CommentResource::collection(Comment::with(['author', 'author.media'])->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => ['required', 'string'],
        ]);

        Comment::create([
            'content' => $request->post('content'),
            'post_id' => $post->id,
            'user_id' => auth()->user()->id,
        ]);

        event(new CommentedOnPost($post, auth()->user()));

        return response()->json([
            'success' => true,
            'message' => 'Successfully created the comment.',
            'data' => [],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully deleted the comment.',
            'data' => [],
        ]);
    }
}
