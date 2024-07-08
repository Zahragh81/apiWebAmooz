<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\V1\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{

    //کدها باتوجه به دوره
//    public function index()
//    {
////        return $this->successResponse(200, Post::all(), 'okConnect');
//        return $this->errorResponse(500, 'noConnect');
//    }
//
//    public function show(Post $post)
//    {
//        $dataResponse = new PostResource($post);
//        return $this->successResponse(200, $dataResponse, 'getOk');
////        return new PostResource($post);
//    }
//////باتوجه به روش دوره
//    public function store(Request $request, Post $post)
//    {
//
//        $validate = Validator::make($request->all(),[
//            'title' => 'required|string',
//            'slug' => 'required|string',
//            'image' => 'required|image',
//            'content' => 'required|string',
//            'user_id' => 'required'
//        ]);
//
//        if ($validate->fails()){
//            return $this->errorResponse(400, $validate->messages());
//        }
//
//       $post->newPost($request);
//
//       $data = $post->orderByDesc('id')->first();
//       return $this->successResponse(200, $data, 'post created successfully');
//    }
//
//    public function update(Request $request, Post $post)
//    {
//        $validate = Validator::make($request->all(), [
//           'title' => 'required|string',
//           'slug' => 'required|string',
//           'image' => 'image',
//           'content' => 'required|string',
//           'user_id' => 'required'
//        ]);
//
//        if ($validate->fails()){
//            return $this->errorResponse(400, $validate->messages());
//        }
//        $post->updatePost($request);
//        return $this->successResponse(200, $post, 'post created successfully');
//    }
//
//
//    public function destroy(Post $post)
//    {
//        $post->deletePost($post);
//        return $this->successResponse(200, $post, 'post deleted successfully');
//    }


//بر اساس تغییرات جدید


    public function index()
    {
        //حالا paginateبه روش دیگه که در دوره نبود
        $posts = Post::paginate(3);
        return PostResource::collection($posts);
//خب حالا برای paginateبه صورت زیردر دوره
//        $posts = Post::paginate(3);
//        return $this->successResponse([
//            'posts' => PostResource::collection($posts),
//            'links' => PostResource::collection($posts)->response()->getData()->links,
//            'meta' => PostResource::collection($posts)->response()->getData()->meta,
//        ]);
//        return PostResource::collection($posts);


        //خب برای ایجاد collectionدوتا روش زیر وجود دارد
        //یک روش اینکه بیایم ازش یک شی بسازیم
//        $posts = Post::all();
//        return new PostCollection($posts);
//یک روش دیگه اینکه از collectionاستفاده کنیم
//        $posts = Post::all();
//        return $this->successResponse(PostResource::collection($posts), 200);


//        $posts = Post::all();
//        return $this->successResponse($posts);
    }


    public function store(PostRequest $request)
    {
        $inputs = $request->all();
        if ($request->hasFile('image')) {
            $path = 'images/post';
            $file_name = uniqid() . '.' . $request->file('image')->extension();
            Storage::drive('public')->putFileAs($path, $request->file('image'), $file_name);
        }
        $post = Post::create($inputs);

        return $this->successResponse($post);
    }


//    public function show(Post $post)
//    {
//        return $this->successResponse($post);
//    }

//تیکه کدبراساس دوره
    public function show(Post $post)
    {
//        return new PostResource($post);//برای اینکه بخواهیم ازwrapاستفاده کنیم
        $dataResponse = new PostResource($post);
        return $this->successResponse($dataResponse);
//        return $dataResponse->additional([
//            'food' => [
//                'slug' => $post->slug,
//            ]
//        ]);
    }


    public function update(PostRequest $request, Post $post)
    {
        $inputs = $request->all();
        if ($request->hasFile('image')) {
            if ($post->image)
                Storage::drive('public')->delete(Str::remove('storage/', $post->image));
            $path = 'images/post';
            $file_name = uniqid() . '.' . $request->file('image')->extension();
            Storage::drive('public')->putFileAs($path, $request->file('image'), $file_name);
            $inputs['image'] = "storage/$path/$file_name";
        }
        $post->update($inputs);
        return $this->successResponse($post);
    }


    public function destroy(Post $post)
    {
        if ($post->image)
            Storage::drive('public')->delete(Str::remove('storage/', $post->image));
        $post->delete();
        return $this->successResponse($post);
    }
}
