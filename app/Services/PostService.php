<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    public function createPost($data)
    {
        // Validate data and create a new post
        $post = new Post([
            'website_id' => $data['website_id'],
            'title' => $data['title'],
            'description' => $data['description'],
        ]);

        $post->save();

        return $post;
    }
}
