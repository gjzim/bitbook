<?php

use App\Models\Like;

if (!function_exists('add_liked_by_logged_in_user_attribute')) {
    /**
     * Loop through each post in posts and add an extra attribute likedByLoggedInUser
     */
    function add_liked_by_logged_in_user_attribute($posts)
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
