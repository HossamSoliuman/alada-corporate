<?php

namespace App\Observers;

use App\Models\CaseStudy;
use App\Services\SitemapService;

class CaseStudyObserver
{
    public function __construct(private SitemapService $sitemapService) {}

    public function saved(CaseStudy $caseStudy): void
    {
        $this->sitemapService->clearCache();
    }

    public function deleted(CaseStudy $caseStudy): void
    {
        $this->sitemapService->clearCache();
    }
}
