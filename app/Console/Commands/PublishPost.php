<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Console\Command;
use App\Jobs\PostPublishNotifyJOb;
use Illuminate\Support\Facades\Cache;

class PublishPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'publish:post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish a post';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentTime = Carbon::now();
        $posts = Post::with('user')->where('published', 0)->where('scheduled_at', '<=', $currentTime)
            ->whereHas('user', function ($query) {
                $query->where('role', 'premium');
            })
            ->get();

        foreach ($posts as $post) {
            $post = Post::find($post->id);
            $post->published = true;
            $post->save();

            // Prepare email details
            $details = [
                'message' => 'A new post has been published by ' . $post->user->name,
                'subject' => 'New post publish notify mail',
                'from' =>  env('MAIL_FROM_ADDRESS'),
            ];
            $receiver = admin()->email;
            PostPublishNotifyJOb::dispatch($receiver, $details); // Dispatch a job to send email notification

            // Clear the cache when a post is deleted
            Cache::forget('all_posts');
        }
    }
}
