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

class ServiceController extends Controller
{
    public function __construct(private ImageService $imageService, private SeoService $seoService) {}

    public function index()
    {
        $services = Service::orderBy('order')->paginate(20);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:150',
            'short_description' => 'required|string|max:300',
            'description'       => 'required|string',
            'icon'              => 'nullable|string|max:100',
            'featured_image'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_featured'       => 'boolean',
            'is_active'         => 'boolean',
            'order'             => 'integer|min:0',
        ]);

        if ($request->hasFile('featured_image')) {
            $paths = $this->imageService->upload($request->file('featured_image'), 'public', 'services');
            $validated['featured_image'] = $paths['medium'];
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active']   = $request->boolean('is_active');

        $service = Service::create($validated);
        $this->seoService->saveFor($service, $request->only(['meta_title', 'meta_description', 'og_image', 'robots']));

        return redirect()->route('admin.services.index')->with('success', 'Service created.');
    }

    public function edit(Service $service)
    {
        $service->load('seo');
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:150',
            'short_description' => 'required|string|max:300',
            'description'       => 'required|string',
            'icon'              => 'nullable|string|max:100',
            'featured_image'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_featured'       => 'boolean',
            'is_active'         => 'boolean',
            'order'             => 'integer|min:0',
        ]);

        if ($request->hasFile('featured_image')) {
            $paths = $this->imageService->upload($request->file('featured_image'), 'public', 'services');
            $validated['featured_image'] = $paths['medium'];
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active']   = $request->boolean('is_active');

        $service->update($validated);
        $this->seoService->saveFor($service, $request->only(['meta_title', 'meta_description', 'og_image', 'robots']));

        return redirect()->route('admin.services.index')->with('success', 'Service updated.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return back()->with('success', 'Service deleted.');
    }
}

// ──────────────────────────────────────────────────────────────
// PageController (Admin) - edit only
// ──────────────────────────────────────────────────────────────
