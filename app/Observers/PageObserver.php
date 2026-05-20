<?php

namespace App\Observers;

use App\Models\Page;
use App\Services\SitemapService;

class PageObserver
{
    public function __construct(private SitemapService $sitemapService) {}

    public function saved(Page $page): void
    {
        $this->sitemapService->clearCache();
    }
}
