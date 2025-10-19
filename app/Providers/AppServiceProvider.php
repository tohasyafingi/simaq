<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

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
        // Membatasi login hanya 3x per menit per email + IP
        RateLimiter::for('login', function ($request) {
            $email = (string) $request->email;

            return Limit::perMinute(3)->by($email.$request->ip());
        });
    }
}
