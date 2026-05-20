{{-- industries/index.blade.php --}}
@extends('layouts.app')
@section('content')
<section class="bg-navy-900 relative overflow-hidden texture text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-breadcrumbs :items="[['name'=>'Industries']]"/>
        <h1 class="text-4xl md:text-5xl font-heading font-bold mt-6 mb-4">Industries We Serve</h1>
        <p class="text-xl text-slate-300">Deep domain expertise across key sectors.</p>
    </div>
</section>
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($industries as $industry)
            <a href="{{ route('industries.show', $industry->slug) }}"
               class="group bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg border border-slate-100 hover:border-teal-200 transition-all duration-300 text-center">
                @if($industry->featured_image)
                <img src="{{ asset('storage/'.$industry->featured_image) }}" alt="{{ $industry->name }}" loading="lazy" class="w-full h-32 object-cover rounded-xl mb-4 not-prose">
                @endif
                <div class="text-3xl mb-3">{{ $industry->icon ?? '🏢' }}</div>
                <h3 class="font-semibold text-navy-900 group-hover:text-teal-600 transition-colors mb-2">{{ $industry->name }}</h3>
                @if($industry->case_studies_count ?? false)
                <p class="text-xs text-slate-400">{{ $industry->case_studies_count }} case {{ Str::plural('study', $industry->case_studies_count) }}</p>
                @endif
            </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
