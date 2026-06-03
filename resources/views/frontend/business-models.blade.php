@extends('layouts.app')
@section('content')

@php $sec = $page->sections ?? []; @endphp

{{-- ═══ HEADER ═══ --}}
<section class="bg-navy-900 relative overflow-hidden texture py-32">
    @if($page->featured_image)
    <img src="{{ asset($page->featured_image) }}" alt="" class="absolute inset-0 w-full h-full object-cover opacity-30">
    @endif
    <div class="absolute inset-0 bg-gradient-to-br from-navy-950 via-navy-900/95 to-teal-900/40"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-breadcrumbs :items="[['name' => 'About Us', 'url' => route('company-overview')], ['name' => $page->title]]"/>
        <div class="mt-8 max-w-3xl">
            <p class="text-xs font-semibold uppercase tracking-widest text-teal-400 mb-4">Engagement Models</p>
            <h1 class="text-5xl md:text-6xl font-heading text-white leading-tight mb-6">{{ $page->title }}</h1>
            @if($page->subtitle)
            <p class="text-xl text-slate-300 leading-relaxed">{{ $page->subtitle }}</p>
            @endif
        </div>
    </div>
</section>

{{-- ═══ TWO-COLUMN INTRO ═══ --}}
@include('frontend.partials.about-two-column', ['sec' => $sec])

{{-- ═══ CARDS ═══ --}}
@include('frontend.partials.about-cards', ['cards' => $cards, 'cardsLabel' => 'Flexible by Design', 'cardsHeading' => 'Our Engagement Models', 'gridCols' => 3, 'colGapOnly' => true])

{{-- ═══ CTA ═══ --}}
<section class="py-20 bg-navy-900 texture relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-navy-950/80 to-transparent"></div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center reveal">
        <p class="max-w-6xl mx-auto font-medium text-3xl md:text-[52px] text-white leading-[1.05] tracking-[-0.02em] mb-8 text-center">"From fixed scope to strategic partnership a model that fits the way you work."</p>
        <a href="{{ route('contact') }}" class="inline-flex items-center gap-3 bg-brown-500 hover:bg-brown-400 text-white font-semibold px-10 py-4 rounded-xl transition-all duration-300 text-lg group">
            Discuss Your Project
            <x-icon name="arrow-long-right" class="w-5 h-5 arrow-nudge"/>
        </a>
    </div>
</section>

@endsection
