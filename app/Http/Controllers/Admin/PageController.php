<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Services\SeoService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            'title' => 'required|string|max:200',
            'subtitle' => 'nullable|string|max:300',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'is_published' => 'boolean',
        ]);

        $validated['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $dir = public_path('pages');
            if (! is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            $filename = Str::uuid().'.'.$file->getClientOriginalExtension();
            $file->move($dir, $filename);
            $validated['featured_image'] = 'pages/'.$filename;
        } else {
            unset($validated['featured_image']);
        }

        // Sections come from named array inputs (sections[key]) on custom page types.
        // Handle outside validation so type mismatches from stale requests never block saves.
        $sections = $request->input('sections');
        if (is_array($sections)) {
            $validated['sections'] = array_filter($sections, fn ($v) => $v !== null && $v !== '');
        }

        $page->update($validated);
        $this->seoService->saveFor($page, $request->only(['meta_title', 'meta_description', 'og_image', 'robots']));

        return back()->with('success', 'Page updated successfully.');
    }
}

// ──────────────────────────────────────────────────────────────
// LeadController (Admin)
// ──────────────────────────────────────────────────────────────
