 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Astha Microfinance — Small Loans, Big Dreams</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy:    '#0C1A2E',
                        navy2:   '#132340',
                        cream:   '#FAFAF7',
                        gold:    '#C9A243',
                        golddk:  '#A6872D',
                        coral:   '#D35E42',
                        muted:   '#6B7A8D',
                        soft:    '#8E9DB0',
                        border:  '#E8E5DE',
                    },
                    fontFamily: {
                        display: ['"DM Serif Display"', 'Georgia', 'serif'],
                        body:    ['"DM Sans"', 'system-ui', 'sans-serif'],
                        mono:    ['"JetBrains Mono"', 'monospace'],
                    },
                },
            },
        }
    </script>
    <style>
        body { font-family: 'DM Sans', system-ui, sans-serif; }
        .font-display { font-family: 'DM Serif Display', Georgia, serif; }
        .font-mono-num { font-family: 'JetBrains Mono', monospace; }

        /* Glass navbar */
        .glass-nav {
            background: rgba(250, 250, 247, 0.82);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        /* Entrance animation */
        @keyframes rise {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .rise { animation: rise 0.65s cubic-bezier(0.23, 1, 0.32, 1) both; }
        .rise-d1 { animation-delay: 0.08s; }
        .rise-d2 { animation-delay: 0.18s; }
        .rise-d3 { animation-delay: 0.30s; }

        /* Ping dot */
        @keyframes soft-ping {
            0%   { transform: scale(1); opacity: 0.7; }
            100% { transform: scale(2.2); opacity: 0; }
        }
        .soft-ping { animation: soft-ping 2s cubic-bezier(0, 0, 0.2, 1) infinite; }

        /* Hover lift */
        .lift { transition: transform 0.3s cubic-bezier(0.23, 1, 0.32, 1), box-shadow 0.3s ease; }
        .lift:hover { transform: translateY(-3px); }

        /* Reduced motion */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body class="font-body antialiased bg-cream text-navy overflow-x-hidden">

    <!-- ========== NAVBAR ========== -->
    <header class="fixed top-0 left-0 right-0 z-50 glass-nav border-b border-navy/[0.05]">
        <div class="max-w-5xl mx-auto px-5 sm:px-6 flex items-center justify-between h-14 sm:h-16">
            <a href="/" class="flex items-center gap-2.5">
                <span class="w-8 h-8 rounded-lg bg-navy flex items-center justify-center text-cream font-display text-sm">A</span>
                <span class="font-display text-[15px] text-navy hidden sm:inline">Astha Microfinance</span>
            </a>
            <nav class="flex items-center gap-2">
                <a href="/login" class="px-3.5 py-1.5 text-sm font-medium text-muted hover:text-navy transition-colors rounded-md">Log in</a>
                <a href="/register" class="px-4 py-1.5 text-sm font-semibold text-cream bg-navy rounded-lg hover:bg-navy2 transition-colors shadow-sm shadow-navy/10">Get Started</a>
            </nav>
        </div>
    </header>

    <!-- ========== HERO ========== -->
    <section class="relative bg-navy pt-14 sm:pt-16 pb-20 sm:pb-28 overflow-hidden">
        <!-- Background blurs -->
        <div class="absolute top-[15%] -left-24 w-80 h-80 rounded-full bg-gold/[0.035] blur-[90px] pointer-events-none"></div>
        <div class="absolute bottom-[5%] right-[0%] w-64 h-64 rounded-full bg-coral/[0.025] blur-[70px] pointer-events-none"></div>

        <div class="relative z-10 max-w-5xl mx-auto px-5 sm:px-6 pt-12 sm:pt-20 lg:pt-24">
            <div class="max-w-xl">
                <!-- Badge -->
                <div class="rise inline-flex items-center gap-2 rounded-full bg-white/[0.06] border border-white/[0.07] px-3.5 py-1.5">
                    <span class="relative flex w-1.5 h-1.5">
                        <span class="absolute inset-0 rounded-full bg-gold soft-ping"></span>
                        <span class="relative w-1.5 h-1.5 rounded-full bg-gold"></span>
                    </span>
                    <span class="text-[11px] font-medium text-white/40 tracking-wide">No collateral &middot; Weekly payments &middot; Doorstep collection</span>
                </div>

                <!-- Heading -->
                <h1 class="rise rise-d1 mt-7 sm:mt-9 font-display text-[2.4rem] sm:text-5xl lg:text-[3.4rem] leading-[1.08] text-white">
                    Small loans,<br><span class="text-gold">big dreams</span> fulfilled.
                </h1>

                <!-- Subtext -->
                <p class="rise rise-d2 mt-5 text-[15px] sm:text-base leading-[1.75] text-white/40 max-w-md">
                    Collateral-free loans for micro-entrepreneurs, farmers and households — with transparent passbooks and a savings account you can rely on.
                </p>

                <!-- Buttons -->
                <div class="rise rise-d3 mt-8 flex flex-wrap gap-3">
                    <a href="#apply" class="inline-flex items-center gap-2 bg-coral text-white px-5 sm:px-6 py-3 rounded-xl text-sm font-semibold shadow-lg shadow-coral/20 hover:shadow-xl hover:shadow-coral/30 hover:-translate-y-0.5 transition-all duration-300">
                        Apply for a Loan
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </a>
                    <a href="#branches" class="inline-flex items-center gap-2 text-white/55 border border-white/[0.1] px-5 sm:px-6 py-3 rounded-xl text-sm font-medium hover:bg-white/[0.05] hover:text-white/80 transition-all duration-300">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 0115 0z"/></svg>
                        Find a Branch
                    </a>
                </div>
            </div>
        </div>

        <!-- Wave separator -->
        <div class="absolute bottom-0 left-0 right-0" aria-hidden="true">
            <svg viewBox="0 0 1440 40" class="w-full block" preserveAspectRatio="none"><path d="M0 40V18C320 2 640 32 960 14C1120 6 1300 16 1440 12V40H0Z" fill="#FAFAF7"/></svg>
        </div>
    </section>

    <!-- ========== STATS ========== -->
    <section class="bg-cream">
        <div class="max-w-5xl mx-auto px-5 sm:px-6 py-10 sm:py-14">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4">
                <!-- Stat 1 -->
                <div class="lift rounded-2xl bg-navy p-6 sm:p-7">
                    <p class="font-mono-num text-2xl sm:text-3xl font-semibold text-white tracking-tight">50,000<span class="text-gold">+</span></p>
                    <p class="mt-1.5 text-sm text-white/35">Active Members</p>
                    <div class="mt-3 w-7 h-[3px] rounded-full bg-gold/35"></div>
                </div>
                <!-- Stat 2 -->
                <div class="lift rounded-2xl bg-white p-6 sm:p-7 border border-navy/[0.05]">
                    <p class="font-mono-num text-2xl sm:text-3xl font-semibold text-navy tracking-tight">&#x09F3;200 <span class="text-coral text-base sm:text-lg align-middle">Cr+</span></p>
                    <p class="mt-1.5 text-sm text-muted">Loans Disbursed</p>
                    <div class="mt-3 w-7 h-[3px] rounded-full bg-coral/25"></div>
                </div>
                <!-- Stat 3 -->
                <div class="lift rounded-2xl bg-white p-6 sm:p-7 border border-navy/[0.05]">
                    <p class="font-mono-num text-2xl sm:text-3xl font-semibold text-navy tracking-tight">98<span class="text-gold">%</span></p>
                    <p class="mt-1.5 text-sm text-muted">On-time Repayment Rate</p>
                    <div class="mt-3 w-7 h-[3px] rounded-full bg-gold/25"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== SERVICES ========== -->
    <section class="bg-cream pb-14 sm:pb-20">
        <div class="max-w-5xl mx-auto px-5 sm:px-6">
            <!-- Section divider -->
            <div class="flex items-center gap-4 mb-9">
                <div class="h-px flex-1 bg-navy/[0.07]"></div>
                <span class="text-[11px] font-semibold text-soft tracking-[0.14em] uppercase whitespace-nowrap">What We Offer</span>
                <div class="h-px flex-1 bg-navy/[0.07]"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-3 sm:gap-4">
                <!-- Loan Management — large card -->
                <a href="#loans" class="lift lg:col-span-7 lg:row-span-2 flex flex-col justify-between rounded-2xl bg-navy2 p-7 sm:p-9 text-white group">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="w-9 h-9 rounded-lg bg-gold/[0.1] border border-gold/20 flex items-center justify-center">
                                <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24"><path d="M3 12h4l2 4 4-8 2 4h6" stroke="#C9A243" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                            <span class="text-[10px] font-semibold tracking-[0.14em] text-gold/45 uppercase">Core Service</span>
                        </div>
                        <h2 class="mt-7 font-display text-2xl sm:text-3xl leading-snug">Loan Management</h2>
                        <p class="mt-3.5 max-w-md text-sm leading-[1.8] text-white/40">
                            From application to approval, disbursement to repayment — every step recorded transparently in your passbook. No hidden terms, no collateral risk.
                        </p>
                    </div>
                    <div class="mt-7 flex flex-wrap items-center justify-between gap-3">
                        <span class="flex items-center gap-1.5 text-sm font-medium text-gold group-hover:gap-2.5 transition-all duration-300">
                            Learn more
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="#C9A243"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        </span>
                        <div class="hidden sm:flex items-center gap-2">
                            <span class="rounded-full bg-white/[0.05] border border-white/[0.06] px-3 py-1 text-[10px] text-white/30">No Collateral</span>
                            <span class="rounded-full bg-white/[0.05] border border-white/[0.06] px-3 py-1 text-[10px] text-white/30">Fast Approval</span>
                        </div>
                    </div>
                </a>

                <!-- Weekly Instalments -->
                <a href="#installments" class="lift lg:col-span-5 flex items-start gap-4 rounded-2xl bg-white p-5 sm:p-6 border border-navy/[0.04] group">
                    <span class="w-10 h-10 shrink-0 rounded-xl bg-coral/[0.06] border border-coral/[0.1] flex items-center justify-center">
                        <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24"><rect x="4" y="5" width="16" height="15" rx="2" stroke="#D35E42" stroke-width="1.8"/><path d="M4 9.5h16M8 3v3M16 3v3" stroke="#D35E42" stroke-width="1.8" stroke-linecap="round"/><path d="M8.5 14l2 2 4-4" stroke="#D35E42" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span>
                    <div class="min-w-0">
                        <h2 class="font-display text-lg sm:text-xl text-navy">Weekly Instalments</h2>
                        <p class="mt-2 text-sm leading-[1.75] text-muted">Field officers visit your doorstep every week — no need to travel to make payments.</p>
                        <span class="mt-2.5 inline-flex items-center gap-1 text-xs font-medium text-coral/50 group-hover:text-coral transition-colors">
                            Read more
                            <svg class="w-3 h-3 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                        </span>
                    </div>
                </a>

                <!-- Savings Account -->
                <a href="#savings" class="lift lg:col-span-5 flex items-start gap-4 rounded-2xl bg-white p-5 sm:p-6 border border-navy/[0.04] group">
                    <span class="w-10 h-10 shrink-0 rounded-xl bg-gold/[0.06] border border-gold/[0.1] flex items-center justify-center">
                        <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24"><path d="M4 13c0-4 3-7 8-7 3 0 4 1.5 5 1.5 1 0 1-1 2-1v6c0 1-1 1-2 1l-1 3H8l-1-2c-2 0-3-1-3-1.5z" stroke="#C9A243" stroke-width="1.7" stroke-linejoin="round"/><circle cx="15" cy="9" r="0.8" fill="#C9A243"/></svg>
                    </span>
                    <div class="min-w-0">
                        <h2 class="font-display text-lg sm:text-xl text-navy">Savings Account</h2>
                        <p class="mt-2 text-sm leading-[1.75] text-muted">Small savings accumulate alongside each instalment — a safety net for hard times or future capital.</p>
                        <span class="mt-2.5 inline-flex items-center gap-1 text-xs font-medium text-golddk/50 group-hover:text-golddk transition-colors">
                            Read more
                            <svg class="w-3 h-3 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                        </span>
                    </div>
                </a>

                <!-- Network banner -->
                <div class="lg:col-span-12 rounded-2xl bg-navy/[0.02] border border-navy/[0.04] p-5 sm:p-7">
                    <div class="flex flex-col sm:flex-row items-start gap-4">
                        <span class="w-11 h-11 shrink-0 rounded-xl bg-navy/[0.04] border border-navy/[0.06] flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"><circle cx="7" cy="8" r="2.2" stroke="#0C1A2E" stroke-width="1.6"/><circle cx="17" cy="8" r="2.2" stroke="#0C1A2E" stroke-width="1.6"/><circle cx="12" cy="16" r="2.2" stroke="#0C1A2E" stroke-width="1.6"/><path d="M8.8 9.5L11 13.5M15.2 9.5L13 13.5" stroke="#0C1A2E" stroke-width="1.3"/></svg>
                        </span>
                        <div>
                            <h2 class="font-display text-lg sm:text-xl text-navy">Our Network</h2>
                            <p class="mt-2 text-sm leading-[1.8] text-muted">
                                <a href="#" class="font-medium text-navy underline decoration-navy/15 underline-offset-2 hover:text-coral hover:decoration-coral/30 transition-colors">Branches</a> across the country,
                                regular <a href="#" class="font-medium text-navy underline decoration-navy/15 underline-offset-2 hover:text-coral hover:decoration-coral/30 transition-colors">training centres</a>,
                                member <a href="#" class="font-medium text-navy underline decoration-navy/15 underline-offset-2 hover:text-coral hover:decoration-coral/30 transition-colors">insurance benefits</a>,
                                dedicated <a href="#" class="font-medium text-navy underline decoration-navy/15 underline-offset-2 hover:text-coral hover:decoration-coral/30 transition-colors">field officer teams</a> and
                                rural <a href="#" class="font-medium text-navy underline decoration-navy/15 underline-offset-2 hover:text-coral hover:decoration-coral/30 transition-colors">agent banking</a> — a network built on trust.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== FOOTER ========== -->
    <footer class="relative bg-navy2 overflow-hidden">
        <div class="absolute -top-px left-0 right-0" aria-hidden="true">
            <svg viewBox="0 0 1440 24" class="w-full block" preserveAspectRatio="none"><path d="M0 24V12C360 2 720 18 1080 8C1260 3 1380 10 1440 8V24H0Z" fill="#FAFAF7"/></svg>
        </div>
        <div class="relative max-w-5xl mx-auto px-5 sm:px-6 pt-10 pb-5">
            <div class="flex flex-col items-center gap-2.5">
                <div class="flex items-center gap-2">
                    <span class="w-6 h-6 rounded-md bg-white/[0.06] flex items-center justify-center text-white/40 font-display text-[10px]">A</span>
                    <span class="font-display text-sm text-white/30">Astha Microfinance</span>
                </div>
                <div class="w-10 h-px bg-white/[0.06]"></div>
                <p class="text-[11px] text-white/18 text-center">&copy; 2025 Astha Microfinance. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>