<header id="site-header" class="bg-white/95 backdrop-blur-sm sticky top-0 z-50 border-b border-slate-200/60"
    x-data="{ mobileOpen: false, servicesOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20 transition-all duration-300">

            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="relative">
                    <div class="ring-pulse absolute inset-0 rounded-full bg-brown-200/30"></div>
                    <img src="{{ asset('images/alada-logo.png') }}" alt="Alada" class="h-12 w-auto relative z-10">
                </div>
            </a>

            <nav class="hidden lg:flex items-center gap-8">
                <a href="{{ route('home') }}"
                    class="text-sm font-medium text-navy-700 hover:text-teal-600 transition-colors tracking-wide">Home</a>
                <a href="{{ route('about') }}"
                    class="text-sm font-medium text-navy-700 hover:text-teal-600 transition-colors tracking-wide">About</a>

                <div class="relative" x-data="{ open: false }" @mouseenter="open=true" @mouseleave="open=false">
                    <button
                        class="flex items-center gap-1 text-sm font-medium text-navy-700 hover:text-teal-600 transition-colors tracking-wide">
                        Expertise
                        <x-icon name="chevron-down" class="w-3.5 h-3.5 transition-transform duration-200"
                            ::class="open ? 'rotate-180' : ''" />
                    </button>
                    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-end="opacity-0 translate-y-2"
                        class="absolute top-full left-1/2 -translate-x-1/2 mt-3 w-[560px] bg-white rounded-2xl shadow-2xl shadow-navy-900/10 border border-slate-100 p-5 z-50">
                        <div class="grid grid-cols-2 gap-1">
                            @foreach ($footerServices as $svc)
                                <a href="{{ route('expertise.show',$svc->slug) }}"
                                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-slate-50 transition-colors group/item">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-teal-50 flex items-center justify-center text-teal-600 group-hover/item:bg-teal-600 group-hover/item:text-white transition-all shrink-0">
                                        <x-icon name="{{ $svc->icon ?? 'building-office-2' }}" class="w-4 h-4" />
                                    </div>
                                    <span
                                        class="text-xs font-medium text-navy-700 leading-tight">{{ $svc->name }}</span>
                                </a>
                            @endforeach
                        </div>
                        <div class="mt-3 pt-3 border-t border-slate-100">
                            <a href="{{ route('expertise.index') }}"
                                class="flex items-center gap-2 text-xs font-semibold text-teal-600 hover:text-teal-700 transition-colors">
                                View all expertise
                                <x-icon name="arrow-long-right" class="w-4 h-4 arrow-nudge" />
                            </a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('industries.index') }}"
                    class="text-sm font-medium text-navy-700 hover:text-teal-600 transition-colors tracking-wide">Industries</a>
                <a href="{{ route('case-studies.index') }}"
                    class="text-sm font-medium text-navy-700 hover:text-teal-600 transition-colors tracking-wide">Case Studies</a>
                <a href="{{ route('blog.index') }}"
                    class="text-sm font-medium text-navy-700 hover:text-teal-600 transition-colors tracking-wide">Insights</a>

                @php
                    $careersPage = app\models\Page::where('slug', 'careers')->firstOrFail();
                @endphp
                @if ($careersPage->is_published)
                    <a href="{{ route('careers') }}"
                        class="text-sm font-medium text-navy-700 hover:text-teal-600 transition-colors tracking-wide">Careers</a>
                @endif

                <a href="{{ route('contact') }}"
                    class="ml-2 inline-flex items-center gap-2 bg-navy-900 text-white text-sm font-semibold px-5 py-2.5 rounded-xl hover:bg-teal-600 transition-all duration-300 group">
                    Get in Touch
                    <x-icon name="arrow-long-right" class="w-4 h-4 arrow-nudge" />
                </a>
            </nav>

            <button @click="mobileOpen = !mobileOpen"
                class="lg:hidden p-2 rounded-lg text-navy-600 hover:bg-slate-100 transition-colors">
                <x-icon name="bars-3" class="w-6 h-6" />
            </button>
        </div>
    </div>

    {{-- Secondary Country/Region Nav --}}
    <div class="hidden lg:block border-t border-slate-200/40 bg-navy-900/95 backdrop-blur-sm" x-data="{ hovered: null }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center">
            @php
                $regions = [
                    'Americas' => ['United States', 'Canada', 'Latin America'],
                    'Europe' => [
                        'United Kingdom',
                        'Sweden',
                        'Italy',
                        'France',
                        'Germany',
                        'Poland',
                        'Netherlands',
                        'Austria',
                        'Greece',
                    ],
                    'Asia' => ['India', 'Singapore', 'Hong Kong', 'Indonesia', 'Malaysia', 'Vietnam'],
                    'Middle East' => [
                        'Bahrain',
                        'Oman',
                        'Kuwait',
                        'Qatar',
                        'Saudi Arabia',
                        'Jordan',
                        'Iran',
                        'Iraq',
                        'Dubai',
                    ],
                    'Oceania' => ['Australia', 'New Zealand'],
                ];
            @endphp
            @foreach ($regions as $region => $countries)
                <div class="relative group" @mouseenter="hovered = '{{ $region }}'" @mouseleave="hovered = null">
                    <button
                        class="px-5 py-2.5 text-xs font-semibold text-slate-300 hover:text-white hover:bg-white/10 uppercase tracking-widest transition-colors flex items-center gap-1.5">
                        {{ $region }}
                        <x-icon name="chevron-down" class="w-3 h-3" />
                    </button>
                    <div x-show="hovered === '{{ $region }}'" x-cloak
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="absolute top-full left-0 min-w-56 bg-navy-950 border border-white/10 shadow-2xl rounded-b-xl py-2 z-50">
                        @foreach ($countries as $country)
                            <span
                                class="block px-5 py-1.5 text-sm text-slate-300 hover:text-white hover:bg-white/10 cursor-default transition-colors">
                                {{ $country }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div x-show="mobileOpen" x-cloak x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        class="lg:hidden border-t border-slate-100 bg-white">
        <div class="max-w-7xl mx-auto px-4 py-4 space-y-1">
            @foreach ([['home', 'Home'], ['about', 'About'], ['expertise.index', 'Expertise'], ['industries.index', 'Industries'], ['case-studies.index', 'Projects'], ['blog.index', 'Insights'], ['careers', 'Careers']] as [$r, $l])
                <a href="{{ route($r) }}"
                    class="block px-4 py-3 rounded-xl text-sm font-medium text-navy-700 hover:bg-slate-50 transition-colors">{{ $l }}</a>
            @endforeach
            <a href="{{ route('contact') }}"
                class="block px-4 py-3 rounded-xl text-sm font-semibold text-white bg-navy-900 text-center mt-2 hover:bg-teal-600 transition-colors">Get
                in Touch</a>
        </div>
    </div>
</header>
