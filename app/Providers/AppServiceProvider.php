<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\View;
use App\Models\Kontak;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Env as SupportEnv;
use App\Models\Profiles;

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
        // Optional: force HTTPS when `FORCE_HTTPS` env is true
        if (env('FORCE_HTTPS', false)) {
            URL::forceScheme('https');
        }

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

        // ===============================
        // View Composer: SEO Meta Defaults
        // ===============================
        View::composer([
            'components.layouts.app',
            'components.layouts.portal'
        ], function ($view) {
            $site = cache()->rememberForever('site_profile', function () {
                return Profiles::where('type', 'site')->first();
            });

            $defaultTitle = config('app.name', 'Laravel');
            if ($site && ! empty($site->judul)) {
                $defaultTitle = $site->judul;
            }

            $meta = [
                'title' => $defaultTitle,
                'description' => optional($site)->content ?? config('app.description', ''),
                'keywords' => '',
                'canonical' => URL::current(),
                'image' => optional($site)->image ? asset('storage/' . optional($site)->image) : asset('assets/og-image.png'),
                'og_type' => 'website',
                'robots' => 'index, follow',
            ];

            // Only provide defaults when the view hasn't already supplied `meta`
            $data = $view->getData();
            if (! isset($data['meta']) || empty($data['meta'])) {
                $view->with('meta', $meta);
            }
        });
    }
}
