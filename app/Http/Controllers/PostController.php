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
        $request->validate(
            [
                'content' => ['nullable', 'string'],
                'image' => [
                    'required_without:content',
                    'mimes:jpg,bmp,png',
                    'min:25',
                    'max:5120',
                ],
            ],
            [
                'image.mimes' => 'Only .jpg, .bmp, and .png files are allowed.',
                'image.min' => 'Image size must be greater than 25KB.',
                'image.max' => 'Image size must be less than 5MB.',
            ],
        );

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
        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully deleted the post.',
            'data' => [],
        ]);
    }
}
