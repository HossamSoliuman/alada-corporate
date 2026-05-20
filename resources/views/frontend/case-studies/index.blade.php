@extends('layouts.app')
@section('content')

<section class="bg-navy-900 relative overflow-hidden texture text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-breadcrumbs :items="[['name'=>'Case Studies']]"/>
        <h1 class="text-4xl md:text-5xl font-heading font-bold mt-6 mb-4">Case Studies</h1>
        <p class="text-xl text-slate-300">Real-world results from our client engagements.</p>
    </div>
</section>

<section class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-10">

            {{-- Sidebar filters --}}
            <aside class="w-full lg:w-64 shrink-0">
                <form method="GET" action="{{ route('case-studies.index') }}" class="space-y-6">
                    @if(request()->hasAny(['category','industry']))
                    <a href="{{ route('case-studies.index') }}" class="text-xs text-teal-600 hover:underline">Clear filters</a>
                    @endif

                    <div>
                        <h3 class="font-semibold text-navy-800 mb-3 text-sm uppercase tracking-wide">Category</h3>
                        <div class="space-y-2">
                            @foreach($categories as $cat)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="category" value="{{ $cat->slug }}"
                                       @checked(request('category') === $cat->slug)
                                       class="text-teal-600" onchange="this.form.submit()">
                                <span class="text-sm text-gray-700">{{ $cat->name }}</span>
                                <span class="ml-auto text-xs text-slate-400">{{ $cat->case_studies_count }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h3 class="font-semibold text-navy-800 mb-3 text-sm uppercase tracking-wide">Industry</h3>
                        <div class="space-y-2">
                            @foreach($industries as $ind)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="industry" value="{{ $ind->slug }}"
                                       @checked(request('industry') === $ind->slug)
                                       class="text-teal-600" onchange="this.form.submit()">
                                <span class="text-sm text-gray-700">{{ $ind->name }}</span>
                                <span class="ml-auto text-xs text-slate-400">{{ $ind->case_studies_count }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </form>
            </aside>

            {{-- Grid --}}
            <div class="flex-1">
                @if($caseStudies->count())
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                    @foreach($caseStudies as $cs)
                    @include('frontend.case-studies._card', ['cs' => $cs])
                    @endforeach
                </div>
                <div class="mt-10">{{ $caseStudies->links() }}</div>
                @else
                <div class="text-center py-20">
                    <p class="text-slate-500 text-lg">No case studies found. Try adjusting your filters.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
