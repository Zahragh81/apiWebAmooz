<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Post extends BaseModel
{
////کدها باتوجه به دوره
//    public function newPost(Request $request)
//    {
//        $imagePath = Carbon::now()->microsecond . '.' . $request->image->extension();
//        $request->image->storeAs('image/posts', $imagePath, 'public');
//        Post::create([
//            'title' => $request->title,
//            'slug' => $request->slug,
//            'image' => $imagePath,
//            'content' => $request->get('content'),
//            'user_id' => 1,
//        ]);
//    }
//
//    public function updatePost(Request $request)
//    {
//        if ($request->has('image')){
//            $imagePath = Carbon::now()->microsecond . '.' . $request->image->extension();
//            $request->image->storeAs('image/posts', $imagePath, 'public');
//        }
//
//        $this->update([
//            'title' => $request->title,
//            'slug' => $request->slug,
//            'image' => $request->has('image') ? $imagePath : $this->image,
//            'content' => $request->get('content'),
//            'user_id' => 1,
//        ]);
//    }
//
//
//    public function deletePost(Post $post)
//    {
//        $post->delete();
//    }
}
