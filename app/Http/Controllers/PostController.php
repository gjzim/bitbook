<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => ['required', 'string'],
            'image' => ['nullable', 'mimes:jpg,bmp,png'],
        ]);

        $post = new Post([
            'content' => $request->input('content'),
        ]);

        auth()->user()->posts()->save($post);

        if ($request->hasFile('image')) {
            $post->addMediaFromRequest('image')
                ->setFileName($request->image->hashName())
                ->toMediaCollection('images');
        }

        return redirect()->back()
            ->with('message', 'Successfully published the status.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->likedByLoggedInUser = Like::where('post_id', $post->id)
            ->where('user_id', auth()->user()->id)
            ->exists();

        $post->load(['media', 'author', 'author.media'])->loadCount(['comments', 'likes']);

        return view('posts.show', ['post' => new PostResource($post)]);
    }


    /**
     * Return a json collection response of this post's paginated comments.
     */
    public function indexComments(Post $post)
    {
        $comments = $post->comments()
            ->with(['author', 'author.media'])
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return CommentResource::collection($comments);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
