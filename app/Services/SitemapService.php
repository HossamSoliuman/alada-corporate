<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Industry;
use App\Models\Page;
use App\Models\Service;
use Illuminate\Support\Facades\Cache;

class SitemapService
{
    public function generate(): string
    {
        return Cache::remember('sitemap_xml', 3600, function () {
            $urls = collect();

            // Static pages
            $urls->push(['loc' => url('/'), 'lastmod' => now()->toAtomString(), 'priority' => '1.0']);
            $urls->push(['loc' => route('about'), 'lastmod' => now()->toAtomString(), 'priority' => '0.8']);
            $urls->push(['loc' => route('contact'), 'lastmod' => now()->toAtomString(), 'priority' => '0.8']);

            // Dynamic pages
            Page::published()->get()->each(function ($page) use ($urls) {
                $urls->push(['loc' => route('page.show', $page->slug), 'lastmod' => $page->updated_at->toAtomString(), 'priority' => '0.6']);
            });

            // Services
            Service::active()->get()->each(function ($s) use ($urls) {
                $urls->push(['loc' => route('services.show', $s->slug), 'lastmod' => $s->updated_at->toAtomString(), 'priority' => '0.8']);
            });

            // Industries
            Industry::active()->get()->each(function ($i) use ($urls) {
                $urls->push(['loc' => route('industries.show', $i->slug), 'lastmod' => $i->updated_at->toAtomString(), 'priority' => '0.7']);
            });

            // Case Studies
            CaseStudy::published()->get()->each(function ($cs) use ($urls) {
                $urls->push(['loc' => route('case-studies.show', $cs->slug), 'lastmod' => $cs->updated_at->toAtomString(), 'priority' => '0.7']);
            });

            // Blogs
            Blog::published()->latest('published_at')->get()->each(function ($b) use ($urls) {
                $urls->push(['loc' => route('blog.show', $b->slug), 'lastmod' => $b->updated_at->toAtomString(), 'priority' => '0.6']);
            });

            return view('sitemap.index', ['urls' => $urls])->render();
        });
    }

    public function clearCache(): void
    {
        Cache::forget('sitemap_xml');
    }
}
