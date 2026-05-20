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

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'leads_new'    => Lead::where('status', 'new')->count(),
            'leads_week'   => Lead::where('created_at', '>=', now()->subWeek())->count(),
            'leads_month'  => Lead::where('created_at', '>=', now()->subMonth())->count(),
            'blogs_total'  => Blog::count(),
            'case_studies' => CaseStudy::count(),
            'services'     => Service::count(),
        ];

        $latestLeads = Lead::with('service')->latest()->limit(5)->get();

        // Lead chart: daily for last 30 days
        $chartData = Lead::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date');

        return view('admin.dashboard', compact('stats', 'latestLeads', 'chartData'));
    }
}

// ──────────────────────────────────────────────────────────────
// BlogController (Admin)
// ──────────────────────────────────────────────────────────────
