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

class BlogTagController extends Controller
{
    public function index()
    {
        $tags = BlogTag::withCount('blogs')->paginate(20);
        return view('admin.blog-tags.index', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:60|unique:blog_tags,name']);
        BlogTag::create(['name' => $request->name]);
        return back()->with('success', 'Tag created.');
    }

    public function destroy(BlogTag $blogTag)
    {
        $blogTag->delete();
        return back()->with('success', 'Tag deleted.');
    }
}

// ──────────────────────────────────────────────────────────────
// CaseStudyController (Admin)
// ──────────────────────────────────────────────────────────────
