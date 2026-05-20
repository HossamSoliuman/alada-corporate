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

class IndustryController extends Controller
{
    public function index()
    {
        $industries = Industry::active()->withCount(['caseStudies' => fn($q) => $q->published()])->get();
        return view('frontend.industries.index', compact('industries'));
    }

    public function show(string $slug)
    {
        $industry    = Industry::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $caseStudies = CaseStudy::published()->where('industry_id', $industry->id)
                                ->with(['category'])->latest('published_at')->paginate(9);
        return view('frontend.industries.show', compact('industry', 'caseStudies'));
    }
}

// ──────────────────────────────────────────────────────────────
// CaseStudyController
// ──────────────────────────────────────────────────────────────
