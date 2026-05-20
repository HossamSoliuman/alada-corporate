{{-- admin/settings/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Settings')
@section('content')

<h2 class="text-xl font-heading font-bold text-gray-900 mb-6">Site Settings</h2>

<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" x-data="{ tab: 'general' }">
    @csrf @method('PUT')

    {{-- Tabs --}}
    <div class="flex gap-1 mb-6 bg-gray-100 p-1 rounded-xl w-fit">
        @foreach(['general','contact','social','analytics'] as $t)
        <button type="button" @click="tab='{{ $t }}'"
                :class="tab==='{{ $t }}' ? 'bg-white shadow text-gray-900' : 'text-gray-500 hover:text-gray-700'"
                class="px-4 py-2 rounded-lg text-sm font-medium transition-all capitalize">{{ $t }}</button>
        @endforeach
    </div>

    {{-- General --}}
    <div x-show="tab==='general'" class="bg-white rounded-xl border border-gray-200 p-6 space-y-5">
        <h3 class="font-semibold text-gray-800 pb-3 border-b border-gray-100">General</h3>
        @foreach([
            ['site_name','Site Name','text'],
            ['site_tagline','Site Tagline','text'],
            ['meta_description','Default Meta Description','textarea'],
            ['footer_text','Footer Text','textarea'],
        ] as [$key, $label, $type])
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ $label }}</label>
            @if($type === 'textarea')
            <textarea name="{{ $key }}" rows="3" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-none">{{ old($key, $settings->get($key)?->value) }}</textarea>
            @else
            <input type="text" name="{{ $key }}" value="{{ old($key, $settings->get($key)?->value) }}"
                   class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
            @endif
        </div>
        @endforeach
    </div>

    {{-- Contact --}}
    <div x-show="tab==='contact'" x-cloak class="bg-white rounded-xl border border-gray-200 p-6 space-y-5">
        <h3 class="font-semibold text-gray-800 pb-3 border-b border-gray-100">Contact Information</h3>
        @foreach([
            ['contact_email','Contact Email'],
            ['phone','Phone'],
            ['whatsapp_number','WhatsApp Number'],
            ['address','Address'],
        ] as [$key, $label])
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ $label }}</label>
            <input type="text" name="{{ $key }}" value="{{ old($key, $settings->get($key)?->value) }}"
                   class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
        </div>
        @endforeach
    </div>

    {{-- Social --}}
    <div x-show="tab==='social'" x-cloak class="bg-white rounded-xl border border-gray-200 p-6 space-y-5">
        <h3 class="font-semibold text-gray-800 pb-3 border-b border-gray-100">Social Media</h3>
        @foreach(['facebook','twitter','linkedin','instagram','youtube'] as $social)
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5 capitalize">{{ $social }}</label>
            <input type="url" name="social_{{ $social }}" value="{{ old('social_'.$social, $settings->get('social_'.$social)?->value) }}"
                   class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500"
                   placeholder="https://{{ $social }}.com/yourpage">
        </div>
        @endforeach
    </div>

    {{-- Analytics --}}
    <div x-show="tab==='analytics'" x-cloak class="bg-white rounded-xl border border-gray-200 p-6 space-y-5">
        <h3 class="font-semibold text-gray-800 pb-3 border-b border-gray-100">Analytics & Tracking</h3>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Google Analytics 4 ID</label>
            <input type="text" name="ga4_id" value="{{ old('ga4_id', $settings->get('ga4_id')?->value) }}"
                   class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500"
                   placeholder="G-XXXXXXXXXX">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Google Tag Manager ID</label>
            <input type="text" name="gtm_id" value="{{ old('gtm_id', $settings->get('gtm_id')?->value) }}"
                   class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500"
                   placeholder="GTM-XXXXXXX">
        </div>
    </div>

    <div class="mt-6">
        <button type="submit" class="bg-teal-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-teal-700 transition-colors">Save All Settings</button>
    </div>
</form>

@endsection
