<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use App\Models\Berita;
use App\Models\KaryaIlmiah;
use App\Models\Downloads;
use App\Models\Books;
use App\Models\Gallery;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemap.xml and write to public directory';

    public function handle()
    {
        $this->info('Generating clean sitemap...');

        $items = [];
        $staticLastmod = Carbon::now()->toAtomString();

        $items[] = [
            'loc' => url('/'),
            'lastmod' => $staticLastmod,
        ];

        $staticPages = [
            '/kontak',
            '/jurusan',
            '/sejarah',
            '/visi-misi',
            '/struktur-organisasi',
            '/ekstrakurikuler',
            '/osis',
            '/pramuka',
            '/program-tahfidz',
            '/e-book',
            '/download',
            '/galeri',
            '/berita',
            '/karya-ilmiah',
        ];

        foreach ($staticPages as $path) {
            $items[] = [
                'loc' => url($path),
                'lastmod' => $staticLastmod,
            ];
        }

        Berita::where('status', 1)
            ->get(['slug', 'updated_at'])
            ->each(function ($b) use (&$items) {
                $items[] = [
                    'loc' => url('/berita/' . $b->slug),
                    'lastmod' => optional($b->updated_at)->toAtomString(),
                ];
            });

        KaryaIlmiah::where('status', 1)
            ->get(['slug', 'updated_at'])
            ->each(function ($k) use (&$items) {
                $items[] = [
                    'loc' => url('/karya-ilmiah/' . $k->slug),
                    'lastmod' => optional($k->updated_at)->toAtomString(),
                ];
            });

        Downloads::where('status', 1)
            ->get(['id', 'updated_at'])
            ->each(function ($d) use (&$items) {
                $items[] = [
                    'loc' => url('/download/' . $d->id),
                    'lastmod' => optional($d->updated_at)->toAtomString(),
                ];
            });

        Books::where('status', 1)
            ->get(['id', 'updated_at'])
            ->each(function ($b) use (&$items) {
                $items[] = [
                    'loc' => url('/e-book/' . $b->id),
                    'lastmod' => optional($b->updated_at)->toAtomString(),
                ];
            });

        Gallery::get(['id', 'updated_at'])
            ->each(function ($g) use (&$items) {
                $items[] = [
                    'loc' => url('/galeri/' . $g->id),
                    'lastmod' => optional($g->updated_at)->toAtomString(),
                ];
            });

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($items as $it) {
            if (empty($it['lastmod'])) {
                continue;
            }

            $xml .= "  <url>" . PHP_EOL;
            $xml .= '    <loc>' . htmlspecialchars($it['loc'], ENT_XML1, 'UTF-8') . '</loc>' . PHP_EOL;
            $xml .= '    <lastmod>' . $it['lastmod'] . '</lastmod>' . PHP_EOL;
            $xml .= "  </url>" . PHP_EOL;
        }

        $xml .= '</urlset>' . PHP_EOL;

        $storageDir = storage_path('app/public');
        if (! file_exists($storageDir)) {
            mkdir($storageDir, 0755, true);
        }

        $storagePath = $storageDir . DIRECTORY_SEPARATOR . 'sitemap.xml';

        try {
            file_put_contents($storagePath, $xml);
            // clear cached sitemap if present
            Cache::forget('seo:sitemap.xml');
            $this->info('Sitemap written to: ' . $storagePath);
        } catch (\Exception $e) {
            $this->error('Failed to write sitemap: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
