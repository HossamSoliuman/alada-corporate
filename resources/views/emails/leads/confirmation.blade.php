{{-- emails/leads/confirmation.blade.php --}}
@component('mail::message')
# Thank You, {{ $lead->name }}!

We've received your message and a member of our team will be in touch with you shortly.

@component('mail::panel')
**Your message:**
{{ $lead->message }}
@endcomponent

In the meantime, feel free to explore our work:

@component('mail::button', ['url' => route('case-studies.index'), 'color' => 'primary'])
View Our Case Studies
@endcomponent

Warm regards,
{{ config('app.name') }} Team
@endcomponent
