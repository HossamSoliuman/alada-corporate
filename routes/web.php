<?php

use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\BlogTagController;
use App\Http\Controllers\Admin\CaseStudyCategoryController;
use App\Http\Controllers\Admin\CaseStudyController as AdminCaseStudyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\IndustryController as AdminIndustryController;
use App\Http\Controllers\Admin\JobListingController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CareerController;
use App\Http\Controllers\Frontend\CaseStudyController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\IndustryController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Frontend\SitemapController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/expertise', [ServiceController::class, 'index'])->name('expertise.index');
Route::get('/expertise/{slug}', [ServiceController::class, 'show'])->name('expertise.show');

Route::get('/industries/{slug}', [IndustryController::class, 'show'])->name('industries.show');

Route::get('/case-studies', [CaseStudyController::class, 'index'])->name('case-studies.index');
Route::get('/case-studies/{slug}', [CaseStudyController::class, 'show'])->name('case-studies.show');
Route::get('/case-studies/{slug}/download', [CaseStudyController::class, 'downloadPdf'])->name('case-studies.download');

Route::get('/insights', [BlogController::class, 'index'])->name('insights.index');
Route::get('/insights/category/{slug}', [BlogController::class, 'category'])->name('insights.category');
Route::get('/insights/tag/{slug}', [BlogController::class, 'tag'])->name('insights.tag');
Route::get('/insights/{slug}', [BlogController::class, 'show'])->name('insights.show');

Route::get('/careers', [CareerController::class, 'index'])->name('careers');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit')->middleware('throttle:5,1');
Route::post('/contact/inquiry', [ContactController::class, 'quickInquiry'])->name('contact.inquiry')->middleware('throttle:5,1');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('blogs', AdminBlogController::class);
    Route::post('blogs/{blog}/toggle-publish', [AdminBlogController::class, 'togglePublish'])->name('blogs.toggle-publish');

    Route::resource('blog-categories', BlogCategoryController::class);
    Route::resource('blog-tags', BlogTagController::class)->only(['index', 'store', 'destroy']);

    Route::resource('case-studies', AdminCaseStudyController::class);

    Route::resource('case-study-categories', CaseStudyCategoryController::class);

    Route::resource('industries', AdminIndustryController::class);

    Route::resource('expertise', AdminServiceController::class);

    Route::resource('job-listings', JobListingController::class);

    Route::get('hero-slides', [HeroSlideController::class, 'index'])->name('hero-slides.index');
    Route::post('hero-slides', [HeroSlideController::class, 'store'])->name('hero-slides.store');
    Route::delete('hero-slides/{heroSlide}', [HeroSlideController::class, 'destroy'])->name('hero-slides.destroy');

    Route::get('pages', [AdminPageController::class, 'index'])->name('pages.index');
    Route::get('pages/{page}/edit', [AdminPageController::class, 'edit'])->name('pages.edit');
    Route::put('pages/{page}', [AdminPageController::class, 'update'])->name('pages.update');

    Route::get('leads/export', [LeadController::class, 'export'])->name('leads.export');
    Route::resource('leads', LeadController::class)->only(['index', 'show', 'update', 'destroy']);

    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

    Route::resource('users', UserController::class);
});

Route::get('/{slug}', [PageController::class, 'show'])->name('page.show')
    ->where('slug', '[a-z0-9\-]+');
