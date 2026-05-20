<?php

namespace App\Observers;

use App\Models\Blog;
use App\Services\SitemapService;

class BlogObserver
{
    public function __construct(private SitemapService $sitemapService) {}

    public function creating(Blog $blog): void
    {
        if (!$blog->user_id) {
            $blog->user_id = auth()->id();
        }
        if (!$blog->reading_time) {
            $words = str_word_count(strip_tags($blog->content ?? ''));
            $blog->reading_time = max(1, (int) ceil($words / 200));
        }
    }

    public function saved(Blog $blog): void
    {
        $this->sitemapService->clearCache();
    }

    public function deleted(Blog $blog): void
    {
        $this->sitemapService->clearCache();
    }
}
