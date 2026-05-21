<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\HeroSlide;
use App\Models\Industry;
use App\Models\Page;
use App\Models\Service;
use App\Services\SeoService;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function __construct(private SeoService $seoService) {}

    public function index()
    {
        $data = [
            'heroSlides' => HeroSlide::active()->get(),
            'featuredServices' => Service::active()->featured()->with('seo')->limit(6)->get(),
            'featuredCaseStudies' => CaseStudy::published()->featured()->with(['category', 'industry'])->limit(3)->get(),
            'latestBlogs' => Blog::published()->with(['category', 'author'])->latest('published_at')->limit(3)->get(),
            'industries' => Industry::active()->limit(8)->get(),
        ];

        if (! is_array($data) || ! array_key_exists('heroSlides', $data)) {
            Cache::forget('home_page_data');

            return redirect()->route('home');
        }

        $page = Page::where('slug', 'home')->first();
        $seo = $page ? $this->seoService->for($page) : [];

        return view('frontend.home', array_merge($data, compact('seo', 'page')));
    }
}
