{{-- emails/leads/new-admin.blade.php --}}
@component('mail::message')
# New Lead Received

You have a new **{{ ucfirst(str_replace('_',' ',$lead->form_type)) }}** submission.

@component('mail::panel')
**Name:** {{ $lead->name }}
**Email:** {{ $lead->email }}
@if($lead->phone)**Phone:** {{ $lead->phone }}@endif
@if($lead->company)**Company:** {{ $lead->company }}@endif
@if($lead->subject)**Subject:** {{ $lead->subject }}@endif

**Message:**
{{ $lead->message }}
@endcomponent

@component('mail::button', ['url' => route('admin.leads.show', $lead->id), 'color' => 'primary'])
View Lead in Admin
@endcomponent

Received at: {{ $lead->created_at->format('M d, Y H:i') }}

Thanks,
{{ config('app.name') }}
@endcomponent
