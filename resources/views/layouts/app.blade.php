<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portofolio - Farah Raihanun Badiu')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Preloader + Top Bar Styles -->
    <noscript><style>#cute-preloader{display:none !important;}#top-bar{display:none !important;}</style></noscript>
    <style>
        /* ===== TOP PROGRESS BAR ===== */
        #top-bar {
            position: fixed;
            top: 0; left: 0;
            height: 3px;
            width: 0%;
            z-index: 10000;
            background: linear-gradient(90deg, #E0457B, #F8C8DC, #E0457B);
            background-size: 200% 100%;
            transition: width 0.3s ease;
            pointer-events: none;
        }
        #top-bar::after {
            content: '';
            position: absolute;
            right: 0; top: 0;
            width: 60px; height: 100%;
            background: rgba(255,255,255,0.7);
            filter: blur(4px);
            animation: topBarGlow 0.8s ease-in-out infinite alternate;
        }
        @keyframes topBarGlow {
            0%   { opacity: 0.4; }
            100% { opacity: 1; }
        }
        @keyframes topBarShimmer {
            0%   { background-position: 200% center; }
            100% { background-position: -200% center; }
        }

        /* ===== PRELOADER ===== */
        #cute-preloader {
            position: fixed;
            inset: 0;
            z-index: 9999;
            background-color: #FCFDFE;
            background-image: radial-gradient(circle at center, rgba(248,200,220,0.4) 0%, transparent 70%),
                              radial-gradient(#F8C8DC 1px, transparent 1px);
            background-size: 100% 100%, 24px 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        .preloader-hidden {
            opacity: 0;
            transform: translateY(-20px);
            pointer-events: none;
        }

        /* Robot keyframes — transform + opacity only */
        @keyframes floatRobot   { 0%,100%{transform:translateY(0)}    50%{transform:translateY(-12px)} }
        @keyframes blinkEyes    { 0%,90%,100%{transform:scaleY(1)}     92%,98%{transform:scaleY(0.08)} }
        @keyframes wiggleAntenna{ 0%,100%{transform:rotate(0deg)}      30%{transform:rotate(12deg)}  70%{transform:rotate(-12deg)} }
        @keyframes blinkBall    { 0%,100%{opacity:1}                    50%{opacity:0.35} }
        @keyframes waveArm      { 0%,100%{transform:rotate(0deg)}      50%{transform:rotate(-35deg)} }
        @keyframes jumpRobot    { 0%,100%{transform:translateY(0)}      50%{transform:translateY(-22px)} }
        @keyframes showHeart    { 0%{opacity:0;transform:translateY(10px) scale(0)} 60%{opacity:1;transform:translateY(-12px) scale(1.2)} 100%{opacity:1;transform:translateY(-18px) scale(1)} }
        @keyframes floatDecor   { 0%,100%{transform:translateY(0) rotate(0deg)} 50%{transform:translateY(-16px) rotate(12deg)} }
        @keyframes blinkCursor  { 0%,100%{opacity:1} 50%{opacity:0} }
        @keyframes blinkBolt    { 0%,100%{opacity:1} 50%{opacity:0.4} }
        /* Stripe: use translateX (hardware-accelerated) */
        @keyframes stripeMove   { 0%{transform:translateX(-100%)} 100%{transform:translateX(100%)} }
        /* Pulse fallback for reduced-motion */
        @keyframes softPulse    { 0%,100%{opacity:1} 50%{opacity:0.65} }

        /* Robot parts */
        .robot-body-group { animation: floatRobot 2.8s ease-in-out infinite; }
        .robot-eyes       { animation: blinkEyes 3.5s ease-in-out infinite; transform-origin: center; }
        .robot-antenna    { animation: wiggleAntenna 2s ease-in-out infinite; transform-origin: 50px 40px; }
        .robot-antenna-ball { animation: blinkBall 1.2s ease-in-out infinite; }
        .robot-arm-right  { animation: waveArm 2.2s ease-in-out infinite; transform-origin: 75px 70px; }
        .robot-jump       { animation: jumpRobot 0.5s ease-out forwards; }
        .heart-popup      { opacity: 0; }
        .show-heart-anim  { animation: showHeart 0.6s ease-out forwards; }

        /* Battery */
        .battery-container {
            width: 200px; height: 24px;
            border: 2px solid #E0457B; border-radius: 12px;
            position: relative; margin-top: 30px; padding: 2px; background: white;
        }
        .battery-container::after {
            content: ''; position: absolute; right: -6px; top: 50%;
            transform: translateY(-50%);
            width: 4px; height: 10px;
            background: #E0457B; border-radius: 0 4px 4px 0;
        }
        .battery-fill {
            height: 100%; width: 0%;
            background: linear-gradient(90deg, #F8C8DC, #E0457B);
            border-radius: 8px;
            position: relative; overflow: hidden;
            transition: width 0.12s linear;
        }
        /* Stripe shine using transform not background-position */
        .battery-fill::after {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 60%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.55), transparent);
            animation: stripeMove 1.1s linear infinite;
            will-change: transform;
        }
        .battery-bolt {
            position: absolute; top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            fill: #E0457B;
            animation: blinkBolt 0.9s ease-in-out infinite;
            z-index: 2;
        }

        /* Text */
        .loading-text { font-family: 'JetBrains Mono', monospace; color: #E0457B; font-size: 0.875rem; margin-top: 12px; display: flex; align-items: center; gap: 4px; }
        .loading-cursor { display: inline-block; width: 8px; height: 16px; background-color: #E0457B; animation: blinkCursor 0.75s step-end infinite; }

        /* Decorations */
        .decor-item { position: absolute; animation: floatDecor 4s ease-in-out infinite; opacity: 0.7; }
        .decor-1 { top: 20%; left: 20%; animation-delay: 0s; }
        .decor-2 { top: 30%; right: 25%; animation-delay: -1s; }
        .decor-3 { bottom: 25%; left: 25%; animation-delay: -2s; }
        .decor-4 { bottom: 35%; right: 20%; animation-delay: -0.5s; }
        .decor-5 { top: 15%; right: 35%; animation-delay: -1.5s; }

        /* Reduced motion: replace movement with gentle pulse, NOT animation:none */
        @media (prefers-reduced-motion: reduce) {
            .robot-body-group, .robot-eyes, .robot-antenna, .robot-arm-right, .decor-item {
                animation: softPulse 2s ease-in-out infinite !important;
            }
            .robot-antenna-ball, .battery-bolt, .loading-cursor {
                animation: softPulse 1.5s ease-in-out infinite !important;
            }
            .battery-fill::after { animation: none !important; }
        }
    </style>
</head>
<body class="bg-[#FCFDFE] text-gray-800 font-sans antialiased bg-[radial-gradient(#F8C8DC_1px,transparent_1px)] [background-size:24px_24px]">

    <!-- Top Progress Bar -->
    <div id="top-bar" role="progressbar" aria-label="Memuat halaman" aria-valuemin="0" aria-valuemax="100"></div>

    <!-- Cute Robot Preloader -->
    <div id="cute-preloader" role="status" aria-live="polite">
        <span class="sr-only" style="position:absolute; width:1px; height:1px; overflow:hidden;">Memuat halaman</span>
        
        <svg class="decor-item decor-1" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#E0457B" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
        <svg class="decor-item decor-2" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#E0457B" stroke-width="2"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>
        <svg class="decor-item decor-3" width="20" height="20" viewBox="0 0 24 24" fill="#F8C8DC" stroke="#E0457B" stroke-width="1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
        <svg class="decor-item decor-4" width="20" height="20" viewBox="0 0 24 24" fill="#F8C8DC" stroke="#E0457B" stroke-width="1"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
        <svg class="decor-item decor-5" width="16" height="16" viewBox="0 0 24 24" fill="#E0457B"><circle cx="12" cy="12" r="10"></circle></svg>

        <svg width="120" height="140" viewBox="0 0 100 120" xmlns="http://www.w3.org/2000/svg" id="robot-svg">
            <g class="robot-body-group">
                <path class="heart-popup" id="robot-heart" d="M50 15 C50 15, 45 5, 35 10 C25 15, 25 30, 50 45 C75 30, 75 15, 65 10 C55 5, 50 15, 50 15 Z" fill="#E0457B"/>
                <g class="robot-antenna">
                    <line x1="50" y1="40" x2="50" y2="20" stroke="#E0457B" stroke-width="3" stroke-linecap="round"/>
                    <circle class="robot-antenna-ball" cx="50" cy="20" r="4" fill="#E0457B"/>
                </g>
                <path d="M 25 70 Q 10 70 15 90" fill="none" stroke="#E0457B" stroke-width="6" stroke-linecap="round"/>
                <g class="robot-arm-right">
                    <path d="M 75 70 Q 90 70 85 50" fill="none" stroke="#E0457B" stroke-width="6" stroke-linecap="round"/>
                </g>
                <circle cx="50" cy="70" r="30" fill="#F8C8DC" stroke="#E0457B" stroke-width="4"/>
                <g class="robot-eyes">
                    <circle cx="38" cy="65" r="5" fill="#E0457B"/>
                    <circle cx="39" cy="63" r="1.5" fill="white"/>
                    <circle cx="62" cy="65" r="5" fill="#E0457B"/>
                    <circle cx="63" cy="63" r="1.5" fill="white"/>
                </g>
                <ellipse cx="28" cy="72" rx="4" ry="2" fill="#E0457B" opacity="0.4"/>
                <ellipse cx="72" cy="72" rx="4" ry="2" fill="#E0457B" opacity="0.4"/>
                <path d="M 45 75 Q 50 80 55 75" fill="none" stroke="#E0457B" stroke-width="2.5" stroke-linecap="round"/>
                <path d="M 40 100 L 40 105 A 10 5 0 0 0 60 105 L 60 100 Z" fill="#E0457B"/>
            </g>
        </svg>

        <div class="flex items-center gap-3">
            <div class="battery-container">
                <div class="battery-fill" id="battery-fill"></div>
                <svg class="battery-bolt" width="12" height="16" viewBox="0 0 24 24"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2" fill="#E0457B"/></svg>
            </div>
            <span class="text-sm font-bold text-[#E0457B] mt-7 w-8" id="battery-pct">0%</span>
        </div>

        <div class="loading-text">
            <span id="loading-msg">menyalakan robot imut...</span>
            <span class="loading-cursor"></span>
        </div>
    </div>

    <script>
    (function() {
        // ===== TOP PROGRESS BAR =====
        const topBar = document.getElementById('top-bar');
        if (topBar) {
            let tbProgress = 0;
            topBar.style.width = '0%';
            const tbInterval = setInterval(() => {
                if (tbProgress < 80) {
                    // Ease-in advance: faster at start, slower near 80
                    tbProgress += (80 - tbProgress) * 0.08 + 0.5;
                    topBar.style.width = Math.min(tbProgress, 80) + '%';
                }
            }, 80);
            window.addEventListener('load', () => {
                clearInterval(tbInterval);
                topBar.style.width = '100%';
                setTimeout(() => {
                    topBar.style.transition = 'opacity 0.4s ease';
                    topBar.style.opacity = '0';
                    setTimeout(() => { topBar.style.display = 'none'; }, 450);
                }, 300);
            }, { once: true });
        }

        try {
            const navEntries = performance.getEntriesByType('navigation');
            const isNavigationOrReload = navEntries.length === 0 || navEntries[0].type === 'navigate' || navEntries[0].type === 'reload';
        const isFirstTime = !sessionStorage.getItem('preloader_shown');
        
        if (!isNavigationOrReload && !isFirstTime) {
            document.getElementById('cute-preloader').style.display = 'none';
            window.dispatchEvent(new CustomEvent('preloader-done'));
            return;
        }
        
        document.documentElement.style.overflow = 'hidden';
        document.body.style.overflow = 'hidden';
        sessionStorage.setItem('preloader_shown', 'true');

        const msgs = [
            "menyalakan robot imut...",
            "mengisi daya semangat...",
            "memetakan UMKM Sorong...",
            "melatih model XGBoost...",
            "siap! halo, aku Farah"
        ];
        let msgIndex = 0;
        const msgEl = document.getElementById('loading-msg');
        const fillEl = document.getElementById('battery-fill');
        const pctEl = document.getElementById('battery-pct');
        const robotGrp = document.querySelector('.robot-body-group');
        const heart = document.getElementById('robot-heart');
        
        let progress = 0;
        let isLoaded = false;
        let minTimePassed = false;
        const minTime = 1500;
        const maxTime = 3500;
        const startTime = Date.now();

        const textInterval = setInterval(() => {
            msgIndex++;
            if (msgIndex < msgs.length) {
                msgEl.textContent = msgs[msgIndex];
            } else {
                msgEl.textContent = msgs[msgs.length - 1];
                clearInterval(textInterval);
            }
        }, 700);

        const progressInterval = setInterval(() => {
            if (progress < 90) {
                progress += Math.random() * 15;
                if (progress > 90) progress = 90;
                fillEl.style.width = progress + '%';
                pctEl.textContent = Math.floor(progress) + '%';
            }
        }, 200);

        function finishLoading() {
            if (!isLoaded || !minTimePassed) return;
            
            clearInterval(progressInterval);
            clearInterval(textInterval);
            fillEl.style.width = '100%';
            pctEl.textContent = '100%';
            msgEl.textContent = msgs[msgs.length - 1];
            
            if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                robotGrp.classList.remove('robot-body-group');
                robotGrp.classList.add('robot-jump');
                heart.classList.add('show-heart-anim');
            }

            setTimeout(() => {
                const loader = document.getElementById('cute-preloader');
                loader.classList.add('preloader-hidden');
                setTimeout(() => {
                    loader.style.display = 'none';
                    document.documentElement.style.overflow = '';
                    document.body.style.overflow = '';
                    window.dispatchEvent(new CustomEvent('preloader-done'));
                }, 500);
            }, 500);
        }

        window.addEventListener('load', () => {
            isLoaded = true;
            const elapsed = Date.now() - startTime;
            if (elapsed < minTime) {
                setTimeout(() => {
                    minTimePassed = true;
                    finishLoading();
                }, minTime - elapsed);
            } else {
                minTimePassed = true;
                finishLoading();
            }
        });

        setTimeout(() => {
            if (document.getElementById('cute-preloader').style.display !== 'none') {
                isLoaded = true;
                minTimePassed = true;
                finishLoading();
            }
        }, maxTime);
        } catch (error) {
            console.error('Preloader error:', error);
            const loader = document.getElementById('cute-preloader');
            if (loader) loader.style.display = 'none';
            document.documentElement.style.overflow = '';
            document.body.style.overflow = '';
            window.dispatchEvent(new CustomEvent('preloader-done'));
        }
    })();
    </script>

    @php
    $navMenus = [
        ['label' => 'Tentang', 'href' => '#about'],
        ['label' => 'Proyek', 'href' => '#projects'],
        ['label' => 'Keahlian', 'href' => '#skills'],
        ['label' => 'Pencapaian', 'href' => '#achievements'],
        ['label' => 'Galeri', 'href' => '#gallery'],
        ['label' => 'Kontak', 'href' => '#contact'],
    ];
    @endphp

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('navbar', () => ({
                scrolled: false,
                scrollProgress: 0,
                activeSection: '#about',
                mobileMenuOpen: false,
                indicatorStyle: 'opacity: 0;',
                dotStyle: 'opacity: 0;',
                
                init() {
                    this.onScroll();
                    
                    const sections = document.querySelectorAll('section[id]');
                    const observer = new IntersectionObserver((entries) => {
                        let current = this.activeSection;
                        entries.forEach(entry => {
                            if (entry.isIntersecting && entry.intersectionRatio > 0.1) {
                                current = '#' + entry.target.id;
                            }
                        });
                        
                        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 50) {
                            current = '#contact'; 
                        }
                        
                        if (this.activeSection !== current) {
                            this.activeSection = current;
                            this.resetIndicator();
                        }
                    }, { threshold: [0.1, 0.5, 0.8], rootMargin: '-20% 0px -40% 0px' });
                    
                    sections.forEach(section => observer.observe(section));
                    
                    setTimeout(() => {
                        this.resetIndicator();
                    }, 300);
                    
                    window.addEventListener('resize', () => {
                        this.resetIndicator();
                    });
                },
                
                onScroll() {
                    this.scrolled = window.scrollY > 20;
                    
                    const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                    const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                    this.scrollProgress = height > 0 ? (winScroll / height) * 100 : 0;
                    
                    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 20) {
                        if (this.activeSection !== '#contact') {
                            this.activeSection = '#contact';
                            this.resetIndicator();
                        }
                    }
                },
                
                updateIndicator(el) {
                    if (!el) return;
                    // Check if prefers-reduced-motion is enabled
                    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                    const containerRect = this.$refs.menuContainer.getBoundingClientRect();
                    const rect = el.getBoundingClientRect();
                    const left = rect.left - containerRect.left;
                    const width = rect.width;
                    
                    this.indicatorStyle = `left: ${left}px; width: ${width}px; opacity: 1; transition: ${reduceMotion ? 'none' : 'all 0.3s ease-out'};`;
                    this.dotStyle = `left: ${left + width/2 - 2}px; opacity: 1; transition: ${reduceMotion ? 'none' : 'all 0.3s ease-out'};`;
                },
                
                resetIndicator() {
                    if (!this.$refs.menuContainer) return;
                    const activeEl = this.$refs.menuContainer.querySelector(`a[href="${this.activeSection}"]`);
                    if (activeEl) {
                        this.updateIndicator(activeEl);
                    } else {
                        this.indicatorStyle = 'opacity: 0;';
                        this.dotStyle = 'opacity: 0;';
                    }
                }
            }));
        });
    </script>

    <nav x-data="navbar" 
         @scroll.window="onScroll"
         :class="{ 
            'py-4 bg-transparent': !scrolled, 
            'py-2 bg-white/80 backdrop-blur-md shadow-[0_4px_20px_rgba(248,200,220,0.4)]': scrolled 
         }"
         class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
         x-init="
            $el.classList.add('motion-safe:-translate-y-full', 'motion-safe:opacity-0');
            setTimeout(() => {
                $el.classList.remove('motion-safe:-translate-y-full', 'motion-safe:opacity-0');
                $el.classList.add('motion-safe:translate-y-0', 'motion-safe:opacity-100');
            }, 100);
         "
         >
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-12">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" 
                       class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-primary-500 to-primary-600 bg-[length:200%_auto] hover:bg-right transition-all duration-1000 motion-reduce:transition-none">
                        Farah Raihanun Badiu
                    </a>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex md:items-center md:space-x-8 relative" x-ref="menuContainer">
                    <!-- Flying Indicator -->
                    <div class="absolute -bottom-1 h-[2px] bg-primary-500 rounded-full transition-all duration-300 ease-out hidden md:block motion-reduce:transition-none"
                         :style="indicatorStyle"></div>
                         
                    <!-- Dot Indicator -->
                    <div class="absolute -bottom-2 h-1 w-1 bg-primary-500 rounded-full transition-all duration-300 ease-out hidden md:block motion-reduce:transition-none"
                         :style="dotStyle"></div>

                    @foreach($navMenus as $index => $menu)
                    <a href="{{ $menu['href'] }}"
                       @mouseenter="updateIndicator($event.currentTarget)"
                       @mouseleave="resetIndicator()"
                       :aria-current="activeSection === '{{ $menu['href'] }}' ? 'page' : null"
                       class="relative inline-flex items-center text-sm font-medium transition-colors duration-300 motion-safe:opacity-0 motion-safe:-translate-y-2 motion-reduce:opacity-100 motion-reduce:translate-y-0 hover:text-primary-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 rounded-sm"
                       x-init="setTimeout(() => { $el.classList.remove('motion-safe:opacity-0', 'motion-safe:-translate-y-2') }, 200 + ({{ $index }} * 60))"
                       :class="activeSection === '{{ $menu['href'] }}' ? 'text-primary-600' : 'text-gray-600'"
                       >
                        <span class="transition-transform duration-300 motion-reduce:transition-none"
                              :class="activeSection === '{{ $menu['href'] }}' ? '-translate-y-[1px]' : 'group-hover:-translate-y-[1px]'">
                            {{ $menu['label'] }}
                        </span>
                    </a>
                    @endforeach
                </div>
                
                <!-- Mobile menu button -->
                <div class="flex items-center md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                            :aria-expanded="mobileMenuOpen"
                            class="p-2 min-h-[44px] min-w-[44px] rounded-md text-gray-600 hover:text-primary-500 hover:bg-primary-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 transition-colors z-50">
                        <span class="sr-only">Buka menu utama</span>
                        <!-- Hamburger icon with animation -->
                        <div class="w-6 h-5 relative flex flex-col justify-between">
                            <span class="w-full h-[2px] bg-current rounded-full transition-all duration-300 origin-left motion-reduce:transition-none"
                                  :class="mobileMenuOpen ? 'rotate-45 translate-x-[2px] -translate-y-[1px]' : ''"></span>
                            <span class="w-full h-[2px] bg-current rounded-full transition-all duration-300 motion-reduce:transition-none"
                                  :class="mobileMenuOpen ? 'opacity-0 translate-x-3' : ''"></span>
                            <span class="w-full h-[2px] bg-current rounded-full transition-all duration-300 origin-left motion-reduce:transition-none"
                                  :class="mobileMenuOpen ? '-rotate-45 translate-x-[2px] translate-y-[1px]' : ''"></span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Progress Bar -->
        <div class="absolute bottom-0 left-0 h-[3px] bg-primary-500 transition-all duration-150 ease-out"
             :style="'width: ' + scrollProgress + '%'"></div>
             
        <!-- Mobile Menu Panel -->
        <div x-show="mobileMenuOpen"
             @click.outside="mobileMenuOpen = false"
             @keydown.escape.window="mobileMenuOpen = false"
             x-transition:enter="transition ease-out duration-300 motion-reduce:transition-none"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200 motion-reduce:transition-none"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="md:hidden absolute top-full left-0 right-0 bg-white/95 backdrop-blur-md shadow-xl border-t border-gray-100"
             style="display: none;">
            <div class="px-4 pt-2 pb-6 space-y-1">
                @foreach($navMenus as $index => $menu)
                <a href="{{ $menu['href'] }}"
                   @click="mobileMenuOpen = false"
                   :aria-current="activeSection === '{{ $menu['href'] }}' ? 'page' : null"
                   class="block px-3 py-3 rounded-xl text-base font-medium transition-colors motion-safe:opacity-0 motion-safe:-translate-x-2 motion-reduce:opacity-100 motion-reduce:translate-x-0 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500"
                   x-init="$watch('mobileMenuOpen', val => { 
                       if(val && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                           setTimeout(() => { $el.classList.remove('motion-safe:opacity-0', 'motion-safe:-translate-x-2') }, 50 + ({{ $index }} * 50));
                       } else {
                           $el.classList.add('motion-safe:opacity-0', 'motion-safe:-translate-x-2');
                       }
                   })"
                   :class="activeSection === '{{ $menu['href'] }}' ? 'bg-primary-50 text-primary-600' : 'text-gray-700 hover:bg-gray-50 hover:text-primary-500'"
                   >
                    {{ $menu['label'] }}
                </a>
                @endforeach
            </div>
        </div>
    </nav>

    <main class="pt-16 min-h-screen">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-gray-100 py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-500 text-sm">
                &copy; {{ date('Y') }} Farah Raihanun Badiu. Dibuat dengan cinta dan Laravel.
            </p>
        </div>
    </footer>

    <!-- Back to top button -->
    <div x-data="{ showTopBtn: false }" 
         @scroll.window="showTopBtn = window.scrollY > 600"
         class="fixed bottom-6 right-6 z-40">
        <button @click="window.scrollTo({top: 0, behavior: 'smooth'})"
                x-show="showTopBtn"
                x-transition:enter="transition ease-out duration-300 motion-reduce:transition-none"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200 motion-reduce:transition-none"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-4"
                style="display: none;"
                class="bg-primary-500 hover:bg-primary-600 text-white w-12 h-12 rounded-full shadow-[0_4px_15px_rgba(224,69,123,0.4)] hover:shadow-[0_6px_20px_rgba(224,69,123,0.6)] flex items-center justify-center transition-all btn-press focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-primary-500"
                aria-label="Kembali ke atas">
            <span class="material-symbols-outlined">arrow_upward</span>
        </button>
    </div>

</body>
</html>
