<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function posts()
    {
        $posts = PostResource::collection(Post::latest()->get());
        return response()->json($posts, 200);
    }
}
