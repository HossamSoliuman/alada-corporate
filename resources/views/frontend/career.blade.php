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
                            hr@aladasolutions.com
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

        @if($jobs->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($jobs as $i => $job)
            <div class="bg-white border border-slate-200 rounded-2xl p-6
                        hover:shadow-[0_4px_24px_rgba(0,0,0,0.08)] hover:-translate-y-0.5
                        transition-all duration-200 reveal"
                 style="transition-delay: {{ $i * 50 }}ms">
                <h3 class="text-[17px] font-semibold text-navy-900 mb-4 leading-snug">{{ $job->position_name }}</h3>
                <div class="flex flex-wrap gap-2">
                    <span class="inline-flex items-center gap-1.5 text-[12px] font-medium text-slate-600 bg-slate-100 px-3 py-1.5 rounded-full">
                        <x-icon name="map-pin" class="w-3.5 h-3.5 shrink-0 text-slate-400"/>
                        {{ $job->location }}
                    </span>
                    <span class="inline-flex items-center gap-1.5 text-[12px] font-medium text-slate-600 bg-slate-100 px-3 py-1.5 rounded-full">
                        <x-icon name="briefcase" class="w-3.5 h-3.5 shrink-0 text-slate-400"/>
                        {{ $job->employment_type === 'full-time' ? 'Full-time' : 'Part-time' }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16 bg-white rounded-2xl border border-slate-100">
            <x-icon name="briefcase" class="w-10 h-10 text-slate-200 mx-auto mb-3"/>
            <p class="text-slate-400 text-sm">No open positions at the moment. Check back soon.</p>
        </div>
        @endif
    </div>
</section>

{{-- ═══ WHY ALADA ═══ --}}
@php
$whyIcons = [
    'light-bulb',
    'chart-bar-square',
    'building-office-2',
    'globe-alt',
    'academic-cap',
    'heart',
];
@endphp

<section class="py-10 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Heading --}}
        <div class="text-center max-w-2xl mx-auto mb-8 reveal">
            <p class="text-[12px] font-semibold uppercase tracking-[0.1em] text-slate-500 mb-2">
                Why Alada
            </p>

            <h2 class="font-heading font-bold text-navy-900 leading-tight mb-2 text-[24px] md:text-[30px]">
                {{ $whySection['heading'] }}
            </h2>

            <p class="text-sm text-slate-500 leading-relaxed">
                {{ $whySection['subheading'] }}
            </p>
        </div>

        {{-- Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

            @foreach($whyCards as $i => $card)

            @php
                $icon = $whyIcons[$i % count($whyIcons)];
            @endphp

            <div
                class="group bg-white border border-[#dbe4ec] rounded-[20px] p-5 flex flex-col
                       hover:border-[#c8d4df]
                       hover:shadow-[0_12px_35px_rgba(15,23,42,0.06)]
                       hover:-translate-y-1
                       transition-all duration-300 ease-out reveal"
                style="transition-delay: {{ $i * 80 }}ms">

                {{-- Icon --}}
                <div class="mx-auto w-11 h-11 rounded-full bg-[#edf4fa] flex items-center justify-center mb-4">
                    <x-icon name="{{ $icon }}" class="w-5 h-5 text-[#355a7c]" />
                </div>

                {{-- Title --}}
                <h3 class="text-[16px] leading-snug font-medium text-[#16324f] mb-2 text-center">
                    {{ $card['title'] }}
                </h3>

                {{-- Description --}}
                <p class="text-[13px] leading-6 text-[#60758d] flex-grow text-center">
                    {{ $card['body'] }}
                </p>

            </div>

            @endforeach

        </div>

    </div>
</section>

@endsection
