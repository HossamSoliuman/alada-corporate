<a href="{{ route('case-studies.show', $cs->slug) }}"
   class="group block bg-white border border-slate-100 rounded-2xl overflow-hidden hover:shadow-xl hover:shadow-navy-900/10 transition-all duration-500 reveal flex flex-col">
    @if($cs->featured_image)
    <div class="aspect-[4/3] overflow-hidden">
        <img src="{{ asset($cs->featured_image) }}" alt="{{ $cs->title }}" loading="lazy"
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
    </div>
    @else
    <div class="aspect-[4/3] bg-gradient-to-br from-navy-800 to-teal-700 flex items-center justify-center">
        <x-icon name="building-office-2" class="w-12 h-12 text-white/30"/>
    </div>
    @endif
    <div class="p-6 flex-1 flex flex-col">
        <div class="flex flex-wrap gap-2 mb-3">
            @if($cs->industry)<span class="text-xs font-semibold text-teal-600 uppercase tracking-widest">{{ $cs->industry->name }}</span>@endif
            @if($cs->category)<span class="text-xs text-slate-400">· {{ $cs->category->name }}</span>@endif
        </div>
        <h3 class="font-heading text-lg text-navy-900 group-hover:text-teal-600 transition-colors leading-snug flex-1">{{ $cs->title }}</h3>
        @if($cs->client_name)<p class="mt-2 text-xs text-slate-400">{{ $cs->client_name }}</p>@endif
        <div class="mt-4 flex items-center gap-2 text-xs font-semibold text-brown-500 group-hover:gap-3 transition-all">
            View Project <x-icon name="arrow-long-right" class="w-4 h-4"/>
        </div>
    </div>
</a>
