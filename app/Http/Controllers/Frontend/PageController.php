<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\CaseStudy;
use App\Models\CaseStudyCategory;
use App\Models\Industry;
use App\Models\Lead;
use App\Models\Page;
use App\Models\Service;
use App\Http\Requests\Frontend\StoreContactRequest;
use App\Services\LeadService;
use App\Services\SeoService;
use App\Services\SitemapService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{
    public function __construct(private SeoService $seoService) {}

    public function show(string $slug)
    {
        $page = Page::published()->where('slug', $slug)->with('seo')->firstOrFail();
        $seo  = $this->seoService->for($page);
        return view('frontend.page', compact('page', 'seo'));
    }
}

// ──────────────────────────────────────────────────────────────
// SitemapController
// ──────────────────────────────────────────────────────────────
