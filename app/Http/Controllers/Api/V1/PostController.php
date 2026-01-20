<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = request()->user();
        $posts = $user->post()->paginate();
       return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
     {
        $data = $request->validated();
        $data['author_id'] = $request->user()->id;
        $post = Post::create($data);
        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $user = request()->user();
        abort_if($post->author_id !== Auth::id(), 403, 'Access denied');
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
         abort_if($post->author_id !== Auth::id(), 403, 'Access denied');
         $data = $request->validate([
            'title' => 'required|string|min:2',
            'body' => ['required','string','min:2']
        ]);
        $data['author_id'] = 1;
        $post->update($data);
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        abort_if($post->author_id !== Auth::id(), 403, 'Access denied');
        $post->delete();
        return response()->noContent();
    }
}
