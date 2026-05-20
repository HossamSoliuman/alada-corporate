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

class CaseStudyController extends Controller
{
    public function __construct(private SeoService $seoService) {}

    public function index(Request $request)
    {
        $query = CaseStudy::published()->with(['category', 'industry']);

        if ($request->filled('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }
        if ($request->filled('industry')) {
            $query->whereHas('industry', fn($q) => $q->where('slug', $request->industry));
        }

        $caseStudies = $query->latest('published_at')->paginate(9)->withQueryString();
        $categories  = CaseStudyCategory::active()->withCount(['caseStudies' => fn($q) => $q->published()])->get();
        $industries  = Industry::active()->withCount(['caseStudies' => fn($q) => $q->published()])->get();

        return view('frontend.case-studies.index', compact('caseStudies', 'categories', 'industries'));
    }

    public function show(string $slug)
    {
        $caseStudy = CaseStudy::published()->where('slug', $slug)->with(['category', 'industry', 'seo'])->firstOrFail();
        $seo       = $this->seoService->for($caseStudy);
        $related   = CaseStudy::published()->where('id', '!=', $caseStudy->id)
                               ->where(fn($q) => $q->where('industry_id', $caseStudy->industry_id)
                                                    ->orWhere('case_study_category_id', $caseStudy->case_study_category_id))
                               ->limit(3)->get();
        return view('frontend.case-studies.show', compact('caseStudy', 'seo', 'related'));
    }

    public function downloadPdf(string $slug)
    {
        $caseStudy = CaseStudy::published()->where('slug', $slug)->firstOrFail();
        abort_if(!$caseStudy->pdf_file, 404);
        return response()->download(storage_path('app/public/' . $caseStudy->pdf_file));
    }
}

// ──────────────────────────────────────────────────────────────
// BlogController
// ──────────────────────────────────────────────────────────────
