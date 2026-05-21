{{-- admin/hero-slides/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Hero Slides')
@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-heading font-bold text-gray-900">Hero Slides</h2>
    <a href="{{ route('admin.hero-slides.create') }}" class="bg-teal-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-teal-700">+ New Slide</a>
</div>
<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-4 py-3 text-left font-semibold text-gray-700">Preview</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-700">Title / Type</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-700 hidden md:table-cell">Order</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-700">Status</th>
                <th class="px-4 py-3 text-right font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($slides as $slide)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3">
                    @if($slide->type === 'image')
                    <img src="{{ $slide->url }}" alt="{{ $slide->title }}" class="w-16 h-10 object-cover rounded">
                    @else
                    <div class="w-16 h-10 bg-gray-200 rounded flex items-center justify-center text-xs text-gray-600">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                    </div>
                    @endif
                </td>
                <td class="px-4 py-3">
                    <p class="font-medium text-gray-900">{{ $slide->title ?? '(Untitled)' }}</p>
                    <p class="text-xs text-gray-500 mt-0.5">{{ ucfirst($slide->type) }}</p>
                </td>
                <td class="px-4 py-3 text-gray-500 hidden md:table-cell">{{ $slide->sort_order }}</td>
                <td class="px-4 py-3">
                    <form action="{{ route('admin.hero-slides.toggle', $slide->id) }}" method="POST" class="inline">
                        @csrf @method('PATCH')
                        <button type="submit" class="text-xs px-2 py-0.5 {{ $slide->is_active ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }} rounded-full cursor-pointer transition-colors">
                            {{ $slide->is_active ? 'Active' : 'Inactive' }}
                        </button>
                    </form>
                </td>
                <td class="px-4 py-3 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.hero-slides.edit', $slide->id) }}" class="text-xs text-teal-600 hover:text-navy-800 font-medium">Edit</a>
                        <form method="POST" action="{{ route('admin.hero-slides.destroy', $slide->id) }}" onsubmit="return confirm('Delete this slide?')" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-medium">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-4 py-10 text-center text-gray-400">No hero slides yet. <a href="{{ route('admin.hero-slides.create') }}" class="text-teal-600 hover:underline">Create one</a></td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-5">{{ $slides->links() }}</div>
@endsection
