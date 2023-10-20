<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPostCreationLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role = Auth::user()->role;

        // Check if the user is free and has exceeded the post limit.
        if ($role === 'free' && Post::where('user_id', Auth::id())->where('created_at', '>=', now()->subDay())->count() >= 2) {
            return response()->json([
                'message' => 'You have exceeded your daily post limit.'
            ], 403);
        }

        return $next($request);
    }
}
