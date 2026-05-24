<footer class="bg-navy-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 py-20 border-b border-white/10">

            <div class="lg:col-span-1">
                <img src="{{ asset('images/alada-logo.png') }}" alt="Alada" class="h-14 w-auto mb-5 brightness-0 invert opacity-90">
                <p class="font-display italic text-slate-300 text-lg mb-2">Growing With Time</p>
                <p class="text-slate-400 text-sm leading-relaxed mb-6">Global engineering, infrastructure & energy solutions delivered with U.S. standards and worldwide reach.</p>

                <div class="flex gap-3">
                    @foreach(['linkedin','twitter','facebook','instagram'] as $s)
                    @if($settings->get("social_{$s}"))
                    <a href="{{ $settings->get("social_{$s}") }}" target="_blank" rel="noopener"
                       class="w-9 h-9 rounded-lg bg-white/10 hover:bg-teal-600 flex items-center justify-center transition-all duration-200 group">
                        @if($s === 'linkedin')
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        @elseif($s === 'twitter')
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        @else
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        @endif
                    </a>
                    @endif
                    @endforeach
                </div>
            </div>

            <div>
                <h4 class="text-xs font-semibold uppercase tracking-widest text-slate-400 mb-5">Expertise</h4>
                <ul class="space-y-2.5">
                    @foreach($footerServices as $svc)
                    <li>
                        <a href="{{ route('expertise.show',$svc->slug) }}"
                           class="text-sm text-slate-300 hover:text-white transition-colors flex items-center gap-2 group">
                            <span class="w-1 h-1 rounded-full bg-teal-500 group-hover:bg-brown-400 transition-colors"></span>
                            {{ $svc->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h4 class="text-xs font-semibold uppercase tracking-widest text-slate-400 mb-5">Company</h4>
                <ul class="space-y-2.5">
                    @foreach([['about','About Alada'],['expertise.index','Our Expertise'],['case-studies.index','Projects'],['blog.index','Insights'],['contact','Contact Us'],['page.show','Careers']] as $link)
                    <li>
                        <a href="{{ $link[0] === 'page.show' ? route($link[0], 'careers') : route($link[0]) }}"
                           class="text-sm text-slate-300 hover:text-white transition-colors flex items-center gap-2 group">
                            <span class="w-1 h-1 rounded-full bg-teal-500 group-hover:bg-brown-400 transition-colors"></span>
                            {{ $link[1] }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h4 class="text-xs font-semibold uppercase tracking-widest text-slate-400 mb-5">Offices</h4>
                <div class="space-y-5 text-sm text-slate-300">
                    <div>
                        <p class="font-semibold text-white mb-1.5">USA Headquarters</p>
                        @if($settings->get('address'))
                        <p class="leading-relaxed">{{ $settings->get('address') }}</p>
                        @else
                        <p class="leading-relaxed">United States</p>
                        @endif
                    </div>
                    <div>
                        <p class="font-semibold text-white mb-1.5">India Engineering Center</p>
                        <p class="leading-relaxed">India</p>
                    </div>
                    @if($settings->get('phone'))
                    <a href="tel:{{ $settings->get('phone') }}" class="flex items-center gap-2 hover:text-white transition-colors">
                        <x-icon name="phone" class="w-4 h-4 text-teal-500 shrink-0"/>
                        {{ $settings->get('phone') }}
                    </a>
                    @endif
                    @if($settings->get('contact_email'))
                    <a href="mailto:{{ $settings->get('contact_email') }}" class="flex items-center gap-2 hover:text-white transition-colors">
                        <x-icon name="envelope" class="w-4 h-4 text-teal-500 shrink-0"/>
                        {{ $settings->get('contact_email') }}
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-center gap-4 py-6">
            <p class="text-slate-500 text-xs">
                {!! $settings->get('footer_text', '© '.date('Y').' Alada. All rights reserved.') !!}
            </p>
            <div class="flex gap-5 text-xs text-slate-500">
                <a href="{{ route('page.show', 'privacy-policy') }}" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="{{ route('page.show', 'terms-conditions') }}" class="hover:text-white transition-colors">Terms</a>
                <a href="{{ route('sitemap') }}" class="hover:text-white transition-colors">Sitemap</a>
            </div>
        </div>
    </div>
</footer>
