<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => strtoupper($this->title),
            'content' => $this->content,
            'created_at' => $this->created_at/*->format('Y-m-d H:i:m')*/,
        ];
    }
}
