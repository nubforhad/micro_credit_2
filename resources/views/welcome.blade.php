<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>আস্থা মাইক্রোফাইন্যান্স</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Tiro+Bangla&family=Hind+Siliguri:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
            <script>
                tailwind.config = {
                    darkMode: 'class',
                    theme: {
                        extend: {
                            colors: {
                                kraft:   '#E9DFC3',
                                kraft2:  '#DED0A9',
                                cream:   '#FBF7EC',
                                indigo:  '#1B2A4A',
                                indigo2: '#122036',
                                brass:   '#A6832E',
                                brassdk: '#7C611F',
                                rust:    '#B23A2E',
                            },
                            fontFamily: {
                                display: ['"Tiro Bangla"', 'serif'],
                                body: ['"Hind Siliguri"', 'sans-serif'],
                                mono: ['"IBM Plex Mono"', 'monospace'],
                            },
                        },
                    },
                }
            </script>
            <style>
                body { font-family: 'Hind Siliguri', sans-serif; }
                .font-display { font-family: 'Tiro Bangla', serif; }
                .font-mono-num { font-family: 'IBM Plex Mono', monospace; }

                /* ── Noise texture ── */
                .noise-bg { position: relative; }
                .noise-bg::before {
                    content: '';
                    position: absolute;
                    inset: 0;
                    opacity: 0.025;
                    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
                    pointer-events: none;
                    z-index: 0;
                }

                /* ── Glass nav ── */
                .glass-nav {
                    background: rgba(251, 247, 236, 0.72);
                    backdrop-filter: blur(20px) saturate(1.4);
                    -webkit-backdrop-filter: blur(20px) saturate(1.4);
                }

                /* ── Animations ── */
                @keyframes float-a {
                    0%, 100% { transform: translateY(0) rotate(0deg); }
                    50% { transform: translateY(-14px) rotate(2deg); }
                }
                @keyframes float-b {
                    0%, 100% { transform: translateY(0) rotate(0deg); }
                    50% { transform: translateY(-9px) rotate(-1.5deg); }
                }
                @keyframes ring-breathe {
                    0%, 100% { transform: scale(1); opacity: 0.35; }
                    50% { transform: scale(1.04); opacity: 0.18; }
                }
                @keyframes dash-flow {
                    to { stroke-dashoffset: -20; }
                }
                @keyframes glow-pulse {
                    0%, 100% { opacity: 0.06; }
                    50% { opacity: 0.12; }
                }
                @keyframes scale-blob {
                    0%, 100% { transform: scale(1); }
                    50% { transform: scale(1.8); }
                }

                .float-a { animation: float-a 6s ease-in-out infinite; }
                .float-b { animation: float-b 8s ease-in-out infinite; }
                .ring-breathe { animation: ring-breathe 4s ease-in-out infinite; }
                .dash-flow { animation: dash-flow 2s linear infinite; }
                .glow-pulse { animation: glow-pulse 5s ease-in-out infinite; }
                .scale-blob { animation: scale-blob 0.6s ease-out forwards; }

                /* ── Animation delay utilities ── */
                .ad-200  { animation-delay: -0.2s; }
                .ad-300  { animation-delay: -0.3s; }
                .ad-500  { animation-delay: -0.5s; }
                .ad-600  { animation-delay: -0.6s; }
                .ad-1000 { animation-delay: -1s; }
                .ad-1200 { animation-delay: -1.2s; }
                .ad-1300 { animation-delay: -1.3s; }
                .ad-1500 { animation-delay: -1.5s; }
                .ad-1800 { animation-delay: -1.8s; }
                .ad-2000 { animation-delay: -2s; }
                .ad-2500 { animation-delay: -2.5s; }
                .ad-3000 { animation-delay: -3s; }
                .ad-3500 { animation-delay: -3.5s; }
                .ad-4000 { animation-delay: -4s; }
                .ad-5000 { animation-delay: -5s; }

                /* ── Hover blob scale (initially 1, hover → 1.8) ── */
                .blob-scale {
                    transform: scale(1);
                    transition: transform 0.5s ease-out;
                }
                .group:hover .blob-scale {
                    transform: scale(1.8);
                }

                /* ── Textures ── */
                .diag-stripes {
                    background-image: repeating-linear-gradient(
                        -45deg, transparent, transparent 8px,
                        rgba(166,131,46,0.06) 8px, rgba(166,131,46,0.06) 9px
                    );
                }
                .dot-grid {
                    background-image: radial-gradient(circle, #1B2A4A 0.5px, transparent 0.5px);
                    background-size: 22px 22px;
                }

                /* ── Reduced motion ── */
                @media (prefers-reduced-motion: reduce) {
                    *, *::before, *::after {
                        transition-duration: 0.01ms !important;
                        animation-duration: 0.01ms !important;
                    }
                }
            </style>
        @endif
    </head>
    <body class="font-body antialiased bg-cream text-indigo overflow-x-hidden">

        <!-- ═══════════ HEADER ═══════════ -->
        <header class="fixed top-0 left-0 right-0 z-50 glass-nav border-b border-indigo/[0.06]">
            <div class="mx-auto max-w-7xl px-6 flex items-center justify-between gap-4 py-3">
                <a href="/" class="flex items-center gap-3 shrink-0 group">
                    <span class="relative flex size-10 items-center justify-center rounded-xl bg-indigo text-cream font-display text-base font-semibold transition-transform duration-300 group-hover:scale-105">
                        আ
                        <span class="absolute -bottom-0.5 -right-0.5 size-2.5 rounded-full bg-rust border-2 border-cream"></span>
                    </span>
                    <div class="flex flex-col leading-none">
                        <span class="font-display text-[15px] font-semibold text-indigo">আস্থা মাইক্রোফাইন্যান্স</span>
                        <span class="text-[10px] text-indigo/40 tracking-wide">বিশ্বস্ত আর্থিক সহায়তা</span>
                    </div>
                </a>

                @if (Route::has('login'))
                    <nav class="flex items-center gap-2">
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="rounded-lg px-4 py-2 text-sm font-semibold text-indigo bg-indigo/[0.05] border border-indigo/10 transition-all duration-200 hover:bg-indigo hover:text-cream hover:border-indigo focus:outline-none focus-visible:ring-2 focus-visible:ring-brass"
                            >
                                ড্যাশবোর্ড
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="rounded-lg px-4 py-2 text-sm font-semibold text-indigo/60 transition-colors duration-200 hover:text-indigo focus:outline-none focus-visible:ring-2 focus-visible:ring-brass"
                            >
                                লগ ইন
                            </a>

                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="rounded-lg bg-rust px-4 py-2 text-sm font-semibold text-cream transition-all duration-200 hover:bg-rust/90 shadow-sm shadow-rust/20 focus:outline-none focus-visible:ring-2 focus-visible:ring-brass"
                                >
                                    নিবন্ধন করুন
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </header>

        <!-- ═══════════ HERO ═══════════ -->
        <section class="relative min-h-[94vh] flex items-center bg-indigo overflow-hidden pt-14">
            <div class="absolute inset-0 pointer-events-none overflow-hidden" aria-hidden="true">
                <div class="absolute top-[15%] -left-40 w-[420px] h-[420px] rounded-full bg-brass/[0.07] blur-[100px] glow-pulse"></div>
                <div class="absolute bottom-[5%] right-[10%] w-[350px] h-[350px] rounded-full bg-rust/[0.06] blur-[90px] glow-pulse ad-2500"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] rounded-full border border-cream/[0.04] ring-breathe"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[520px] h-[520px] rounded-full border border-cream/[0.03] ring-breathe ad-1300"></div>
                <div class="absolute top-[18%] left-[12%] w-2 h-2 rounded-full bg-brass/40 float-a"></div>
                <div class="absolute top-[42%] left-[6%] w-1.5 h-1.5 rounded-full bg-cream/20 float-b"></div>
                <div class="absolute top-[62%] right-[10%] w-2.5 h-2.5 rounded-full bg-rust/25 float-a ad-2000"></div>
                <div class="absolute top-[22%] right-[22%] w-1.5 h-1.5 rounded-full bg-brass/30 float-b ad-3500"></div>
                <div class="absolute bottom-[18%] left-[28%] w-2 h-2 rounded-full bg-cream/15 float-a ad-4000"></div>
                <div class="absolute top-[72%] left-[55%] w-1 h-1 rounded-full bg-brass/35 float-b ad-1500"></div>
                <div class="absolute top-[35%] left-[42%] w-1.5 h-1.5 rounded-full bg-cream/10 float-a ad-5000"></div>
                <svg class="absolute inset-0 w-full h-full opacity-[0.07]">
                    <line x1="12%" y1="18%" x2="6%" y2="42%" stroke="#A6832E" stroke-width="1" stroke-dasharray="4 6" class="dash-flow"/>
                    <line x1="6%" y1="42%" x2="28%" y2="82%" stroke="#A6832E" stroke-width="1" stroke-dasharray="4 6" class="dash-flow ad-600"/>
                    <line x1="22%" y1="22%" x2="90%" y2="62%" stroke="#B23A2E" stroke-width="1" stroke-dasharray="4 6" class="dash-flow ad-1200"/>
                    <line x1="55%" y1="72%" x2="90%" y2="62%" stroke="#A6832E" stroke-width="1" stroke-dasharray="4 6" class="dash-flow ad-1800"/>
                    <line x1="42%" y1="35%" x2="12%" y2="18%" stroke="#E9DFC3" stroke-width="0.8" stroke-dasharray="3 8" class="dash-flow ad-300"/>
                </svg>
            </div>

            <div class="relative z-10 mx-auto w-full max-w-7xl px-6">
                <div class="grid lg:grid-cols-12 gap-10 lg:gap-6 items-center">
                    <div class="lg:col-span-7 space-y-7">
                        <div class="inline-flex items-center gap-2.5 rounded-full bg-cream/[0.08] px-4 py-1.5 border border-cream/[0.08]">
                            <span class="relative flex size-2">
                                <span class="absolute inline-flex h-full w-full rounded-full bg-brass opacity-75 animate-ping"></span>
                                <span class="relative inline-flex size-2 rounded-full bg-brass"></span>
                            </span>
                            <span class="text-xs font-semibold text-cream/60 tracking-wide">সহজ শর্তে · দ্রুত অনুমোদন · ঘরে বসে কিস্তি</span>
                        </div>

                        <h1 class="font-display text-[2.75rem] sm:text-6xl lg:text-[4.25rem] leading-[1.08] text-cream">
                            ছোট ঋণে,<br>
                            <span class="relative inline-block mt-1">
                                <span class="text-brass">বড় স্বপ্ন</span>
                                <span class="absolute -bottom-1.5 left-0 right-0 h-[3px] bg-gradient-to-r from-rust via-brass to-transparent rounded-full"></span>
                            </span>
                            <br>পূরণের সঙ্গী।
                        </h1>

                        <p class="max-w-lg text-[15px] leading-[1.8] text-cream/55">
                            ক্ষুদ্র উদ্যোক্তা, কৃষক ও গৃহিণীদের জন্য জামানত-মুক্ত ঋণ, সাপ্তাহিক কিস্তি এবং
                            একটি নির্ভরযোগ্য সঞ্চয় খাতা — নকশিকাঁথার প্রতিটি ফোঁড়ের মতোই যত্নে গাঁথা আপনার হিসাব।
                        </p>

                        <div class="flex flex-wrap items-center gap-3.5 pt-1">
                            <a href="#apply" class="group inline-flex items-center gap-2 rounded-xl bg-rust px-7 py-3.5 text-sm font-semibold text-cream shadow-lg shadow-rust/25 transition-all duration-300 hover:shadow-xl hover:shadow-rust/35 hover:-translate-y-0.5 focus:outline-none focus-visible:ring-2 focus-visible:ring-brass focus-visible:ring-offset-2 focus-visible:ring-offset-indigo">
                                ঋণের জন্য আবেদন করুন
                                <svg class="size-4 transition-transform duration-300 group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" stroke="currentColor"/></svg>
                            </a>
                            <a href="#branches" class="inline-flex items-center gap-2 rounded-xl px-7 py-3.5 text-sm font-semibold text-cream/70 border border-cream/[0.12] transition-all duration-300 hover:bg-cream/[0.08] hover:border-cream/20 hover:text-cream focus:outline-none focus-visible:ring-2 focus-visible:ring-brass focus-visible:ring-offset-2 focus-visible:ring-offset-indigo">
                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" stroke="currentColor"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 0115 0z" stroke="currentColor"/></svg>
                                নিকটস্থ শাখা খুঁজুন
                            </a>
                        </div>
                    </div>

                    <div class="lg:col-span-5 flex justify-center lg:justify-end" aria-hidden="true">
                        <div class="relative w-[300px] h-[300px] sm:w-[380px] sm:h-[380px]">
                            <div class="absolute inset-0 rounded-full border border-cream/[0.08] ring-breathe"></div>
                            <div class="absolute inset-5 rounded-full border border-cream/[0.06] ring-breathe ad-1000"></div>
                            <div class="absolute inset-10 rounded-full border border-cream/[0.04] ring-breathe ad-2000"></div>

                            <div class="absolute inset-[85px] sm:inset-[105px] rounded-full bg-gradient-to-br from-brass/20 to-rust/10 border border-brass/25 flex items-center justify-center float-a shadow-lg shadow-brass/10">
                                <div class="text-center">
                                    <div class="font-display text-3xl sm:text-4xl text-cream leading-none">আ</div>
                                    <div class="text-[8px] sm:text-[9px] text-cream/40 tracking-[0.25em] mt-1 uppercase">স্থা</div>
                                </div>
                            </div>

                            <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1 w-11 h-11 sm:w-14 sm:h-14 rounded-xl bg-cream/[0.08] border border-cream/[0.12] flex items-center justify-center float-b backdrop-blur-sm">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-brass" viewBox="0 0 24 24" fill="none"><path d="M12 6v12m-6-6h12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                            </div>
                            <div class="absolute bottom-4 left-2 sm:bottom-6 sm:left-4 w-11 h-11 sm:w-14 sm:h-14 rounded-xl bg-cream/[0.08] border border-cream/[0.12] flex items-center justify-center float-a ad-2000 backdrop-blur-sm">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-rust/70" viewBox="0 0 24 24" fill="none"><path d="M3 12h4l2 4 4-8 2 4h6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </div>
                            <div class="absolute bottom-4 right-2 sm:bottom-6 sm:right-4 w-11 h-11 sm:w-14 sm:h-14 rounded-xl bg-cream/[0.08] border border-cream/[0.12] flex items-center justify-center float-b ad-4000 backdrop-blur-sm">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-cream/50" viewBox="0 0 24 24" fill="none"><path d="M4 13c0-4 3-7 8-7 3 0 4 1.5 5 1.5 1 0 1-1 2-1v6c0 1-1 1-2 1l-1 3H8l-1-2c-2 0-3-1-3-1.5z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
                            </div>
                            <div class="absolute top-1/3 -right-1 sm:-right-2 w-11 h-11 sm:w-14 sm:h-14 rounded-xl bg-cream/[0.08] border border-cream/[0.12] flex items-center justify-center float-a ad-3000 backdrop-blur-sm">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-brass/60" viewBox="0 0 24 24" fill="none"><circle cx="7" cy="8" r="2" stroke="currentColor" stroke-width="1.8"/><circle cx="17" cy="8" r="2" stroke="currentColor" stroke-width="1.8"/><circle cx="12" cy="16" r="2" stroke="currentColor" stroke-width="1.8"/><path d="M9 9.5l2.5 4.5M15 9.5l-2.5 4.5" stroke="currentColor" stroke-width="1.4"/></svg>
                            </div>

                            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 380 380">
                                <line x1="190" y1="190" x2="190" y2="28" stroke="#A6832E" stroke-width="0.6" stroke-dasharray="3 7" opacity="0.25" class="dash-flow"/>
                                <line x1="190" y1="190" x2="55" y2="320" stroke="#B23A2E" stroke-width="0.6" stroke-dasharray="3 7" opacity="0.25" class="dash-flow ad-500"/>
                                <line x1="190" y1="190" x2="325" y2="320" stroke="#E9DFC3" stroke-width="0.6" stroke-dasharray="3 7" opacity="0.12" class="dash-flow ad-1000"/>
                                <line x1="190" y1="190" x2="370" y2="127" stroke="#A6832E" stroke-width="0.6" stroke-dasharray="3 7" opacity="0.25" class="dash-flow ad-1500"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="absolute bottom-0 left-0 right-0" aria-hidden="true">
                <svg viewBox="0 0 1440 64" class="w-full block" preserveAspectRatio="none">
                    <path d="M0 64V28C240 4 480 52 720 32C960 12 1200 48 1440 24V64H0Z" fill="#FBF7EC"/>
                </svg>
            </div>
        </section>

        <!-- ═══════════ STATS ═══════════ -->
        <section class="relative bg-cream noise-bg">
            <div class="relative z-10 mx-auto max-w-7xl px-6 py-10 sm:py-14">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="group relative overflow-hidden rounded-2xl bg-indigo p-6 sm:p-7 transition-all duration-300 hover:shadow-2xl hover:shadow-indigo/25 hover:-translate-y-1">
                        <div class="absolute -top-6 -right-6 w-28 h-28 rounded-full bg-brass/10 blob-scale"></div>
                        <div class="relative">
                            <p class="font-mono-num text-3xl sm:text-4xl font-semibold text-cream tracking-tight">৫০,০০০<span class="text-brass">+</span></p>
                            <p class="mt-2.5 text-sm text-cream/45">সক্রিয় সদস্য</p>
                            <div class="mt-3 h-[3px] w-8 rounded-full bg-brass/50"></div>
                        </div>
                    </div>

                    <div class="group relative overflow-hidden rounded-2xl bg-white p-6 sm:p-7 border border-indigo/[0.05] transition-all duration-300 hover:shadow-xl hover:shadow-indigo/[0.08] hover:-translate-y-1">
                        <div class="absolute -top-6 -right-6 w-28 h-28 rounded-full bg-rust/[0.06] blob-scale"></div>
                        <div class="relative">
                            <p class="font-mono-num text-3xl sm:text-4xl font-semibold text-indigo tracking-tight">৳২০০ <span class="text-rust text-xl align-middle">কোটি+</span></p>
                            <p class="mt-2.5 text-sm text-indigo/45">বিতরণকৃত ঋণ</p>
                            <div class="mt-3 h-[3px] w-8 rounded-full bg-rust/35"></div>
                        </div>
                    </div>

                    <div class="group relative overflow-hidden rounded-2xl bg-white p-6 sm:p-7 border border-indigo/[0.05] transition-all duration-300 hover:shadow-xl hover:shadow-indigo/[0.08] hover:-translate-y-1">
                        <div class="absolute -top-6 -right-6 w-28 h-28 rounded-full bg-brass/[0.06] blob-scale"></div>
                        <div class="relative">
                            <p class="font-mono-num text-3xl sm:text-4xl font-semibold text-indigo tracking-tight">৯৮<span class="text-brass">%</span></p>
                            <p class="mt-2.5 text-sm text-indigo/45">সময়মতো পরিশোধের হার</p>
                            <div class="mt-3 h-[3px] w-8 rounded-full bg-brass/35"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ═══════════ SERVICES ═══════════ -->
        <section class="relative bg-cream noise-bg pb-16 sm:pb-24">
            <div class="relative z-10 mx-auto max-w-7xl px-6">
                <div class="flex items-center gap-5 mb-10">
                    <div class="h-px flex-1 bg-gradient-to-r from-transparent via-indigo/10 to-transparent"></div>
                    <span class="text-[11px] font-semibold text-indigo/35 tracking-[0.2em] uppercase whitespace-nowrap">আমাদের সেবাসমূহ</span>
                    <div class="h-px flex-1 bg-gradient-to-r from-transparent via-indigo/10 to-transparent"></div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
                    <a
                        href="#loans"
                        id="loans-card"
                        class="group relative lg:col-span-7 lg:row-span-2 flex flex-col justify-between overflow-hidden rounded-2xl bg-indigo2 p-8 sm:p-10 text-cream transition-all duration-500 hover:shadow-2xl hover:shadow-indigo2/40 hover:-translate-y-1 focus:outline-none focus-visible:ring-2 focus-visible:ring-brass focus-visible:ring-offset-2 focus-visible:ring-offset-cream"
                    >
                        <div class="absolute inset-0 pointer-events-none diag-stripes opacity-60"></div>
                        <div class="absolute -bottom-24 -right-24 w-72 h-72 rounded-full bg-brass/[0.06] blur-[80px] blob-scale"></div>
                        <div class="absolute -top-12 -left-12 w-48 h-48 rounded-full bg-rust/[0.04] blur-[60px]"></div>

                        <div class="relative">
                            <div class="flex items-center gap-3">
                                <span class="flex size-11 items-center justify-center rounded-xl bg-brass/[0.12] border border-brass/20">
                                    <svg class="size-5" viewBox="0 0 24 24" fill="none"><path d="M3 12h4l2 4 4-8 2 4h6" stroke="#A6832E" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </span>
                                <span class="text-[10px] font-semibold tracking-[0.18em] text-brass/60 uppercase">কেন্দ্রীয় সেবা</span>
                            </div>
                            <h2 class="mt-8 font-display text-3xl sm:text-[2.1rem] text-cream leading-snug">ঋণ ব্যবস্থাপনা</h2>
                            <p class="mt-5 max-w-md text-sm leading-[1.85] text-cream/55">
                                আবেদন থেকে অনুমোদন, বিতরণ ও কিস্তি পরিশোধ — প্রতিটি ধাপ আপনার পাসবইয়ে
                                স্বচ্ছভাবে লেখা থাকে। কোনো লুকানো শর্ত নেই, কোনো জামানতের ঝক্কি নেই।
                            </p>
                        </div>

                        <div class="relative mt-8 flex flex-wrap items-center justify-between gap-4">
                            <div class="flex items-center gap-2 text-sm font-semibold text-brass">
                                বিস্তারিত জানুন
                                <svg class="size-4 transition-transform duration-300 group-hover:translate-x-1.5" viewBox="0 0 24 24" fill="none" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" stroke="#A6832E"/></svg>
                            </div>
                            <div class="hidden sm:flex items-center gap-2">
                                <span class="rounded-full bg-cream/[0.07] px-3 py-1 text-[11px] text-cream/40 border border-cream/[0.08]">জামানত-মুক্ত</span>
                                <span class="rounded-full bg-cream/[0.07] px-3 py-1 text-[11px] text-cream/40 border border-cream/[0.08]">দ্রুত অনুমোদন</span>
                            </div>
                        </div>
                    </a>

                    <a
                        href="#installments"
                        class="group relative lg:col-span-5 flex items-start gap-5 overflow-hidden rounded-2xl bg-white p-6 sm:p-7 border border-indigo/[0.04] transition-all duration-300 hover:shadow-lg hover:shadow-indigo/[0.07] hover:-translate-y-0.5 hover:border-rust/15 focus:outline-none focus-visible:ring-2 focus-visible:ring-brass focus-visible:ring-offset-2 focus-visible:ring-offset-cream"
                    >
                        <span class="flex size-12 shrink-0 items-center justify-center rounded-xl bg-rust/[0.06] border border-rust/[0.10] transition-colors duration-300 group-hover:bg-rust/[0.12]">
                            <svg class="size-5" viewBox="0 0 24 24" fill="none"><rect x="4" y="5" width="16" height="15" rx="2" stroke="#B23A2E" stroke-width="1.8"/><path d="M4 9.5h16M8 3v3M16 3v3" stroke="#B23A2E" stroke-width="1.8" stroke-linecap="round"/><path d="M8.5 14l2 2 4-4" stroke="#B23A2E" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                        <div class="min-w-0">
                            <h2 class="font-display text-xl text-indigo">সাপ্তাহিক কিস্তি</h2>
                            <p class="mt-3 text-sm leading-[1.8] text-indigo/55">
                                মাঠকর্মী প্রতি সপ্তাহে আপনার দরজায় আসেন, খাতায় এন্ট্রি লেখেন — নগদ টাকা
                                নিয়ে ব্যাংকে ছোটার দরকার নেই।
                            </p>
                            <span class="mt-4 inline-flex items-center gap-1.5 text-xs font-semibold text-rust/60 group-hover:text-rust transition-colors">
                                আরও পড়ুন
                                <svg class="size-3 transition-transform duration-200 group-hover:translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" stroke="currentColor"/></svg>
                            </span>
                        </div>
                    </a>

                    <a
                        href="#savings"
                        class="group relative lg:col-span-5 flex items-start gap-5 overflow-hidden rounded-2xl bg-white p-6 sm:p-7 border border-indigo/[0.04] transition-all duration-300 hover:shadow-lg hover:shadow-indigo/[0.07] hover:-translate-y-0.5 hover:border-brass/15 focus:outline-none focus-visible:ring-2 focus-visible:ring-brass focus-visible:ring-offset-2 focus-visible:ring-offset-cream"
                    >
                        <span class="flex size-12 shrink-0 items-center justify-center rounded-xl bg-brass/[0.06] border border-brass/[0.10] transition-colors duration-300 group-hover:bg-brass/[0.12]">
                            <svg class="size-5" viewBox="0 0 24 24" fill="none"><path d="M4 13c0-4 3-7 8-7 3 0 4 1.5 5 1.5 1 0 1-1 2-1v6c0 1-1 1-2 1l-1 3H8l-1-2c-2 0-3-1-3-1.5z" stroke="#A6832E" stroke-width="1.7" stroke-linejoin="round"/><circle cx="15" cy="9" r="0.8" fill="#A6832E"/></svg>
                        </span>
                        <div class="min-w-0">
                            <h2 class="font-display text-xl text-indigo">সঞ্চয় হিসাব</h2>
                            <p class="mt-3 text-sm leading-[1.8] text-indigo/55">
                                প্রতিটি কিস্তির পাশাপাশি ছোট ছোট সঞ্চয় জমা হয় — বিপদের দিনে কিংবা
                                ভবিষ্যতের পুঁজি হিসেবে কাজে লাগে।
                            </p>
                            <span class="mt-4 inline-flex items-center gap-1.5 text-xs font-semibold text-brass/60 group-hover:text-brass transition-colors">
                                আরও পড়ুন
                                <svg class="size-3 transition-transform duration-200 group-hover:translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" stroke="currentColor"/></svg>
                            </span>
                        </div>
                    </a>

                    <div class="lg:col-span-12 relative overflow-hidden rounded-2xl bg-indigo/[0.025] border border-indigo/[0.06] p-7 sm:p-8">
                        <div class="absolute inset-0 dot-grid opacity-[0.15]" aria-hidden="true"></div>
                        <div class="relative flex flex-col sm:flex-row items-start gap-5 sm:gap-6">
                            <span class="flex size-14 shrink-0 items-center justify-center rounded-2xl bg-indigo/[0.05] border border-indigo/[0.08]">
                                <svg class="size-6" viewBox="0 0 24 24" fill="none"><circle cx="7" cy="8" r="2.4" stroke="#1B2A4A" stroke-width="1.7"/><circle cx="17" cy="8" r="2.4" stroke="#1B2A4A" stroke-width="1.7"/><circle cx="12" cy="16" r="2.4" stroke="#1B2A4A" stroke-width="1.7"/><path d="M8.8 9.6L11 14M15.2 9.6L13 14M9.4 8h5.2" stroke="#1B2A4A" stroke-width="1.4"/></svg>
                            </span>
                            <div>
                                <h2 class="font-display text-2xl text-indigo">আমাদের নেটওয়ার্ক</h2>
                                <p class="mt-3 text-sm leading-[1.85] text-indigo/55">
                                    সারা দেশজুড়ে ছড়িয়ে থাকা <a href="#" class="rounded-sm font-medium text-brassdk underline decoration-brass/30 underline-offset-2 hover:text-indigo hover:decoration-brass transition-colors focus:outline-none focus-visible:ring-1 focus-visible:ring-brass">শাখা</a>,
                                    নিয়মিত <a href="#" class="rounded-sm font-medium text-brassdk underline decoration-brass/30 underline-offset-2 hover:text-indigo hover:decoration-brass transition-colors focus:outline-none focus-visible:ring-1 focus-visible:ring-brass">প্রশিক্ষণ কেন্দ্র</a>,
                                    সদস্যদের জন্য <a href="#" class="rounded-sm font-medium text-brassdk underline decoration-brass/30 underline-offset-2 hover:text-indigo hover:decoration-brass transition-colors focus:outline-none focus-visible:ring-1 focus-visible:ring-brass">বীমা সুবিধা</a>,
                                    নিবেদিত <a href="#" class="rounded-sm font-medium text-brassdk underline decoration-brass/30 underline-offset-2 hover:text-indigo hover:decoration-brass transition-colors focus:outline-none focus-visible:ring-1 focus-visible:ring-brass">মাঠকর্মী দল</a> এবং
                                    গ্রামীণ পর্যায়ে <a href="#" class="rounded-sm font-medium text-brassdk underline decoration-brass/30 underline-offset-2 hover:text-indigo hover:decoration-brass transition-colors focus:outline-none focus-visible:ring-1 focus-visible:ring-brass">এজেন্ট ব্যাংকিং</a> —
                                    সবকিছু নিয়ে আমাদের বিশ্বাসের নেটওয়ার্ক।
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ═══════════ FOOTER ═══════════ -->
        <footer class="relative bg-indigo2 overflow-hidden">
            <div class="absolute -top-px left-0 right-0" aria-hidden="true">
                <svg viewBox="0 0 1440 36" class="w-full block" preserveAspectRatio="none">
                    <path d="M0 36V18C360 2 720 30 1080 12C1260 4 1380 16 1440 12V36H0Z" fill="#FBF7EC"/>
                </svg>
            </div>
            <div class="relative mx-auto max-w-7xl px-6 pt-14 pb-7">
                <div class="flex flex-col items-center gap-3">
                    <div class="flex items-center gap-2.5">
                        <span class="flex size-7 items-center justify-center rounded-lg bg-cream/[0.08] text-cream/60 font-display text-xs">আ</span>
                        <span class="font-display text-sm text-cream/45">আস্থা মাইক্রোফাইন্যান্স</span>
                    </div>
                    <div class="h-px w-14 bg-cream/[0.08]"></div>
                    <div class="flex flex-col items-center gap-1 text-center text-[11px] text-cream/25">
                        <span>© {{ date('Y') }} আস্থা মাইক্রোফাইন্যান্স। সর্বস্বত্ব সংরক্ষিত।</span>
                        <span class="font-mono-num">Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</span>
                    </div>
                </div>
            </div>
        </footer>

    </body>
</html>