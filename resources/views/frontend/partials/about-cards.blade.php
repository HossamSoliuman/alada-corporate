{{-- Full-width cards grid (4 per row): image + heading + description. Expects $cards + optional $cardsHeading/$cardsLabel. --}}
@if($cards->count())
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(!empty($cardsHeading ?? '') || !empty($cardsLabel ?? ''))
        <div class="text-center mb-14 reveal">
            @if(!empty($cardsLabel ?? ''))
            <p class="text-xs font-semibold uppercase tracking-widest text-teal-600 mb-4">{{ $cardsLabel }}</p>
            @endif
            @if(!empty($cardsHeading ?? ''))
            <h2 class="text-3xl md:text-4xl font-heading text-navy-900">{{ $cardsHeading }}</h2>
            @endif
        </div>
        @endif
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($cards as $i => $card)
            <div class="bg-white rounded-2xl overflow-hidden border border-slate-100 service-card reveal" style="transition-delay: {{ ($i % 4) * 100 }}ms">
                @if($card->image)
                <div class="aspect-[4/3] overflow-hidden bg-slate-100">
                    <img src="{{ asset($card->image) }}" alt="{{ $card->title }}" class="w-full h-full object-cover" loading="lazy">
                </div>
                @else
                <div class="aspect-[4/3] bg-gradient-to-br from-navy-900 to-teal-900 flex items-center justify-center">
                    <span class="font-display text-5xl text-white/40">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                </div>
                @endif
                <div class="p-6">
                    <h3 class="font-heading text-lg text-navy-900 font-semibold mb-2 leading-snug">{{ $card->title }}</h3>
                    @if($card->description)
                    <p class="text-sm text-slate-500 leading-relaxed">{{ $card->description }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
