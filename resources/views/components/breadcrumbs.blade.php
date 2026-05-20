@props(['items' => []])
<nav aria-label="Breadcrumb" class="text-sm text-slate-400">
    <ol class="flex items-center flex-wrap gap-1.5">
        <li>
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
        </li>
        @foreach($items as $item)
        <li class="flex items-center gap-1.5">
            <x-icon name="chevron-right" class="w-3.5 h-3.5 text-slate-600"/>
            @if(!$loop->last && isset($item['url']))
                <a href="{{ $item['url'] }}" class="hover:text-white transition-colors">{{ $item['name'] }}</a>
            @else
                <span class="text-white font-medium">{{ $item['name'] }}</span>
            @endif
        </li>
        @endforeach
    </ol>
</nav>
