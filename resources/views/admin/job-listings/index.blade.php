{{-- admin/job-listings/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Careers')
@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-heading font-bold text-gray-900">Careers — Job Positions</h2>
    <a href="{{ route('admin.job-listings.create') }}" class="bg-teal-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-teal-700">+ New Position</a>
</div>
<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-4 py-3 text-left font-semibold text-gray-700">Position</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-700 hidden md:table-cell">Location</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-700 hidden md:table-cell">Type</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-700 hidden md:table-cell">Order</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-700">Status</th>
                <th class="px-4 py-3 text-right font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($jobs as $job)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 font-medium text-gray-900">{{ $job->position_name }}</td>
                <td class="px-4 py-3 text-gray-500 hidden md:table-cell">{{ $job->location }}</td>
                <td class="px-4 py-3 text-gray-500 hidden md:table-cell">{{ $job->employment_type === 'full-time' ? 'Full-time' : 'Part-time' }}</td>
                <td class="px-4 py-3 text-gray-500 hidden md:table-cell">{{ $job->order }}</td>
                <td class="px-4 py-3">
                    <span class="text-xs px-2 py-0.5 {{ $job->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }} rounded-full">
                        {{ $job->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td class="px-4 py-3 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.job-listings.edit', $job->id) }}" class="text-xs text-teal-600 hover:text-navy-800 font-medium">Edit</a>
                        <form method="POST" action="{{ route('admin.job-listings.destroy', $job->id) }}" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-medium">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-4 py-10 text-center text-gray-400">No job listings yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-5">{{ $jobs->links() }}</div>
@endsection
