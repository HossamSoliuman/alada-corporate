{{-- admin/pages/edit.blade.php --}}
@extends('layouts.admin')
@section('title', 'Edit Page: '.$page->title)
@section('content')
<div class="mb-6"><a href="{{ route('admin.pages.index') }}" class="text-sm text-teal-600 hover:underline">← Back to Pages</a></div>

<form method="POST" action="{{ route('admin.pages.update', $page->id) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <div class="xl:col-span-2 space-y-5">
            <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Title</label>
                    <input type="text" name="title" value="{{ old('title', $page->title) }}" required
                           class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Subtitle</label>
                    <input type="text" name="subtitle" value="{{ old('subtitle', $page->subtitle) }}"
                           class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Content</label>
                    <textarea name="content" id="page-content" rows="14"
                              class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">{{ old('content', $page->content) }}</textarea>
                </div>
            </div>
            @include('admin.partials.seo-fields', ['model' => $page])
        </div>

        <div class="space-y-5">
            <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $page->is_published)) class="text-teal-600 rounded">
                    <span class="text-sm font-medium text-gray-700">Published</span>
                </label>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Featured Image</label>
                    <input type="file" name="featured_image" accept="image/*" class="text-sm text-gray-600 w-full">
                    @if($page->featured_image)
                    <img src="{{ asset('storage/'.$page->featured_image) }}" class="mt-2 w-full h-32 object-cover rounded-lg">
                    @endif
                </div>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="flex-1 bg-teal-600 text-white py-2.5 px-5 rounded-lg font-semibold hover:bg-teal-700 transition-colors text-sm">Save Page</button>
                <a href="{{ route('admin.pages.index') }}" class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-lg text-sm hover:bg-gray-50 transition-colors">Cancel</a>
            </div>
        </div>
    </div>
</form>
@endsection
