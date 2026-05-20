{{-- admin/blog-categories/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Blog Categories')
@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-heading font-bold text-gray-900">Blog Categories</h2>
    <a href="{{ route('admin.blog-categories.create') }}" class="bg-teal-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-teal-700">+ New</a>
</div>
<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b"><tr>
            <th class="px-4 py-3 text-left font-semibold text-gray-700">Name</th>
            <th class="px-4 py-3 text-left font-semibold text-gray-700">Posts</th>
            <th class="px-4 py-3 text-left font-semibold text-gray-700">Status</th>
            <th class="px-4 py-3 text-right font-semibold text-gray-700">Actions</th>
        </tr></thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($categories as $cat)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 font-medium text-gray-900">{{ $cat->name }}</td>
                <td class="px-4 py-3 text-gray-500">{{ $cat->blogs_count }}</td>
                <td class="px-4 py-3"><span class="text-xs px-2 py-0.5 {{ $cat->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }} rounded-full">{{ $cat->is_active ? 'Active' : 'Inactive' }}</span></td>
                <td class="px-4 py-3 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.blog-categories.edit', $cat->id) }}" class="text-xs text-teal-600 font-medium">Edit</a>
                        <form method="POST" action="{{ route('admin.blog-categories.destroy', $cat->id) }}" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs text-red-500 font-medium">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="px-4 py-10 text-center text-gray-400">No categories.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-5">{{ $categories->links() }}</div>
@endsection
