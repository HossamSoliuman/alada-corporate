@extends('layouts.app')

@section('content')
    {{-- ═══ HERO ═══ --}}
    <section class="relative min-h-screen flex items-end pb-24 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <video autoplay muted loop playsinline class="w-full h-full object-cover">
                <source src="{{ $heroVideo?->url ?? asset('videos/hero-construction.webm') }}" type="video/webm">
            </video>
            <div class="absolute inset-0 bg-gradient-to-r from-navy-950/90 via-navy-900/70 to-transparent"></div>
        </div>

        {{-- Left Content Panel --}}
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="max-w-2xl bg-navy-950/40 backdrop-blur-md border border-white/10 rounded-2xl p-10">
                <h1 class="reveal text-5xl md:text-7xl font-heading font-bold text-white leading-[1.05] tracking-tight mb-6">
                    Growing<br>
                    <span class="font-display italic text-brown-300">With Time.</span>
                </h1>

                <p class="reveal delay-100 text-lg text-slate-300 leading-relaxed mb-10">
                    A globally integrated engineering and infrastructure consultancy delivering complex, high-performance
                    solutions across every phase of the project lifecycle.
                </p>

                <div class="reveal delay-200 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('expertise.index') }}"
                        class="group inline-flex items-center justify-center gap-3 bg-brown-500 hover:bg-brown-400 text-white font-semibold px-8 py-4 rounded-xl transition-all duration-300 shadow-lg shadow-brown-900/30">
                        Explore Services
                        <x-icon name="arrow-long-right" class="w-5 h-5 arrow-nudge" />
                    </a>
                    <a href="{{ route('case-studies.index') }}"
                        class="group inline-flex items-center justify-center gap-3 border border-white/30 text-white hover:bg-white/10 font-semibold px-8 py-4 rounded-xl transition-all duration-300 backdrop-blur-sm">
                        View Projects
                        <x-icon name="arrow-long-right" class="w-5 h-5 arrow-nudge" />
                    </a>
                </div>
            </div>
        </div>

        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 animate-bounce z-10">
            <span class="text-xs text-slate-400 uppercase tracking-widest">Scroll</span>
            <div class="w-px h-8 bg-gradient-to-b from-slate-400 to-transparent"></div>
        </div>
    </section>

    {{-- ═══ STATS ═══ --}}
    <section class="bg-white border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @foreach ([['5000', '+', 'Delivered Projects', 'Infrastructure & industrial across 5 continents'], ['55', '+', 'Satisfied Clients', 'Global and regional partnerships'], ['100', '+', 'Years Collective Experience', 'Delivered through one powerful team'], ['9', '', 'Engineering Disciplines', 'Built to 100% global standards']] as [$num, $suf, $label, $sub])
                    <div class="text-center reveal">
                        <div class="font-display text-5xl md:text-6xl font-bold text-navy-900 mb-1"
                            data-count="{{ $num }}" data-suffix="{{ $suf }}">
                            {{ $num }}{{ $suf }}</div>
                        <div class="text-sm font-semibold text-teal-600 uppercase tracking-wide">{{ $label }}</div>
                        <div class="text-xs text-slate-500 mt-0.5">{{ $sub }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══ ABOUT STRIP ═══ --}}
    <section class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="reveal-left">
                    <p class="text-xs font-semibold uppercase tracking-widest text-teal-600 mb-4">Who We Are</p>
                    <h2 class="text-4xl md:text-5xl font-heading text-navy-900 leading-tight mb-6">Engineering The
                        Infrastructure<br><em class="font-display text-brown-500 not-italic">Of Tomorrow</em></h2>
                    <p class="text-slate-600 leading-relaxed mb-6">Alada is a globally integrated, multi-disciplinary
                        engineering consultancy established in the United States, with a fully owned and operational India
                        based delivery model. We operate across the complete project lifecycle from feasibility and
                        conceptual design through to construction documentation and project management.</p>
                    <p class="text-slate-600 leading-relaxed mb-8">Our unique combination of Global engineering standards,
                        advanced digital methodologies, and globally distributed execution ensures technically robust,
                        cost-efficient, and scalable solutions across every environment.</p>
                    <a href="{{ route('company-overview') }}"
                        class="inline-flex items-center gap-2 font-semibold text-teal-600 hover:text-navy-900 transition-colors group">
                        Discover Our Story
                        <x-icon name="arrow-long-right" class="w-5 h-5 arrow-nudge" />
                    </a>
                </div>
                <div class="reveal-right grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach ([['Consulting Expertise', 'Renowned International Civil Engineers with Diverse Skill Set'], ['Robust Delivery', 'Consistent on-time, on-budget project completion globally'], ['Rapid Value Creation', 'Fast-tracked design cycles without compromising quality or compliance'], ['Tech-Forward Approach', 'BIM, digital twin, and parametric modeling embedded across all disciplines']] as [$t, $d])
                        <div
                            class="bg-white rounded-2xl p-5 border border-slate-100 hover:border-teal-200 hover:shadow-lg hover:shadow-teal-900/5 transition-all duration-300 text-center sm:text-left">
                            <div
                                class="w-10 h-10 rounded-xl bg-teal-50 flex items-center justify-center text-teal-600 mb-3 mx-auto sm:mx-0">
                                <x-icon name="check-circle" class="w-5 h-5" />
                            </div>
                            <h4 class="font-semibold text-navy-900 text-sm mb-1">{{ $t }}</h4>
                            <p class="text-xs text-slate-500 leading-relaxed">{{ $d }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ SERVICES ═══ --}}
    @if ($featuredServices->count())
        <section class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16 reveal">
                    <p class="text-xs font-semibold uppercase tracking-widest text-teal-600 mb-4">What We Do</p>
                    <h2 class="text-4xl md:text-5xl font-heading text-navy-900 mb-4">Global Urban & Infrastructure<br><em
                            class="font-display not-italic text-brown-500">Development Engineering</em></h2>
                    <p class="text-slate-500 max-w-xl mx-auto">Comprehensive engineering capabilities across all
                        disciplines, delivered as integrated solutions from concept to completion.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($featuredServices as $i => $service)
                        <a href="{{ route('expertise.show', $service->slug) }}"
                            class="service-card group bg-white border border-slate-100 rounded-2xl p-7 flex flex-col reveal"
                            style="transition-delay: {{ $i * 80 }}ms">
                            <div class="flex items-start justify-between mb-5">
                                <div
                                    class="icon-wrap w-12 h-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center">
                                    <x-icon name="{{ $service->icon ?? 'building-office-2' }}" class="w-6 h-6" />
                                </div>
                                <div class="arrow-wrap text-brown-500">
                                    <x-icon name="arrow-long-right" class="w-5 h-5" />
                                </div>
                            </div>
                            <h3 class="font-heading text-lg text-navy-900 mb-2 leading-snug">{{ $service->name }}</h3>
                            <p class="text-sm text-slate-500 leading-relaxed flex-1">{{ $service->short_description }}</p>
                            <div class="mt-5 pt-4 border-t border-slate-50">
                                <span class="text-xs font-semibold text-teal-600 uppercase tracking-wide">Learn More</span>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="text-center mt-10 reveal">
                    <a href="{{ route('expertise.index') }}"
                        class="inline-flex items-center gap-3 bg-navy-900 text-white font-semibold px-8 py-4 rounded-xl hover:bg-teal-600 transition-all duration-300 group">
                        All Engineering Expertise
                        <x-icon name="arrow-long-right" class="w-5 h-5 arrow-nudge" />
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- ═══ PROJECT LIFECYCLE ═══ --}}
    <section class="py-24 bg-white" style="padding-top: 0px;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header --}}
            <p class="text-xs font-semibold uppercase tracking-widest text-teal-600 mb-4 reveal">Our Involvement</p>
            <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-start mb-20">
                <div class="reveal-left">
                    <h2 class="text-3xl md:text-4xl font-heading text-navy-900 leading-tight">Project Lifecycle. <em
                            class="font-display not-italic text-brown-500">Dedicated. Value Driven.</em></h2>
                </div>
                <p class="reveal-right text-slate-500 leading-relaxed">
                    Alada supports its partners at every stage — from bidding and early planning through detailed design,
                    construction, and as-built handover. Backed by rigorous engineering and digital workflows, we deliver
                    seamless coordination, accurate deliverables, and practical solutions that keep projects moving forward
                    — an integrated extension of your team from concept to completion.
                </p>
            </div>

            @php
                $lifecycleSteps = [
                    ['num' => '01', 'icon' => 'fa-clipboard-list', 'title' => 'Tendering Stage', 'desc' => 'BOQs, conceptual designs, visualizations, bid support.'],
                    ['num' => '02', 'icon' => 'fa-compass-drafting', 'title' => 'Preliminary Design Stage', 'desc' => 'Project setup, workflows, feasibility studies, preliminary engineering designs.'],
                    ['num' => '03', 'icon' => 'fa-cube', 'title' => 'Detailed Design Stage', 'desc' => 'Detailed engineering, coordination, IFC drawings, BIM, machine guidance.'],
                    ['num' => '04', 'icon' => 'fa-helmet-safety', 'title' => 'Construction Stage', 'desc' => 'Design for temporary works, 4D/5D, quantities, utility coordination, RFI support.'],
                    ['num' => '05', 'icon' => 'fa-handshake', 'title' => 'Handover Stage', 'desc' => 'As-built documentation, consolidated RFIs, finalized coordinated models.'],
                    ['num' => '06', 'icon' => 'fa-gears', 'title' => 'Operations & Maintenance Stage', 'desc' => 'Digital twin, asset registers, updated as-built lifecycle data.'],
                ];
                $lastStep = count($lifecycleSteps) - 1;
            @endphp

            {{-- Desktop: single horizontal timeline --}}
            <div class="hidden lg:grid grid-cols-6 reveal">
                @foreach ($lifecycleSteps as $i => $step)
                    <div class="group flex flex-col items-center text-center">
                        {{-- big icon --}}
                        <div
                            class="w-16 h-16 rounded-full bg-slate-50 ring-1 ring-slate-200 flex items-center justify-center mb-6 transition-all duration-300 group-hover:bg-teal-600 group-hover:ring-teal-600 group-hover:-translate-y-1 group-hover:shadow-lg group-hover:shadow-teal-900/20">
                            <i
                                class="fa-solid {{ $step['icon'] }} text-2xl text-navy-700 transition-all duration-300 group-hover:text-white group-hover:scale-110"></i>
                        </div>

                        {{-- connector line + number circle --}}
                        <div class="relative w-full h-14 flex items-center justify-center mb-5">
                            @unless ($i === 0)
                                <span class="absolute top-1/2 left-0 w-1/2 h-0.5 bg-slate-200 -translate-y-1/2"></span>
                            @endunless
                            @unless ($i === $lastStep)
                                <span class="absolute top-1/2 right-0 w-1/2 h-0.5 bg-slate-200 -translate-y-1/2"></span>
                            @endunless
                            <span
                                class="relative z-10 w-14 h-14 rounded-full bg-white border-2 border-teal-600 text-teal-600 font-display text-lg font-bold flex items-center justify-center transition-all duration-300 group-hover:bg-teal-600 group-hover:text-white group-hover:scale-110">{{ $step['num'] }}</span>
                        </div>

                        {{-- title + description --}}
                        <div class="px-3">
                            <h3
                                class="font-heading text-base font-bold text-navy-900 mb-2 leading-snug transition-colors duration-300 group-hover:text-teal-700">
                                {{ $step['title'] }}</h3>
                            <p class="text-sm text-slate-500 leading-relaxed">{{ $step['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Mobile: vertical timeline --}}
            <div class="lg:hidden">
                @foreach ($lifecycleSteps as $i => $step)
                    <div class="group relative flex gap-5 {{ $i === $lastStep ? '' : 'pb-10' }} reveal">
                        {{-- vertical connector line --}}
                        @unless ($i === $lastStep)
                            <span class="absolute left-7 top-14 bottom-0 w-0.5 -translate-x-1/2 bg-slate-200"></span>
                        @endunless

                        {{-- number circle + icon --}}
                        <div class="relative shrink-0 flex flex-col items-center">
                            <span
                                class="relative z-10 w-14 h-14 rounded-full bg-white border-2 border-teal-600 text-teal-600 font-display text-lg font-bold flex items-center justify-center transition-all duration-300 group-hover:bg-teal-600 group-hover:text-white group-hover:scale-110">{{ $step['num'] }}</span>
                            <div
                                class="w-12 h-12 rounded-full bg-slate-50 ring-1 ring-slate-200 flex items-center justify-center mt-4 transition-all duration-300 group-hover:bg-teal-600 group-hover:ring-teal-600">
                                <i
                                    class="fa-solid {{ $step['icon'] }} text-lg text-navy-700 transition-all duration-300 group-hover:text-white group-hover:scale-110"></i>
                            </div>
                        </div>

                        {{-- title + description --}}
                        <div class="pt-3">
                            <h3
                                class="font-heading text-base font-bold text-navy-900 mb-2 leading-snug transition-colors duration-300 group-hover:text-teal-700">
                                {{ $step['title'] }}</h3>
                            <p class="text-sm text-slate-500 leading-relaxed">{{ $step['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══ CASE STUDIES ═══ --}}
    @if ($featuredCaseStudies->count())
        <section class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row lg:items-end justify-between mb-16 gap-6">
                    <div class="reveal-left">
                        <p class="text-xs font-semibold uppercase tracking-widest text-teal-600 mb-4">Our Work</p>
                        <h2 class="text-4xl md:text-5xl font-heading text-navy-900">Featured<br><em
                                class="font-display not-italic text-brown-500">Projects</em></h2>
                    </div>
                    <a href="{{ route('case-studies.index') }}"
                        class="reveal-right inline-flex items-center gap-2 font-semibold text-navy-700 hover:text-teal-600 transition-colors group shrink-0">
                        All Projects
                        <x-icon name="arrow-long-right" class="w-5 h-5 arrow-nudge" />
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-7">
                    @foreach ($featuredCaseStudies as $i => $cs)
                        <a href="{{ route('case-studies.show', $cs->slug) }}"
                            class="group block bg-white border border-slate-100 rounded-2xl overflow-hidden hover:shadow-xl hover:shadow-navy-900/10 transition-all duration-500 reveal"
                            style="transition-delay:{{ $i * 100 }}ms">
                            @if ($cs->featured_image)
                                <div class="aspect-[4/3] overflow-hidden">
                                    <img src="{{ asset($cs->featured_image) }}" alt="{{ $cs->title }}"
                                        loading="lazy"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                </div>
                            @else
                                <div
                                    class="aspect-[4/3] bg-gradient-to-br from-navy-800 to-teal-700 flex items-center justify-center">
                                    <x-icon name="building-office-2" class="w-12 h-12 text-white/30" />
                                </div>
                            @endif
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-3">
                                    @if ($cs->industry)
                                        <span
                                            class="text-xs font-semibold text-teal-600 uppercase tracking-wide">{{ $cs->industry->name }}</span>
                                    @endif
                                </div>
                                <h3
                                    class="font-heading text-lg text-navy-900 group-hover:text-teal-600 transition-colors leading-snug mb-2">
                                    {{ $cs->title }}</h3>
                                @if ($cs->client_name)
                                    <p class="text-xs text-slate-400">{{ $cs->client_name }}</p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

{{-- ═══ INDUSTRIES ═══ --}}
@if ($industries->count())
    <section class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 reveal">
                <p class="text-xs font-semibold uppercase tracking-widest text-teal-600 mb-4">
                    Sectors
                </p>

                <h2 class="text-4xl md:text-5xl font-heading text-navy-900 mb-4">
                    Industries<br>
                    <em class="font-display not-italic text-brown-500">
                        We Serve
                    </em>
                </h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                @foreach ($industries as $i => $industry)

                    @php
                        $iconName = $industry->icon ?: 'building';
                        $iconClass = \Illuminate\Support\Str::startsWith($iconName, 'fa-')
                            ? $iconName
                            : 'fa-' . $iconName;
                    @endphp

                    <div
                        class="group bg-white border border-slate-100 rounded-2xl p-6 text-center hover:border-teal-200 hover:shadow-lg hover:shadow-teal-900/5 transition-all duration-300 reveal cursor-pointer"
                        style="transition-delay:{{ $i * 60 }}ms">

                        <div
                            class="w-12 h-12 mx-auto rounded-xl bg-slate-50 group-hover:bg-teal-600 flex items-center justify-center text-teal-600 group-hover:text-white transition-all duration-300 mb-3">

                            <i class="fa-solid {{ $iconClass }} text-xl"></i>

                        </div>

                        <h3
                            class="font-semibold text-navy-800 group-hover:text-teal-700 text-sm transition-colors">

                            {{ $industry->name }}

                        </h3>

                    </div>

                @endforeach

            </div>
        </div>
    </section>
@endif

    {{-- ═══ PROJECT FOOTPRINT ═══ --}}
    <section class="py-24 bg-white" style="padding-bottom: 20px;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-end mb-12">
                <div class="reveal-left">
                    <p class="text-xs font-semibold uppercase tracking-widest text-teal-600 mb-4">Our Project's Footprint
                    </p>
                    <h2 class="text-4xl md:text-5xl font-heading text-navy-900 leading-tight">Infrastructure.
                        Industry.<br><em class="font-display not-italic text-brown-500">Environment.</em></h2>
                </div>
                <p class="reveal-right text-slate-600 leading-relaxed">
                    Alada has built a strong footprint across regions spanning the infrastructure and industrial sectors. We
                    continue to expand our capabilities and partnerships to deliver sustainable, compliant solutions in a
                    rapidly evolving environment.
                </p>
            </div>

            <div class="reveal-scale">
                <img src="{{ asset('images/alada-map.png') }}"
                    alt="Map of Alada's global project footprint across infrastructure and industry" loading="lazy"
                    class="w-full h-auto select-none pointer-events-none">
            </div>
        </div>
    </section>

    {{-- ═══ LATEST INSIGHTS ═══ --}}
    @if ($latestBlogs->count())
        <section class="py-24 bg-white" style="padding-top: 0px;">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row lg:items-end justify-between mb-16 gap-6">
                    <div class="reveal-left">
                        <p class="text-xs font-semibold uppercase tracking-widest text-teal-600 mb-4">Knowledge</p>
                        <h2 class="text-4xl md:text-5xl font-heading text-navy-900">Latest<br><em
                                class="font-display not-italic text-brown-500">Insights</em></h2>
                    </div>
                    <a href="{{ route('insights.index') }}"
                        class="reveal-right inline-flex items-center gap-2 font-semibold text-navy-700 hover:text-teal-600 transition-colors group shrink-0">
                        All Articles
                        <x-icon name="arrow-long-right" class="w-5 h-5 arrow-nudge" />
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-7">
                    @foreach ($latestBlogs as $i => $blog)
                        @include('frontend.insights._card', ['blog' => $blog, 'delay' => $i * 100])
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ═══ SOFTWARES WE USE ═══ --}}
    @if ($softwareLogos->count())
        <section class="py-16 bg-white border-t border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10 reveal">
                    <h2 class="text-3xl md:text-4xl font-heading font-bold text-navy-900">
                        Softwares <em class="font-display not-italic text-brown-500">We Use</em>
                    </h2>
                </div>
                <div class="flex flex-wrap items-center justify-center gap-8 md:gap-12 reveal">
                    @foreach ($softwareLogos as $logo)
                        <div class="flex items-center justify-center h-14">
                            <img src="{{ asset($logo->path) }}" alt="{{ $logo->name ?? 'Software' }}"
                                title="{{ $logo->name ?? '' }}"
                                class="max-h-full w-auto object-contain transition-all duration-300 opacity-90 hover:opacity-100"
                                loading="lazy">
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ═══ CTA ═══ --}}
    <section class="py-28 bg-slate-50 relative overflow-hidden texture">
        <div class="absolute right-0 bottom-0 w-96 h-96 opacity-10">
            <div class="absolute inset-0 rounded-full border-2 border-slate-300" style="margin:0"></div>
            <div class="absolute inset-0 rounded-full border border-slate-300" style="margin:24px"></div>
            <div class="absolute inset-0 rounded-full border border-slate-300" style="margin:48px"></div>
            <div class="absolute inset-0 rounded-full border border-slate-300" style="margin:72px"></div>
            <div class="absolute inset-0 rounded-full border border-slate-300" style="margin:96px"></div>
        </div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="reveal">
                <p class="text-xs font-semibold uppercase tracking-widest text-teal-600 mb-5">Start a Conversation</p>
                <h2 class="text-4xl md:text-6xl font-heading text-navy-900 mb-6">Ready to Build<br><em
                        class="font-display not-italic text-brown-500">Something Great?</em></h2>
                <p class="text-slate-500 text-lg mb-10 max-w-2xl mx-auto">From feasibility to final delivery — tell us
                    about your project and let Alada's global engineering team develop the solution.</p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('contact') }}"
                        class="group inline-flex items-center gap-3 bg-brown-500 hover:bg-brown-400 text-white font-semibold px-10 py-4 rounded-xl transition-all duration-300 shadow-lg shadow-brown-900/30 text-lg">
                        Get in Touch
                        <x-icon name="arrow-long-right" class="w-5 h-5 arrow-nudge" />
                    </a>
                    <a href="{{ route('expertise.index') }}"
                        class="inline-flex items-center gap-3 border border-navy-900/20 text-navy-900 hover:bg-navy-900/10 font-semibold px-8 py-4 rounded-xl transition-all duration-300">
                        Our Services
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
