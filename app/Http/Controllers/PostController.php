<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $post = new Post();
        $post->user_id = auth()->user()->id;
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->save();
    }

    public function index()
    {
        $posts =  Post::where('user_id', Auth::user()->id)->latest()->get();
        return response()->json($posts, 200);
    }


    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return response()->json($post, 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $post = Post::find($id);

        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->save();
        return response()->json($post, 200);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return response()->json('Post deleted successfully', 200);
    }
}
