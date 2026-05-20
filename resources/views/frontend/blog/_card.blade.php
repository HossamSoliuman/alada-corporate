@php $delay = $delay ?? 0; @endphp
<a href="{{ route('blog.show', $blog->slug) }}"
   class="group flex flex-col bg-white border border-slate-100 rounded-2xl overflow-hidden hover:shadow-xl hover:shadow-navy-900/8 hover:border-slate-200 transition-all duration-500 reveal"
   style="transition-delay: {{ $delay }}ms">
    @if($blog->featured_image)
    <div class="aspect-[16/9] overflow-hidden">
        <img src="{{ asset('storage/'.$blog->featured_image) }}" alt="{{ $blog->title }}" loading="lazy"
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
    </div>
    @else
    <div class="aspect-[16/9] bg-gradient-to-br from-navy-800 to-teal-700"></div>
    @endif
    <div class="p-6 flex flex-col flex-1">
        @if($blog->category)
        <span class="text-xs font-semibold text-teal-600 uppercase tracking-widest mb-3">{{ $blog->category->name }}</span>
        @endif
        <h3 class="font-heading text-lg text-navy-900 group-hover:text-teal-600 transition-colors leading-snug flex-1 mb-3">{{ $blog->title }}</h3>
        @if($blog->excerpt)
        <p class="text-sm text-slate-500 line-clamp-2 mb-4">{{ $blog->excerpt }}</p>
        @endif
        <div class="flex items-center justify-between text-xs text-slate-400 pt-3 border-t border-slate-50">
            <div class="flex items-center gap-1.5">
                @if($blog->author)<span>{{ $blog->author->name }}</span><span>·</span>@endif
                <span>{{ $blog->published_at?->format('M d, Y') }}</span>
            </div>
            <span>{{ $blog->reading_time }} min read</span>
        </div>
    </div>
</a>
