<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\View;
use App\Models\Kontak;

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
        // ===============================
        // Rate Limiter Login
        // ===============================
        RateLimiter::for('login', function ($request) {
            $email = (string) $request->email;
            return Limit::perMinute(3)->by($email.$request->ip());
        });

        // ===============================
        // View Composer Footer Portal
        // ===============================
        View::composer(
            'components.layouts.portal.footer',
            function ($view) {
                $kontak = cache()->rememberForever('footer_kontak', function () {
                    return Kontak::latest()->first();
                });

                $view->with('kontak', $kontak);
            }
        );
    }
}
