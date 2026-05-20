{{-- admin/pages/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Pages')
@section('content')
<h2 class="text-xl font-heading font-bold text-gray-900 mb-6">Pages</h2>
<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-4 py-3 text-left font-semibold text-gray-700">Page</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-700">Slug</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-700">Status</th>
                <th class="px-4 py-3 text-right font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($pages as $page)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 font-medium text-gray-900">{{ $page->title }}</td>
                <td class="px-4 py-3 text-gray-500 font-mono text-xs">/{{ $page->slug }}</td>
                <td class="px-4 py-3">
                    <span class="text-xs px-2.5 py-1 rounded-full {{ $page->is_published ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                        {{ $page->is_published ? 'Published' : 'Draft' }}
                    </span>
                </td>
                <td class="px-4 py-3 text-right">
                    <a href="{{ route('admin.pages.edit', $page->id) }}" class="text-xs text-teal-600 hover:text-navy-800 font-medium">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
