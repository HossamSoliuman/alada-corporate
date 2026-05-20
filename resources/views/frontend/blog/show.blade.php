@extends('layouts.app')
@section('content')

<section class="bg-navy-900 relative overflow-hidden texture py-28">
    <div class="absolute inset-0 bg-gradient-to-br from-navy-950 via-navy-900 to-teal-900/40"></div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-breadcrumbs :items="[['name'=>'Insights','url'=>route('blog.index')],['name'=>$blog->title]]"/>
        @if($blog->category)
        <a href="{{ route('blog.category', $blog->category->slug) }}" class="mt-6 inline-block text-xs font-semibold text-teal-400 uppercase tracking-widest hover:text-white transition-colors">{{ $blog->category->name }}</a>
        @endif
        <h1 class="text-4xl md:text-5xl font-heading text-white mt-3 mb-6 leading-tight">{{ $blog->title }}</h1>
        <div class="flex items-center gap-3 text-slate-400 text-sm">
            @if($blog->author)<span class="font-medium text-slate-300">{{ $blog->author->name }}</span><span>·</span>@endif
            <span>{{ $blog->published_at?->format('M d, Y') }}</span>
            <span>·</span>
            <span>{{ $blog->reading_time }} min read</span>
        </div>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-12">
            <article class="lg:col-span-2 reveal-left">
                @if($blog->featured_image)
                <img src="{{ asset('storage/'.$blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full rounded-2xl mb-8 shadow-sm aspect-video object-cover">
                @endif
                <div class="prose prose-slate prose-lg max-w-none">{!! $blog->content !!}</div>
                @if($blog->tags->count())
                <div class="mt-8 flex flex-wrap gap-2">
                    @foreach($blog->tags as $tag)
                    <a href="{{ route('blog.tag', $tag->slug) }}" class="text-xs px-3 py-1.5 rounded-full bg-teal-50 text-teal-700 hover:bg-teal-100 transition-colors font-medium">{{ $tag->name }}</a>
                    @endforeach
                </div>
                @endif
            </article>

            <aside class="space-y-6 reveal-right">
                <div class="bg-navy-900 rounded-2xl p-6 text-white">
                    <h3 class="font-heading text-lg mb-3">Discuss a Project</h3>
                    <p class="text-sm text-slate-400 mb-5">Speak with Alada's engineering team about your infrastructure needs.</p>
                    <a href="{{ route('contact') }}" class="block text-center bg-brown-500 hover:bg-brown-400 text-white py-3 rounded-xl text-sm font-semibold transition-colors">Contact Alada</a>
                </div>
                @if($related->count())
                <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                    <h3 class="font-semibold text-navy-900 mb-4 text-sm">Related Articles</h3>
                    <div class="space-y-4">
                        @foreach($related as $rel)
                        <a href="{{ route('blog.show', $rel->slug) }}" class="flex gap-3 group">
                            @if($rel->featured_image)
                            <img src="{{ asset('storage/'.$rel->featured_image) }}" alt="{{ $rel->title }}" class="w-16 h-16 object-cover rounded-xl shrink-0">
                            @endif
                            <div>
                                <p class="text-sm font-medium text-navy-900 group-hover:text-teal-600 leading-snug transition-colors">{{ $rel->title }}</p>
                                <p class="text-xs text-slate-400 mt-1">{{ $rel->published_at?->format('M d, Y') }}</p>
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
