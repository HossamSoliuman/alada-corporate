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

class ContactController extends Controller
{
    public function __construct(private LeadService $leadService) {}

    public function index()
    {
        return view('frontend.contact');
    }

    public function submit(StoreContactRequest $request)
    {
        $this->leadService->create($request->validated(), 'contact');

        return back()->with('success', 'Thank you! We\'ll be in touch shortly.');
    }

    public function quickInquiry(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:120',
            'email'   => 'required|email',
            'phone'   => 'nullable|string|max:30',
            'message' => 'required|string|min:5|max:1000',
        ]);

        $this->leadService->create($request->only('name', 'email', 'phone', 'message'), 'inquiry');

        return response()->json(['message' => 'Thank you! We will contact you shortly.']);
    }
}

// ──────────────────────────────────────────────────────────────
// PageController
// ──────────────────────────────────────────────────────────────
