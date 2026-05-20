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

class IndustryController extends Controller
{
    public function __construct(private ImageService $imageService) {}

    public function index()
    {
        $industries = Industry::withCount(['caseStudies'])->orderBy('order')->paginate(20);
        return view('admin.industries.index', compact('industries'));
    }

    public function create()
    {
        return view('admin.industries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:100',
            'icon'           => 'nullable|string|max:100',
            'description'    => 'nullable|string|max:1000',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active'      => 'boolean',
            'order'          => 'integer|min:0',
        ]);

        if ($request->hasFile('featured_image')) {
            $paths = $this->imageService->upload($request->file('featured_image'), 'public', 'industries');
            $validated['featured_image'] = $paths['medium'];
        }

        $validated['is_active'] = $request->boolean('is_active');
        Industry::create($validated);
        return redirect()->route('admin.industries.index')->with('success', 'Industry created.');
    }

    public function edit(Industry $industry)
    {
        return view('admin.industries.edit', compact('industry'));
    }

    public function update(Request $request, Industry $industry)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:100',
            'icon'           => 'nullable|string|max:100',
            'description'    => 'nullable|string|max:1000',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active'      => 'boolean',
            'order'          => 'integer|min:0',
        ]);

        if ($request->hasFile('featured_image')) {
            $paths = $this->imageService->upload($request->file('featured_image'), 'public', 'industries');
            $validated['featured_image'] = $paths['medium'];
        }

        $validated['is_active'] = $request->boolean('is_active');
        $industry->update($validated);
        return redirect()->route('admin.industries.index')->with('success', 'Industry updated.');
    }

    public function destroy(Industry $industry)
    {
        $industry->delete();
        return back()->with('success', 'Industry deleted.');
    }
}

// ──────────────────────────────────────────────────────────────
// ServiceController (Admin)
// ──────────────────────────────────────────────────────────────
