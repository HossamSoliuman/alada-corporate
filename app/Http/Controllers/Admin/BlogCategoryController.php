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

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::withCount('blogs')->orderBy('order')->paginate(20);
        return view('admin.blog-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.blog-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
            'is_active'   => 'boolean',
            'order'       => 'integer|min:0',
        ]);
        BlogCategory::create($validated);
        return redirect()->route('admin.blog-categories.index')->with('success', 'Category created.');
    }

    public function edit(BlogCategory $blogCategory)
    {
        return view('admin.blog-categories.edit', compact('blogCategory'));
    }

    public function update(Request $request, BlogCategory $blogCategory)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
            'is_active'   => 'boolean',
            'order'       => 'integer|min:0',
        ]);
        $blogCategory->update($validated);
        return redirect()->route('admin.blog-categories.index')->with('success', 'Category updated.');
    }

    public function destroy(BlogCategory $blogCategory)
    {
        $blogCategory->delete();
        return back()->with('success', 'Category deleted.');
    }
}

// ──────────────────────────────────────────────────────────────
// BlogTagController (Admin)
// ──────────────────────────────────────────────────────────────
