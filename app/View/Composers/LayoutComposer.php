<?php

namespace App\View\Composers;

use App\Models\BlogCategory;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class LayoutComposer
{
    public function compose(View $view): void
    {
        $settings = Cache::remember('layout_settings', 3600, function () {
            return Setting::all()->keyBy('key')->map(fn ($s) => $s->getCastedValue());
        });

        $footerServices = Cache::remember('footer_services', 3600, function () {
            return Service::active()->limit(6)->get(['name', 'slug', 'icon']);
        });

        $footerCategories = Cache::remember('footer_categories', 3600, function () {
            return BlogCategory::active()->limit(6)->get(['name', 'slug']);
        });

        $view->with(compact('settings', 'footerServices', 'footerCategories'));
    }
}
