<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        return $this->serve('sitemap.xml');
    }

    public function show(string $sitemap)
    {
        return $this->serve($sitemap);
    }

    private function serve(string $filename)
    {
        $path = storage_path('app/public/' . $filename);

        abort_unless(file_exists($path), 404);

        return response()->file(
            $path,
            [
                'Content-Type'  => 'application/xml; charset=UTF-8',
                'Cache-Control' => 'public, max-age=3600',
            ]
        );
    }
}
