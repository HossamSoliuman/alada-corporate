{{-- admin/expertise/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Expertise')
@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-heading font-bold text-gray-900">Expertise</h2>
    <a href="{{ route('admin.expertise.create') }}" class="bg-teal-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-teal-700">+ New Expertise</a>
</div>
<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-4 py-3 text-left font-semibold text-gray-700">Name</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-700 hidden md:table-cell">Order</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-700">Status</th>
                <th class="px-4 py-3 text-right font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($services as $service)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3">
                    <p class="font-medium text-gray-900">{{ $service->name }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ Str::limit($service->short_description, 60) }}</p>
                </td>
                <td class="px-4 py-3 text-gray-500 hidden md:table-cell">{{ $service->order }}</td>
                <td class="px-4 py-3">
                    <div class="flex gap-2">
                        @if($service->is_featured)<span class="text-xs px-2 py-0.5 bg-amber-100 text-amber-700 rounded-full">Featured</span>@endif
                        <span class="text-xs px-2 py-0.5 {{ $service->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }} rounded-full">{{ $service->is_active ? 'Active' : 'Inactive' }}</span>
                    </div>
                </td>
                <td class="px-4 py-3 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.expertise.edit', ['expertise' => $service->id]) }}" class="text-xs text-teal-600 hover:text-navy-800 font-medium">Edit</a>
                        <form method="POST" action="{{ route('admin.expertise.destroy', ['expertise' => $service->id]) }}" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-medium">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="px-4 py-10 text-center text-gray-400">No expertise yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-5">{{ $services->links() }}</div>
@endsection
