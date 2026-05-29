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
            <p class="text-xs font-semibold uppercase tracking-widest text-teal-400 mb-4">Who We Are</p>
            <h1 class="text-5xl md:text-6xl font-heading text-white leading-tight mb-6">{{ $page->title }}</h1>
            @if($page->subtitle)
            <p class="text-xl text-slate-300 leading-relaxed">{{ $page->subtitle }}</p>
            @endif
        </div>
    </div>
</section>

{{-- ═══ TWO-COLUMN INTRO ═══ --}}
@include('frontend.partials.about-two-column', ['sec' => $sec])

{{-- ═══ TEAM MEMBERS ═══ --}}
@if($teamMembers->count())
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 reveal">
            <h2 class="text-4xl md:text-5xl font-heading font-bold leading-tight">
                <span class="text-navy-900">Our Team</span><br>
                <em class="font-display not-italic text-brown-500">Members</em>
            </h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($teamMembers as $i => $member)
            <div class="bg-white rounded-2xl overflow-hidden border border-slate-100 reveal" style="transition-delay: {{ $i * 100 }}ms">
                <div class="px-6 pt-6 pb-3">
                    <p class="text-xs font-semibold uppercase tracking-widest text-slate-400 mb-1">{{ $member->role }}</p>
                    <h3 class="font-heading text-xl text-navy-900 font-semibold">{{ $member->name }}</h3>
                </div>
                <div class="px-6 pb-6">
                    @if($member->photo)
                    <div class="rounded-xl overflow-hidden aspect-[4/3]">
                        <img src="{{ asset($member->photo) }}" alt="{{ $member->name }}"
                             class="w-full h-full object-cover object-top"
                             loading="lazy">
                    </div>
                    @else
                    <div class="rounded-xl aspect-[4/3] bg-slate-200 flex items-center justify-center">
                        <x-icon name="user-circle" class="w-16 h-16 text-slate-400"/>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══ CTA ═══ --}}
<section class="py-20 bg-navy-900 texture relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-navy-950/80 to-transparent"></div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center reveal">
        <p class="font-display italic text-4xl md:text-5xl text-white leading-tight mb-8">"Great engineering is built by great people working as one team."</p>
        <a href="{{ route('careers') }}" class="inline-flex items-center gap-3 bg-brown-500 hover:bg-brown-400 text-white font-semibold px-10 py-4 rounded-xl transition-all duration-300 text-lg group">
            Join Our Team
            <x-icon name="arrow-long-right" class="w-5 h-5 arrow-nudge"/>
        </a>
    </div>
</section>

@endsection
