<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /*
        |--------------------------------------------------------------------------
        | ADMIN PERMISSION
        |--------------------------------------------------------------------------
        */

        Gate::define('admin', function ($user) {
            return $user->role === 'Admin';
        });

        /*
        |--------------------------------------------------------------------------
        | BOOKING RATE LIMITER
        |--------------------------------------------------------------------------
        |
        | Maximum 5 booking requests per minute for each logged-in user.
        |
        | This helps prevent:
        | - Spam booking requests
        | - Repeated submit clicks
        | - Automated booking requests
        | - Excessive POST requests
        |
        */

        RateLimiter::for('booking', function ($request) {

            $user = $request->user();

            if ($user) {
                return Limit::perMinute(5)
                    ->by('user:' . $user->id);
            }

            return Limit::perMinute(3)
                ->by('ip:' . $request->ip());
        });
    }
}
