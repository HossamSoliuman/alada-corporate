<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\TeamMember;
use App\Services\SeoService;

class AboutController extends Controller
{
    public function __construct(private SeoService $seoService) {}

    public function index()
    {
        $page = Page::where('slug', 'about')->firstOrFail();
        $seo = $this->seoService->for($page);
        $teamMembers = TeamMember::ordered()->get();

        return view('frontend.about', compact('page', 'seo', 'teamMembers'));
    }
}

// ──────────────────────────────────────────────────────────────
// ServiceController
// ──────────────────────────────────────────────────────────────
