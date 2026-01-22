<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Books;
use App\Models\Berita;
use App\Models\Gallery;
use App\Models\Downloads;
use App\Models\KaryaIlmiah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SitemapController extends Controller
{
    public function index(Request $request)
    {
        // If a pre-generated sitemap file exists in storage/public or public/, serve it directly.
        $storagePath = storage_path('app/public/sitemap.xml');
        $publicPath = public_path('sitemap.xml');

        if (file_exists($storagePath)) {
            return response()->file($storagePath, ['Content-Type' => 'application/xml']);
        }

        if (file_exists($publicPath)) {
            return response()->file($publicPath, ['Content-Type' => 'application/xml']);
        }

        $ttl = 60 * 60; // cache 1 hour

        $xml = Cache::remember('seo:sitemap.xml', $ttl, function () {
            $items = [];

            // Always include home with high priority
            $items[] = [
                'loc' => URL::to('/'),
                'lastmod' => Carbon::now()->toAtomString(),
                'changefreq' => 'daily',
                'priority' => '1.0',
            ];

            // Static portal routes
            $static = [
                '/kontak' => 'monthly',
                '/jurusan' => 'monthly',
                '/sejarah' => 'yearly',
                '/visi-misi' => 'yearly',
                '/struktur-organisasi' => 'yearly',
                '/ekstrakurikuler' => 'monthly',
                '/osis' => 'monthly',
                '/pramuka' => 'monthly',
                '/program-tahfidz' => 'monthly',
                '/e-book' => 'monthly',
                '/download' => 'monthly',
                '/galeri' => 'monthly',
                '/berita' => 'daily',
                '/karya-ilmiah' => 'monthly',
            ];

            foreach ($static as $path => $freq) {
                $items[] = [
                    'loc' => URL::to($path),
                    'changefreq' => $freq,
                    'priority' => '0.8',
                ];
            }

            // Dynamic: Berita
            try {
                Berita::where('status', 1)->orderBy('updated_at', 'desc')->get(['slug', 'updated_at'])->each(function ($b) use (&$items) {
                    $items[] = [
                        'loc' => URL::to('/berita/' . $b->slug),
                        'lastmod' => optional($b->updated_at)->toAtomString() ?: Carbon::now()->toAtomString(),
                        'changefreq' => 'weekly',
                        'priority' => '0.7',
                    ];
                });
            } catch (\Exception $e) {
                // ignore model errors, continue building sitemap
            }

            // Dynamic: Karya Ilmiah
            try {
                KaryaIlmiah::where('status', 1)->orderBy('updated_at', 'desc')->get(['slug', 'updated_at'])->each(function ($k) use (&$items) {
                    $items[] = [
                        'loc' => URL::to('/karya-ilmiah/' . $k->slug),
                        'lastmod' => optional($k->updated_at)->toAtomString() ?: Carbon::now()->toAtomString(),
                        'changefreq' => 'monthly',
                        'priority' => '0.6',
                    ];
                });
            } catch (\Exception $e) {
            }

            // Dynamic: Downloads
            try {
                Downloads::where('status', 1)->orderBy('updated_at', 'desc')->get(['id', 'updated_at'])->each(function ($d) use (&$items) {
                    $items[] = [
                        'loc' => URL::to('/download/' . $d->id),
                        'lastmod' => optional($d->updated_at)->toAtomString() ?: Carbon::now()->toAtomString(),
                        'changefreq' => 'monthly',
                        'priority' => '0.5',
                    ];
                });
            } catch (\Exception $e) {
            }

            // Dynamic: Books (e-book)
            try {
                Books::where('status', 1)->orderBy('updated_at', 'desc')->get(['id', 'updated_at'])->each(function ($b) use (&$items) {
                    $items[] = [
                        'loc' => URL::to('/e-book/' . $b->id),
                        'lastmod' => optional($b->updated_at)->toAtomString() ?: Carbon::now()->toAtomString(),
                        'changefreq' => 'monthly',
                        'priority' => '0.5',
                    ];
                });
            } catch (\Exception $e) {
            }

            // Dynamic: Gallery (individual galleries may not have slug; use id)
            try {
                Gallery::orderBy('updated_at', 'desc')->get(['id', 'updated_at'])->each(function ($g) use (&$items) {
                    $items[] = [
                        'loc' => URL::to('/galeri/' . $g->id),
                        'lastmod' => optional($g->updated_at)->toAtomString() ?: Carbon::now()->toAtomString(),
                        'changefreq' => 'monthly',
                        'priority' => '0.5',
                    ];
                });
            } catch (\Exception $e) {
            }

            // Build XML
            $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
            $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

            foreach ($items as $it) {
                $xml .= "  <url>" . PHP_EOL;
                $xml .= '    <loc>' . htmlspecialchars($it['loc'], ENT_XML1, 'UTF-8') . '</loc>' . PHP_EOL;

                if (!empty($it['lastmod'])) {
                    $xml .= '    <lastmod>' . \Carbon\Carbon::parse($it['lastmod'])->toAtomString() . '</lastmod>' . PHP_EOL;
                }

                if (!empty($it['changefreq'])) {
                    $xml .= '    <changefreq>' . htmlspecialchars($it['changefreq'], ENT_XML1, 'UTF-8') . '</changefreq>' . PHP_EOL;
                }

                if (!empty($it['priority'])) {
                    $xml .= '    <priority>' . number_format((float) $it['priority'], 1) . '</priority>' . PHP_EOL;
                }

                $xml .= "  </url>" . PHP_EOL;
            }

            $xml .= '</urlset>' . PHP_EOL;
            Storage::disk('public')->put('sitemap.xml', $xml);
            return $xml;
        });

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }
}
