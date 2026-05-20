{{-- admin/blog-categories/create.blade.php --}}
@extends('layouts.admin')
@section('title', 'New Blog Category')
@section('content')
<div class="mb-6"><a href="{{ route('admin.blog-categories.index') }}" class="text-sm text-teal-600 hover:underline">← Back</a></div>
<form method="POST" action="{{ route('admin.blog-categories.store') }}">
    @csrf
    <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4 max-w-lg">
        <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Name</label><input type="text" name="name" value="{{ old('name') }}" required class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Description</label><textarea name="description" rows="3" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-none">{{ old('description') }}</textarea></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Order</label><input type="number" name="order" value="{{ old('order', 0) }}" min="0" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500"></div>
        <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" name="is_active" value="1" checked class="text-teal-600 rounded"><span class="text-sm font-medium text-gray-700">Active</span></label>
        <div class="flex gap-3 pt-2"><button type="submit" class="bg-teal-600 text-white py-2.5 px-6 rounded-lg text-sm font-semibold hover:bg-teal-700">Save</button><a href="{{ route('admin.blog-categories.index') }}" class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg text-sm hover:bg-gray-50">Cancel</a></div>
    </div>
</form>
@endsection
