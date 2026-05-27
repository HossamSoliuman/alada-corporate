@extends('layouts.app')
@section('content')

<section class="bg-navy-900 relative overflow-hidden texture py-28">
    <div class="absolute inset-0 bg-gradient-to-br from-navy-950 via-navy-900 to-teal-900/40"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-breadcrumbs :items="[['name'=>'Insights']]"/>
        <div class="mt-8">
            <p class="text-xs font-semibold uppercase tracking-widest text-teal-400 mb-4">Knowledge Hub</p>
            <h1 class="text-5xl md:text-6xl font-heading text-white leading-tight mb-4">Engineering <em class="font-display not-italic text-brown-300">Insights</em></h1>
            <p class="text-lg text-slate-300">Ideas, updates, and expertise from Alada's engineering teams worldwide.</p>
        </div>
    </div>
</section>

<section class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-10">

            <aside class="w-full lg:w-64 shrink-0 space-y-6 reveal-left">
                <form method="GET" action="{{ route('insights.index') }}">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Search articles..."
                               class="w-full pl-4 pr-10 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-teal-500 outline-none bg-white">
                        <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-teal-600 transition-colors">
                            <x-icon name="arrow-long-right" class="w-4 h-4"/>
                        </button>
                    </div>
                </form>

                <div class="card-glass rounded-2xl p-5">
                    <h3 class="text-xs font-semibold uppercase tracking-widest text-slate-400 mb-4">Categories</h3>
                    <div class="space-y-1">
                        <a href="{{ route('insights.index') }}" class="block px-3 py-2 rounded-lg text-sm {{ !request('category') ? 'bg-white/10 text-white font-semibold' : 'text-slate-300 hover:bg-white/5' }} transition-colors">
                            All Posts
                        </a>
                        @foreach($categories as $cat)
                        <a href="{{ route('insights.category', $cat->slug) }}"
                           class="flex items-center justify-between px-3 py-2 rounded-lg text-sm {{ request('category') === $cat->slug ? 'bg-white/10 text-white font-semibold' : 'text-slate-300 hover:bg-white/5' }} transition-colors">
                            <span>{{ $cat->name }}</span>
                            <span class="text-xs text-slate-300 bg-white/10 px-1.5 py-0.5 rounded-full">{{ $cat->blogs_count }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>

                @if($latestTags->count())
                <div class="card-glass rounded-2xl p-5">
                    <h3 class="text-xs font-semibold uppercase tracking-widest text-slate-400 mb-4">Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($latestTags as $tag)
                        <a href="{{ route('insights.tag', $tag->slug) }}"
                           class="text-xs px-3 py-1.5 rounded-full border border-white/15 text-slate-300 hover:border-brown-400 hover:text-brown-200 hover:bg-white/10 transition-all">
                            {{ $tag->name }}
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </aside>

            <div class="flex-1">
                @if($blogs->count())
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($blogs as $i => $blog)
                    @include('frontend.insights._card', ['blog' => $blog, 'delay' => $i * 60])
                    @endforeach
                </div>
                <div class="mt-10">{{ $blogs->links() }}</div>
                @else
                <div class="text-center py-20 card-glass rounded-2xl">
                    <x-icon name="pencil-square" class="w-12 h-12 text-slate-500 mx-auto mb-3"/>
                    <p class="text-slate-300">No articles found.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
