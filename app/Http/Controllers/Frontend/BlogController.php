<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Services\SeoService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct(private SeoService $seoService) {}

    public function index(Request $request)
    {
        $query = Blog::published()->with(['category', 'author', 'tags']);

        if ($request->filled('search')) {
            $query->where(fn ($q) => $q->where('title', 'like', "%{$request->search}%")
                ->orWhere('excerpt', 'like', "%{$request->search}%"));
        }
        if ($request->filled('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->category));
        }
        if ($request->filled('tag')) {
            $query->whereHas('tags', fn ($q) => $q->where('slug', $request->tag));
        }

        $blogs = $query->latest('published_at')->paginate(9)->withQueryString();
        $categories = BlogCategory::active()->withCount(['blogs' => fn ($q) => $q->published()])->get();
        $latestTags = BlogTag::withCount('blogs')->orderByDesc('blogs_count')->limit(20)->get();

        return view('frontend.insights.index', compact('blogs', 'categories', 'latestTags'));
    }

    public function show(string $slug)
    {
        $blog = Blog::published()->where('slug', $slug)->with(['category', 'author', 'tags', 'seo'])->firstOrFail();
        $blog->increment('views_count');
        $seo = $this->seoService->for($blog);
        $related = Blog::published()->where('id', '!=', $blog->id)
            ->where('blog_category_id', $blog->blog_category_id)
            ->latest('published_at')->limit(3)->get();

        return view('frontend.insights.show', compact('blog', 'seo', 'related'));
    }

    public function category(string $slug)
    {
        $category = BlogCategory::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $blogs = Blog::published()->where('blog_category_id', $category->id)
            ->with(['author'])->latest('published_at')->paginate(9);

        return view('frontend.insights.category', compact('category', 'blogs'));
    }

    public function tag(string $slug)
    {
        $tag = BlogTag::where('slug', $slug)->firstOrFail();
        $blogs = $tag->blogs()->published()->with(['category', 'author'])->latest('published_at')->paginate(9);

        return view('frontend.insights.tag', compact('tag', 'blogs'));
    }
}

// ──────────────────────────────────────────────────────────────
// ContactController
// ──────────────────────────────────────────────────────────────
