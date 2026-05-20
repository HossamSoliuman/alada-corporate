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
                <img src="{{ asset('storage/'.$caseStudy->featured_image) }}" alt="{{ $caseStudy->title }}"
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
                <div>
                    <h2 class="text-2xl font-heading font-bold text-navy-900 mb-6">Gallery</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($caseStudy->gallery as $img)
                        <img src="{{ asset('storage/'.$img) }}" alt="Gallery" loading="lazy" class="rounded-xl w-full h-40 object-cover">
                        @endforeach
                    </div>
                </div>
                @endif
            </article>

            {{-- Sidebar --}}
            <aside class="space-y-6">
                @if($caseStudy->pdf_file)
                <a href="{{ route('case-studies.download', $caseStudy->slug) }}"
                   class="flex items-center gap-3 w-full bg-teal-600 text-white px-5 py-4 rounded-xl font-semibold hover:bg-navy-900 transition-colors">
                    📄 Download PDF
                </a>
                @endif

                @if($caseStudy->cta_title)
                <div class="bg-teal-50 border border-primary-100 rounded-2xl p-6">
                    <h3 class="font-heading font-bold text-navy-900 mb-3">{{ $caseStudy->cta_title }}</h3>
                    @if($caseStudy->cta_text)<p class="text-sm text-slate-600 mb-4">{{ $caseStudy->cta_text }}</p>@endif
                    <a href="{{ $caseStudy->cta_link ?? route('contact') }}"
                       class="block text-center bg-teal-600 text-white py-3 rounded-xl font-semibold hover:bg-navy-900 transition-colors text-sm">
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
                            <img src="{{ asset('storage/'.$rel->featured_image) }}" alt="{{ $rel->title }}" class="w-16 h-16 object-cover rounded-lg shrink-0">
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
