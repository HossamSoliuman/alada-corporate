<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('frontend.partials.seo')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=DM+Serif+Display:ital@0;1&display=swap"
        rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: {
                            50: '#e8eef3',
                            100: '#c5d5e0',
                            200: '#9fb8c9',
                            300: '#779bb3',
                            400: '#4f7e9c',
                            500: '#2e6485',
                            600: '#1e4f6e',
                            700: '#193d55',
                            800: '#112d3f',
                            900: '#0d3041',
                            950: '#081a24'
                        },
                        teal: {
                            50: '#e6eff6',
                            100: '#c0d6e9',
                            200: '#96badb',
                            300: '#6a9dce',
                            400: '#3e7fbe',
                            500: '#19587f',
                            600: '#144a6a',
                            700: '#0f3c56',
                            800: '#092e42',
                            900: '#06212f'
                        },
                        brown: {
                            50: '#f5ede4',
                            100: '#e8d4bf',
                            200: '#dab898',
                            300: '#cc9c71',
                            400: '#bf834e',
                            500: '#8e6b51',
                            600: '#785840',
                            700: '#62462f',
                            800: '#4d3520',
                            900: '#382512'
                        },
                        slate: {
                            50: '#f4f6f7',
                            100: '#e8edef',
                            200: '#c1cfd2',
                            300: '#a0b4b9',
                            400: '#7d98a0',
                            500: '#5e7f88',
                            600: '#4a6870',
                            700: '#385159',
                            800: '#273b42',
                            900: '#18272c'
                        },
                    },
                    fontFamily: {
                        sans: ['"DM Sans"', 'ui-sans-serif', 'system-ui'],
                        heading: ['"DM Serif Display"', 'Georgia', 'serif'],
                        display: ['"Cormorant Garamond"', 'Georgia', 'serif'],
                    },
                }
            }
        }
    </script>
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        [x-cloak] {
            display: none !important;
        }

        html {
            font-family: 'DM Sans', ui-sans-serif, system-ui;
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: 'DM Serif Display', Georgia, serif;
        }

        .font-display {
            font-family: 'Cormorant Garamond', Georgia, serif;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .prose img {
            border-radius: 0.75rem;
        }

        .prose a {
            color: #19587f;
        }

        .prose h2,
        .prose h3,
        .prose h4 {
            font-family: 'DM Serif Display', Georgia, serif;
        }

        /* Reveal animations */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity .65s cubic-bezier(.16, 1, .3, 1), transform .65s cubic-bezier(.16, 1, .3, 1);
        }

        .reveal.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-left {
            opacity: 0;
            transform: translateX(-32px);
            transition: opacity .65s cubic-bezier(.16, 1, .3, 1), transform .65s cubic-bezier(.16, 1, .3, 1);
        }

        .reveal-left.is-visible {
            opacity: 1;
            transform: translateX(0);
        }

        .reveal-right {
            opacity: 0;
            transform: translateX(32px);
            transition: opacity .65s cubic-bezier(.16, 1, .3, 1), transform .65s cubic-bezier(.16, 1, .3, 1);
        }

        .reveal-right.is-visible {
            opacity: 1;
            transform: translateX(0);
        }

        .reveal-scale {
            opacity: 0;
            transform: scale(.94);
            transition: opacity .6s cubic-bezier(.16, 1, .3, 1), transform .6s cubic-bezier(.16, 1, .3, 1);
        }

        .reveal-scale.is-visible {
            opacity: 1;
            transform: scale(1);
        }

        .delay-100 {
            transition-delay: .1s;
        }

        .delay-200 {
            transition-delay: .2s;
        }

        .delay-300 {
            transition-delay: .3s;
        }

        .delay-400 {
            transition-delay: .4s;
        }

        .delay-500 {
            transition-delay: .5s;
        }

        .delay-600 {
            transition-delay: .6s;
        }

        .delay-700 {
            transition-delay: .7s;
        }

        /* Header scroll shrink */
        #site-header {
            transition: all .3s ease;
        }

        #site-header.scrolled {
            box-shadow: 0 4px 24px rgba(13, 48, 65, .13);
        }

        /* Ring pulse on logo */
        @keyframes ring-pulse {

            0%,
            100% {
                opacity: .15;
                transform: scale(1)
            }

            50% {
                opacity: .3;
                transform: scale(1.06)
            }
        }

        .ring-pulse {
            animation: ring-pulse 4s ease-in-out infinite;
        }

        /* Arrow micro-bounce */
        @keyframes arrow-nudge {

            0%,
            100% {
                transform: translateX(0)
            }

            50% {
                transform: translateX(4px)
            }
        }

        .group:hover .arrow-nudge {
            animation: arrow-nudge .5s ease-in-out;
        }

        /* Count-up */
        .count-up {
            font-family: 'Cormorant Garamond', Georgia, serif;
        }

        /* Connecting line draw */
        @keyframes draw-line {
            from {
                stroke-dashoffset: 400
            }

            to {
                stroke-dashoffset: 0
            }
        }

        .line-draw {
            stroke-dasharray: 400;
            stroke-dashoffset: 400;
        }

        .line-draw.is-visible {
            animation: draw-line 1.2s cubic-bezier(.16, 1, .3, 1) forwards;
            animation-delay: .3s;
        }

        /* Card hover */
        .service-card {
            transition: transform .3s cubic-bezier(.16, 1, .3, 1), box-shadow .3s ease;
        }

        .service-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 48px rgba(13, 48, 65, .14);
        }

        .service-card .icon-wrap {
            transition: background .3s ease, color .3s ease;
        }

        .service-card:hover .icon-wrap {
            background: #8e6b51 !important;
            color: #fff !important;
        }

        .service-card .arrow-wrap {
            opacity: 0;
            transform: translateX(-6px);
            transition: opacity .3s ease, transform .3s ease;
        }

        .service-card:hover .arrow-wrap {
            opacity: 1;
            transform: translateX(0);
        }

        /* Texture overlay */
        .texture::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
        }

        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Selection */
        ::selection {
            background: #19587f;
            color: #fff;
        }

        @media (prefers-reduced-motion:reduce) {

            .reveal,
            .reveal-left,
            .reveal-right,
            .reveal-scale {
                opacity: 1 !important;
                transform: none !important;
                transition: none !important;
            }

            .line-draw {
                stroke-dashoffset: 0 !important;
                animation: none !important;
            }
        }
    </style>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>

    @stack('styles')

    @if ($settings->get('gtm_id'))
        <script>
            (function(w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start': new Date().getTime(),
                    event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', '{{ $settings->get('gtm_id') }}');
        </script>
    @endif

    <script type="application/ld+json">{!! app(\App\Services\SeoService::class)->generateJsonLdOrganization() !!}</script>
</head>

<body class="antialiased bg-white text-navy-900" x-data>

    @if ($settings->get('gtm_id'))
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $settings->get('gtm_id') }}"
                height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif

    @include('frontend.partials.header')

    <main>
        @yield('content')
    </main>

    @include('frontend.partials.footer')
    @include('frontend.partials.whatsapp-float')

    @if ($settings->get('ga4_id'))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $settings->get('ga4_id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', '{{ $settings->get('ga4_id') }}');
        </script>
    @endif

    <script>
        (function() {
            const io = new IntersectionObserver((entries) => {
                entries.forEach(e => {
                    if (e.isIntersecting) {
                        e.target.classList.add('is-visible');
                        io.unobserve(e.target);
                    }
                });
            }, {
                threshold: 0.12
            });
            document.querySelectorAll('.reveal,.reveal-left,.reveal-right,.reveal-scale,.line-draw').forEach(el => io
                .observe(el));

            const header = document.getElementById('site-header');
            window.addEventListener('scroll', () => {
                header?.classList.toggle('scrolled', window.scrollY > 60);
            }, {
                passive: true
            });

            document.querySelectorAll('[data-count]').forEach(el => {
                const target = +el.dataset.count;
                const suffix = el.dataset.suffix || '';
                const io2 = new IntersectionObserver(entries => {
                    if (!entries[0].isIntersecting) return;
                    io2.unobserve(el);
                    let start = 0,
                        duration = 1800,
                        startTime = null;

                    function step(ts) {
                        if (!startTime) startTime = ts;
                        const progress = Math.min((ts - startTime) / duration, 1);
                        const ease = 1 - Math.pow(1 - progress, 3);
                        el.textContent = Math.round(ease * target) + suffix;
                        if (progress < 1) requestAnimationFrame(step);
                    }
                    requestAnimationFrame(step);
                }, {
                    threshold: 0.5
                });
                io2.observe(el);
            });
        })();
    </script>

    @stack('scripts')
</body>

</html>
