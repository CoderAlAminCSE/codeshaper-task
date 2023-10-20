<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{

    public function posts()
    {
        // Retrieve a list of published posts, caching the result for 1 hour
        $posts = Cache::remember('all_posts', 3600, function () {
            return PostResource::collection(Post::where('published', true)->latest()->get());
        });

        return response()->json($posts, 200);
    }





    public function show($slug)
    {
        // Find and return a post by its slug; return a 404 response if not found
        $post = Post::where('slug', $slug)->first();
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return new PostResource($post);
    }
}
