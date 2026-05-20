<?php

namespace App\Http\Controllers\Admin;

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
use App\Models\Setting;
use App\Models\User;
use App\Services\ImageService;
use App\Services\SeoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Facades\Excel;

class PageController extends Controller
{
    public function __construct(private SeoService $seoService) {}

    public function index()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    public function edit(Page $page)
    {
        $page->load('seo');
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:200',
            'subtitle'       => 'nullable|string|max:300',
            'content'        => 'nullable|string',
            'sections'       => 'nullable|json',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'is_published'   => 'boolean',
        ]);

        $validated['is_published'] = $request->boolean('is_published');
        if (!empty($validated['sections'])) {
            $validated['sections'] = json_decode($validated['sections'], true);
        }

        $page->update($validated);
        $this->seoService->saveFor($page, $request->only(['meta_title', 'meta_description', 'og_image', 'robots']));

        return back()->with('success', 'Page updated successfully.');
    }
}

// ──────────────────────────────────────────────────────────────
// LeadController (Admin)
// ──────────────────────────────────────────────────────────────
