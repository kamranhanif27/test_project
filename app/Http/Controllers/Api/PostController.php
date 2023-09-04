<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function create(CreatePostRequest $request)
    {
        $data = $request->validated();
        $post = $this->postService->createPost($data);

        return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);
    }
}
