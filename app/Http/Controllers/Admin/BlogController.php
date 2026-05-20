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

class BlogController extends Controller
{
    public function __construct(private ImageService $imageService, private SeoService $seoService) {}

    public function index(Request $request)
    {
        $query = Blog::with(['category', 'author'])->latest();

        if ($request->filled('search')) {
            $query->where('title', 'like', "%{$request->search}%");
        }
        if ($request->filled('category')) {
            $query->where('blog_category_id', $request->category);
        }
        if ($request->filled('status')) {
            $query->where('is_published', $request->status === 'published');
        }

        $blogs      = $query->paginate(15)->withQueryString();
        $categories = BlogCategory::all();
        return view('admin.blog.index', compact('blogs', 'categories'));
    }

    public function create()
    {
        $categories = BlogCategory::all();
        $tags       = BlogTag::all();
        return view('admin.blog.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'excerpt'          => 'nullable|string|max:500',
            'content'          => 'required|string',
            'blog_category_id' => 'nullable|exists:blog_categories,id',
            'is_featured'      => 'boolean',
            'is_published'     => 'boolean',
            'published_at'     => 'nullable|date',
            'featured_image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tags'             => 'nullable|array',
            'tags.*'           => 'exists:blog_tags,id',
        ]);

        if ($request->hasFile('featured_image')) {
            $paths = $this->imageService->upload($request->file('featured_image'), 'public', 'blogs');
            $validated['featured_image'] = $paths['medium'];
        }

        $validated['user_id']    = auth()->id();
        $validated['is_featured']  = $request->boolean('is_featured');
        $validated['is_published'] = $request->boolean('is_published');
        if ($validated['is_published'] && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $blog = Blog::create($validated);
        if (!empty($validated['tags'])) {
            $blog->tags()->sync($validated['tags']);
        }

        if ($request->filled('meta_title')) {
            $this->seoService->saveFor($blog, $request->only(['meta_title', 'meta_description', 'meta_keywords', 'og_image', 'robots']));
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog)
    {
        $blog->load('tags', 'seo');
        $categories = BlogCategory::all();
        $tags       = BlogTag::all();
        return view('admin.blog.edit', compact('blog', 'categories', 'tags'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'excerpt'          => 'nullable|string|max:500',
            'content'          => 'required|string',
            'blog_category_id' => 'nullable|exists:blog_categories,id',
            'is_featured'      => 'boolean',
            'is_published'     => 'boolean',
            'published_at'     => 'nullable|date',
            'featured_image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tags'             => 'nullable|array',
            'tags.*'           => 'exists:blog_tags,id',
        ]);

        if ($request->hasFile('featured_image')) {
            $paths = $this->imageService->upload($request->file('featured_image'), 'public', 'blogs');
            $validated['featured_image'] = $paths['medium'];
        }

        $validated['is_featured']  = $request->boolean('is_featured');
        $validated['is_published'] = $request->boolean('is_published');

        $blog->update($validated);
        $blog->tags()->sync($validated['tags'] ?? []);

        $this->seoService->saveFor($blog, $request->only(['meta_title', 'meta_description', 'meta_keywords', 'og_image', 'robots']));

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return back()->with('success', 'Blog deleted.');
    }

    public function togglePublish(Blog $blog)
    {
        $blog->update([
            'is_published' => !$blog->is_published,
            'published_at' => !$blog->is_published ? now() : $blog->published_at,
        ]);
        return back()->with('success', 'Blog status updated.');
    }
}

// ──────────────────────────────────────────────────────────────
// BlogCategoryController (Admin)
// ──────────────────────────────────────────────────────────────
