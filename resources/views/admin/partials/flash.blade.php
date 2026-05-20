{{-- admin/partials/flash.blade.php --}}
@if(session('success'))
<div class="mb-6 bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3 text-sm flex items-center justify-between"
     x-data x-init="setTimeout(() => $el.remove(), 5000)">
    <span>✓ {{ session('success') }}</span>
    <button @click="$el.remove()" class="text-green-600 hover:text-green-800">✕</button>
</div>
@endif

@if(session('error'))
<div class="mb-6 bg-red-50 border border-red-200 text-red-800 rounded-lg px-4 py-3 text-sm">
    ✕ {{ session('error') }}
</div>
@endif

@if($errors->any())
<div class="mb-6 bg-red-50 border border-red-200 text-red-800 rounded-lg px-4 py-3 text-sm">
    <p class="font-medium mb-2">Please fix the following errors:</p>
    <ul class="list-disc list-inside space-y-1">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
