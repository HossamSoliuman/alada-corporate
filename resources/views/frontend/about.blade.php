@extends('layouts.app')
@section('content')

<section class="bg-navy-900 relative overflow-hidden texture py-32">
    <div class="absolute inset-0 bg-gradient-to-br from-navy-950 via-navy-900 to-teal-900/40"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-breadcrumbs :items="[['name' => 'About Us']]"/>
        <div class="mt-8 max-w-3xl">
            <p class="text-xs font-semibold uppercase tracking-widest text-teal-400 mb-4">Who We Are</p>
            <h1 class="text-5xl md:text-6xl font-heading text-white leading-tight mb-6">About <em class="font-display not-italic text-brown-300">Alada</em></h1>
            <p class="text-xl text-slate-300 leading-relaxed">A globally integrated, multi-disciplinary engineering and infrastructure consultancy — established in the United States, delivering worldwide.</p>
        </div>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-start">
            <div class="reveal-left">
                <p class="text-xs font-semibold uppercase tracking-widest text-teal-600 mb-4">Our Story</p>
                <h2 class="text-3xl md:text-4xl font-heading text-navy-900 mb-6">Built for Complex,<br>High-Performance Projects</h2>
                <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed space-y-4">
                    <p>Alada is built to deliver complex, high-performance infrastructure, industrial, and energy projects — leveraging a unique combination of U.S. engineering standards, advanced digital engineering methodologies, and globally distributed execution capabilities.</p>
                    <p>The organization operates across the complete project lifecycle: feasibility studies, conceptual design, detailed engineering, BIM-based coordination, construction documentation, and project management. This integrated approach ensures seamless coordination between all project stakeholders, reducing risks, delays, and inefficiencies.</p>
                </div>
            </div>
            <div class="reveal-right space-y-4">
                @foreach([['U.S. Engineering Standards','Every project benchmarked against international quality frameworks'],['Advanced Digital Methodologies','BIM, simulation and digital engineering tools throughout'],['Global Delivery Network','Offices in USA and India, projects across five continents'],['Complete Lifecycle Coverage','Feasibility through construction supervision in a single team']] as [$t,$d])
                <div class="flex gap-4 p-5 bg-slate-50 rounded-2xl border border-slate-100 hover:border-teal-200 transition-colors">
                    <div class="w-10 h-10 rounded-xl bg-teal-600 flex items-center justify-center text-white shrink-0">
                        <x-icon name="check-circle" class="w-5 h-5"/>
                    </div>
                    <div>
                        <h4 class="font-semibold text-navy-900 mb-1">{{ $t }}</h4>
                        <p class="text-sm text-slate-500">{{ $d }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12">
            <div class="bg-navy-900 rounded-3xl p-10 text-white reveal-left">
                <div class="w-12 h-12 rounded-xl bg-teal-600/30 flex items-center justify-center text-teal-400 mb-6">
                    <x-icon name="sparkles" class="w-6 h-6"/>
                </div>
                <h2 class="text-xs font-semibold uppercase tracking-widest text-teal-400 mb-3">Our Vision</h2>
                <p class="font-heading text-2xl md:text-3xl text-white leading-snug mb-4">"To be recognized as a global leader in delivering innovative, sustainable, and technology-driven engineering solutions."</p>
                <p class="text-slate-400 text-sm leading-relaxed">Shaping the infrastructure of the future through engineering excellence and digital innovation.</p>
            </div>
            <div class="bg-brown-500 rounded-3xl p-10 text-white reveal-right">
                <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center text-white mb-6">
                    <x-icon name="chart-bar" class="w-6 h-6"/>
                </div>
                <h2 class="text-xs font-semibold uppercase tracking-widest text-brown-100 mb-3">Our Mission</h2>
                <p class="font-heading text-xl text-white leading-snug mb-5">Engineering excellence through innovation, efficiency and global infrastructure development.</p>
                <ul class="space-y-2.5 text-sm text-brown-100">
                    @foreach(['Adopting advanced BIM and digital simulation technologies','Delivering efficient and sustainable infrastructure solutions','Ensuring cost optimisation and high-quality delivery','Supporting global infrastructure development through innovation'] as $item)
                    <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-white mt-1.5 shrink-0"></span>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 reveal">
            <p class="text-xs font-semibold uppercase tracking-widest text-teal-600 mb-4">Our Offices</p>
            <h2 class="text-3xl md:text-4xl font-heading text-navy-900">Two Hubs,<br><em class="font-display not-italic text-brown-500">One Standard</em></h2>
        </div>
        <div class="grid md:grid-cols-2 gap-8 max-w-3xl mx-auto">
            @foreach([['USA Headquarters','Strategy, client engagement, commercial and project leadership. All projects scoped and managed to U.S. engineering standards.','map-pin'],['India Engineering Center','Full engineering design, BIM coordination, CAD production, and technical delivery. Operates as a fully owned and integrated office.','building-office']] as $i => [$title,$desc,$icon])
            <div class="text-center p-8 bg-slate-50 rounded-3xl border border-slate-100 reveal" style="transition-delay:{{ $i*150 }}ms">
                <div class="w-14 h-14 mx-auto rounded-2xl bg-navy-900 flex items-center justify-center text-white mb-5">
                    <x-icon name="{{ $icon }}" class="w-7 h-7"/>
                </div>
                <h3 class="font-heading text-xl text-navy-900 mb-3">{{ $title }}</h3>
                <p class="text-sm text-slate-500 leading-relaxed">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-20 bg-navy-900 texture relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-navy-950/80 to-transparent"></div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center reveal">
        <p class="font-display italic text-5xl md:text-6xl text-white leading-tight mb-8">"Alada represents the next generation of engineering firms — delivering innovative, sustainable, and globally integrated infrastructure solutions."</p>
        <a href="{{ route('contact') }}" class="inline-flex items-center gap-3 bg-brown-500 hover:bg-brown-400 text-white font-semibold px-10 py-4 rounded-xl transition-all duration-300 text-lg group">
            Work With Us
            <x-icon name="arrow-long-right" class="w-5 h-5 arrow-nudge"/>
        </a>
    </div>
</section>

@endsection
