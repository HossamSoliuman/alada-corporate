<?php

namespace App\Console\Commands;

use App\Services\SitemapService;
use Illuminate\Console\Command;

class SitemapGenerate extends Command
{
    protected $signature   = 'sitemap:generate';
    protected $description = 'Generate and cache the sitemap XML file';

    public function __construct(private SitemapService $sitemapService) {
        parent::__construct();
    }

    public function handle(): int
    {
        $this->info('Generating sitemap...');
        $this->sitemapService->clearCache();
        $xml = $this->sitemapService->generate();
        file_put_contents(public_path('sitemap.xml'), $xml);
        $this->info('Sitemap written to public/sitemap.xml');
        return self::SUCCESS;
    }
}
