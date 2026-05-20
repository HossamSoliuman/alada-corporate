{{-- admin/leads/show.blade.php --}}
@extends('layouts.admin')
@section('title', 'Lead #'.$lead->id)
@section('content')

<div class="mb-6"><a href="{{ route('admin.leads.index') }}" class="text-sm text-teal-600 hover:underline">← Back to Leads</a></div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200 p-6 space-y-6">
        <div class="flex items-start justify-between">
            <div>
                <h2 class="text-xl font-heading font-bold text-gray-900">{{ $lead->name }}</h2>
                <p class="text-sm text-gray-500 mt-0.5">{{ $lead->email }} @if($lead->phone)· {{ $lead->phone }}@endif</p>
            </div>
            <span class="text-xs px-3 py-1.5 rounded-full bg-blue-100 text-blue-700 font-medium">{{ ucfirst(str_replace('_',' ',$lead->form_type)) }}</span>
        </div>

        @if($lead->company)
        <div><p class="text-xs font-semibold text-gray-500 uppercase mb-1">Company</p><p class="text-gray-800">{{ $lead->company }}</p></div>
        @endif
        @if($lead->subject)
        <div><p class="text-xs font-semibold text-gray-500 uppercase mb-1">Subject</p><p class="text-gray-800">{{ $lead->subject }}</p></div>
        @endif
        <div><p class="text-xs font-semibold text-gray-500 uppercase mb-1">Message</p><p class="text-gray-800 whitespace-pre-line">{{ $lead->message }}</p></div>
        @if($lead->service)
        <div><p class="text-xs font-semibold text-gray-500 uppercase mb-1">Service Inquiry</p><p class="text-gray-800">{{ $lead->service->name }}</p></div>
        @endif
        @if($lead->source_url)
        <div><p class="text-xs font-semibold text-gray-500 uppercase mb-1">Source URL</p><p class="text-xs text-gray-500 break-all">{{ $lead->source_url }}</p></div>
        @endif
    </div>

    <div class="space-y-5">
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="font-semibold text-gray-800 mb-4">Update Status</h3>
            <form method="POST" action="{{ route('admin.leads.update', $lead->id) }}">
                @csrf @method('PUT')
                <div class="space-y-4">
                    <select name="status" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                        @foreach(['new','contacted','qualified','converted','archived'] as $s)
                        <option value="{{ $s }}" @selected($lead->status === $s)>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                    <textarea name="notes" rows="4" placeholder="Internal notes..."
                              class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-none">{{ $lead->notes }}</textarea>
                    <button type="submit" class="w-full bg-teal-600 text-white py-2.5 rounded-lg text-sm font-semibold hover:bg-teal-700 transition-colors">Save Changes</button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-6 text-sm text-gray-600 space-y-2">
            <p><span class="font-medium text-gray-800">Received:</span> {{ $lead->created_at->format('M d, Y H:i') }}</p>
            <p><span class="font-medium text-gray-800">Read at:</span> {{ $lead->read_at?->format('M d, Y H:i') ?? 'Not read' }}</p>
            <p><span class="font-medium text-gray-800">IP:</span> {{ $lead->ip_address ?? '—' }}</p>
        </div>
    </div>
</div>

@endsection
