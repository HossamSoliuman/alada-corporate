@extends('layouts.app')

@section('content')

{{-- ═══ HERO ═══ --}}
<section class="bg-navy-900 relative overflow-hidden texture py-32">
    <div class="absolute inset-0">
        <img src="https://images.pexels.com/photos/1216589/pexels-photo-1216589.jpeg?auto=compress&cs=tinysrgb&w=1600"
             alt="" class="w-full h-full object-cover opacity-20">
        <div class="absolute inset-0 bg-gradient-to-r from-navy-950/95 via-navy-900/80 to-navy-900/60"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-breadcrumbs :items="[['name'=>'Careers']]"/>
        <div class="mt-8 max-w-3xl">
            <p class="text-xs font-semibold uppercase tracking-widest text-teal-400 mb-4">Join Our Team</p>
            <h1 class="text-5xl md:text-6xl font-heading text-white leading-tight mb-6">
                Build the World's<br><em class="font-display not-italic text-brown-300">Infrastructure</em>
            </h1>
            <p class="text-lg text-slate-300 leading-relaxed max-w-2xl mb-8">
                We bring together exceptional engineers, designers, and project leaders to deliver infrastructure that shapes communities, industries, and economies across five continents. If you're driven by precision, scale, and global impact — you belong here.
            </p>
            <div class="flex flex-wrap gap-4">
                <div class="flex items-center gap-2 bg-white/10 border border-white/20 rounded-full px-4 py-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-teal-400"></span>
                    <span class="text-sm text-slate-200">Remote & On-site Roles</span>
                </div>
                <div class="flex items-center gap-2 bg-white/10 border border-white/20 rounded-full px-4 py-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-teal-400"></span>
                    <span class="text-sm text-slate-200">Global Opportunities</span>
                </div>
                <div class="flex items-center gap-2 bg-white/10 border border-white/20 rounded-full px-4 py-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-teal-400"></span>
                    <span class="text-sm text-slate-200">All Experience Levels</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══ WHY ALADA ═══ --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 reveal">
            <p class="text-xs font-semibold uppercase tracking-widest text-teal-600 mb-4">Why Alada</p>
            <h2 class="text-4xl font-heading text-navy-900 mb-4">Grow Your Career at<br><em class="font-display not-italic text-brown-500">Global Scale</em></h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['globe-alt',       'Global Projects',       'Work on landmark infrastructure projects across the Americas, Europe, Middle East, Asia, and Oceania.'],
                ['academic-cap',    'Continuous Learning',   'Structured mentorship, technical training, and access to the latest engineering tools and methodologies.'],
                ['users',           'Diverse Team',          'Collaborate with a high-performing, multi-disciplinary team of civil, structural, and digital engineers.'],
                ['arrow-trending-up','Career Progression',   'Clear growth paths from graduate to principal level, with leadership opportunities in a fast-scaling firm.'],
            ] as [$icon, $title, $desc])
            <div class="bg-slate-50 rounded-2xl p-7 border border-slate-100 hover:border-teal-200 hover:shadow-lg transition-all duration-300 reveal">
                <div class="w-12 h-12 rounded-xl bg-teal-50 flex items-center justify-center text-teal-600 mb-5">
                    <x-icon name="{{ $icon }}" class="w-6 h-6"/>
                </div>
                <h3 class="font-heading text-lg text-navy-900 mb-2">{{ $title }}</h3>
                <p class="text-sm text-slate-500 leading-relaxed">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ OPEN POSITIONS ═══ --}}
<section class="py-20 bg-slate-50"
         x-data="{
             activeFilter: 'all',
             jobs: {{ Js::from($jobs) }},
             get filtered() {
                 if (this.activeFilter === 'all') return this.jobs;
                 return this.jobs.filter(j => j.category === this.activeFilter);
             }
         }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-12 reveal">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-teal-600 mb-4">Open Positions</p>
                <h2 class="text-4xl font-heading text-navy-900">Current <em class="font-display not-italic text-brown-500">Opportunities</em></h2>
            </div>
            <div class="flex flex-wrap gap-2">
                @foreach($categories as $key => $label)
                <button @click="activeFilter = '{{ $key }}'"
                        :class="activeFilter === '{{ $key }}'
                            ? 'bg-navy-900 text-white border-navy-900'
                            : 'bg-white text-navy-700 border-slate-200 hover:border-teal-400 hover:text-teal-600'"
                        class="px-4 py-2 rounded-full text-xs font-semibold border transition-all duration-200">
                    {{ $label }}
                </button>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <template x-for="job in filtered" :key="job.id">
                <div class="group bg-white border border-slate-100 rounded-2xl overflow-hidden hover:shadow-xl hover:shadow-navy-900/10 transition-all duration-500">
                    <div class="aspect-[16/9] overflow-hidden relative">
                        <img :src="job.image" :alt="job.title"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-navy-950/60 to-transparent"></div>
                        <span class="absolute bottom-3 left-4 text-xs font-semibold text-white bg-teal-600/90 backdrop-blur-sm px-3 py-1 rounded-full"
                              x-text="job.label"></span>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-xs font-semibold text-teal-600 uppercase tracking-wide" x-text="job.location"></span>
                            <span class="text-slate-300">·</span>
                            <span class="text-xs text-slate-500" x-text="job.type"></span>
                        </div>
                        <h3 class="font-heading text-lg text-navy-900 group-hover:text-teal-600 transition-colors leading-snug mb-2" x-text="job.title"></h3>
                        <p class="text-sm text-slate-500 leading-relaxed mb-5" x-text="job.description"></p>
                        <a :href="job.applyUrl"
                           class="inline-flex items-center gap-2 text-xs font-semibold text-teal-600 hover:text-navy-900 transition-colors group/link">
                            View Role
                            <svg class="w-4 h-4 transition-transform group-hover/link:translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </template>
        </div>

        <div x-show="filtered.length === 0" class="text-center py-20">
            <p class="text-slate-400 text-lg">No open positions in this category right now.</p>
            <p class="text-slate-500 text-sm mt-2">Check back soon or send us your CV for future opportunities.</p>
        </div>
    </div>
</section>

{{-- ═══ SPONTANEOUS APPLICATION ═══ --}}
<section class="py-24 bg-navy-900 relative overflow-hidden texture">
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center reveal">
        <p class="text-xs font-semibold uppercase tracking-widest text-teal-400 mb-5">Don't See Your Role?</p>
        <h2 class="text-4xl md:text-5xl font-heading text-white mb-6">Send Us Your<br><em class="font-display not-italic text-brown-300">Profile</em></h2>
        <p class="text-slate-400 text-lg mb-10 max-w-2xl mx-auto">We're always looking for talented engineers and project leaders. Send your CV and tell us about your expertise — we'll be in touch when the right opportunity arises.</p>
        <a href="{{ route('contact') }}"
           class="group inline-flex items-center gap-3 bg-brown-500 hover:bg-brown-400 text-white font-semibold px-10 py-4 rounded-xl transition-all duration-300 shadow-lg shadow-brown-900/30">
            Submit Your CV
            <x-icon name="arrow-long-right" class="w-5 h-5 arrow-nudge"/>
        </a>
    </div>
</section>

@endsection
