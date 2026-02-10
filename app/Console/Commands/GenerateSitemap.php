<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SitemapGenerator;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate-split';
    // protected $signature = 'sitemap:generate';
    protected $description = 'Generate split sitemap.xml (SEO optimized)';

    private SitemapGenerator $generator;

    public function __construct(SitemapGenerator $generator)
    {
        parent::__construct();
        $this->generator = $generator;
    }

    public function handle()
    {
        $this->info('Generating split sitemaps...');

        $sitemaps = $this->generator->generateAll();
        $this->generator->generateIndex($sitemaps);

        $this->info('All sitemaps generated successfully.');
    }
}
