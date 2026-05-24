<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Lead;
use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'leads_new' => Lead::where('status', 'new')->count(),
            'leads_week' => Lead::where('created_at', '>=', now()->subWeek())->count(),
            'leads_month' => Lead::where('created_at', '>=', now()->subMonth())->count(),
            'blogs_total' => Blog::count(),
            'case_studies' => CaseStudy::count(),
            'expertise' => Service::count(),
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
