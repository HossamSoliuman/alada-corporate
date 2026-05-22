@extends('layouts.app')
@section('content')

<section class="bg-navy-900 relative overflow-hidden texture text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-heading font-bold mb-4">{{ $page->title }}</h1>
        @if($page->subtitle)<p class="text-xl text-slate-300">{{ $page->subtitle }}</p>@endif
    </div>
</section>

<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($page->content)
        <div class="space-y-4 text-gray-700 text-base leading-relaxed">
            @foreach(array_filter(explode("\n\n", $page->content)) as $paragraph)
            <p>{!! nl2br(e(trim($paragraph))) !!}</p>
            @endforeach
        </div>
        @endif

        @if($page->sections)
            @foreach($page->sections as $section)
            <div class="mt-12">
                @if(!empty($section['title']))<h2 class="text-2xl font-heading font-bold text-navy-900 mb-4">{{ $section['title'] }}</h2>@endif
                @if(!empty($section['content']))<div class="prose prose-headings:font-heading prose-headings:text-navy-900 prose-a:text-teal-600 max-w-none">{!! $section['content'] !!}</div>@endif
            </div>
            @endforeach
        @endif
    </div>
</section>

@endsection
