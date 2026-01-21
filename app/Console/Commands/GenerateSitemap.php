<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Berita;
use App\Models\KaryaIlmiah;
use App\Models\Books;
use App\Models\Downloads;
use App\Models\Profiles;

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
    protected $description = 'Generate sitemap.xml using Spatie\Sitemap';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating sitemap from routes and models...');

        try {
            $sitemap = Sitemap::create();

            // Static pages
            $staticRoutes = [
                route('beranda'),
                route('kontak'),
                route('jurusan'),
                route('ppdb'),
                route('berita-agenda'),
                route('galeri'),
                route('sejarah'),
                route('visi-misi'),
                route('struktur-organisasi'),
                route('ekstrakurikuler'),
                route('osis'),
                route('pramuka'),
                route('program-tahfidz'),
                route('artikel'),
                route('download'),
            ];

            foreach ($staticRoutes as $url) {
                $sitemap->add(Url::create($url));
            }

            // Berita
            Berita::where('status', 1)->get()->each(function ($item) use ($sitemap) {
                $sitemap->add(Url::create(route('detail-berita-agenda', $item->slug))
                    ->setLastModificationDate($item->updated_at)
                    ->setChangeFrequency('daily')
                    ->setPriority(0.8)
                );
            });

            // Karya Ilmiah
            KaryaIlmiah::where('status', 1)->get()->each(function ($item) use ($sitemap) {
                $sitemap->add(Url::create(route('detail-karya-ilmiah', $item->slug))
                    ->setLastModificationDate($item->updated_at)
                    ->setChangeFrequency('weekly')
                    ->setPriority(0.7)
                );
            });

            // Books (pdf viewer)
            Books::where('status', 1)->get()->each(function ($item) use ($sitemap) {
                $sitemap->add(Url::create(route('pdf-viewer', $item->id))
                    ->setLastModificationDate($item->updated_at)
                );
            });

            // Downloads
            Downloads::where('status', 1)->get()->each(function ($item) use ($sitemap) {
                // if you have a detail route, add it; else add listing
                $sitemap->add(Url::create(route('download')));
            });

            // Profiles pages (jurusan etc) if they have links
            Profiles::where('status', 1)->get()->each(function ($item) use ($sitemap) {
                if (! empty($item->link) && filter_var($item->link, FILTER_VALIDATE_URL)) {
                    $sitemap->add(Url::create($item->link));
                }
            });

            $sitemap->writeToFile(public_path('sitemap.xml'));

            $this->info('sitemap.xml written to public/sitemap.xml');
        } catch (\Exception $e) {
            $this->error('Failed to generate sitemap: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
