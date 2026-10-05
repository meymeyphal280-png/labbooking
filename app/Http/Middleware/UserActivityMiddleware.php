<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserActivityMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            // Set user online cache key for 5 minutes
            $expiresAt = now()->addMinutes(5);
            Cache::put('user-is-online-' . Auth::id(), true, $expiresAt);

            // Optional: Store last active timestamp in database if needed permanently
            // Auth::user(a)->update(['last_seen_at' => now()]);
        }

        return $next($request);
    }
}

