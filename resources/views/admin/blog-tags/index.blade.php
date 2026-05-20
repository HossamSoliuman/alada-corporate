{{-- admin/blog-tags/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Blog Tags')
@section('content')
<div class="flex items-start gap-8">
    {{-- Tag list --}}
    <div class="flex-1">
        <h2 class="text-xl font-heading font-bold text-gray-900 mb-6">Blog Tags</h2>
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b"><tr>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Name</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Slug</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Posts</th>
                    <th class="px-4 py-3 text-right font-semibold text-gray-700">Actions</th>
                </tr></thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($tags as $tag)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $tag->name }}</td>
                        <td class="px-4 py-3 text-gray-400 font-mono text-xs">{{ $tag->slug }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $tag->blogs_count }}</td>
                        <td class="px-4 py-3 text-right">
                            <form method="POST" action="{{ route('admin.blog-tags.destroy', $tag->id) }}" onsubmit="return confirm('Delete tag?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-medium">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="px-4 py-10 text-center text-gray-400">No tags yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $tags->links() }}</div>
    </div>

    {{-- Quick add form --}}
    <div class="w-72 shrink-0">
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="font-semibold text-gray-800 mb-4">Add New Tag</h3>
            <form method="POST" action="{{ route('admin.blog-tags.store') }}">
                @csrf
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Tag name" required
                       class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 mb-3">
                @error('name')<p class="text-xs text-red-600 mb-2">{{ $message }}</p>@enderror
                <button type="submit" class="w-full bg-teal-600 text-white py-2.5 rounded-lg text-sm font-semibold hover:bg-teal-700">Add Tag</button>
            </form>
        </div>
    </div>
</div>
@endsection
