<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />

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
<body class="bg-gray-50 font-sans antialiased text-gray-800">

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
            <span id="loading-msg">menyiapkan admin panel...</span>
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
            
            const isFirstTime = !sessionStorage.getItem('admin_preloader_shown');
            
            if (!isNavigationOrReload && !isFirstTime) {
                document.getElementById('cute-preloader').style.display = 'none';
                return;
            }
            
            document.documentElement.style.overflow = 'hidden';
            document.body.style.overflow = 'hidden';
            sessionStorage.setItem('admin_preloader_shown', 'true');

            const msgs = [
                "menyiapkan admin panel...",
                "memuat data dashboard...",
                "mengamankan koneksi...",
                "siap digunakan!"
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
            const minTime = 800; 
            const maxTime = 2000;
            const startTime = Date.now();

            const textInterval = setInterval(() => {
                msgIndex++;
                if (msgIndex < msgs.length) {
                    msgEl.textContent = msgs[msgIndex];
                } else {
                    msgEl.textContent = msgs[msgs.length - 1];
                    clearInterval(textInterval);
                }
            }, 400);

            const progressInterval = setInterval(() => {
                if (progress < 90) {
                    progress += Math.random() * 25;
                    if (progress > 90) progress = 90;
                    fillEl.style.width = progress + '%';
                    pctEl.textContent = Math.floor(progress) + '%';
                }
            }, 100);

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
                    }, 500);
                }, 400);
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
            document.getElementById('cute-preloader').style.display = 'none';
            document.documentElement.style.overflow = '';
            document.body.style.overflow = '';
        }
    })();
    </script>

    <div class="min-h-screen flex" x-data="{ sidebarOpen: false }">
        <!-- Sidebar -->
        <aside class="bg-white w-64 border-r border-gray-200 fixed inset-y-0 left-0 z-50 transform transition-transform duration-300 md:translate-x-0" :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}">
            <div class="h-16 flex items-center px-6 border-b border-gray-100">
                <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-primary-500 to-primary-600">
                    Admin Panel
                </span>
            </div>
            
            <nav class="p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-primary-50 text-primary-600 font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <span class="material-symbols-outlined">dashboard</span>
                    Dashboard
                </a>
                
                <div class="pt-4 pb-2">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Kelola Konten</p>
                </div>
                <a href="{{ route('admin.projects.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.projects.*') ? 'bg-primary-50 text-primary-600 font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <span class="material-symbols-outlined">work</span>
                    Proyek
                </a>
                <a href="{{ route('admin.skills.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.skills.*') ? 'bg-primary-50 text-primary-600 font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <span class="material-symbols-outlined">code</span>
                    Keahlian
                </a>
                <a href="{{ route('admin.achievements.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.achievements.*') ? 'bg-primary-50 text-primary-600 font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <span class="material-symbols-outlined">emoji_events</span>
                    Pencapaian
                </a>
                <a href="{{ route('admin.artworks.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.artworks.*') ? 'bg-primary-50 text-primary-600 font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <span class="material-symbols-outlined">photo_library</span>
                    Galeri Karya
                </a>
                
                <div class="pt-4 pb-2">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Interaksi</p>
                </div>
                <a href="{{ route('admin.messages.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.messages.*') ? 'bg-primary-50 text-primary-600 font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <span class="material-symbols-outlined">mail</span>
                    Pesan
                </a>
                
                <div class="pt-4 pb-2">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Sistem</p>
                </div>
                <a href="{{ route('admin.settings.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-primary-50 text-primary-600 font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <span class="material-symbols-outlined">settings</span>
                    Pengaturan Profil
                </a>
                
                <form method="POST" action="{{ route('logout') }}" class="pt-4 border-t border-gray-100 mt-4">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-colors text-red-600 hover:bg-red-50 font-medium">
                        <span class="material-symbols-outlined">logout</span>
                        Keluar
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Overlay -->
        <div class="fixed inset-0 bg-gray-900/50 z-40 md:hidden" x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity></div>

        <!-- Main Content -->
        <main class="flex-1 md:ml-64 min-w-0">
            <!-- Header -->
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 sm:px-6 sticky top-0 z-30">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="md:hidden p-2 text-gray-500 hover:bg-gray-100 rounded-lg">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                    <h2 class="text-xl font-semibold text-gray-800">@yield('title')</h2>
                </div>
                
                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" target="_blank" class="text-sm font-medium text-gray-500 hover:text-primary-600 flex items-center gap-2">
                        <span>Lihat Situs</span>
                        <span class="material-symbols-outlined text-sm">open_in_new</span>
                    </a>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-4 sm:p-6 lg:p-8">
                @if(session('success'))
                <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-6 flex items-center gap-3">
                    <span class="material-symbols-outlined">check_circle</span>
                    {{ session('success') }}
                </div>
                @endif
                
                @yield('content')
            </div>
        </main>
    </div>

</body>
</html>
