{{-- blog/tag.blade.php --}}
@extends('layouts.app')
@section('content')
<section class="bg-navy-900 relative overflow-hidden texture text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-breadcrumbs :items="[['name'=>'Insights','url'=>route('insights.index')],['name'=>'#'.$tag->name]]"/>
        <h1 class="text-4xl font-heading font-bold mt-6 mb-4">#{{ $tag->name }}</h1>
    </div>
</section>
<section class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($blogs->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($blogs as $blog)
            @include('frontend.insights._card', ['blog' => $blog])
            @endforeach
        </div>
        <div class="mt-10">{{ $blogs->links() }}</div>
        @else
        <p class="text-center text-slate-500 py-16">No posts with this tag yet.</p>
        @endif
    </div>
</section>
@endsection
