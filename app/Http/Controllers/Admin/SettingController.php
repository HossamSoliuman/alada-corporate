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

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->keyBy('key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method']);
        foreach ($data as $key => $value) {
            Setting::set($key, $value);
        }
        Cache::flush(); // clear all cached settings
        return back()->with('success', 'Settings saved.');
    }
}

// ──────────────────────────────────────────────────────────────
// UserController (Admin)
// ──────────────────────────────────────────────────────────────
