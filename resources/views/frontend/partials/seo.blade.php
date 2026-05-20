{{-- resources/views/frontend/partials/seo.blade.php --}}
@php
    $seoData = $seo ?? $defaultSeo ?? [];
    $title       = $seoData['title']       ?? config('app.name');
    $description = $seoData['description'] ?? '';
    $keywords    = $seoData['keywords']    ?? '';
    $canonical   = $seoData['canonical']   ?? url()->current();
    $ogTitle     = $seoData['og_title']    ?? $title;
    $ogDesc      = $seoData['og_description'] ?? $description;
    $ogImage     = $seoData['og_image']    ?? '';
    $robots      = $seoData['robots']      ?? 'index,follow';
    $schemaJson  = $seoData['schema_json'] ?? null;
@endphp

<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
@if($keywords)
<meta name="keywords" content="{{ $keywords }}">
@endif
<meta name="robots" content="{{ $robots }}">
<link rel="canonical" href="{{ $canonical }}">

{{-- Open Graph --}}
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $ogTitle }}">
<meta property="og:description" content="{{ $ogDesc }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:site_name" content="{{ $seoData['site_name'] ?? config('app.name') }}">
@if($ogImage)
<meta property="og:image" content="{{ Str::startsWith($ogImage, 'http') ? $ogImage : asset('storage/'.$ogImage) }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
@endif

{{-- Twitter Card --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seoData['twitter_title'] ?? $ogTitle }}">
<meta name="twitter:description" content="{{ $seoData['twitter_description'] ?? $ogDesc }}">
@if($ogImage)
<meta name="twitter:image" content="{{ Str::startsWith($ogImage, 'http') ? $ogImage : asset('storage/'.$ogImage) }}">
@endif

{{-- Custom Schema --}}
@if($schemaJson)
<script type="application/ld+json">{!! is_array($schemaJson) ? json_encode($schemaJson) : $schemaJson !!}</script>
@endif
