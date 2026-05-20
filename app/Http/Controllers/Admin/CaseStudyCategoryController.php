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

class CaseStudyCategoryController extends Controller
{
    public function index()
    {
        $categories = CaseStudyCategory::withCount('caseStudies')->orderBy('order')->paginate(20);
        return view('admin.case-study-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.case-study-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:100', 'is_active' => 'boolean', 'order' => 'integer']);
        CaseStudyCategory::create($request->only('name', 'is_active', 'order') + ['is_active' => $request->boolean('is_active')]);
        return redirect()->route('admin.case-study-categories.index')->with('success', 'Category created.');
    }

    public function edit(CaseStudyCategory $caseStudyCategory)
    {
        return view('admin.case-study-categories.edit', compact('caseStudyCategory'));
    }

    public function update(Request $request, CaseStudyCategory $caseStudyCategory)
    {
        $request->validate(['name' => 'required|string|max:100', 'is_active' => 'boolean', 'order' => 'integer']);
        $caseStudyCategory->update($request->only('name', 'order') + ['is_active' => $request->boolean('is_active')]);
        return redirect()->route('admin.case-study-categories.index')->with('success', 'Category updated.');
    }

    public function destroy(CaseStudyCategory $caseStudyCategory)
    {
        $caseStudyCategory->delete();
        return back()->with('success', 'Category deleted.');
    }
}

// ──────────────────────────────────────────────────────────────
// IndustryController (Admin)
// ──────────────────────────────────────────────────────────────
