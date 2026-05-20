{{-- admin/leads/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Leads')
@section('content')

<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-heading font-bold text-gray-900">Leads</h2>
    <a href="{{ route('admin.leads.export') }}{{ request()->getQueryString() ? '?'.request()->getQueryString() : '' }}"
       class="bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-800 transition-colors">
        ↓ Export CSV
    </a>
</div>

<form method="GET" class="flex flex-wrap gap-3 mb-6">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Name or email..."
           class="px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
    <select name="type" class="px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
        <option value="">All Types</option>
        @foreach(['contact','inquiry','service_inquiry','callback'] as $t)
        <option value="{{ $t }}" @selected(request('type') === $t)>{{ ucfirst(str_replace('_',' ',$t)) }}</option>
        @endforeach
    </select>
    <select name="status" class="px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
        <option value="">All Status</option>
        @foreach(['new','contacted','qualified','converted','archived'] as $s)
        <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
        @endforeach
    </select>
    <input type="date" name="from" value="{{ request('from') }}" class="px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
    <input type="date" name="to" value="{{ request('to') }}" class="px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
    <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded-lg text-sm">Filter</button>
    <a href="{{ route('admin.leads.index') }}" class="px-4 py-2 border border-gray-300 text-sm rounded-lg hover:bg-gray-50">Reset</a>
</form>

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-4 py-3 text-left font-semibold text-gray-700">Name</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-700 hidden md:table-cell">Type</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-700">Status</th>
                <th class="px-4 py-3 text-left font-semibold text-gray-700 hidden lg:table-cell">Date</th>
                <th class="px-4 py-3 text-right font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($leads as $lead)
            <tr class="{{ !$lead->read_at ? 'bg-blue-50/30' : '' }} hover:bg-gray-50 transition-colors">
                <td class="px-4 py-3">
                    <p class="font-medium text-gray-900 flex items-center gap-2">
                        @if(!$lead->read_at)<span class="w-2 h-2 bg-blue-500 rounded-full shrink-0"></span>@endif
                        {{ $lead->name }}
                    </p>
                    <p class="text-xs text-gray-400">{{ $lead->email }}</p>
                </td>
                <td class="px-4 py-3 text-gray-600 hidden md:table-cell">
                    <span class="text-xs px-2 py-0.5 bg-gray-100 rounded-full">{{ ucfirst(str_replace('_',' ',$lead->form_type)) }}</span>
                </td>
                <td class="px-4 py-3">
                    @php $colors = ['new'=>'blue','contacted'=>'yellow','qualified'=>'purple','converted'=>'green','archived'=>'gray']; @endphp
                    <span class="text-xs px-2 py-0.5 rounded-full bg-{{ $colors[$lead->status] ?? 'gray' }}-100 text-{{ $colors[$lead->status] ?? 'gray' }}-700 font-medium">
                        {{ ucfirst($lead->status) }}
                    </span>
                </td>
                <td class="px-4 py-3 text-gray-500 text-xs hidden lg:table-cell">{{ $lead->created_at->format('M d, Y H:i') }}</td>
                <td class="px-4 py-3 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.leads.show', $lead->id) }}" class="text-xs text-teal-600 hover:text-navy-800 font-medium">View</a>
                        <form method="POST" action="{{ route('admin.leads.destroy', $lead->id) }}" onsubmit="return confirm('Delete this lead?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-medium">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-4 py-10 text-center text-gray-400">No leads found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-5">{{ $leads->links() }}</div>

@endsection
