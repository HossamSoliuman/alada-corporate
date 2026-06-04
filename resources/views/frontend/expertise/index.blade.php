@extends('layouts.app')
@section('content')

<section class="bg-navy-900 relative overflow-hidden texture py-28">
    <div class="absolute inset-0 bg-gradient-to-br from-navy-950 via-navy-900 to-teal-900/40"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-breadcrumbs :items="[['name'=>'Expertise']]"/>
        <div class="mt-8">
            <p class="text-xs font-semibold uppercase tracking-widest text-teal-400 mb-4">What We Do</p>
            <h1 class="text-5xl md:text-6xl font-heading text-white leading-tight mb-4">Engineering <em class="font-display not-italic text-brown-300">Expertise</em></h1>
            <p class="text-lg text-slate-300 max-w-xl">Multi-disciplinary capabilities delivered as integrated solutions, from concept to completion.</p>
        </div>
    </div>
</section>

<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($services as $i => $service)
            <a href="{{ route('expertise.show', $service->slug) }}"
               class="service-card card-glass group rounded-2xl p-7 flex flex-col reveal"
               style="transition-delay: {{ $i * 60 }}ms">
                <div class="flex items-start justify-between mb-5">
                    <div class="icon-wrap w-12 h-12 rounded-xl glass-chip flex items-center justify-center">
                        <x-icon name="{{ $service->icon ?? 'building-office-2' }}" class="w-6 h-6"/>
                    </div>
                    @if($service->is_featured)
                    <span class="text-xs font-semibold bg-white/10 text-brown-300 px-2.5 py-1 rounded-full">Featured</span>
                    @endif
                </div>
                <h3 class="font-heading text-lg text-white mb-2 leading-snug flex-1">{{ $service->name }}</h3>
                <p class="text-sm text-slate-300 leading-relaxed mb-5">{{ $service->short_description }}</p>
                <div class="flex items-center justify-between pt-4 border-t border-white/10">
                    <span class="text-xs font-semibold text-brown-300 uppercase tracking-wide">Explore</span>
                    <div class="arrow-wrap text-brown-300"><x-icon name="arrow-long-right" class="w-5 h-5"/></div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<section class="py-16 bg-navy-900 texture relative overflow-hidden">
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center reveal">
        <h2 class="text-3xl md:text-4xl font-heading text-white mb-4">Need an Integrated Solution?</h2>
        <p class="text-slate-400 mb-8">Our multi-disciplinary teams combine expertise across engineering disciplines to deliver seamless, end-to-end project delivery.</p>
        <a href="{{ route('contact') }}" class="btn-glossy inline-flex items-center gap-3 text-white font-semibold px-8 py-4 rounded-xl group">
            Discuss Your Project
            <x-icon name="arrow-long-right" class="w-5 h-5 arrow-nudge"/>
        </a>
    </div>
</section>

@endsection
