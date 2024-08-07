<?php

namespace App\Http\Resources;

use App\Http\Resources\V1\PostResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'posts' => PostResource::collection($this->whenLoaded('posts')),
//        'posts' => $this->whenLoaded('posts'),
        'response' => $this->slug,
        ];
    }
}
