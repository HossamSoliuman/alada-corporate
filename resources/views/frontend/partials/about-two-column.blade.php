{{-- Two-column intro band: left = text, right = image. Expects $sec (sections array) + $page. --}}
@if(($sec['intro_heading'] ?? '') || ($sec['intro_body'] ?? '') || ($sec['side_image'] ?? ''))
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="reveal-left">
                @if($sec['intro_label'] ?? '')
                <p class="text-xs font-semibold uppercase tracking-widest text-teal-600 mb-4">{{ $sec['intro_label'] }}</p>
                @endif
                @if($sec['intro_heading'] ?? '')
                <h2 class="text-3xl md:text-4xl font-heading text-navy-900 mb-6 leading-snug">{{ $sec['intro_heading'] }}</h2>
                @endif
                @if($sec['intro_body'] ?? '')
                <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed space-y-4">
                    @foreach(preg_split('/\r\n\r\n|\n\n/', trim($sec['intro_body'])) as $para)
                    <p>{{ $para }}</p>
                    @endforeach
                </div>
                @endif
            </div>
            <div class="reveal-right">
                @if($sec['side_image'] ?? '')
                <div class="rounded-3xl overflow-hidden shadow-xl shadow-navy-900/10">
                    <img src="{{ asset($sec['side_image']) }}" alt="{{ $page->title }}" class="w-full h-full object-cover" loading="lazy">
                </div>
                @else
                <div class="rounded-3xl aspect-[4/3] bg-gradient-to-br from-navy-900 to-teal-900 flex items-center justify-center">
                    <x-icon name="building-office-2" class="w-20 h-20 text-white/30"/>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endif
