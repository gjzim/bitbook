<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'url' => route('posts.show', ['post' => $this]),
            'content' => $this->content,
            'author' => new UserResource($this->whenLoaded('author')),
            'image' => $this->when($this->relationLoaded('media') && $this->getMedia('images')->isNotEmpty(), function () {
                return [
                    'full' => $this->getMedia('images')->last()->getUrl(),
                    'large' => $this->getMedia('images')->last()->getUrl('large'),
                ];
            }),
            'likes_count' => $this->likes_count ?: 0,
            'liked_by_logged_in_user' => $this->likedByLoggedInUser ?: false,
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
            'comments_count' => $this->comments_count ?: 0,
            'deletable_by_logged_in_user' => auth()->user()->can('delete', $this->resource),
            'visibility' => $this->visibility,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
