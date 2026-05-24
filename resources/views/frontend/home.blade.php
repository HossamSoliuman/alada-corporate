@extends('layouts.app')

@section('content')

{{-- ═══ HERO ═══ --}}
<section class="relative min-h-screen flex items-end pb-24 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <video autoplay muted loop playsinline class="w-full h-full object-cover">
            <source src="{{ $heroVideo?->url ?? asset('videos/hero-construction.mp4') }}" type="video/mp4">
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
                A globally integrated engineering and infrastructure consultancy delivering complex, high-performance solutions across every phase of the project lifecycle.
            </p>

            <div class="reveal delay-200 flex flex-col sm:flex-row gap-4">
                <a href="{{ route('expertise.index') }}"
                   class="group inline-flex items-center justify-center gap-3 bg-brown-500 hover:bg-brown-400 text-white font-semibold px-8 py-4 rounded-xl transition-all duration-300 shadow-lg shadow-brown-900/30">
                    Explore Services
                    <x-icon name="arrow-long-right" class="w-5 h-5 arrow-nudge"/>
                </a>
                <a href="{{ route('case-studies.index') }}"
                   class="group inline-flex items-center justify-center gap-3 border border-white/30 text-white hover:bg-white/10 font-semibold px-8 py-4 rounded-xl transition-all duration-300 backdrop-blur-sm">
                    View Projects
                    <x-icon name="arrow-long-right" class="w-5 h-5 arrow-nudge"/>
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
            @foreach([
                ['5000', '+', 'Delivered Projects',         'Infrastructure & industrial across 5 continents'],
                ['55',   '+', 'Satisfied Clients',          'Global and regional partnerships'],
                ['100',  '+', 'Years Collective Experience', 'Delivered through one powerful team'],
                ['9',    '',  'Engineering Disciplines',     'Built to 100% global standards'],
            ] as [$num, $suf, $label, $sub])
            <div class="text-center reveal">
                <div class="font-display text-5xl md:text-6xl font-bold text-navy-900 mb-1"
                     data-count="{{ $num }}" data-suffix="{{ $suf }}">{{ $num }}{{ $suf }}</div>
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
                <h2 class="text-4xl md:text-5xl font-heading text-navy-900 leading-tight mb-6">Engineering The Infrastructure<br><em class="font-display text-brown-500 not-italic">Of Tomorrow</em></h2>
                <p class="text-slate-600 leading-relaxed mb-6">Alada is a globally integrated, multi-disciplinary engineering consultancy established in the United States, with a fully owned and operational India-based delivery model. We operate across the complete project lifecycle — from feasibility and conceptual design through to construction documentation and project management.</p>
                <p class="text-slate-600 leading-relaxed mb-8">Our unique combination of U.S. engineering standards, advanced digital methodologies, and globally distributed execution ensures technically robust, cost-efficient, and scalable solutions across every environment.</p>
                <a href="{{ route('about') }}" class="inline-flex items-center gap-2 font-semibold text-teal-600 hover:text-navy-900 transition-colors group">
                    Discover Our Story
                    <x-icon name="arrow-long-right" class="w-5 h-5 arrow-nudge"/>
                </a>
            </div>
            <div class="reveal-right grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach([
                    ['Consulting Expertise',  'Renowned International Civil Engineers with Diverse Skill Set'],
                    ['Robust Delivery',       'Consistent on-time, on-budget project completion globally'],
                    ['Rapid Value Creation',  'Fast-tracked design cycles without compromising quality or compliance'],
                    ['Tech-Forward Approach', 'BIM, digital twin, and parametric modeling embedded across all disciplines'],
                ] as [$t, $d])
                <div class="bg-white rounded-2xl p-5 border border-slate-100 hover:border-teal-200 hover:shadow-lg hover:shadow-teal-900/5 transition-all duration-300 text-center sm:text-left">
                    <div class="w-10 h-10 rounded-xl bg-teal-50 flex items-center justify-center text-teal-600 mb-3 mx-auto sm:mx-0">
                        <x-icon name="check-circle" class="w-5 h-5"/>
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
@if($featuredServices->count())
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 reveal">
            <p class="text-xs font-semibold uppercase tracking-widest text-teal-600 mb-4">What We Do</p>
            <h2 class="text-4xl md:text-5xl font-heading text-navy-900 mb-4">Global Urban & Infrastructure<br><em class="font-display not-italic text-brown-500">Development Engineering</em></h2>
            <p class="text-slate-500 max-w-xl mx-auto">Comprehensive engineering capabilities across all disciplines, delivered as integrated solutions from concept to completion.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featuredServices as $i => $service)
            <a href="{{ route('expertise.show',$service->slug) }}"
               class="service-card group bg-white border border-slate-100 rounded-2xl p-7 flex flex-col reveal"
               style="transition-delay: {{ $i * 80 }}ms">
                <div class="flex items-start justify-between mb-5">
                    <div class="icon-wrap w-12 h-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center">
                        <x-icon name="{{ $service->icon ?? 'building-office-2' }}" class="w-6 h-6"/>
                    </div>
                    <div class="arrow-wrap text-brown-500">
                        <x-icon name="arrow-long-right" class="w-5 h-5"/>
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
            <a href="{{ route('expertise.index') }}" class="inline-flex items-center gap-3 bg-navy-900 text-white font-semibold px-8 py-4 rounded-xl hover:bg-teal-600 transition-all duration-300 group">
                All Engineering Expertise
                <x-icon name="arrow-long-right" class="w-5 h-5 arrow-nudge"/>
            </a>
        </div>
    </div>
</section>
@endif

{{-- ═══ PROVEN. SCALABLE. DELIVERABLE. ═══ --}}
<section class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['Urban & Infrastructure Development Engineering',   '/images/specialty/Urban & Infrastructure Development Engineering.png'],
                ['Transportation Infrastructure Engineering',        '/images/specialty/Transportation Infrastructure Engineering.png'],
                ['Industrial, LNG, Oil & Gas & Energy Engineering', '/images/specialty/Industrial, LNG, Oil & Gas & Energy Engineering.png'],
                ['Environmental Engineering & Hydrogeology',        '/images/specialty/Environmental Engineering & Hydrogeology.png'],
                ['Water, Wastewater & Drainage Engineering',        '/images/specialty/Water, Wastewater & Drainage Engineering.png'],
                ['Structural Engineering',                          '/images/specialty/Structural Engineering.png'],
            ] as $i => [$title, $img])
            <div class="group rounded-3xl overflow-hidden reveal" style="transition-delay: {{ $i * 100 }}ms">
                <div class="relative overflow-hidden aspect-[4/3]">
                    <img src="{{ $img }}" alt="{{ $title }}"
                         loading="lazy"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                </div>
                <div class="pt-5 pb-2 px-1">
                    <h3 class="font-heading text-2xl text-navy-900 leading-snug">{{ $title }}</h3>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ PROJECT LIFECYCLE ═══ --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-start mb-20">
            <div class="reveal-left">
                <p class="text-xs font-semibold uppercase tracking-widest text-teal-600 mb-4">Our Involvement</p>
                <h2 class="text-4xl md:text-5xl font-heading text-navy-900 leading-tight">Project Lifecycle.<br><em class="font-display not-italic text-brown-500">Dedicated. Value Driven.</em></h2>
            </div>
            <p class="reveal-right text-slate-500 leading-relaxed">
                Alada supports its partners at every stage — from bidding and early planning through detailed design, construction, and as-built handover. Backed by rigorous engineering and digital workflows, we deliver seamless coordination, accurate deliverables, and practical solutions that keep projects moving forward — an integrated extension of your team from concept to completion.
            </p>
        </div>

        {{-- Desktop: horizontal zigzag timeline --}}
        {{-- Tall cards (01,03,05): h-[400px] — start at top. Short cards (02,04,06): h-[370px] — bottom-aligned, so they start 90px lower. --}}
        <div class="hidden lg:flex items-end gap-4 overflow-visible reveal">

            {{-- 01 · tall --}}
            <div class="flex-1 relative">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 h-[400px] flex flex-col">
                    <span class="font-display text-8xl font-bold text-teal-600 leading-none">01</span>
                    <h3 class="font-heading text-base font-bold text-navy-900 mt-6 mb-3 leading-snug">Tendering Stage</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">BOQs, conceptual designs, visualizations, bid support.</p>
                </div>
               
            </div>

            {{-- 02 · short --}}
            <div class="flex-1 relative">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 h-[370px] flex flex-col">
                    <span class="font-display text-8xl font-bold text-teal-600 leading-none">02</span>
                    <h3 class="font-heading text-base font-bold text-navy-900 mt-6 mb-3 leading-snug">Preliminary Design Stage</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Project setup, workflows, feasibility studies, preliminary engineering designs.</p>
                </div>
                </div>

            {{-- 03 · tall --}}
            <div class="flex-1 relative">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 h-[400px] flex flex-col">
                    <span class="font-display text-8xl font-bold text-teal-600 leading-none">03</span>
                    <h3 class="font-heading text-base font-bold text-navy-900 mt-6 mb-3 leading-snug">Detailed Design Stage</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Detailed engineering, coordination, IFC drawings, BIM, machine guidance.</p>
                </div>
                  </div>

            {{-- 04 · short --}}
            <div class="flex-1 relative">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 h-[370px] flex flex-col">
                    <span class="font-display text-8xl font-bold text-teal-600 leading-none">04</span>
                    <h3 class="font-heading text-base font-bold text-navy-900 mt-6 mb-3 leading-snug">Construction Stage</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Design for temporary works, 4D/5D, quantities, utility coordination, RFI support.</p>
                </div>
                 </div>

            {{-- 05 · tall --}}
            <div class="flex-1 relative">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 h-[400px] flex flex-col">
                    <span class="font-display text-8xl font-bold text-teal-600 leading-none">05</span>
                    <h3 class="font-heading text-base font-bold text-navy-900 mt-6 mb-3 leading-snug">Handover Stage</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">As-built documentation, consolidated RFIs, finalized coordinated models.</p>
                </div>
                 </div>

            {{-- 06 · short --}}
            <div class="flex-1 relative">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 h-[370px] flex flex-col">
                    <span class="font-display text-8xl font-bold text-teal-600 leading-none">06</span>
                    <h3 class="font-heading text-base font-bold text-navy-900 mt-6 mb-3 leading-snug">Operations & Maintenance Stage</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Digital twin, asset registers, updated as-built lifecycle data.</p>
                </div>
            </div>

        </div>

        {{-- Mobile: vertical stack --}}
        <div class="lg:hidden space-y-4">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 reveal">
                <span class="font-display text-6xl font-bold text-teal-600 leading-none block mb-3">01</span>
                <h3 class="font-heading text-base font-bold text-navy-900 mb-2">Tendering Stage</h3>
                <p class="text-sm text-slate-500 leading-relaxed">BOQs, conceptual designs, visualizations, bid support.</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 reveal">
                <span class="font-display text-6xl font-bold text-teal-600 leading-none block mb-3">02</span>
                <h3 class="font-heading text-base font-bold text-navy-900 mb-2">Preliminary Design Stage</h3>
                <p class="text-sm text-slate-500 leading-relaxed">Project setup, workflows, feasibility studies, preliminary engineering designs.</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 reveal">
                <span class="font-display text-6xl font-bold text-teal-600 leading-none block mb-3">03</span>
                <h3 class="font-heading text-base font-bold text-navy-900 mb-2">Detailed Design Stage</h3>
                <p class="text-sm text-slate-500 leading-relaxed">Detailed engineering, coordination, IFC drawings, BIM, machine guidance.</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 reveal">
                <span class="font-display text-6xl font-bold text-teal-600 leading-none block mb-3">04</span>
                <h3 class="font-heading text-base font-bold text-navy-900 mb-2">Construction Stage</h3>
                <p class="text-sm text-slate-500 leading-relaxed">Design for temporary works, 4D/5D, quantities, utility coordination, RFI support.</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 reveal">
                <span class="font-display text-6xl font-bold text-teal-600 leading-none block mb-3">05</span>
                <h3 class="font-heading text-base font-bold text-navy-900 mb-2">Handover Stage</h3>
                <p class="text-sm text-slate-500 leading-relaxed">As-built documentation, consolidated RFIs, finalized coordinated models.</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 reveal">
                <span class="font-display text-6xl font-bold text-teal-600 leading-none block mb-3">06</span>
                <h3 class="font-heading text-base font-bold text-navy-900 mb-2">Operations & Maintenance Stage</h3>
                <p class="text-sm text-slate-500 leading-relaxed">Digital twin, asset registers, updated as-built lifecycle data.</p>
            </div>
        </div>
    </div>
</section>

{{-- ═══ CASE STUDIES ═══ --}}
@if($featuredCaseStudies->count())
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row lg:items-end justify-between mb-16 gap-6">
            <div class="reveal-left">
                <p class="text-xs font-semibold uppercase tracking-widest text-teal-600 mb-4">Our Work</p>
                <h2 class="text-4xl md:text-5xl font-heading text-navy-900">Featured<br><em class="font-display not-italic text-brown-500">Projects</em></h2>
            </div>
            <a href="{{ route('case-studies.index') }}" class="reveal-right inline-flex items-center gap-2 font-semibold text-navy-700 hover:text-teal-600 transition-colors group shrink-0">
                All Projects
                <x-icon name="arrow-long-right" class="w-5 h-5 arrow-nudge"/>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-7">
            @foreach($featuredCaseStudies as $i => $cs)
            <a href="{{ route('case-studies.show', $cs->slug) }}"
               class="group block bg-white border border-slate-100 rounded-2xl overflow-hidden hover:shadow-xl hover:shadow-navy-900/10 transition-all duration-500 reveal"
               style="transition-delay:{{ $i*100 }}ms">
                @if($cs->featured_image)
                <div class="aspect-[4/3] overflow-hidden">
                    <img src="{{ asset('storage/'.$cs->featured_image) }}" alt="{{ $cs->title }}" loading="lazy"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                </div>
                @else
                <div class="aspect-[4/3] bg-gradient-to-br from-navy-800 to-teal-700 flex items-center justify-center">
                    <x-icon name="building-office-2" class="w-12 h-12 text-white/30"/>
                </div>
                @endif
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        @if($cs->industry)<span class="text-xs font-semibold text-teal-600 uppercase tracking-wide">{{ $cs->industry->name }}</span>@endif
                    </div>
                    <h3 class="font-heading text-lg text-navy-900 group-hover:text-teal-600 transition-colors leading-snug mb-2">{{ $cs->title }}</h3>
                    @if($cs->client_name)<p class="text-xs text-slate-400">{{ $cs->client_name }}</p>@endif
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══ INDUSTRIES ═══ --}}
@if($industries->count())
<section class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 reveal">
            <p class="text-xs font-semibold uppercase tracking-widest text-teal-600 mb-4">Sectors</p>
            <h2 class="text-4xl md:text-5xl font-heading text-navy-900 mb-4">Industries<br><em class="font-display not-italic text-brown-500">We Serve</em></h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
         
            @foreach($industries as $i => $industry)
            <a href="{{ route('industries.show', $industry->slug) }}"
               class="group bg-white border border-slate-100 rounded-2xl p-6 text-center hover:border-teal-200 hover:shadow-lg hover:shadow-teal-900/5 transition-all duration-300 reveal"
               style="transition-delay:{{ $i*60 }}ms">
                <div class="w-12 h-12 mx-auto rounded-xl bg-slate-50 group-hover:bg-teal-600 flex items-center justify-center text-teal-600 group-hover:text-white transition-all duration-300 mb-3">
                    <x-icon name="{{ $industry->featured_image ?? 'building-office' }}" class="w-6 h-6"/>
                </div>
                <h3 class="font-semibold text-navy-800 group-hover:text-teal-700 text-sm transition-colors">{{ $industry->name }}</h3>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══ PROJECT FOOTPRINT ═══ --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-end mb-12">
            <div class="reveal-left">
                <p class="text-xs font-semibold uppercase tracking-widest text-teal-600 mb-4">Our Project's Footprint</p>
                <h2 class="text-4xl md:text-5xl font-heading text-navy-900 leading-tight">Infrastructure. Industry.<br><em class="font-display not-italic text-brown-500">Environment.</em></h2>
            </div>
            <p class="reveal-right text-slate-600 leading-relaxed">
                Alada has built a strong footprint across regions spanning the infrastructure and industrial sectors. We continue to expand our capabilities and partnerships to deliver sustainable, compliant solutions in a rapidly evolving environment.
            </p>
        </div>

        <div class="reveal-scale">
            <img src="{{ asset('images/Our%20Expertise.svg') }}" alt="Map of Alada's global project footprint across infrastructure and industry"
                 loading="lazy" class="w-full h-auto select-none pointer-events-none">
        </div>
    </div>
</section>

{{-- ═══ GLOBAL STATS BAND ═══ --}}
<section class="bg-navy-900 py-16 relative overflow-hidden">
    <div class="absolute inset-0 opacity-[0.04]">
        <svg viewBox="0 0 1000 200" class="w-full h-full" preserveAspectRatio="xMidYMid slice">
            <defs><pattern id="grid2" x="0" y="0" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.4"/></pattern></defs>
            <rect width="100%" height="100%" fill="url(#grid2)"/>
        </svg>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
            @foreach([
                ['5000', '+', 'Delivered Projects',     'Project lifecycle consistently delivered on time'],
                ['55',   '+', 'Delighted Clients',       'Consistently positive feedback from valued clients'],
                ['100',  '+', 'Team of Skilled Experts', 'A strong, skilled team providing diverse expertise'],
            ] as [$num, $suf, $label, $sub])
            <div class="reveal">
                <div class="font-display text-6xl md:text-7xl font-bold text-white mb-2"
                     data-count="{{ $num }}" data-suffix="{{ $suf }}">{{ $num }}{{ $suf }}</div>
                <div class="text-sm font-semibold text-teal-400 uppercase tracking-widest mb-1">{{ $label }}</div>
                <div class="text-xs text-slate-500">{{ $sub }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ LATEST INSIGHTS ═══ --}}
@if($latestBlogs->count())
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row lg:items-end justify-between mb-16 gap-6">
            <div class="reveal-left">
                <p class="text-xs font-semibold uppercase tracking-widest text-teal-600 mb-4">Knowledge</p>
                <h2 class="text-4xl md:text-5xl font-heading text-navy-900">Latest<br><em class="font-display not-italic text-brown-500">Insights</em></h2>
            </div>
            <a href="{{ route('insights.index') }}" class="reveal-right inline-flex items-center gap-2 font-semibold text-navy-700 hover:text-teal-600 transition-colors group shrink-0">
                All Articles
                <x-icon name="arrow-long-right" class="w-5 h-5 arrow-nudge"/>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-7">
            @foreach($latestBlogs as $i => $blog)
            @include('frontend.insights._card', ['blog' => $blog, 'delay' => $i * 100])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══ CTA ═══ --}}
<section class="py-28 bg-navy-900 relative overflow-hidden texture">
    <div class="absolute right-0 bottom-0 w-96 h-96 opacity-10">
        <div class="absolute inset-0 rounded-full border-2 border-slate-300" style="margin:0"></div>
        <div class="absolute inset-0 rounded-full border border-slate-300" style="margin:24px"></div>
        <div class="absolute inset-0 rounded-full border border-slate-300" style="margin:48px"></div>
        <div class="absolute inset-0 rounded-full border border-slate-300" style="margin:72px"></div>
        <div class="absolute inset-0 rounded-full border border-slate-300" style="margin:96px"></div>
    </div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="reveal">
            <p class="text-xs font-semibold uppercase tracking-widest text-teal-400 mb-5">Start a Conversation</p>
            <h2 class="text-4xl md:text-6xl font-heading text-white mb-6">Ready to Build<br><em class="font-display not-italic text-brown-300">Something Great?</em></h2>
            <p class="text-slate-400 text-lg mb-10 max-w-2xl mx-auto">From feasibility to final delivery — tell us about your project and let Alada's global engineering team develop the solution.</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('contact') }}" class="group inline-flex items-center gap-3 bg-brown-500 hover:bg-brown-400 text-white font-semibold px-10 py-4 rounded-xl transition-all duration-300 shadow-lg shadow-brown-900/30 text-lg">
                    Get in Touch
                    <x-icon name="arrow-long-right" class="w-5 h-5 arrow-nudge"/>
                </a>
                <a href="{{ route('expertise.index') }}" class="inline-flex items-center gap-3 border border-white/20 text-white hover:bg-white/10 font-semibold px-8 py-4 rounded-xl transition-all duration-300">
                    Our Services
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
