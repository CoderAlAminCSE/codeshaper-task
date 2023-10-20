<?php

use Carbon\Carbon;
use App\Models\Post;
use App\Http\Middleware;
use Illuminate\Http\Request;
use App\Jobs\PostPublishNotifyJOb;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// authentication related rotues
Route::post('register', [RegisteredUserController::class, 'store']);
Route::middleware('auth:sanctum')->post('logout', [AuthenticatedSessionController::class, 'destroy']);
Route::post('login', [AuthenticatedSessionController::class, 'store']);


// post related routes
Route::middleware(['auth:sanctum', 'CheckPostCreationLimit'])->post('post/store', [PostController::class, 'store']);
Route::middleware('auth:sanctum')->get('post/index', [PostController::class, 'index']);
Route::middleware('auth:sanctum')->get('/post/edit/{id}', [PostController::class, 'edit']);
Route::middleware('auth:sanctum')->post('/post/update/{id}', [PostController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/post/delete/{id}', [PostController::class, 'destroy']);
Route::middleware('auth:sanctum')->post('/post/publish/{id}', [PostController::class, 'publish']);



// frontend post related routes
Route::get('frontend/post', [HomeController::class, 'posts']);
Route::get('post/{slug}', [HomeController::class, 'show']);


//delete it, it's for testing
Route::get('test', function () {
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

    return "published";
});
