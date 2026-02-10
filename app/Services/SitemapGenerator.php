<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\FilesystemAdapter;
use Carbon\Carbon;
use App\Models\Berita;
use App\Models\KaryaIlmiah;
use App\Models\Downloads;
use App\Models\Books;
use App\Models\Gallery;

class SitemapGenerator
{
    protected FilesystemAdapter $disk;

    public function __construct()
    {
        $this->disk = Storage::disk('public');
    }

    public function generateAll(): array
    {
        $this->ensureDirectory();

        $sitemaps = [];

        $sitemaps['sitemap-static.xml'] = $this->generateStatic();
        $sitemaps['sitemap-berita.xml'] = $this->generateBerita();
        $sitemaps['sitemap-karya-ilmiah.xml'] = $this->generateKaryaIlmiah();
        $sitemaps['sitemap-download.xml'] = $this->generateDownload();
        $sitemaps['sitemap-ebook.xml'] = $this->generateEbook();
        $sitemaps['sitemap-gallery.xml'] = $this->generateGallery();

        return $sitemaps;
    }

    private function ensureDirectory(): void
    {
        $dir = storage_path('app/public');
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }
    }

    private function writeSitemap(string $filename, array $items): void
    {
        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($items as $it) {
            if (empty($it['lastmod'])) continue;

            $xml .= "  <url>\n";
            $xml .= '    <loc>' . htmlspecialchars($it['loc'], ENT_XML1) . "</loc>\n";
            $xml .= '    <lastmod>' . $it['lastmod'] . "</lastmod>\n";
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        $this->disk->put($filename, $xml);
    }

    public function homeLastmod(): ?string
    {
        $raw = collect([
            Berita::max('updated_at'),
            KaryaIlmiah::max('updated_at'),
            Gallery::max('updated_at'),
            Downloads::max('updated_at'),
            Books::max('updated_at'),
        ])->filter()->max();

        return $raw ? Carbon::parse($raw)->toAtomString() : null;
    }

    private function generateStatic(): ?string
    {
        // prefer the latest content update across models for static pages
        $lastmod = $this->homeLastmod() ?? Carbon::now()->toAtomString();

        $pages = [
            '/kontak',
            '/jurusan',
            '/sejarah',
            '/visi-misi',
            '/struktur-organisasi',
            '/ekstrakurikuler',
            '/osim',
            '/pramuka',
            '/program-tahfidz',
        ];

        // include homepage as part of the static sitemap
        $items = collect(array_merge(['/'], $pages))->map(fn($p) => [
            'loc' => url($p),
            'lastmod' => $lastmod,
        ])->toArray();

        $this->writeSitemap('sitemap-static.xml', $items);
        return $lastmod;
    }

    private function generateBerita(): ?string
    {
        $items = [];

        $raw = Berita::max('updated_at');
        $lastmod = $raw ? Carbon::parse($raw)->toAtomString() : null;

        Berita::where('status', 1)
            ->get(['slug', 'updated_at'])
            ->each(function ($b) use (&$items) {
                $items[] = [
                    'loc' => url('/berita/' . $b->slug),
                    'lastmod' => optional($b->updated_at)->toAtomString(),
                ];
            });

        $this->writeSitemap('sitemap-berita.xml', $items);
        return $lastmod;
    }

    private function generateKaryaIlmiah(): ?string
    {
        $items = [];

        $raw = KaryaIlmiah::max('updated_at');
        $lastmod = $raw ? Carbon::parse($raw)->toAtomString() : null;

        KaryaIlmiah::where('status', 1)
            ->get(['slug', 'updated_at'])
            ->each(function ($k) use (&$items) {
                $items[] = [
                    'loc' => url('/karya-ilmiah/' . $k->slug),
                    'lastmod' => optional($k->updated_at)->toAtomString(),
                ];
            });

        $this->writeSitemap('sitemap-karya-ilmiah.xml', $items);
        return $lastmod;
    }

    private function generateDownload(): ?string
    {
        $items = [];

        $raw = Downloads::max('updated_at');
        $lastmod = $raw ? Carbon::parse($raw)->toAtomString() : null;

        Downloads::where('status', 1)
            ->get(['id', 'slug', 'judul', 'updated_at'])
            ->each(function ($d) use (&$items) {
                $slug = $d->slug ?: \Illuminate\Support\Str::slug($d->judul ?? 'download');
                $items[] = [
                    'loc' => url('/download/' . $slug),
                    'lastmod' => optional($d->updated_at)->toAtomString(),
                ];
            });

        $this->writeSitemap('sitemap-download.xml', $items);
        return $lastmod;
    }

    private function generateEbook(): ?string
    {
        $items = [];

        $raw = Books::max('updated_at');
        $lastmod = $raw ? Carbon::parse($raw)->toAtomString() : null;

        Books::where('status', 1)
            ->get(['id', 'slug', 'judul', 'updated_at'])
            ->each(function ($b) use (&$items) {
                $slug = $b->slug ?: \Illuminate\Support\Str::slug($b->judul ?? 'ebook');
                $items[] = [
                    'loc' => url('/e-book/' . $slug),
                    'lastmod' => optional($b->updated_at)->toAtomString(),
                ];
            });

        $this->writeSitemap('sitemap-ebook.xml', $items);
        return $lastmod;
    }

    private function generateGallery(): ?string
    {
        $items = [];

        $raw = Gallery::max('updated_at');
        $lastmod = $raw ? Carbon::parse($raw)->toAtomString() : null;

        Gallery::get(['id', 'slug', 'judul', 'updated_at'])
            ->each(function ($g) use (&$items) {
                $slug = $g->slug ?: \Illuminate\Support\Str::slug($g->judul ?? 'gallery');
                $items[] = [
                    'loc' => url('/gallery/' . $slug),
                    'lastmod' => optional($g->updated_at)->toAtomString(),
                ];
            });

        $this->writeSitemap('sitemap-gallery.xml', $items);
        return $lastmod;
    }

    public function generateIndex(array $sitemaps): void
    {
        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($sitemaps as $file => $lastmod) {
            if (!$lastmod) continue;

            // homepage entry uses root url, others use root-level sitemap paths
            if ($file === '/') {
                $loc = url('/');
            } else {
                $loc = url($file);
            }

            $xml .= "  <sitemap>\n";
            $xml .= '    <loc>' . $loc . "</loc>\n";
            $xml .= '    <lastmod>' . $lastmod . "</lastmod>\n";
            $xml .= "  </sitemap>\n";
        }

        $xml .= '</sitemapindex>';

        $this->disk->put('sitemap.xml', $xml);
    }
}
