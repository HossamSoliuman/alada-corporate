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
                All Engineering Services
                <x-icon name="arrow-long-right" class="w-5 h-5 arrow-nudge"/>
            </a>
        </div>
    </div>
</section>
@endif

{{-- ═══ PROVEN. SCALABLE. DELIVERABLE. ═══ --}}
<section class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-end mb-16">
            <div class="reveal-left">
                <p class="text-xs font-semibold uppercase tracking-widest text-teal-600 mb-4">Core Capabilities</p>
                <h2 class="text-4xl md:text-5xl font-heading text-navy-900 leading-tight">Proven. Scalable.<br><em class="font-display not-italic text-brown-500">Deliverable.</em></h2>
            </div>
            <div class="reveal-right">
                <p class="text-slate-500 leading-relaxed">From land preparation to complex industrial systems — we deliver engineering solutions built to international standards, at any scale, in any environment across five continents.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach([
                ['01', 'Land Development',
                 'Site planning, grading, drainage design, and infrastructure layout for residential, commercial, and mixed-use developments.',
                 '/images/Subdivision-land-course-hero-image.png'],
                ['02', 'Transportation Infrastructure',
                 'Road, bridge, highway, and rail design engineered for capacity, safety, and long-term performance at any scale.',
                 '/images/Transportation Infrastructure.jpg'],
                ['03', 'Industrial Plant & Piping',
                 'Process plant design, piping systems, industrial infrastructure, and facility engineering for complex industrial environments.',
                 '/images/Process-Piping.jpg'],
                ['04', 'Digital Twin & Parametric Modeling',
                 'BIM-driven design, parametric modelling, and digital twin delivery for data-rich asset management and informed decision-making.',
                 '/images/Digital-Twin-Model.jpg'],
            ] as $i => [$num, $title, $desc, $img])
            <div class="group relative overflow-hidden rounded-3xl reveal aspect-[4/3]" style="transition-delay: {{ $i * 100 }}ms">
                <img src="{{ $img }}" alt="{{ $title }}"
                     loading="lazy"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-navy-950/92 via-navy-950/40 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-8">
                    <span class="inline-block text-xs font-semibold text-teal-400 uppercase tracking-widest mb-2">{{ $num }}</span>
                    <h3 class="font-heading text-2xl text-white mb-2 leading-snug">{{ $title }}</h3>
                    <p class="text-sm text-slate-300 leading-relaxed max-w-sm opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-400">{{ $desc }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ PROJECT LIFECYCLE ═══ --}}
<section class="py-24 bg-navy-900 relative overflow-hidden texture">
    <div class="absolute inset-0 opacity-[0.03]">
        <svg viewBox="0 0 1000 600" class="w-full h-full" preserveAspectRatio="xMidYMid slice">
            <defs><pattern id="hex" x="0" y="0" width="40" height="46" patternUnits="userSpaceOnUse">
                <polygon points="20,2 38,12 38,34 20,44 2,34 2,12" fill="none" stroke="white" stroke-width="0.6"/>
            </pattern></defs>
            <rect width="100%" height="100%" fill="url(#hex)"/>
        </svg>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-end mb-20">
            <div class="reveal-left">
                <p class="text-xs font-semibold uppercase tracking-widest text-teal-400 mb-4">Our Involvement</p>
                <h2 class="text-4xl md:text-5xl font-heading text-white leading-tight">Project Lifecycle.<br><em class="font-display not-italic text-brown-300">Dedicated. Value Driven.</em></h2>
            </div>
            <p class="reveal-right text-slate-400 leading-relaxed">
                Alada supports its partners at every stage — from bidding and early planning through detailed design, construction, and as-built handover. Backed by rigorous engineering and digital workflows, we deliver seamless coordination, accurate deliverables, and practical solutions that keep projects moving forward — an integrated extension of your team from concept to completion.
            </p>
        </div>

        {{-- Connected lifecycle timeline --}}
        <div class="relative">
            {{-- Spine --}}
            <span class="pointer-events-none absolute top-4 bottom-4 left-7 lg:left-1/2 lg:-translate-x-1/2 w-px bg-gradient-to-b from-teal-500/0 via-teal-500/50 to-teal-500/0"></span>

            <div class="space-y-8 lg:space-y-2">
                @foreach([
                    ['01', 'Tendering',                'BOQ preparation, conceptual design, visualizations, and end-to-end bid support.',                              'clipboard-document-list'],
                    ['02', 'Preliminary Design',       'Project setup, workflow definition, feasibility studies, and preliminary engineering design.',                 'pencil-square'],
                    ['03', 'Detailed Design',          'Detailed engineering, multi-discipline coordination, IFC drawings, and BIM model development.',                 'cube-transparent'],
                    ['04', 'Construction',             'Temporary works design, 4D/5D modeling, quantity take-offs, utility coordination, and RFI support.',           'building-office-2'],
                    ['05', 'Handover',                 'As-built documentation, consolidated RFIs, and finalized coordinated models ready for operation.',            'shield-check'],
                    ['06', 'Operations & Maintenance', 'Digital twin delivery, asset registers, and continuously updated as-built lifecycle data.',                    'cog-6-tooth'],
                ] as $i => [$num, $title, $desc, $icon])
                @php $isLeft = $i % 2 === 0; @endphp
                <div class="relative flex {{ $isLeft ? 'lg:flex-row' : 'lg:flex-row-reverse' }} reveal" style="transition-delay: {{ $i * 80 }}ms">
                    {{-- Node on the spine --}}
                    <span class="absolute z-10 left-7 lg:left-1/2 top-7 -translate-x-1/2 w-3.5 h-3.5 rounded-full bg-teal-400 ring-4 ring-teal-400/15"></span>

                    {{-- Stage card --}}
                    <div class="w-full lg:w-1/2 pl-16 lg:pl-0 {{ $isLeft ? 'lg:pr-14 lg:text-right' : 'lg:pl-14' }}">
                        <div class="group bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-7 hover:bg-white/[0.08] hover:border-teal-500/30 transition-all duration-300">
                            <div class="flex items-center gap-3 mb-4 {{ $isLeft ? 'lg:flex-row-reverse' : '' }}">
                                <span class="font-display text-5xl font-bold leading-none text-teal-500/40 group-hover:text-teal-400 transition-colors duration-300">{{ $num }}</span>
                                <div class="w-11 h-11 rounded-xl bg-teal-600/20 text-teal-400 flex items-center justify-center group-hover:bg-teal-600 group-hover:text-white transition-all duration-300 shrink-0">
                                    <x-icon name="{{ $icon }}" class="w-5 h-5"/>
                                </div>
                            </div>
                            <h3 class="font-heading text-xl text-white mb-2 leading-snug">{{ $title }}</h3>
                            <p class="text-sm text-slate-400 leading-relaxed">{{ $desc }}</p>
                        </div>
                    </div>

                    {{-- Spacer keeps the card on its side of the spine --}}
                    <div class="hidden lg:block lg:w-1/2"></div>
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
