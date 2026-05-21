@extends('layouts.admin')
@section('title', 'Hero Video')
@section('content')

<h2 class="text-xl font-heading font-bold text-gray-900 mb-6">Hero Video</h2>

@include('admin.partials.flash')

{{-- Current Video --}}
<div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
    <h3 class="font-semibold text-gray-800 mb-4">Current Video</h3>
    @if($heroVideo)
        <video controls class="w-full max-h-64 rounded-lg bg-black mb-4 object-contain">
            <source src="{{ $heroVideo->url }}" type="video/mp4">
        </video>
        <div class="flex items-center justify-between">
            <p class="text-sm text-gray-500">{{ basename($heroVideo->file_path) }}</p>
            <form method="POST" action="{{ route('admin.hero-slides.destroy', $heroVideo->id) }}" onsubmit="return confirm('Remove the hero video?')">
                @csrf @method('DELETE')
                <button type="submit" class="text-sm text-red-500 hover:text-red-700 font-medium">Remove</button>
            </form>
        </div>
    @else
        <div class="flex items-center justify-center h-40 bg-gray-50 rounded-lg border border-dashed border-gray-300">
            <p class="text-sm text-gray-400">No hero video uploaded yet. Upload one below.</p>
        </div>
    @endif
</div>

{{-- Upload / Replace --}}
<div class="bg-white rounded-xl border border-gray-200 p-6">
    <h3 class="font-semibold text-gray-800 mb-4">{{ $heroVideo ? 'Replace Video' : 'Upload Video' }}</h3>
    <form method="POST" action="{{ route('admin.hero-slides.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                Video file <span class="text-red-500">*</span>
                <span class="text-xs text-gray-500">(MP4 or WebM, max 200 MB)</span>
            </label>
            <input type="file" name="file" accept="video/mp4,video/webm" required
                   class="w-full text-sm text-gray-600 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
            @error('file')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="bg-teal-600 text-white px-6 py-2.5 rounded-lg font-semibold text-sm hover:bg-teal-700 transition-colors">
            {{ $heroVideo ? 'Replace Video' : 'Upload Video' }}
        </button>
    </form>
</div>

@endsection
