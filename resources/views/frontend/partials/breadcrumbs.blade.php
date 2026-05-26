@props(['items' => []])
<nav aria-label="Breadcrumb" class="text-sm text-gray-500">
    <ol class="flex items-center flex-wrap gap-1.5">
        <li>
            <a href="{{ route('home') }}" class="hover:text-brown-500 transition-colors">Home</a>
        </li>
        @foreach($items as $item)
        <li class="flex items-center gap-1.5">
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            @if(!$loop->last && isset($item['url']))
                <a href="{{ $item['url'] }}" class="hover:text-brown-500 transition-colors">{{ $item['name'] }}</a>
            @else
                <span class="text-gray-800 font-medium">{{ $item['name'] }}</span>
            @endif
        </li>
        @endforeach
    </ol>
</nav>
