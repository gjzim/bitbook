<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function indexComments(Post $post)
    {
        $comments = $post->comments()
            ->with(['author', 'author.media'])
            ->orderBy('created_at', 'desc')
            ->paginate(2);

        return CommentResource::collection($comments);
    }

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
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
