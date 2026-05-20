{{-- admin/case-studies/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Case Studies')
@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-heading font-bold text-gray-900">Case Studies</h2>
    <a href="{{ route('admin.case-studies.create') }}" class="bg-teal-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-teal-700">+ New</a>
</div>
<form method="GET" class="flex flex-wrap gap-3 mb-6">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
    <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded-lg text-sm">Search</button>
    <a href="{{ route('admin.case-studies.index') }}" class="px-4 py-2 border border-gray-300 text-sm rounded-lg hover:bg-gray-50">Reset</a>
</form>
<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b"><tr>
            <th class="px-4 py-3 text-left font-semibold text-gray-700">Title</th>
            <th class="px-4 py-3 text-left font-semibold text-gray-700 hidden md:table-cell">Client</th>
            <th class="px-4 py-3 text-left font-semibold text-gray-700">Status</th>
            <th class="px-4 py-3 text-right font-semibold text-gray-700">Actions</th>
        </tr></thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($caseStudies as $cs)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3">
                    <p class="font-medium text-gray-900 truncate max-w-xs">{{ $cs->title }}</p>
                    <div class="flex gap-1 mt-0.5">
                        @if($cs->category)<span class="text-xs text-gray-400">{{ $cs->category->name }}</span>@endif
                        @if($cs->industry)<span class="text-xs text-gray-300">·</span><span class="text-xs text-gray-400">{{ $cs->industry->name }}</span>@endif
                    </div>
                </td>
                <td class="px-4 py-3 text-gray-500 hidden md:table-cell">{{ $cs->client_name ?? '—' }}</td>
                <td class="px-4 py-3">
                    <div class="flex gap-1.5 flex-wrap">
                        @if($cs->is_featured)<span class="text-xs px-2 py-0.5 bg-amber-100 text-amber-700 rounded-full">Featured</span>@endif
                        <span class="text-xs px-2 py-0.5 {{ $cs->is_published ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }} rounded-full">{{ $cs->is_published ? 'Published' : 'Draft' }}</span>
                    </div>
                </td>
                <td class="px-4 py-3 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.case-studies.edit', $cs->id) }}" class="text-xs text-teal-600 font-medium">Edit</a>
                        <form method="POST" action="{{ route('admin.case-studies.destroy', $cs->id) }}" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE') <button type="submit" class="text-xs text-red-500 font-medium">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="px-4 py-10 text-center text-gray-400">No case studies yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-5">{{ $caseStudies->links() }}</div>
@endsection
