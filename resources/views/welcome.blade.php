<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>আস্থা মাইক্রোফাইন্যান্স — বিশ্বস্ত আর্থিক সহায়তা</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Tiro+Bangla&family=Hind+Siliguri:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
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
                                paper:   '#F1ECD6',
                                paper2:  '#EAE3C8',
                                ink:     '#123B2C',
                                ink2:    '#0E3527',
                                gold:    '#C79A43',
                                golddark:'#93701F',
                                stamp:   '#A83C2E',
                                cream:   '#FBF8EF',
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
                .ledger-bg {
                    background-image: repeating-linear-gradient(
                        to bottom,
                        transparent 0px,
                        transparent 27px,
                        rgba(18,59,44,0.06) 28px
                    );
                }
                @media (prefers-reduced-motion: reduce) {
                    * { transition-duration: 0.01ms !important; animation-duration: 0.01ms !important; }
                }
            </style>
        @endif
    </head>
    <body class="font-body antialiased bg-paper text-ink">

        <div class="relative min-h-screen overflow-hidden selection:bg-gold selection:text-ink">

            <!-- ambient ledger texture -->
            <div class="pointer-events-none absolute inset-0 ledger-bg"></div>

            <div class="relative mx-auto w-full max-w-7xl px-6">

                <!-- HEADER -->
                <header class="flex items-center justify-between gap-4 py-8">
                    <a href="/" class="flex items-center gap-3 shrink-0">
                        <span class="flex size-11 items-center justify-center rounded-full border-2 border-gold bg-ink text-cream font-display text-lg">
                            আ
                        </span>
                        <span class="flex flex-col leading-none">
                            <span class="font-display text-lg font-semibold text-ink">আস্থা মাইক্রোফাইন্যান্স</span>
                            <span class="text-xs text-ink/60">বিশ্বস্ত আর্থিক সহায়তা</span>
                        </span>
                    </a>

                    @if (Route::has('login'))
                        <nav class="flex items-center gap-2">
                            @auth
                                <a
                                    href="{{ url('/dashboard') }}"
                                    class="rounded-full px-5 py-2 text-sm font-semibold text-ink ring-1 ring-ink/15 transition hover:bg-ink hover:text-cream focus:outline-none focus-visible:ring-2 focus-visible:ring-gold"
                                >
                                    ড্যাশবোর্ড
                                </a>
                            @else
                                <a
                                    href="{{ route('login') }}"
                                    class="rounded-full px-5 py-2 text-sm font-semibold text-ink transition hover:text-golddark focus:outline-none focus-visible:ring-2 focus-visible:ring-gold"
                                >
                                    লগ ইন
                                </a>

                                @if (Route::has('register'))
                                    <a
                                        href="{{ route('register') }}"
                                        class="rounded-full bg-ink px-5 py-2 text-sm font-semibold text-cream ring-1 ring-ink transition hover:bg-ink2 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold"
                                    >
                                        নিবন্ধন করুন
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </header>

                <!-- HERO -->
                <main>
                    <section class="grid items-center gap-12 py-10 lg:grid-cols-2 lg:py-16">
                        <div class="relative z-10">
                            <span class="inline-flex items-center gap-2 rounded-full bg-ink px-4 py-1.5 text-xs font-semibold tracking-wide text-gold ring-1 ring-ink">
                                সহজ শর্তে · দ্রুত অনুমোদন · ঘরে বসে কিস্তি
                            </span>

                            <h1 class="mt-6 font-display text-4xl leading-tight text-ink sm:text-5xl">
                                ছোট ঋণে,
                                <span class="relative inline-block">
                                    বড় স্বপ্ন
                                    <svg class="absolute -bottom-1 left-0 w-full" viewBox="0 0 200 10" preserveAspectRatio="none" aria-hidden="true">
                                        <path d="M0 6 Q50 0 100 5 T200 4" stroke="#C79A43" stroke-width="5" fill="none" stroke-linecap="round"/>
                                    </svg>
                                </span>
                                পূরণের সঙ্গী।
                            </h1>

                            <p class="mt-6 max-w-md text-base leading-relaxed text-ink/70">
                                ক্ষুদ্র উদ্যোক্তা, কৃষক ও গৃহিণীদের জন্য জামানত-মুক্ত ঋণ, সাপ্তাহিক কিস্তি এবং
                                একটি নির্ভরযোগ্য সঞ্চয় খাতা — সবকিছু একটি পাসবইয়ে গোছানো।
                            </p>

                            <div class="mt-8 flex flex-wrap items-center gap-4">
                                <a href="#apply" class="rounded-full bg-stamp px-7 py-3 text-sm font-semibold text-cream shadow-lg shadow-stamp/30 transition hover:bg-stamp/90 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold">
                                    ঋণের জন্য আবেদন করুন
                                </a>
                                <a href="#branches" class="rounded-full bg-cream px-7 py-3 text-sm font-semibold text-ink ring-1 ring-ink/20 transition hover:bg-ink/5 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold">
                                    নিকটস্থ শাখা খুঁজুন
                                </a>
                            </div>
                        </div>

                        <!-- SIGNATURE VISUAL: passbook -->
                        <div class="relative mx-auto h-[340px] w-full max-w-md" aria-hidden="true">
                            <svg viewBox="0 0 420 340" class="h-full w-full overflow-visible">
                                <ellipse cx="230" cy="300" rx="150" ry="18" fill="#123B2C" opacity="0.12" />

                                <!-- open page peeking behind -->
                                <g transform="rotate(4 210 170)">
                                    <rect x="120" y="30" width="230" height="290" rx="6" fill="#FBF8EF" stroke="#123B2C" stroke-opacity="0.10" />
                                    <g stroke="#123B2C" stroke-opacity="0.20" stroke-width="2">
                                        <line x1="150" y1="70" x2="320" y2="70" />
                                        <line x1="150" y1="95" x2="320" y2="95" />
                                        <line x1="150" y1="120" x2="320" y2="120" />
                                        <line x1="150" y1="145" x2="280" y2="145" />
                                    </g>
                                </g>

                                <!-- cover -->
                                <g transform="rotate(-6 200 170)">
                                    <rect x="70" y="20" width="240" height="300" rx="14" fill="#0E3527" />
                                    <rect x="70" y="20" width="22" height="300" rx="10" fill="#C79A43" />
                                    <rect x="96" y="46" width="188" height="248" rx="8" fill="none" stroke="#C79A43" stroke-opacity="0.4" stroke-width="1.5" />

                                    <text x="190" y="140" text-anchor="middle" fill="#C79A43" font-family="Tiro Bangla, serif" font-size="26" letter-spacing="1">সঞ্চয়ী</text>
                                    <text x="190" y="175" text-anchor="middle" fill="#C79A43" font-family="Tiro Bangla, serif" font-size="26" letter-spacing="1">হিসাব খাতা</text>

                                    <circle cx="190" cy="230" r="5" fill="#C79A43" />
                                </g>

                                <!-- approval stamp -->
                                <g transform="rotate(-12 320 250)">
                                    <circle cx="320" cy="250" r="46" fill="#FBF8EF" stroke="#A83C2E" stroke-width="3" />
                                    <circle cx="320" cy="250" r="38" fill="none" stroke="#A83C2E" stroke-width="1.5" />
                                    <text x="320" y="246" text-anchor="middle" fill="#A83C2E" font-family="Tiro Bangla, serif" font-size="14">অনুমোদিত</text>
                                    <path d="M303 256 l11 11 l22 -26" fill="none" stroke="#A83C2E" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                            </svg>
                        </div>
                    </section>

                    <!-- LEDGER STATS -->
                    <section class="rounded-2xl border border-ink/10 bg-cream/60 py-8 shadow-sm">
                        <div class="grid grid-cols-1 divide-y divide-ink/10 sm:grid-cols-3 sm:divide-x sm:divide-y-0">
                            <div class="px-4 py-4 text-center sm:py-0">
                                <p class="font-mono-num text-3xl font-semibold text-ink">৫০,০০০+</p>
                                <p class="mt-1 text-sm text-ink/60">সক্রিয় সদস্য</p>
                            </div>
                            <div class="px-4 py-4 text-center sm:py-0">
                                <p class="font-mono-num text-3xl font-semibold text-ink">৳২০০ কোটি+</p>
                                <p class="mt-1 text-sm text-ink/60">বিতরণকৃত ঋণ</p>
                            </div>
                            <div class="px-4 py-4 text-center sm:py-0">
                                <p class="font-mono-num text-3xl font-semibold text-ink">৯৮%</p>
                                <p class="mt-1 text-sm text-ink/60">সময়মতো পরিশোধের হার</p>
                            </div>
                        </div>
                    </section>

                    <!-- SERVICES -->
                    <section class="py-16">
                        <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">

                            <!-- big card -->
                            <a
                                href="#loans"
                                id="loans-card"
                                class="group relative flex flex-col justify-between gap-8 overflow-hidden rounded-2xl bg-ink2 p-8 text-cream shadow-[0px_14px_34px_0px_rgba(14,53,39,0.25)] ring-1 ring-black/10 transition duration-300 hover:shadow-[0px_18px_40px_0px_rgba(14,53,39,0.35)] focus:outline-none focus-visible:ring-2 focus-visible:ring-gold md:row-span-3 lg:p-10"
                            >
                                <div class="pointer-events-none absolute inset-0 opacity-[0.06]" style="background-image: repeating-linear-gradient(to bottom, transparent 0px, transparent 27px, #C79A43 28px);"></div>

                                <div class="relative">
                                    <span class="inline-flex size-12 items-center justify-center rounded-full bg-gold/20 ring-1 ring-gold/50">
                                        <svg class="size-6" viewBox="0 0 24 24" fill="none"><path d="M3 12h4l2 4 4-8 2 4h6" stroke="#C79A43" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </span>
                                    <h2 class="mt-6 font-display text-2xl text-cream">ঋণ ব্যবস্থাপনা</h2>
                                    <p class="mt-4 max-w-sm text-sm leading-relaxed text-cream/75">
                                        আবেদন থেকে অনুমোদন, বিতরণ ও কিস্তি পরিশোধ — প্রতিটি ধাপ আপনার পাসবইয়ে
                                        স্বচ্ছভাবে লেখা থাকে। কোনো লুকানো শর্ত নেই, কোনো জামানতের ঝক্কি নেই।
                                    </p>
                                </div>

                                <div class="relative flex items-center gap-2 text-sm font-semibold text-gold">
                                    বিস্তারিত জানুন
                                    <svg class="size-5 transition group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" stroke="#C79A43"/></svg>
                                </div>
                            </a>

                            <a
                                href="#installments"
                                class="group flex items-start gap-5 rounded-2xl bg-cream p-6 shadow-[0px_10px_26px_0px_rgba(18,59,44,0.08)] ring-1 ring-ink/10 transition duration-300 hover:shadow-[0px_14px_30px_0px_rgba(18,59,44,0.14)] hover:ring-gold/60 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold lg:pb-8"
                            >
                                <span class="flex size-12 shrink-0 items-center justify-center rounded-full bg-ink/5 ring-1 ring-gold/40 sm:size-14">
                                    <svg class="size-5 sm:size-6" viewBox="0 0 24 24" fill="none"><rect x="4" y="5" width="16" height="15" rx="2" stroke="#123B2C" stroke-width="1.8"/><path d="M4 9.5h16M8 3v3M16 3v3" stroke="#123B2C" stroke-width="1.8" stroke-linecap="round"/><path d="M8.5 14l2 2 4-4" stroke="#A83C2E" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </span>
                                <div>
                                    <h2 class="font-display text-xl text-ink">সাপ্তাহিক কিস্তি</h2>
                                    <p class="mt-3 text-sm leading-relaxed text-ink/70">
                                        মাঠকর্মী প্রতি সপ্তাহে আপনার দরজায় আসেন, খাতায় এন্ট্রি লেখেন — নগদ টাকা
                                        নিয়ে ব্যাংকে ছোটার দরকার নেই।
                                    </p>
                                </div>
                            </a>

                            <a
                                href="#savings"
                                class="group flex items-start gap-5 rounded-2xl bg-cream p-6 shadow-[0px_10px_26px_0px_rgba(18,59,44,0.08)] ring-1 ring-ink/10 transition duration-300 hover:shadow-[0px_14px_30px_0px_rgba(18,59,44,0.14)] hover:ring-gold/60 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold lg:pb-8"
                            >
                                <span class="flex size-12 shrink-0 items-center justify-center rounded-full bg-ink/5 ring-1 ring-gold/40 sm:size-14">
                                    <svg class="size-5 sm:size-6" viewBox="0 0 24 24" fill="none"><path d="M4 13c0-4 3-7 8-7 3 0 4 1.5 5 1.5 1 0 1-1 2-1v6c0 1-1 1-2 1l-1 3H8l-1-2c-2 0-3-1-3-1.5z" stroke="#123B2C" stroke-width="1.7" stroke-linejoin="round"/><circle cx="15" cy="9" r="0.8" fill="#123B2C"/></svg>
                                </span>
                                <div>
                                    <h2 class="font-display text-xl text-ink">সঞ্চয় হিসাব</h2>
                                    <p class="mt-3 text-sm leading-relaxed text-ink/70">
                                        প্রতিটি কিস্তির পাশাপাশি ছোট ছোট সঞ্চয় জমা হয় — বিপদের দিনে কিংবা
                                        ভবিষ্যতের পুঁজি হিসেবে কাজে লাগে।
                                    </p>
                                </div>
                            </a>

                            <div class="flex items-start gap-5 rounded-2xl bg-cream p-6 shadow-[0px_10px_26px_0px_rgba(18,59,44,0.08)] ring-1 ring-ink/10 lg:pb-8">
                                <span class="flex size-12 shrink-0 items-center justify-center rounded-full bg-ink/5 ring-1 ring-gold/40 sm:size-14">
                                    <svg class="size-5 sm:size-6" viewBox="0 0 24 24" fill="none"><circle cx="7" cy="8" r="2.4" stroke="#123B2C" stroke-width="1.7"/><circle cx="17" cy="8" r="2.4" stroke="#123B2C" stroke-width="1.7"/><circle cx="12" cy="16" r="2.4" stroke="#123B2C" stroke-width="1.7"/><path d="M8.8 9.6L11 14M15.2 9.6L13 14M9.4 8h5.2" stroke="#123B2C" stroke-width="1.4"/></svg>
                                </span>
                                <div>
                                    <h2 class="font-display text-xl text-ink">আমাদের নেটওয়ার্ক</h2>
                                    <p class="mt-3 text-sm leading-relaxed text-ink/70">
                                        সারা দেশজুড়ে ছড়িয়ে থাকা <a href="#" class="rounded-sm font-medium text-golddark underline decoration-gold underline-offset-2 hover:text-ink focus:outline-none focus-visible:ring-1 focus-visible:ring-gold">শাখা</a>,
                                        নিয়মিত <a href="#" class="rounded-sm font-medium text-golddark underline decoration-gold underline-offset-2 hover:text-ink focus:outline-none focus-visible:ring-1 focus-visible:ring-gold">প্রশিক্ষণ কেন্দ্র</a>,
                                        সদস্যদের জন্য <a href="#" class="rounded-sm font-medium text-golddark underline decoration-gold underline-offset-2 hover:text-ink focus:outline-none focus-visible:ring-1 focus-visible:ring-gold">বীমা সুবিধা</a>,
                                        নিবেদিত <a href="#" class="rounded-sm font-medium text-golddark underline decoration-gold underline-offset-2 hover:text-ink focus:outline-none focus-visible:ring-1 focus-visible:ring-gold">মাঠকর্মী দল</a> এবং
                                        গ্রামীণ পর্যায়ে <a href="#" class="rounded-sm font-medium text-golddark underline decoration-gold underline-offset-2 hover:text-ink focus:outline-none focus-visible:ring-1 focus-visible:ring-gold">এজেন্ট ব্যাংকিং</a> —
                                        সবকিছু নিয়ে আমাদের বিশ্বাসের নেটওয়ার্ক।
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>
                </main>

                <!-- FOOTER -->
                <footer class="flex flex-col items-center gap-2 border-t border-ink/10 py-10 text-center text-xs text-ink/50">
                    <span>© {{ date('Y') }} আস্থা মাইক্রোফাইন্যান্স। সর্বস্বত্ব সংরক্ষিত।</span>
                    <span class="font-mono-num">Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</span>
                </footer>
            </div>
        </div>
    </body>
</html>