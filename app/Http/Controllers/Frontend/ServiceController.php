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

class ServiceController extends Controller
{
    public function __construct(private SeoService $seoService) {}

    public function index()
    {
        $services = Service::active()->get();
        return view('frontend.services.index', compact('services'));
    }

    public function show(string $slug)
    {
        $service = Service::where('slug', $slug)->where('is_active', true)->with('seo')->firstOrFail();
        $seo     = $this->seoService->for($service);
        $related = Service::active()->where('id', '!=', $service->id)->limit(3)->get();
        return view('frontend.services.show', compact('service', 'seo', 'related'));
    }
}

// ──────────────────────────────────────────────────────────────
// IndustryController
// ──────────────────────────────────────────────────────────────
