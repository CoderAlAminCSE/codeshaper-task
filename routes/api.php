<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
Route::middleware('auth:sanctum')->post('post/store', [PostController::class, 'store']);
Route::middleware('auth:sanctum')->get('post/index', [PostController::class, 'index']);
Route::middleware('auth:sanctum')->get('/post/edit/{id}', [PostController::class, 'edit']);
Route::middleware('auth:sanctum')->post('/post/update/{id}', [PostController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/post/delete/{id}', [PostController::class, 'destroy']);



// frontend post related routes
Route::get('frontend/post', [HomeController::class, 'posts']);
Route::get('post/{slug}', [HomeController::class, 'show']);
