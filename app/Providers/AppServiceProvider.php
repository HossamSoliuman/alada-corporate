<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Page;
use App\Observers\BlogObserver;
use App\Observers\CaseStudyObserver;
use App\Observers\PageObserver;
use App\View\Composers\AdminLayoutComposer;
use App\View\Composers\LayoutComposer;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Observers
        Blog::observe(BlogObserver::class);
        CaseStudy::observe(CaseStudyObserver::class);
        Page::observe(PageObserver::class);

        // View composers
        view()->composer(['layouts.app', 'frontend.*'], LayoutComposer::class);
        view()->composer(['layouts.admin', 'admin.*'], AdminLayoutComposer::class);

        // Gate
        Gate::before(function ($user, $ability) {
            return $user->is_admin ? true : null;
        });
    }
}
