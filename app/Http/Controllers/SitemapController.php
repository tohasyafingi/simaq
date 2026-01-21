<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index(Request $request)
    {
        $path = public_path('sitemap.xml');

        if (! file_exists($path)) {
            // If Spatie package is installed, attempt to generate
            if (class_exists('\\Spatie\\Sitemap\\SitemapGenerator')) {
                try {
                    \Spatie\Sitemap\SitemapGenerator::create(config('app.url'))->writeToFile($path);
                } catch (\Exception $e) {
                    abort(500, 'Failed to generate sitemap: ' . $e->getMessage());
                }
            } else {
                abort(404, 'Sitemap not found. Install spatie/laravel-sitemap and run the generator.');
            }
        }

        return response()->file($path, ['Content-Type' => 'application/xml']);
    }
}
