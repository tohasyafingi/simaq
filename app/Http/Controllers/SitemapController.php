<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index(Request $request)
    {
        $storagePath = storage_path('app/public/sitemap.xml');
        $publicPath = public_path('sitemap.xml');

        if (file_exists($storagePath)) {
            $path = $storagePath;
        } elseif (file_exists($publicPath)) {
            $path = $publicPath;
        } else {
            // If Spatie package is installed, attempt to generate into storage/public
            if (class_exists('\Spatie\\Sitemap\\SitemapGenerator')) {
                try {
                    // ensure storage public directory exists
                    $dir = dirname($storagePath);
                    if (! file_exists($dir)) {
                        mkdir($dir, 0755, true);
                    }
                    \Spatie\Sitemap\SitemapGenerator::create(config('app.url'))->writeToFile($storagePath);
                    $path = $storagePath;
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
