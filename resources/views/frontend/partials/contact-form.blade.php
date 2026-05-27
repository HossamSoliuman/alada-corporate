<form method="POST" action="{{ route('contact.submit') }}" class="space-y-5">
    @csrf

    @if(session('success'))
    <div class="bg-teal-50 border border-teal-200 text-teal-800 rounded-xl p-4 text-sm flex items-center gap-2">
        <x-icon name="check-circle" class="w-5 h-5 text-teal-500 shrink-0"/>
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
        <div>
            <label for="name" class="block text-sm font-medium text-slate-200 mb-1.5">Full Name <span class="text-brown-500">*</span></label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                   class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-white text-navy-900 text-sm focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition @error('name') border-red-400 @enderror">
            @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-slate-200 mb-1.5">Email Address <span class="text-brown-500">*</span></label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                   class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-white text-navy-900 text-sm focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition @error('email') border-red-400 @enderror">
            @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
        <div>
            <label for="phone" class="block text-sm font-medium text-slate-200 mb-1.5">Phone Number</label>
            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                   class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-white text-navy-900 text-sm focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition">
        </div>
        <div>
            <label for="company" class="block text-sm font-medium text-slate-200 mb-1.5">Company</label>
            <input type="text" id="company" name="company" value="{{ old('company') }}"
                   class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-white text-navy-900 text-sm focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition">
        </div>
    </div>

    <div>
        <label for="subject" class="block text-sm font-medium text-slate-200 mb-1.5">Subject</label>
        <input type="text" id="subject" name="subject" value="{{ old('subject') }}"
               class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-white text-navy-900 text-sm focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition">
    </div>

    <div>
        <label for="message" class="block text-sm font-medium text-slate-200 mb-1.5">Message <span class="text-brown-500">*</span></label>
        <textarea id="message" name="message" rows="5" required
                  class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-white text-navy-900 text-sm focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition resize-none @error('message') border-red-400 @enderror">{{ old('message') }}</textarea>
        @error('message')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        {!! NoCaptcha::display() !!}
        @error('g-recaptcha-response')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
    </div>

    <button type="submit"
            class="btn-glossy w-full font-semibold py-4 px-8 text-sm flex items-center justify-center gap-2 group">
        Send Message
        <x-icon name="arrow-long-right" class="w-4 h-4 arrow-nudge"/>
    </button>
</form>

@push('scripts')
{!! NoCaptcha::renderJs() !!}
@endpush
