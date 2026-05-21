@extends('layouts.admin')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <h1 class="text-3xl font-bold text-gray-900">Edit Hero Slide</h1>
    <a href="{{ route('admin.hero-slides.index') }}" class="text-teal-600 hover:text-teal-700 font-semibold">← Back</a>
</div>

<form action="{{ route('admin.hero-slides.update', $heroSlide) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.hero-slides._form', ['slide' => $heroSlide])
</form>
@endsection
