<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => strtoupper($this->title),
            'body' => $this->content,
            'created_at' => $this->created_at/*->format('Y-m-d H:i:m')*/,
        ];
    }
}
