{{-- industries/show.blade.php --}}
@extends('layouts.app')
@section('content')
<section class="bg-navy-900 relative overflow-hidden texture text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-breadcrumbs :items="[['name'=>'Industries'],['name'=>$industry->name]]"/>
        <h1 class="text-4xl md:text-5xl font-heading font-bold mt-6 mb-4">{{ $industry->name }}</h1>
        @if($industry->description)<p class="text-xl text-slate-300">{{ $industry->description }}</p>@endif
    </div>
</section>
<section class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($caseStudies->count())
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($caseStudies as $cs)
            @include('frontend.case-studies._card', ['cs' => $cs])
            @endforeach
        </div>
        {{ $caseStudies->links() }}
        @else
        <p class="text-center text-slate-500 py-12">No case studies yet for this industry.</p>
        @endif
    </div>
</section>
@endsection
