@extends('layouts.app')

@section('content')

<style>
@keyframes careers-scroll-up {
    from { transform: translateY(0); }
    to   { transform: translateY(-50%); }
}
.marquee-up {
    animation: careers-scroll-up 40s linear infinite;
}
.marquee-track-v:hover .marquee-up {
    animation-play-state: paused;
}
</style>

{{-- ═══ HERO ═══ --}}
<section class="relative bg-white overflow-hidden pt-20 pb-16 md:pt-24 md:pb-20">
    {{-- Decorative shapes --}}
    <img src="https://cdn.prod.website-files.com/696659aa8fa6ba842420cbf1/6985d78a604e715fb832bac7_Inner%20page%20-%20Graphic.svg"
         alt="" aria-hidden="true"
         class="absolute bottom-0 right-0 z-0 pointer-events-none select-none w-72 md:w-[420px] opacity-50">
    <img src="https://cdn.prod.website-files.com/696659aa8fa6ba842420cbf1/6985d7931e0a021f7b8ca43c_Innerpage%20graphic%202.svg"
         alt="" aria-hidden="true"
         class="absolute bottom-0 right-24 z-0 pointer-events-none select-none w-52 md:w-80 opacity-35">

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-[13px] text-slate-500 mb-8" aria-label="Breadcrumb">
            <a href="{{ url('/') }}" class="hover:text-navy-900 transition-colors">Home</a>
            <span aria-hidden="true" class="text-slate-300">›</span>
            <span class="font-semibold text-navy-900">Careers</span>
        </nav>

        {{-- Labels --}}
        <div class="flex items-center gap-5 mb-4">
            <span class="text-[12px] font-semibold uppercase tracking-[0.1em] text-slate-500">Join our team</span>
            <span class="text-slate-300 select-none" aria-hidden="true">|</span>
            <span class="text-[12px] font-semibold uppercase tracking-[0.1em] text-slate-500">Careers</span>
        </div>

        {{-- H1 --}}
        <h1 class="font-heading font-bold text-navy-900 leading-tight mt-4 mb-4 text-[32px] md:text-[52px] reveal">
            {{ $hero['heading'] }}
        </h1>

        {{-- Tagline --}}
        <p class="text-lg text-slate-500 leading-relaxed max-w-[560px] mt-4 reveal delay-100">
            {{ $hero['tagline'] }}
        </p>
    </div>
</section>

{{-- ═══ INTRO / ABOUT ═══ --}}
<section class="py-20 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid lg:grid-cols-[55fr_45fr] gap-12 lg:gap-16 items-start">

            {{-- Left: text + contact --}}
            <div class="reveal-left">
                <p class="text-[12px] font-semibold uppercase tracking-[0.1em] text-slate-500 mb-4">{{ $intro['label'] }}</p>
                <h2 class="font-heading font-bold text-navy-900 leading-tight mb-8 text-[28px] md:text-[38px]">
                    {{ $intro['heading'] }}
                </h2>
                <div class="space-y-4 text-base text-slate-500 leading-[1.7]">
                    @if($intro['body_1'])<p>{{ $intro['body_1'] }}</p>@endif
                    @if($intro['body_2'])<p>{{ $intro['body_2'] }}</p>@endif
                    @if($intro['body_3'])<p>{{ $intro['body_3'] }}</p>@endif
                </div>

                {{-- Recruitment contact --}}
                @if($contactEmail || $phone)
                <div class="mt-8 flex flex-col gap-4">
                    @if($contactEmail)
                    <div class="flex items-center gap-4">
                        <div class="w-11 h-11 rounded-full bg-teal-50 flex items-center justify-center text-teal-600 shrink-0">
                            <x-icon name="envelope" class="w-5 h-5"/>
                        </div>
                        <a href="mailto:{{ $contactEmail }}"
                           class="text-base font-medium text-navy-900 hover:text-teal-600 transition-colors break-all">
                            {{ $contactEmail }}
                        </a>
                    </div>
                    @endif
                    @if($phone)
                    <div class="flex items-center gap-4">
                        <div class="w-11 h-11 rounded-full bg-teal-50 flex items-center justify-center text-teal-600 shrink-0">
                            <x-icon name="phone" class="w-5 h-5"/>
                        </div>
                        <a href="tel:{{ $phone }}"
                           class="text-base font-medium text-navy-900 hover:text-teal-600 transition-colors">
                            {{ $phone }}
                        </a>
                    </div>
                    @endif
                </div>
                @endif
            </div>

            {{-- Right: vertical image marquee --}}
            @if($galleryImages)
            <div class="reveal-right">
                <div class="relative h-[580px] overflow-hidden rounded-2xl marquee-track-v"
                     style="-webkit-mask-image: linear-gradient(to bottom, transparent, black 60px, black calc(100% - 60px), transparent);
                            mask-image: linear-gradient(to bottom, transparent, black 60px, black calc(100% - 60px), transparent);">
                    <div class="flex flex-col gap-3 marquee-up" style="will-change: transform;">
                        @foreach($galleryImages as $img)
                        <img src="{{ $img }}" alt="Alada team" loading="lazy"
                             class="w-full h-[200px] rounded-lg object-cover shrink-0">
                        @endforeach
                        @foreach($galleryImages as $img)
                        <img src="{{ $img }}" alt="" aria-hidden="true" loading="lazy"
                             class="w-full h-[200px] rounded-lg object-cover shrink-0">
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</section>

{{-- ═══ JOB OPENINGS ═══ --}}
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-10 reveal">
            <p class="text-[12px] font-semibold uppercase tracking-[0.1em] text-slate-500 mb-3">Our Job Openings</p>
            <h2 class="font-heading font-bold text-navy-900 leading-tight mb-4 text-[28px] md:text-[38px]">
                {{ $jobsSection['heading'] }}
            </h2>
            <p class="text-base text-slate-500 max-w-2xl">
                {{ $jobsSection['subheading'] }}
            </p>
        </div>

        <div class="space-y-3">
            @foreach($jobs as $i => $job)
            <div class="group flex flex-col sm:flex-row sm:items-center justify-between gap-4
                        bg-white border border-slate-200 rounded px-6 sm:px-8 py-5 sm:py-6
                        hover:shadow-[0_4px_24px_rgba(0,0,0,0.08)] hover:-translate-y-0.5
                        transition-all duration-200 reveal"
                 style="transition-delay: {{ $i * 50 }}ms">
                <div>
                    <h3 class="text-[18px] font-semibold text-navy-900 mb-2">{{ $job['title'] }}</h3>
                    <div class="flex flex-wrap items-center gap-4">
                        <span class="inline-flex items-center gap-1.5 text-[13px] text-slate-500">
                            <x-icon name="map-pin" class="w-4 h-4 shrink-0 text-slate-400"/>
                            {{ $job['location'] }}
                        </span>
                        <span class="inline-flex items-center gap-1.5 text-[13px] text-slate-500">
                            <svg class="w-4 h-4 shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                            </svg>
                            {{ $job['type'] }}
                        </span>
                    </div>
                </div>
                <a href="{{ $job['applyUrl'] }}"
                   class="inline-flex items-center justify-center px-6 py-2.5
                          text-[13px] font-semibold uppercase tracking-[0.08em]
                          border-2 border-teal-600 text-teal-600 rounded-sm
                          hover:bg-teal-600 hover:text-white
                          transition-all duration-200
                          whitespace-nowrap shrink-0 self-start sm:self-auto">
                    Find Out More
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ WHY ALADA ═══ --}}
<section class="py-20 bg-white" x-data="{ page: 0 }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header row + navigation arrows --}}
        <div class="flex flex-col lg:flex-row lg:items-start justify-between gap-6 mb-12 reveal">
            <div class="max-w-2xl">
                <p class="text-[12px] font-semibold uppercase tracking-[0.1em] text-slate-500 mb-3">Why Alada</p>
                <h2 class="font-heading font-bold text-navy-900 leading-tight mb-4 text-[28px] md:text-[38px]">
                    {{ $whySection['heading'] }}
                </h2>
                <p class="text-base text-slate-500 leading-relaxed">
                    {{ $whySection['subheading'] }}
                </p>
            </div>
            <div class="flex items-center gap-2 shrink-0 lg:mt-12">
                <button @click="page = Math.max(0, page - 1)"
                        :class="page === 0 ? 'opacity-40 cursor-default' : 'hover:bg-teal-600 hover:border-teal-600 hover:text-white'"
                        class="w-10 h-10 rounded-full border border-slate-200 flex items-center justify-center text-slate-500 transition-all duration-200"
                        aria-label="Previous cards">
                    <x-icon name="chevron-left" class="w-4 h-4"/>
                </button>
                <button @click="page = Math.min(1, page + 1)"
                        :class="page === 1 ? 'opacity-40 cursor-default' : 'hover:bg-teal-600 hover:border-teal-600 hover:text-white'"
                        class="w-10 h-10 rounded-full border border-slate-200 flex items-center justify-center text-slate-500 transition-all duration-200"
                        aria-label="Next cards">
                    <x-icon name="chevron-right" class="w-4 h-4"/>
                </button>
            </div>
        </div>

        {{-- Cards: 3 per page --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($whyCards as $i => $card)
            <div x-show="{{ $i }} >= page * 3 && {{ $i }} < page * 3 + 3"
                 x-transition:enter="transition-opacity duration-300 ease-out"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 class="border border-slate-200 rounded p-8 bg-white min-h-[220px]
                        hover:shadow-[0_4px_24px_rgba(0,0,0,0.10)] transition-shadow duration-200">
                <img src="{{ $card['icon'] }}" alt="{{ $card['title'] }}"
                     class="w-12 h-12 mb-5 object-contain" loading="lazy">
                <h3 class="text-base font-semibold text-navy-900 mb-3">{{ $card['title'] }}</h3>
                <p class="text-sm text-slate-500 leading-[1.6]">{{ $card['body'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- Page dots --}}
        <div class="flex justify-center gap-2 mt-8">
            <button @click="page = 0"
                    :class="page === 0 ? 'bg-teal-600 w-6' : 'bg-slate-300 w-2'"
                    class="h-2 rounded-full transition-all duration-300"
                    aria-label="Page 1"></button>
            <button @click="page = 1"
                    :class="page === 1 ? 'bg-teal-600 w-6' : 'bg-slate-300 w-2'"
                    class="h-2 rounded-full transition-all duration-300"
                    aria-label="Page 2"></button>
        </div>

    </div>
</section>

@endsection
