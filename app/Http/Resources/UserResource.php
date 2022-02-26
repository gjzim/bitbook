<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'username' => $this->username,
            'tagline' => $this->tagline,
            'sex' => $this->sex,
            'email' => $this->email,
            'birthdate' => $this->birthdate,
            'country' => $this->country,
            'about' => $this->about,
            'url' => $this->url,
            'avatar' => $this->whenLoaded('media', function () {
                return [
                    'full' => $this->getAvatarUrl(),
                    'thumb' => $this->getAvatarUrl('thumb'),
                    'small' => $this->getAvatarUrl('small'),
                ];
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
