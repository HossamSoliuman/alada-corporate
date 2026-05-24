@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous">
<style>
/* Bootstrap-compatible grid inside description */
.service-desc .row { display: flex; flex-wrap: wrap; margin: 0 -0.75rem; }
.service-desc [class*="col-"] { padding: 0 0.75rem; box-sizing: border-box; width: 100%; }
@media (min-width: 768px) {
    .service-desc .col-md-6 { width: 50%; }
}
@media (min-width: 992px) {
    .service-desc .col-lg-4 { width: 33.333%; }
}

/* Bootstrap utilities */
.service-desc .list-unstyled { list-style: none; padding-left: 0; margin: 0; }
.service-desc .text-center { text-align: center; }
.service-desc .mt-4 { margin-top: 1.5rem; }
.service-desc .mb-3 { margin-bottom: 0.75rem; }
.service-desc .mb-4 { margin-bottom: 1rem; }
.service-desc .mb-5 { margin-bottom: 2rem; }
.service-desc .me-2 { margin-right: 0.5rem; }
.service-desc .mt-5 { margin-top: 2rem; }

/* Section headers */
.service-desc .service-section h2,
.service-desc .service-intro + * h2 {
    font-family: 'Poppins', ui-sans-serif, system-ui;
    font-size: 1.35rem;
    font-weight: 700;
    color: #0d3041;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e8eef3;
}

/* Expertise cards */
.service-desc .expertise-card {
    background: #f4f6f7;
    border: 1px solid #e8eef3;
    border-radius: 1rem;
    padding: 1.5rem 1rem;
    margin-bottom: 1rem;
    color: #0d3041;
}
.service-desc .expertise-card h5 {
    font-family: 'Poppins', ui-sans-serif, system-ui;
    font-size: 0.875rem;
    font-weight: 600;
    margin: 0;
    color: #0d3041;
}
.service-desc .expertise-card i { color: #19587f; }

/* Icon colors */
.service-desc .text-primary { color: #19587f; }
.service-desc .text-success { color: #16a34a; }
.service-desc i.fa-3x { font-size: 2rem; display: block; margin-bottom: 0.75rem; }

/* Blockquote */
.service-desc .blockquote {
    background: #e6eff6;
    border-left: 4px solid #19587f;
    border-radius: 0.75rem;
    padding: 1.25rem 1.5rem;
    font-size: 1rem;
    font-style: italic;
    color: #193d55;
    margin: 0;
}
</style>
@endpush

@section('content')

<section class="bg-navy-900 relative overflow-hidden texture py-28">
    <div class="absolute inset-0 bg-gradient-to-br from-navy-950 via-navy-900 to-teal-900/40"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-breadcrumbs :items="[['name'=>'Expertise','url'=>route('expertise.index')],['name'=>$service->name]]"/>
        <div class="mt-8 flex items-start gap-6">
            <div class="w-16 h-16 rounded-2xl bg-teal-600/30 flex items-center justify-center text-teal-300 shrink-0">
                <x-icon name="{{ $service->icon ?? 'building-office-2' }}" class="w-8 h-8"/>
            </div>
            <div>
                <h1 class="text-4xl md:text-5xl font-heading text-white leading-tight mb-3">{{ $service->name }}</h1>
                <p class="text-lg text-slate-300">{{ $service->short_description }}</p>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-12">
            <article class="lg:col-span-2 reveal-left">
                @if($service->featured_image)
                <img src="{{ asset($service->featured_image) }}" alt="{{ $service->name }}"
                     class="w-full rounded-2xl mb-8 aspect-video object-cover shadow-sm">
                @endif
                <div class="prose prose-slate prose-lg max-w-none service-desc">{!! $service->description !!}</div>
            </article>

            <aside class="space-y-6 reveal-right">
                <div class="bg-navy-900 rounded-2xl p-6 text-white">
                    <h3 class="font-heading text-lg mb-3">Start a Project</h3>
                    <p class="text-sm text-slate-400 mb-5">Tell us about your project and we'll outline how Alada can deliver it.</p>
                    <a href="{{ route('contact') }}" class="block w-full text-center bg-brown-500 hover:bg-brown-400 text-white py-3 px-6 rounded-xl font-semibold transition-colors text-sm">
                        Get in Touch
                    </a>
                </div>

                @if($related->count())
                <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                    <h3 class="font-semibold text-navy-900 mb-4 text-sm uppercase tracking-wide">Related Expertise</h3>
                    <div class="space-y-3">
                        @foreach($related as $rel)
                        <a href="{{ route('expertise.show', $rel->slug) }}"
                           class="flex items-center gap-3 p-3 rounded-xl hover:bg-white border border-transparent hover:border-slate-200 transition-all group">
                            <div class="w-9 h-9 rounded-lg bg-teal-50 flex items-center justify-center text-teal-600 group-hover:bg-teal-600 group-hover:text-white transition-all shrink-0">
                                <x-icon name="{{ $rel->icon ?? 'building-office-2' }}" class="w-4 h-4"/>
                            </div>
                            <span class="text-sm font-medium text-navy-700 leading-tight">{{ $rel->name }}</span>
                            <x-icon name="chevron-right" class="w-4 h-4 text-slate-400 ml-auto shrink-0"/>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="border border-slate-200 rounded-2xl p-6">
                    <h3 class="font-semibold text-navy-900 mb-2 text-sm">Delivered Worldwide</h3>
                    <p class="text-xs text-slate-500 mb-4">USA · UK · Middle East · ANZ · Asia</p>
                    <a href="{{ route('case-studies.index') }}" class="flex items-center gap-2 text-xs font-semibold text-teal-600 hover:text-navy-900 transition-colors">
                        View all projects <x-icon name="arrow-long-right" class="w-4 h-4"/>
                    </a>
                </div>
            </aside>
        </div>
    </div>
</section>

@endsection
