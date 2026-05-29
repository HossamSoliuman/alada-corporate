<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\TeamMember;
use App\Services\SeoService;

class AboutController extends Controller
{
    public function __construct(private SeoService $seoService) {}

    public function companyOverview()
    {
        $page = Page::where('slug', 'company-overview')->firstOrFail();
        $seo = $this->seoService->for($page);

        return view('frontend.company-overview', compact('page', 'seo'));
    }

    public function ourTeam()
    {
        $page = Page::where('slug', 'our-team')->firstOrFail();
        $seo = $this->seoService->for($page);
        $teamMembers = TeamMember::ordered()->get();

        return view('frontend.our-team', compact('page', 'seo', 'teamMembers'));
    }

    public function whyChooseUs()
    {
        $page = Page::where('slug', 'why-choose-us')->firstOrFail();
        $seo = $this->seoService->for($page);
        $cards = $page->cards;

        return view('frontend.why-choose-us', compact('page', 'seo', 'cards'));
    }

    public function businessModels()
    {
        $page = Page::where('slug', 'business-models')->firstOrFail();
        $seo = $this->seoService->for($page);
        $cards = $page->cards;

        return view('frontend.business-models', compact('page', 'seo', 'cards'));
    }
}

// ──────────────────────────────────────────────────────────────
// ServiceController
// ──────────────────────────────────────────────────────────────
