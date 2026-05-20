@extends('layouts.app')

@section('content')

{{-- ═══ HERO ═══ --}}
<section class="relative min-h-screen flex items-center overflow-hidden bg-navy-900 texture">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-br from-navy-950 via-navy-900 to-teal-900/60"></div>
        <svg class="absolute right-0 top-0 w-full h-full opacity-[0.04]" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid slice">
            <defs><pattern id="grid" x="0" y="0" width="8" height="8" patternUnits="userSpaceOnUse"><path d="M 8 0 L 0 0 0 8" fill="none" stroke="white" stroke-width="0.3"/></pattern></defs>
            <rect width="100%" height="100%" fill="url(#grid)"/>
        </svg>
    </div>

    <div class="absolute right-0 top-0 w-1/2 h-full flex items-center justify-center pointer-events-none">
        <div class="relative w-[600px] h-[600px] opacity-20">
            @for($i = 1; $i <= 12; $i++)
            <div class="absolute inset-0 rounded-full border border-slate-300/60"
                 style="margin: {{ ($i-1)*22 }}px; animation: ring-pulse {{ 3 + $i*0.3 }}s ease-in-out infinite; animation-delay: {{ $i*0.15 }}s;"></div>
            @endfor
        </div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 grid lg:grid-cols-2 gap-16 items-center">
        <div>
            <div class="reveal mb-6 inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full px-4 py-1.5">
                <span class="w-2 h-2 rounded-full bg-teal-400 animate-pulse"></span>
                <span class="text-xs font-medium text-slate-200 tracking-widest uppercase">Global Engineering Solutions</span>
            </div>

            <h1 class="reveal delay-100 text-5xl md:text-7xl font-heading font-bold text-white leading-[1.05] tracking-tight mb-6">
                Growing<br>
                <span class="font-display italic text-brown-300">With Time.</span>
            </h1>

            <p class="reveal delay-200 text-lg text-slate-300 leading-relaxed max-w-xl mb-10">
                A globally integrated engineering and infrastructure consultancy delivering complex, high-performance solutions across every phase of the project lifecycle.
            </p>

            <div class="reveal delay-300 flex flex-col sm:flex-row gap-4">
                <a href="{{ route('services.index') }}"
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

        <div class="hidden lg:flex flex-col gap-4 reveal-right delay-400">
            @foreach([['USA','Headquarters & Strategy Lead'],['India','Engineering & Execution Hub'],['Middle East','Large-scale Civil Projects'],['UK & ANZ','Civil Infrastructure Delivery']] as [$region,$desc])
            <div class="group bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-5 hover:bg-white/10 hover:border-teal-500/40 transition-all duration-300 cursor-default">
                <div class="flex items-center gap-3">
                    <div class="w-2 h-2 rounded-full bg-teal-400"></div>
                    <span class="font-semibold text-white text-sm">{{ $region }}</span>
                    <x-icon name="chevron-right" class="w-4 h-4 text-slate-500 ml-auto group-hover:text-teal-400 group-hover:translate-x-1 transition-all"/>
                </div>
                <p class="text-slate-400 text-xs mt-1 ml-5">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>

    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 animate-bounce">
        <span class="text-xs text-slate-500 uppercase tracking-widest">Scroll</span>
        <div class="w-px h-8 bg-gradient-to-b from-slate-500 to-transparent"></div>
    </div>
</section>

{{-- ═══ STATS ═══ --}}
<section class="bg-white border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            @foreach([['20','+ Years','of Engineering Excellence'],['5','Continents','Global Project Reach'],['11','Disciplines','Fully Integrated'],['100','%','U.S. Standards Applied']] as [$num,$label,$sub])
            <div class="text-center reveal">
                <div class="font-display text-5xl md:text-6xl font-bold text-navy-900 mb-1" data-count="{{ preg_replace('/\D/','',$num) }}" data-suffix="{{ preg_replace('/\d/','',$num) }}">{{ $num }}</div>
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
            <div class="reveal-right grid grid-cols-2 gap-4">
                @foreach([['U.S. Standards','Engineering excellence benchmarked to international quality'],['BIM & Digital','Advanced 3D modeling, clash detection, and digital simulation'],['Full Lifecycle','From feasibility study to construction supervision'],['Global Reach','Projects delivered across USA, UK, Middle East, ANZ & Asia']] as [$t,$d])
                <div class="bg-white rounded-2xl p-5 border border-slate-100 hover:border-teal-200 hover:shadow-lg hover:shadow-teal-900/5 transition-all duration-300">
                    <div class="w-10 h-10 rounded-xl bg-teal-50 flex items-center justify-center text-teal-600 mb-3">
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
            <h2 class="text-4xl md:text-5xl font-heading text-navy-900 mb-4">Multi-Disciplinary<br><em class="font-display not-italic text-brown-500">Engineering Services</em></h2>
            <p class="text-slate-500 max-w-xl mx-auto">Comprehensive engineering capabilities across all disciplines, delivered as integrated solutions.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featuredServices as $i => $service)
            <a href="{{ route('services.show', $service->slug) }}"
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
            <a href="{{ route('services.index') }}" class="inline-flex items-center gap-3 bg-navy-900 text-white font-semibold px-8 py-4 rounded-xl hover:bg-teal-600 transition-all duration-300 group">
                All 11 Services
                <x-icon name="arrow-long-right" class="w-5 h-5 arrow-nudge"/>
            </a>
        </div>
    </div>
</section>
@endif

{{-- ═══ GLOBAL PRESENCE ═══ --}}
<section class="py-24 bg-navy-900 relative overflow-hidden texture">
    <div class="absolute inset-0 opacity-5">
        <svg viewBox="0 0 1000 500" class="w-full h-full" preserveAspectRatio="xMidYMid slice">
            @foreach([[140,120],[200,200],[350,150],[600,180],[750,140],[850,200],[500,300],[300,350],[700,320],[180,380],[900,100],[450,80]] as $dot)
            <circle cx="{{ $dot[0] }}" cy="{{ $dot[1] }}" r="3" fill="white" opacity="0.6"/>
            @endforeach
            <line x1="140" y1="120" x2="350" y2="150" stroke="white" stroke-width="0.5" opacity="0.3"/>
            <line x1="350" y1="150" x2="600" y2="180" stroke="white" stroke-width="0.5" opacity="0.3"/>
            <line x1="600" y1="180" x2="850" y2="200" stroke="white" stroke-width="0.5" opacity="0.3"/>
            <line x1="200" y1="200" x2="500" y2="300" stroke="white" stroke-width="0.5" opacity="0.3"/>
            <line x1="500" y1="300" x2="750" y2="140" stroke="white" stroke-width="0.5" opacity="0.3"/>
        </svg>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 reveal">
            <p class="text-xs font-semibold uppercase tracking-widest text-teal-400 mb-4">Our Reach</p>
            <h2 class="text-4xl md:text-5xl font-heading text-white mb-4">Delivering Across<br><em class="font-display not-italic text-brown-300">Five Continents</em></h2>
            <p class="text-slate-400 max-w-xl mx-auto">Localised expertise with international engineering quality — from concept to completion, wherever your project is.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach([
                ['United States','Headquarters & Strategy','Land development, industrial facilities, civil infrastructure','building-office'],
                ['United Kingdom & Europe','Civil Infrastructure','Comprehensive civil infrastructure projects across sectors','building-library'],
                ['Middle East (GCC)','Large-Scale Projects','Extensive large-scale civil infrastructure developments','map'],
                ['Australia & New Zealand','End-to-End Delivery','Reliable and complete civil infrastructure services','globe-alt'],
                ['Asia (India Hub)','Engineering Centre','Design, BIM execution and project coordination','cpu-chip'],
                ['Global Network','Integrated Delivery','U.S. standards applied at any location, any scale','shield-check'],
            ] as $i => [$region,$role,$desc,$icon])
            <div class="reveal group bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-7 hover:bg-white/10 hover:border-teal-500/30 transition-all duration-300" style="transition-delay:{{ $i*80 }}ms">
                <div class="w-12 h-12 rounded-xl bg-teal-600/20 text-teal-400 flex items-center justify-center mb-5 group-hover:bg-teal-600 group-hover:text-white transition-all duration-300">
                    <x-icon name="{{ $icon }}" class="w-6 h-6"/>
                </div>
                <p class="text-xs font-semibold text-teal-400 uppercase tracking-widest mb-1">{{ $role }}</p>
                <h3 class="font-heading text-lg text-white mb-2">{{ $region }}</h3>
                <p class="text-sm text-slate-400 leading-relaxed">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ DELIVERY MODEL ═══ --}}
<section class="py-24 bg-slate-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 reveal">
            <p class="text-xs font-semibold uppercase tracking-widest text-teal-600 mb-4">How We Work</p>
            <h2 class="text-4xl md:text-5xl font-heading text-navy-900 mb-4">Our Delivery<br><em class="font-display not-italic text-brown-500">Model</em></h2>
        </div>

        <div class="relative">
            <svg class="hidden lg:block absolute top-16 left-0 w-full h-6" viewBox="0 0 800 24" preserveAspectRatio="none">
                <line x1="133" y1="12" x2="667" y2="12" stroke="#c1cfd2" stroke-width="2" stroke-dasharray="6 4" class="line-draw"/>
            </svg>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 relative">
                @foreach([
                    ['01','USA','Strategy & Leadership','Client engagement, project scoping, commercial strategy, and U.S.-standard specifications set in our headquarters.','teal'],
                    ['02','India','Engineering & Execution','Full engineering design, BIM coordination, detailed drawings, and technical delivery from our India centre.','brown'],
                    ['03','Global','Project Delivery','On-the-ground support, construction supervision, and client handover wherever in the world your project sits.','navy'],
                ] as $i => [$num,$loc,$title,$desc,$color])
                <div class="reveal text-center" style="transition-delay:{{ $i*150 }}ms">
                    <div class="relative inline-flex items-center justify-center w-16 h-16 rounded-full bg-{{ $color }}-600 text-white font-display text-2xl font-bold mb-6 shadow-lg shadow-{{ $color }}-900/20">
                        {{ $num }}
                        <div class="absolute inset-0 rounded-full border-4 border-{{ $color }}-200 scale-125 opacity-30"></div>
                    </div>
                    <p class="text-xs font-semibold uppercase tracking-widest text-{{ $color }}-600 mb-1">{{ $loc }}</p>
                    <h3 class="font-heading text-xl text-navy-900 mb-3">{{ $title }}</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">{{ $desc }}</p>
                </div>
                @endforeach
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
                    <x-icon name="{{ $industry->icon ?? 'building-office' }}" class="w-6 h-6"/>
                </div>
                <h3 class="font-semibold text-navy-800 group-hover:text-teal-700 text-sm transition-colors">{{ $industry->name }}</h3>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══ LATEST INSIGHTS ═══ --}}
@if($latestBlogs->count())
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row lg:items-end justify-between mb-16 gap-6">
            <div class="reveal-left">
                <p class="text-xs font-semibold uppercase tracking-widest text-teal-600 mb-4">Knowledge</p>
                <h2 class="text-4xl md:text-5xl font-heading text-navy-900">Latest<br><em class="font-display not-italic text-brown-500">Insights</em></h2>
            </div>
            <a href="{{ route('blog.index') }}" class="reveal-right inline-flex items-center gap-2 font-semibold text-navy-700 hover:text-teal-600 transition-colors group shrink-0">
                All Articles
                <x-icon name="arrow-long-right" class="w-5 h-5 arrow-nudge"/>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-7">
            @foreach($latestBlogs as $i => $blog)
            @include('frontend.blog._card', ['blog' => $blog, 'delay' => $i * 100])
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
                <a href="{{ route('services.index') }}" class="inline-flex items-center gap-3 border border-white/20 text-white hover:bg-white/10 font-semibold px-8 py-4 rounded-xl transition-all duration-300">
                    Our Services
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
