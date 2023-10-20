<?php

namespace App\Http\Controllers;

use App\Jobs\PostPublishNotifyJOb;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{

    public function store(Request $request)
    {
        // validation check
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        // Create a new Post instance, set details, and save it
        $post = new Post();
        $post->user_id = auth()->user()->id;
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->save();

        // Clear the cache when a new post is created and send success response
        Cache::forget('all_posts');
        return response()->json('Post created successfully', 200);
    }

    public function index()
    {
        // Get the user's posts and return them in descending order
        $posts =  Post::where('user_id', Auth::user()->id)->latest()->get();
        return response()->json($posts, 200);
    }


    public function edit($id)
    {
        // Find and return a specific post by its ID
        $post = Post::findOrFail($id);
        return response()->json($post, 200);
    }

    public function update(Request $request, $id)
    {
        // validation check
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        // Find and update a specific post by its ID
        $post = Post::find($id);
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->save();

        // Clear the cache after a post is updated
        Cache::forget('all_posts');
        return response()->json($post, 200);
    }

    public function destroy($id)
    {
        // Find and delete a specific post by its ID
        $post = Post::find($id);
        $post->delete();

        // Clear the cache when a post is deleted
        Cache::forget('all_posts');
        return response()->json('Post deleted successfully', 200);
    }


    public function publish($id)
    {
        // Find and publish a specific post by its ID
        $post = Post::find($id);
        $post->published = true;
        $post->save();

        // Prepare email details
        $details = [
            'message' => 'A new post has been published by ' . Auth::user()->name,
            'subject' => 'New post publish notify mail',
            'from' =>  env('MAIL_FROM_ADDRESS'),
        ];
        $receiver = Auth::user()->email;
        PostPublishNotifyJOb::dispatch($receiver, $details); // Dispatch a job to send email notification

        // Clear the cache when a post is deleted
        Cache::forget('all_posts');
        return response()->json(['message' => 'Post status updated successfully.']);
    }
}
