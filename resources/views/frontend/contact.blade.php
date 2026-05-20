@extends('layouts.app')
@section('content')

<section class="bg-navy-900 relative overflow-hidden texture py-28">
    <div class="absolute inset-0 bg-gradient-to-br from-navy-950 via-navy-900 to-teal-900/40"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-breadcrumbs :items="[['name'=>'Contact Us']]"/>
        <div class="mt-8">
            <p class="text-xs font-semibold uppercase tracking-widest text-teal-400 mb-4">Get in Touch</p>
            <h1 class="text-5xl md:text-6xl font-heading text-white leading-tight mb-4">Let's Build<br><em class="font-display not-italic text-brown-300">Something Together</em></h1>
            <p class="text-lg text-slate-300">Tell us about your project and our global engineering team will be in touch.</p>
        </div>
    </div>
</section>

<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-12">

            <div class="space-y-6 reveal-left">
                <div>
                    <h2 class="text-2xl font-heading text-navy-900 mb-6">Contact Information</h2>
                    <div class="space-y-4">
                        @foreach([['map-pin','USA Headquarters',$settings->get('address','United States')],['building-office','India Engineering Center','India'],['envelope','Email',$settings->get('contact_email','info@alada.com')],['phone','Phone',$settings->get('phone','—')]] as [$icon,$label,$val])
                        <div class="flex gap-4">
                            <div class="w-10 h-10 bg-teal-50 rounded-xl flex items-center justify-center text-teal-600 shrink-0">
                                <x-icon name="{{ $icon }}" class="w-5 h-5"/>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide">{{ $label }}</p>
                                <p class="text-sm text-navy-800 mt-0.5">{{ $val }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-navy-900 rounded-2xl p-6 text-white">
                    <p class="font-display italic text-lg text-slate-300 mb-2">"Growing With Time"</p>
                    <p class="text-sm text-slate-400">Alada delivers engineering excellence with U.S. standards across every continent.</p>
                </div>
            </div>

            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 p-8 md:p-10 reveal-right">
                <h2 class="text-2xl font-heading text-navy-900 mb-8">Send a Message</h2>
                @include('frontend.partials.contact-form')
            </div>
        </div>
    </div>
</section>

@endsection
