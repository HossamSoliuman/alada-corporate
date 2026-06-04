@extends('layouts.app')
@section('content')

<section class="bg-navy-900 relative overflow-hidden texture text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-breadcrumbs :items="[['name'=>'Case Studies','url'=>route('case-studies.index')],['name'=>$caseStudy->title]]"/>
        <div class="flex items-center gap-3 mt-6 mb-4">
            @if($caseStudy->industry)<span class="text-xs font-semibold bg-white/20 px-3 py-1 rounded-full">{{ $caseStudy->industry->name }}</span>@endif
            @if($caseStudy->category)<span class="text-xs font-semibold bg-white/20 px-3 py-1 rounded-full">{{ $caseStudy->category->name }}</span>@endif
        </div>
        <h1 class="text-4xl md:text-5xl font-heading font-bold mb-4">{{ $caseStudy->title }}</h1>
        @if($caseStudy->client_name)<p class="text-slate-300">Client: {{ $caseStudy->client_name }}</p>@endif
    </div>
</section>

<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <article class="lg:col-span-2 space-y-10">
                @if($caseStudy->featured_image)
                <img src="{{ asset($caseStudy->featured_image) }}" alt="{{ $caseStudy->title }}"
                     class="w-full rounded-2xl shadow-sm">
                @endif

                <div>
                    <h2 class="text-2xl font-heading font-bold text-navy-900 mb-4">The Challenge</h2>
                    <div class="prose max-w-none text-gray-700">{!! $caseStudy->challenge !!}</div>
                </div>
                <div>
                    <h2 class="text-2xl font-heading font-bold text-navy-900 mb-4">Our Solution</h2>
                    <div class="prose max-w-none text-gray-700">{!! $caseStudy->solution !!}</div>
                </div>
                <div>
                    <h2 class="text-2xl font-heading font-bold text-navy-900 mb-4">The Results</h2>
                    <div class="prose max-w-none text-gray-700">{!! $caseStudy->result !!}</div>
                </div>

                {{-- Gallery --}}
                @if($caseStudy->gallery && count($caseStudy->gallery))
                @php($galleryUrls = collect($caseStudy->gallery)->map(fn ($img) => asset($img))->values())
                <div x-data="{
                        open: false,
                        active: 0,
                        images: @js($galleryUrls),
                        show(i) { this.active = i; this.open = true; document.body.style.overflow = 'hidden'; },
                        close() { this.open = false; document.body.style.overflow = ''; },
                        next() { this.active = (this.active + 1) % this.images.length; },
                        prev() { this.active = (this.active - 1 + this.images.length) % this.images.length; }
                     }"
                     @keydown.escape.window="close()"
                     @keydown.arrow-right.window="open && next()"
                     @keydown.arrow-left.window="open && prev()">
                    <h2 class="text-2xl font-heading font-bold text-navy-900 mb-6">Gallery</h2>

                    {{-- Scrollable strip --}}
                    <div class="flex gap-4 overflow-x-auto snap-x snap-mandatory scroll-smooth pb-4 -mx-4 px-4">
                        @foreach($caseStudy->gallery as $i => $img)
                        <button type="button" @click="show({{ $i }})"
                                class="group relative shrink-0 snap-start overflow-hidden rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
                            <img src="{{ asset($img) }}" alt="{{ $caseStudy->title }} — image {{ $i + 1 }}" loading="lazy"
                                 class="h-44 w-64 sm:h-52 sm:w-80 object-cover transition-transform duration-500 group-hover:scale-105">
                            <span class="pointer-events-none absolute inset-0 flex items-center justify-center bg-navy-900/0 transition-colors duration-300 group-hover:bg-navy-900/30">
                                <span class="translate-y-1 rounded-full bg-white/90 p-2.5 text-navy-900 opacity-0 shadow transition-all duration-300 group-hover:translate-y-0 group-hover:opacity-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607ZM10.5 7.5v6m3-3h-6"/>
                                    </svg>
                                </span>
                            </span>
                        </button>
                        @endforeach
                    </div>

                    {{-- Lightbox --}}
                    <div x-show="open" x-cloak
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                         @click.self="close()"
                         class="fixed inset-0 z-[100] flex items-center justify-center bg-navy-950/90 p-4 backdrop-blur-sm sm:p-8">

                        <button type="button" @click="close()" aria-label="Close gallery"
                                class="absolute right-4 top-4 rounded-full bg-white/10 p-2.5 text-white transition-colors hover:bg-white/20 sm:right-6 sm:top-6">
                            <x-icon name="x-mark" class="w-6 h-6" />
                        </button>

                        <button type="button" @click.stop="prev()" x-show="images.length > 1" aria-label="Previous image"
                                class="absolute left-3 rounded-full bg-white/10 p-2.5 text-white transition-colors hover:bg-white/20 sm:left-6">
                            <x-icon name="chevron-left" class="w-6 h-6" />
                        </button>

                        <img :src="images[active]" :alt="'Gallery image ' + (active + 1)" @click.stop
                             class="max-h-[85vh] max-w-full rounded-xl object-contain shadow-2xl">

                        <button type="button" @click.stop="next()" x-show="images.length > 1" aria-label="Next image"
                                class="absolute right-3 rounded-full bg-white/10 p-2.5 text-white transition-colors hover:bg-white/20 sm:right-6">
                            <x-icon name="chevron-right" class="w-6 h-6" />
                        </button>

                        <div x-show="images.length > 1"
                             class="absolute bottom-5 left-1/2 -translate-x-1/2 rounded-full bg-white/10 px-4 py-1.5 text-sm font-medium text-white">
                            <span x-text="active + 1"></span> / <span x-text="images.length"></span>
                        </div>
                    </div>
                </div>
                @endif
            </article>

            {{-- Sidebar --}}
            <aside class="space-y-6">
                @if($caseStudy->pdf_file)
                <a href="{{ route('case-studies.download', $caseStudy->slug) }}"
                   class="btn-glossy-navy flex items-center gap-3 w-full text-white px-5 py-4 rounded-xl font-semibold">
                    📄 Download PDF
                </a>
                @endif

                @if($caseStudy->cta_title)
                <div class="card-glass rounded-2xl p-6">
                    <h3 class="font-heading font-bold text-white mb-3">{{ $caseStudy->cta_title }}</h3>
                    @if($caseStudy->cta_text)<p class="text-sm text-slate-300 mb-4">{{ $caseStudy->cta_text }}</p>@endif
                    <a href="{{ $caseStudy->cta_link ?? route('contact') }}"
                       class="btn-glossy block text-center text-white py-3 rounded-xl font-semibold text-sm">
                        Get Started
                    </a>
                </div>
                @endif

                @if($related->count())
                <div>
                    <h3 class="font-semibold text-navy-900 mb-4">Related Work</h3>
                    <div class="space-y-4">
                        @foreach($related as $rel)
                        <a href="{{ route('case-studies.show', $rel->slug) }}" class="flex gap-3 group">
                            @if($rel->featured_image)
                            <img src="{{ asset($rel->featured_image) }}" alt="{{ $rel->title }}" class="w-16 h-16 object-cover rounded-lg shrink-0">
                            @endif
                            <div>
                                <p class="text-sm font-medium text-navy-900 group-hover:text-teal-600 leading-snug">{{ $rel->title }}</p>
                                @if($rel->client_name)<p class="text-xs text-slate-400 mt-0.5">{{ $rel->client_name }}</p>@endif
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </aside>
        </div>
    </div>
</section>

@endsection
