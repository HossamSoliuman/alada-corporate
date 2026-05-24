{{-- admin/blog/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Blog Posts')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-heading font-bold text-gray-900">Blog Posts</h2>
    <a href="{{ route('admin.blogs.create') }}" class="bg-teal-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-teal-700 transition-colors">+ New Post</a>
</div>

{{-- Filters --}}
<form method="GET" class="flex flex-wrap gap-3 mb-6">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
    <select name="category" class="px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
        <option value="">All Categories</option>
        @foreach($categories as $cat)
        <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
        @endforeach
    </select>
    <select name="status" class="px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
        <option value="">All Status</option>
        <option value="published" @selected(request('status') === 'published')>Published</option>
        <option value="draft" @selected(request('status') === 'draft')>Draft</option>
    </select>
    <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded-lg text-sm">Filter</button>
    <a href="{{ route('admin.blogs.index') }}" class="px-4 py-2 border border-gray-300 text-sm rounded-lg hover:bg-gray-50">Reset</a>
</form>

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-4 py-3 text-left font-semibold text-gray-700">Title</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-700 hidden md:table-cell">Category</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-700 hidden lg:table-cell">Author</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-700">Status</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-700 hidden lg:table-cell">Date</th>
                <th class="px-4 py-3 text-right font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($blogs as $blog)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-4 py-3">
                    <div class="flex items-center gap-3">
                        @if($blog->featured_image)
                        <img src="{{ asset($blog->featured_image) }}" alt="" class="w-10 h-10 rounded-lg object-cover hidden sm:block">
                        @endif
                        <div>
                            <p class="font-medium text-gray-900 truncate max-w-xs">{{ $blog->title }}</p>
                            @if($blog->is_featured)<span class="text-xs text-amber-600">★ Featured</span>@endif
                        </div>
                    </div>
                </td>
                <td class="px-4 py-3 text-gray-600 hidden md:table-cell">{{ $blog->category?->name ?? '—' }}</td>
                <td class="px-4 py-3 text-gray-600 hidden lg:table-cell">{{ $blog->author?->name ?? '—' }}</td>
                <td class="px-4 py-3">
                    <form method="POST" action="{{ route('admin.blogs.toggle-publish', $blog->id) }}">
                        @csrf
                        <button type="submit"
                                class="text-xs px-2.5 py-1 rounded-full font-medium {{ $blog->is_published ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }} hover:opacity-80 transition-opacity">
                            {{ $blog->is_published ? 'Published' : 'Draft' }}
                        </button>
                    </form>
                </td>
                <td class="px-4 py-3 text-gray-500 text-xs hidden lg:table-cell">{{ $blog->published_at?->format('M d, Y') ?? 'Not set' }}</td>
                <td class="px-4 py-3 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="text-xs text-teal-600 hover:text-navy-800 font-medium">Edit</a>
                        <form method="POST" action="{{ route('admin.blogs.destroy', $blog->id) }}" onsubmit="return confirm('Delete this post?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-medium">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-4 py-10 text-center text-gray-400">No blog posts yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-5">{{ $blogs->links() }}</div>

@endsection
