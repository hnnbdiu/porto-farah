@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section id="about" class="relative pt-32 pb-24 lg:pt-48 lg:pb-36 overflow-hidden scroll-mt-24">
    <!-- Hero Background Blobs -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute inset-0 bg-[radial-gradient(#F8C8DC_1.5px,transparent_1.5px)] [background-size:30px_30px] opacity-40 anim-grid"></div>
        <div class="anim-blob absolute w-64 h-64 sm:w-96 sm:h-96 bg-primary-100/30 rounded-full blur-3xl top-10 left-[10%]"></div>
        <div class="anim-blob absolute w-72 h-72 sm:w-[28rem] sm:h-[28rem] bg-primary-50/40 rounded-full blur-3xl top-20 right-[15%]"></div>
        <div class="anim-blob absolute w-64 h-64 sm:w-80 sm:h-80 bg-pink-100/30 rounded-full blur-3xl bottom-10 left-[20%]"></div>
    </div>

    <div class="max-w-6xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-[1.15fr_0.85fr] gap-12 items-center text-left max-w-3xl lg:max-w-none mx-auto">
            <!-- Kolom Kiri: Teks -->
            <div class="order-2 lg:order-1 flex flex-col items-center lg:items-start text-center lg:text-left">
                <div class="reveal rv-hero-badge inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary-50 text-primary-600 text-sm font-medium mb-6">
                    <span class="w-2 h-2 rounded-full bg-primary-500 animate-pulse"></span>
                    Tersedia untuk proyek freelance
                </div>
                <h1 class="reveal rv-hero-title text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-gray-900 mb-6 w-full">
                    Halo, saya <span class="anim-gradient-text text-transparent bg-clip-text bg-gradient-to-r from-primary-500 to-primary-600">{{ $profile->nama ?? 'Nama' }}</span>
                </h1>
                <p class="reveal rv-hero-subtitle text-xl text-gray-600 mb-8 font-mono text-sm sm:text-base w-full">
                    <span class="hero-typing anim-typing-cursor" data-text="{{ $profile->role ?? 'Role' }}">{{ $profile->role ?? 'Role' }}</span>
                </p>
                <p class="reveal rv-hero-desc text-lg text-gray-600 mb-10 leading-relaxed max-w-[60ch]">
                    {!! nl2br(e($profile->bio ?? 'Bio')) !!}
                </p>
                <div class="rv-hero-btn-container flex flex-wrap items-center justify-center lg:justify-start gap-4 w-full">
                    <a href="#projects" style="--stagger: 0;" class="reveal hover-btn-up smooth-color btn-pulse-glow bg-primary-500 hover:bg-primary-600 text-white px-8 py-3 rounded-2xl font-medium transition-all shadow-[0_4px_20px_rgba(224,69,123,0.3)]">
                        Lihat Portofolio
                    </a>
                    <a href="#contact" style="--stagger: 1;" class="reveal hover-btn-up smooth-color bg-white hover:bg-gray-50 text-gray-700 border border-gray-200 px-8 py-3 rounded-2xl font-medium transition-all shadow-sm">
                        Hubungi Saya
                    </a>
                    @if(!empty($profile->cv_path) && Storage::disk('public')->exists($profile->cv_path))
                    <a href="{{ route('cv.show') }}" style="--stagger: 2;" target="_blank" rel="noopener noreferrer" class="reveal hover-btn-up smooth-color bg-white hover:bg-gray-50 text-gray-700 border border-gray-200 px-8 py-3 rounded-2xl font-medium transition-all shadow-sm flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">picture_as_pdf</span>
                        Lihat CV
                    </a>
                    @endif
                </div>
            </div>

            <!-- Kolom Kanan: Foto Profil -->
            <div class="order-1 lg:order-2 relative w-full max-w-sm mx-auto lg:max-w-none group reveal hero-photo-container">
                <!-- Floating chips -->
                <div class="absolute -top-6 -left-6 lg:-left-12 bg-white/90 backdrop-blur-sm p-3 rounded-2xl shadow-lg border border-gray-100 z-20 anim-float-deco" style="animation-delay: 0s;">
                    <span class="material-symbols-outlined text-primary-500">code</span>
                </div>
                <div class="absolute top-1/2 -right-6 lg:-right-8 bg-white/90 backdrop-blur-sm p-3 rounded-2xl shadow-lg border border-gray-100 z-20 anim-float-deco" style="animation-delay: -2s;">
                    <span class="material-symbols-outlined text-[#F8C8DC]">design_services</span>
                </div>
                <div class="absolute -bottom-4 left-10 lg:left-12 bg-white/90 backdrop-blur-sm p-3 rounded-2xl shadow-lg border border-gray-100 z-20 anim-float-deco" style="animation-delay: -1s;">
                    <span class="material-symbols-outlined text-primary-600">terminal</span>
                </div>

                <!-- Main Photo -->
                <div class="relative rounded-t-full rounded-b-[40%] overflow-hidden border-8 border-white shadow-xl bg-[#FFE4EE] aspect-[4/5] transform transition-all duration-700 ease-out group-hover:scale-[1.02] group-hover:-translate-y-3 group-hover:shadow-primary-500/30">
                    @if(!empty($profile->foto) && Storage::disk('public')->exists($profile->foto))
                        <img src="{{ Storage::url($profile->foto) }}" alt="Foto Profil" class="w-full h-full object-cover">
                    @else
                        <!-- Abstract Tech Placeholder -->
                        <div class="w-full h-full flex items-center justify-center relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-tr from-[#FFE4EE] to-[#F8C8DC] opacity-50"></div>
                            <svg width="100%" height="100%" viewBox="0 0 200 250" class="absolute inset-0 z-0">
                                <circle cx="100" cy="125" r="70" fill="none" stroke="#E0457B" stroke-width="2" stroke-dasharray="8 8" class="origin-center animate-[spin_20s_linear_infinite]" opacity="0.3"></circle>
                                <circle cx="100" cy="125" r="50" fill="none" stroke="#E0457B" stroke-width="1" opacity="0.5"></circle>
                                <path d="M 30 125 L 60 125 M 140 125 L 170 125 M 100 55 L 100 25 M 100 195 L 100 225" stroke="#E0457B" stroke-width="2" opacity="0.2"></path>
                            </svg>
                            <span class="material-symbols-outlined text-primary-500 text-6xl relative z-10 anim-float-deco">rocket_launch</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Projects Section -->
<section id="projects" class="py-20 md:py-24 bg-[#FFF0F5] scroll-mt-24 relative overflow-hidden">
    <!-- Floating Decorations -->
    <div class="absolute inset-0 pointer-events-none z-0">
        <span class="material-symbols-outlined absolute top-20 left-10 text-primary-500 opacity-15 text-4xl anim-float-deco" style="animation-delay: 0s;">data_object</span>
        <span class="material-symbols-outlined absolute bottom-32 right-12 text-primary-500 opacity-15 text-5xl anim-float-deco" style="animation-delay: -2s;">code</span>
        <span class="material-symbols-outlined absolute top-1/2 left-1/4 text-primary-500 opacity-15 text-3xl anim-float-deco" style="animation-delay: -4s;">pin_drop</span>
    </div>

    <div class="max-w-6xl mx-auto px-6 relative z-10">
        <div class="text-center mb-12 flex flex-col items-center">
            <h2 class="reveal rv-section-title text-3xl md:text-4xl font-bold text-gray-900 mb-3">Proyek Pilihan</h2>
            <div class="reveal rv-section-line h-[3px] bg-primary-500 rounded-full mb-4"></div>
            <p class="reveal rv-section-subtitle text-gray-600">Beberapa karya terbaik yang pernah saya buat.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" data-reveal-group="projects" data-stagger="90">
            @foreach($projects as $project)
            <div class="reveal hover-card-up group bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-sm flex flex-col h-full">
                @if($project->demo_url)
                <a href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer" aria-label="Buka {{ $project->title }}" 
                   class="thumb-container relative aspect-video bg-[#FFE4EE] skeleton-bg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-inset"
                   x-data="{}"
                   x-init="if($refs.img && $refs.img.complete) { $el.classList.add('skeleton-loaded'); $refs.img.classList.add('img-loaded'); }">
                    <img x-ref="img" src="{{ $project->image_url }}" alt="{{ $project->title }}" loading="lazy" decoding="async" 
                         onerror="this.onerror=null;this.src='{{ asset('images/placeholder.jpg') }}';"
                         x-on:load="$el.closest('.skeleton-bg').classList.add('skeleton-loaded'); $el.classList.add('img-loaded');"
                         x-on:error="$el.closest('.skeleton-bg').classList.add('skeleton-loaded'); $el.classList.add('img-loaded');"
                         class="hover-img-zoom object-cover w-full h-full transform img-loading">
                    
                    <div class="thumb-overlay"></div>
                    <div class="thumb-badge bg-white text-primary-600 px-4 py-1.5 rounded-full shadow-lg flex items-center gap-1">
                        Buka Website <span class="material-symbols-outlined text-[14px]">north_east</span>
                    </div>
                </a>
                @else
                <div class="thumb-container relative aspect-video bg-[#FFE4EE] skeleton-bg"
                     x-data="{}"
                     x-init="if($refs.img && $refs.img.complete) { $el.classList.add('skeleton-loaded'); $refs.img.classList.add('img-loaded'); }">
                    <img x-ref="img" src="{{ $project->image_url }}" alt="{{ $project->title }}" loading="lazy" decoding="async" 
                         onerror="this.onerror=null;this.src='{{ asset('images/placeholder.jpg') }}';"
                         x-on:load="$el.closest('.skeleton-bg').classList.add('skeleton-loaded'); $el.classList.add('img-loaded');"
                         x-on:error="$el.closest('.skeleton-bg').classList.add('skeleton-loaded'); $el.classList.add('img-loaded');"
                         class="hover-img-zoom object-cover w-full h-full transform img-loading">
                </div>
                @endif
                <div class="p-6 flex flex-col flex-grow">
                    @if($project->demo_url)
                    <a href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer" class="focus:outline-none focus:ring-2 focus:ring-primary-500 rounded-lg w-fit -ml-1 p-1 mb-1 group/title smooth-color">
                        <h3 class="text-xl font-bold text-gray-900 group-hover/title:text-primary-500 transition-colors">{{ $project->title }}</h3>
                    </a>
                    @else
                    <h3 class="text-xl font-bold text-gray-900 mb-2 transition-colors">{{ $project->title }}</h3>
                    @endif
                    <p class="text-gray-600 mb-6 text-sm line-clamp-3">{{ $project->description }}</p>
                    
                    <div class="flex flex-wrap gap-2 mt-auto">
                        @if($project->tech_stack)
                            @foreach($project->tech_stack as $tech)
                            <span class="px-3 py-1 bg-primary-50 text-primary-600 rounded-lg text-xs font-mono font-medium">{{ $tech }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Skills Section -->
<section id="skills" class="py-20 md:py-24 bg-white scroll-mt-24 relative">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-12 flex flex-col items-center">
            <h2 class="reveal rv-section-title text-3xl md:text-4xl font-bold text-gray-900 mb-3">Keahlian & Teknologi</h2>
            <div class="reveal rv-section-line h-[3px] bg-primary-500 rounded-full mb-4"></div>
            <p class="reveal rv-section-subtitle text-gray-600">Alat yang saya gunakan untuk mewujudkan ide.</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6" data-reveal-group="skills" data-stagger="90">
            @foreach($skills as $skill)
            <div class="reveal hover-card-up bg-white p-6 rounded-3xl border border-gray-100 shadow-sm group text-center skill-card">
                <div class="w-12 h-12 mx-auto bg-primary-50 text-primary-500 rounded-2xl flex items-center justify-center mb-4 transition-transform duration-250 group-hover:scale-110">
                    <span class="material-symbols-outlined">{{ $skill->icon ?: 'code' }}</span>
                </div>
                <h3 class="font-bold text-gray-900 mb-1">{{ $skill->name }}</h3>
                <p class="text-xs text-gray-500 font-mono">{{ $skill->category }}</p>
                
                @if($skill->percentage)
                <div class="w-full bg-gray-100 rounded-full h-1.5 mt-4 overflow-hidden">
                    <div class="skill-bar bg-gradient-to-r from-primary-500 to-[#F8C8DC] h-1.5 rounded-full"
                         style="--skill-level: {{ $skill->percentage }}%;"></div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Achievements Section -->
@if($achievements->count() > 0)
<section id="achievements" class="py-20 md:py-24 bg-[#FFF0F5] scroll-mt-24 relative overflow-hidden" x-data="{ 
    modalOpen: false, 
    current: null,
    previouslyFocused: null,
    openModal(data) {
        this.current = data;
        this.previouslyFocused = document.activeElement;
        this.modalOpen = true;
        document.body.style.overflow = 'hidden';
        $nextTick(() => { $refs.closeBtn.focus() });
    },
    closeModal() {
        this.modalOpen = false;
        document.body.style.overflow = '';
        if(this.previouslyFocused) this.previouslyFocused.focus();
    }
}">
    <!-- Floating Decorations -->
    <div class="absolute inset-0 pointer-events-none z-0">
        <span class="material-symbols-outlined absolute top-10 right-20 text-primary-500 opacity-15 text-3xl anim-float-deco" style="animation-delay: -1s;">emoji_events</span>
        <span class="material-symbols-outlined absolute bottom-20 left-10 text-primary-500 opacity-15 text-4xl anim-float-deco" style="animation-delay: -3s;">military_tech</span>
        <span class="material-symbols-outlined absolute top-1/2 right-1/4 text-primary-500 opacity-15 text-5xl anim-float-deco" style="animation-delay: -5s;">star</span>
    </div>

    <div class="max-w-6xl mx-auto px-6 relative z-10">
        <div class="text-center mb-12 flex flex-col items-center">
            <h2 class="reveal rv-section-title text-3xl md:text-4xl font-bold text-gray-900 mb-3">Pencapaian</h2>
            <div class="reveal rv-section-line h-[3px] bg-primary-500 rounded-full mb-4"></div>
            <p class="reveal rv-section-subtitle text-gray-600">Beberapa tonggak perjalanan karir saya.</p>
        </div>
        
        <div class="flex flex-wrap justify-center gap-8" data-reveal-group="achievements" data-stagger="90">
            @foreach($achievements as $achievement)
            @php
                $achievementData = json_encode([
                    'title' => $achievement->title,
                    'type' => $achievement->type,
                    'description' => $achievement->description,
                    'image' => $achievement->image_url,
                    'tags' => $achievement->tags,
                    'date' => $achievement->date ? $achievement->date->format('d M Y') : null,
                ]);
            @endphp
            <div class="reveal hover-card-up w-full md:w-[calc(50%-1rem)] lg:w-[calc(33.333333%-1.333333rem)] max-w-[384px] mx-auto group bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-sm cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary-500 flex flex-col"
                 data-achievement="{{ $achievementData }}"
                 @click="openModal(JSON.parse($el.dataset.achievement))"
                 @keydown.enter="openModal(JSON.parse($el.dataset.achievement))"
                 tabindex="0">
                 
                 <div class="thumb-container relative aspect-[16/10] bg-[#FFE4EE] skeleton-bg p-4 flex items-center justify-center"
                      x-data="{}"
                      x-init="if($refs.img && $refs.img.complete) { $el.classList.add('skeleton-loaded'); $refs.img.classList.add('img-loaded'); }">
                     <img x-ref="img" src="{{ $achievement->thumbnail_url ?: $achievement->image_url }}" alt="{{ $achievement->title }}" loading="lazy" decoding="async" 
                          onerror="this.onerror=null;this.src='{{ asset('images/placeholder.jpg') }}';"
                          x-on:load="$el.closest('.skeleton-bg').classList.add('skeleton-loaded'); $el.classList.add('img-loaded');"
                          x-on:error="$el.closest('.skeleton-bg').classList.add('skeleton-loaded'); $el.classList.add('img-loaded');"
                          class="hover-img-zoom object-contain w-full h-full transform img-loading">
                          
                     <div class="thumb-overlay"></div>
                     <div class="thumb-badge bg-white text-primary-600 px-4 py-1.5 rounded-full shadow-lg flex items-center gap-1">
                         Lihat Detail
                     </div>
                 </div>
                 
                 <div class="p-6 flex flex-col flex-grow">
                     @if($achievement->type)
                     <div class="text-xs font-mono text-primary-600 mb-2">{{ $achievement->type }}</div>
                     @endif
                     
                     <h3 class="text-xl font-bold text-gray-900 mb-3 smooth-color group-hover:text-primary-500 line-clamp-2">{{ $achievement->title }}</h3>
                     
                     <p class="text-gray-600 mb-5 text-sm line-clamp-2">{{ $achievement->summary ?: Str::limit(strip_tags($achievement->description), 120) }}</p>
                     
                     @if($achievement->tags && count($achievement->tags) > 0)
                     <div class="flex flex-wrap gap-2 mb-6 mt-auto">
                         @foreach(array_slice($achievement->tags, 0, 2) as $tag)
                         <span class="px-2.5 py-1 bg-gray-50 text-gray-600 rounded-lg text-xs font-medium">{{ $tag }}</span>
                         @endforeach
                         @if(count($achievement->tags) > 2)
                         <span class="px-2.5 py-1 bg-gray-50 text-gray-600 rounded-lg text-xs font-medium">+{{ count($achievement->tags) - 2 }}</span>
                         @endif
                     </div>
                     @else
                     <div class="mt-auto mb-6"></div>
                     @endif
                     
                     <div class="flex items-center gap-3 border-t border-gray-100 pt-4">
                         <div class="p-2 -ml-2 text-gray-500 smooth-color group-hover:text-primary-500 group-hover:bg-primary-50 rounded-xl flex items-center gap-2 text-sm font-medium">
                             <span class="material-symbols-outlined text-sm">visibility</span>
                             <span>Lihat detail</span>
                         </div>
                     </div>
                 </div>
            </div>
            @endforeach
        </div>

        <!-- Detail Modal -->
        <div x-show="modalOpen" style="display: none;" class="fixed inset-0 z-[60] flex items-center justify-center p-4 sm:p-6" 
             aria-modal="true" role="dialog"
             @keydown.escape.window="closeModal()">
            
            <!-- Backdrop -->
            <div x-show="modalOpen" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100 backdrop-blur-sm"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 backdrop-blur-sm"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 bg-black/60 backdrop-blur-sm"
                 @click="closeModal()">
            </div>
            
            <!-- Modal Content -->
            <div x-show="modalOpen"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4 sm:translate-y-0"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-4 sm:translate-y-0"
                 class="relative bg-white rounded-3xl shadow-2xl w-full max-w-4xl max-h-[95vh] sm:max-h-[90vh] overflow-hidden flex flex-col z-10"
                 @click.stop>
                
                <!-- Header with close button -->
                <div class="absolute top-4 right-4 z-20">
                    <button @click="closeModal()" x-ref="closeBtn" class="bg-white/80 hover:bg-white text-gray-800 p-2 rounded-full shadow-sm backdrop-blur transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500" aria-label="Tutup">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                
                <!-- Scrollable Content -->
                <div class="overflow-y-auto flex-grow scroll-themed">
                    <!-- Image Area -->
                    <div class="bg-pink-50 p-6 sm:p-10 flex items-center justify-center min-h-[250px] relative">
                        <template x-if="current && current.image">
                            <img :src="current.image" :alt="current.title" class="object-contain w-full max-h-[50vh] sm:max-h-[60vh] rounded-xl shadow-sm">
                        </template>
                    </div>
                    
                    <!-- Details Area -->
                    <div class="p-6 sm:p-10">
                        <template x-if="current && current.type">
                            <div class="inline-block px-3 py-1 bg-primary-50 text-primary-600 rounded-lg text-xs font-mono font-medium mb-4" x-text="current.type"></div>
                        </template>
                        <h3 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4" x-text="current ? current.title : ''"></h3>
                        
                        <template x-if="current && current.date">
                            <div class="flex items-center gap-2 text-gray-500 text-sm mb-6">
                                <span class="material-symbols-outlined text-sm">calendar_month</span>
                                <span x-text="current.date"></span>
                            </div>
                        </template>

                        <div class="prose prose-gray max-w-none text-gray-600 mb-8 whitespace-pre-wrap" x-text="current ? current.description : ''"></div>
                        
                        <template x-if="current && current.tags && current.tags.length > 0">
                            <div class="flex flex-wrap gap-2 pt-6 border-t border-gray-100">
                                <template x-for="tag in current.tags">
                                    <span class="px-3 py-1.5 bg-gray-50 text-gray-700 rounded-lg text-sm font-medium" x-text="tag"></span>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Gallery Section -->
<section id="gallery" class="py-20 md:py-24 bg-white scroll-mt-24 relative" x-data="{ 
    lightboxOpen: false, 
    currentIndex: 0,
    limit: 12,
    artworks: [
        @if(isset($artworks))
        @foreach($artworks as $artwork)
        {
            image: `{{ $artwork->image_url }}`,
            thumb: `{{ $artwork->thumbnail_url }}`,
            title: `{{ addslashes(str_replace('`', '\`', $artwork->title)) }}`,
            desc: `{{ addslashes(str_replace('`', '\`', $artwork->description)) }}`
        }{{ !$loop->last ? ',' : '' }}
        @endforeach
        @endif
    ],
    get currentImage() { return this.artworks[this.currentIndex]?.image || ''; },
    get currentThumb() { return this.artworks[this.currentIndex]?.thumb || ''; },
    get currentTitle() { return this.artworks[this.currentIndex]?.title || ''; },
    get currentDescription() { return this.artworks[this.currentIndex]?.desc || ''; },
    next() { if(this.currentIndex < this.artworks.length - 1) this.currentIndex++; else this.currentIndex = 0; },
    prev() { if(this.currentIndex > 0) this.currentIndex--; else this.currentIndex = this.artworks.length - 1; }
}" x-effect="document.body.style.overflow = lightboxOpen ? 'hidden' : ''">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-12 flex flex-col items-center">
            <h2 class="reveal rv-section-title text-3xl md:text-4xl font-bold text-gray-900 mb-3">Galeri Karya</h2>
            <div class="reveal rv-section-line h-[3px] bg-primary-500 rounded-full mb-4"></div>
            <p class="reveal rv-section-subtitle text-gray-600">Eksplorasi visual dan beberapa karya kreatif saya.</p>
        </div>
        
        @if(isset($artworks) && $artworks->count() > 0)
            @php
                $isFew = $artworks->count() <= 2;
            @endphp
            <div class="{{ $isFew ? 'flex flex-wrap justify-center' : 'grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4' }} gap-4 max-w-6xl mx-auto gallery-grid" data-reveal-group="gallery" data-stagger="90">
                @foreach($artworks as $index => $artwork)
                    <div x-show="{{ $index }} < limit" style="display: {{ $index < 12 ? 'block' : 'none' }};"
                         class="reveal hover-card-up {{ $isFew ? 'w-[calc(50%-0.5rem)] sm:w-[calc(33.333%-0.66rem)] lg:w-[calc(25%-0.75rem)] max-w-[280px]' : '' }} thumb-container relative group rounded-2xl overflow-hidden cursor-pointer bg-[#FFE4EE] skeleton-bg shadow-sm aspect-[4/3] focus:outline-none focus:ring-2 focus:ring-primary-500" 
                         x-data="{}" 
                         x-init="if($refs.img && $refs.img.complete) { $el.classList.add('skeleton-loaded'); $refs.img.classList.add('img-loaded'); }"
                         @click="lightboxOpen = true; currentIndex = {{ $index }}"
                         tabindex="0"
                         @keydown.enter="lightboxOpen = true; currentIndex = {{ $index }}">
                        
                        <img x-ref="img" src="{{ $artwork->thumbnail_url }}" alt="{{ $artwork->title ?: 'Karya' }}" loading="lazy" decoding="async" 
                             class="hover-img-zoom object-cover w-full h-full transform img-loading"
                             x-on:load="$el.closest('.skeleton-bg').classList.add('skeleton-loaded'); $el.classList.add('img-loaded');"
                             x-on:error="$el.closest('.skeleton-bg').classList.add('skeleton-loaded'); $el.classList.add('img-loaded'); this.onerror=null;this.src='{{ asset('images/placeholder.jpg') }}'">
                        
                        <div class="thumb-overlay"></div>
                        <div class="thumb-badge bg-white text-primary-600 px-4 py-1.5 rounded-full shadow-lg flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">search</span>
                            {{ $artwork->title ? Str::limit($artwork->title, 20) : 'Lihat' }}
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if($artworks->count() > 12)
                <div x-show="limit < {{ $artworks->count() }}" class="mt-10 flex justify-center" style="display: none;">
                    <button @click="limit += 12" class="bg-primary-50 hover:bg-primary-100 text-primary-600 px-6 py-2 rounded-full font-medium transition-colors text-sm">
                        Lihat Lebih Banyak
                    </button>
                </div>
            @endif
        @else
            <div class="text-center py-16 bg-gray-50 rounded-3xl border border-gray-100">
                <span class="material-symbols-outlined text-5xl text-gray-400 mb-4">photo_library</span>
                <h3 class="text-xl font-medium text-gray-900 mb-2">Galeri Segera Hadir</h3>
                <p class="text-gray-500">Belum ada karya yang diunggah. Silakan kembali lagi nanti.</p>
            </div>
        @endif
    </div>

    <!-- Lightbox Modal -->
    <div x-show="lightboxOpen" class="fixed inset-0 z-[60] overflow-y-auto bg-black/90 overscroll-contain" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;"
         @keydown.escape.window="lightboxOpen = false"
         @keydown.right.window="next()"
         @keydown.left.window="prev()">
        
        <!-- Close Button -->
        <button @click="lightboxOpen = false" class="fixed top-4 right-4 text-white/70 hover:text-white p-2 z-[70] bg-black/20 hover:bg-black/40 rounded-full backdrop-blur-sm transition-all focus:outline-none focus:ring-2 focus:ring-primary-500" aria-label="Tutup lightbox">
            <span class="material-symbols-outlined text-3xl drop-shadow-md">close</span>
        </button>

        <!-- Navigation Buttons -->
        <button @click.stop="prev()" class="fixed left-4 top-1/2 -translate-y-1/2 text-white/70 hover:text-white p-2 z-[70] bg-black/20 hover:bg-black/40 rounded-full backdrop-blur-sm transition-all focus:outline-none hidden sm:block" aria-label="Sebelumnya">
            <span class="material-symbols-outlined text-4xl drop-shadow-md">chevron_left</span>
        </button>
        <button @click.stop="next()" class="fixed right-4 top-1/2 -translate-y-1/2 text-white/70 hover:text-white p-2 z-[70] bg-black/20 hover:bg-black/40 rounded-full backdrop-blur-sm transition-all focus:outline-none hidden sm:block" aria-label="Selanjutnya">
            <span class="material-symbols-outlined text-4xl drop-shadow-md">chevron_right</span>
        </button>
        
        <div class="min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8 sm:px-20 pointer-events-none">
            <div class="relative w-full max-w-6xl flex flex-col lg:flex-row pointer-events-auto bg-gray-900 rounded-2xl overflow-hidden shadow-2xl" 
                 @click.away="lightboxOpen = false" x-data="{ loaded: false }" x-init="$watch('currentImage', () => loaded = false)">
                
                <!-- Image Area -->
                <div class="w-full lg:w-[65%] flex items-center justify-center bg-black/50 relative min-h-[30vh]">
                    <!-- Loading indicator -->
                    <div x-show="!loaded" class="absolute inset-0 flex items-center justify-center z-10">
                        <span class="material-symbols-outlined animate-spin text-white text-4xl opacity-75">refresh</span>
                    </div>
                    
                    <img x-show="!loaded" :src="currentThumb" :alt="currentTitle || 'Karya'" class="w-full h-full max-h-[55vh] lg:max-h-[85vh] object-contain rounded-t-2xl lg:rounded-l-2xl lg:rounded-tr-none blur-md transition-all duration-300 absolute inset-0 m-auto z-0">
                    <img :src="currentImage" @load="loaded = true" :class="{ 'opacity-0': !loaded, 'opacity-100': loaded }" :alt="currentTitle || 'Karya'" class="w-full h-full max-h-[55vh] lg:max-h-[85vh] object-contain rounded-t-2xl lg:rounded-l-2xl lg:rounded-tr-none transition-opacity duration-500 ease-in-out relative z-10" decoding="async">
                </div>
                
                <!-- Text Panel -->
                <div class="w-full lg:w-[35%] bg-gray-900 p-6 sm:p-8 flex flex-col text-left overflow-y-auto scroll-themed pb-[calc(1.5rem+env(safe-area-inset-bottom))] lg:max-h-[85vh]">
                    <template x-if="currentTitle">
                        <h3 x-text="currentTitle" class="text-white text-lg font-semibold mb-4 border-b border-gray-800 pb-4"></h3>
                    </template>
                    <template x-if="currentDescription">
                        <div x-text="currentDescription" class="text-gray-300 text-sm leading-relaxed whitespace-pre-line"></div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-20 md:py-24 bg-gray-900 text-white relative overflow-hidden scroll-mt-24">
    <div class="absolute inset-0 bg-[radial-gradient(#E0457B_1px,transparent_1px)] [background-size:24px_24px] opacity-10"></div>
    <div class="max-w-6xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <div class="mb-12 text-left">
                    <h2 class="reveal rv-section-title text-3xl md:text-4xl font-bold mb-3">Mari Berkolaborasi!</h2>
                    <div class="reveal rv-section-line h-[3px] bg-primary-500 rounded-full mb-4 w-16"></div>
                    <p class="reveal rv-section-subtitle text-gray-400 text-lg">Tertarik untuk bekerja sama atau sekadar menyapa? Jangan ragu untuk mengirim pesan kepada saya.</p>
                </div>
                
                <div class="space-y-4" data-reveal-group="contact-icons" data-stagger="90">
                    @if(!empty($profile->sosial_media['email']))
                    <div class="flex items-center justify-between group" x-data="{ copied: false }">
                        <a href="https://mail.google.com/mail/?view=cm&to={{ $profile->sosial_media['email'] }}" target="_blank" rel="noopener noreferrer" aria-label="Kirim Email" class="flex items-center gap-4 text-gray-300 hover:text-white transition-colors">
                            <div class="reveal rv-fade-up w-12 h-12 bg-gray-800 rounded-2xl flex items-center justify-center transition-transform duration-250 group-hover:scale-110">
                                <span class="material-symbols-outlined text-primary-500">mail</span>
                            </div>
                            <span>{{ $profile->sosial_media['email'] }}</span>
                        </a>
                        <button type="button" @click="navigator.clipboard.writeText('{{ $profile->sosial_media['email'] }}'); copied = true; setTimeout(() => copied = false, 2000)" class="text-gray-400 hover:text-primary-500 transition-colors p-2 relative" aria-label="Salin Email">
                            <span class="material-symbols-outlined text-lg">content_copy</span>
                            <span x-show="copied" x-transition style="display: none;" class="absolute -top-8 left-1/2 -translate-x-1/2 bg-gray-800 text-white text-xs py-1 px-2 rounded whitespace-nowrap">Email disalin</span>
                        </button>
                    </div>
                    @endif
                    @if(!empty($profile->sosial_media['instagram']))
                    <a href="https://instagram.com/{{ $profile->sosial_media['instagram'] }}" target="_blank" rel="noopener noreferrer" aria-label="Buka profil Instagram" class="flex items-center gap-4 text-gray-300 hover:text-white transition-colors">
                        <div class="reveal rv-fade-up w-12 h-12 bg-gray-800 rounded-2xl flex items-center justify-center transition-transform duration-250 group-hover:scale-110">
                            <span class="material-symbols-outlined text-primary-500">photo_camera</span>
                        </div>
                        <span>{{ '@' . $profile->sosial_media['instagram'] }}</span>
                    </a>
                    @endif
                    @if(!empty($profile->sosial_media['whatsapp']))
                    <a href="https://wa.me/{{ $profile->sosial_media['whatsapp'] }}?text=Halo%20Farah%2C%20saya%20melihat%20portofolio%20Anda" target="_blank" rel="noopener noreferrer" aria-label="Chat via WhatsApp" class="flex items-center gap-4 text-gray-300 hover:text-white transition-colors">
                        <div class="reveal rv-fade-up w-12 h-12 bg-gray-800 rounded-2xl flex items-center justify-center transition-transform duration-250 group-hover:scale-110">
                            <span class="material-symbols-outlined text-primary-500">chat</span>
                        </div>
                        <span>Chat via WhatsApp</span>
                    </a>
                    @endif
                </div>
            </div>
            
            <div class="reveal hover-card-up bg-white/10 backdrop-blur-xl p-8 rounded-3xl border border-white/10" x-data="{
                name: '', email: '', message: '', website_url: '', status: '', errors: {}, loading: false, serverError: '',
                submit() {
                    this.loading = true;
                    this.status = '';
                    this.errors = {};
                    this.serverError = '';
                    fetch('{{ route('message.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            name: this.name,
                            email: this.email,
                            message: this.message,
                            website_url: this.website_url
                        })
                    })
                    .then(res => res.json().then(data => ({ status: res.status, body: data })))
                    .then(res => {
                        this.loading = false;
                        if(res.status === 422) {
                            this.status = 'validation_error';
                            this.errors = res.body.errors || {};
                        } else if(res.status === 429) {
                            this.status = 'error';
                            this.serverError = res.body.error || 'Terlalu banyak percobaan. Silakan coba lagi nanti.';
                        } else if(res.status === 200 && res.body.success) {
                            this.status = 'success';
                            this.name = ''; this.email = ''; this.message = ''; this.website_url = '';
                        } else {
                            this.status = 'error';
                            this.serverError = res.body.error || 'Terjadi kesalahan pada server. Silakan coba lagi nanti.';
                        }
                    })
                    .catch(() => {
                        this.loading = false;
                        this.status = 'error';
                        this.serverError = 'Terjadi kesalahan jaringan. Silakan coba lagi nanti.';
                    });
                }
            }">
                <h3 class="text-xl font-bold mb-6">Kirim Pesan</h3>
                
                <div x-show="status === 'success'" style="display: none;" class="mb-6 p-4 bg-green-500/20 border border-green-500/50 rounded-xl text-green-300 text-sm">
                    Pesan berhasil dikirim, terima kasih!
                </div>
                
                <div x-show="status === 'error'" style="display: none;" class="mb-6 p-4 bg-red-500/20 border border-red-500/50 rounded-xl text-red-300 text-sm" x-text="serverError">
                </div>

                <form @submit.prevent="submit" class="space-y-4">
                    <!-- Honeypot -->
                    <div style="display: none;">
                        <input type="text" x-model="website_url" tabindex="-1" autocomplete="off">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Nama</label>
                        <input type="text" x-model="name" required class="w-full bg-gray-800/50 border border-gray-700 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500 transition-all" :class="{'border-red-500 focus:ring-red-500': errors.name}">
                        <template x-if="errors.name">
                            <p class="text-red-400 text-sm mt-1" x-text="errors.name[0]"></p>
                        </template>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                        <input type="email" x-model="email" required class="w-full bg-gray-800/50 border border-gray-700 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500 transition-all" :class="{'border-red-500 focus:ring-red-500': errors.email}">
                        <template x-if="errors.email">
                            <p class="text-red-400 text-sm mt-1" x-text="errors.email[0]"></p>
                        </template>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Pesan</label>
                        <textarea x-model="message" required rows="4" class="w-full bg-gray-800/50 border border-gray-700 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500 transition-all" :class="{'border-red-500 focus:ring-red-500': errors.message}"></textarea>
                        <template x-if="errors.message">
                            <p class="text-red-400 text-sm mt-1" x-text="errors.message[0]"></p>
                        </template>
                    </div>
                    <button type="submit" :disabled="loading" class="w-full magnetic-btn btn-press bg-primary-500 hover:bg-primary-600 disabled:opacity-50 text-white font-medium py-3 rounded-xl transition-colors flex items-center justify-center gap-2">
                        <span x-show="!loading">Kirim Pesan</span>
                        <span x-show="loading" style="display: none;" class="flex items-center gap-2"><span class="material-symbols-outlined animate-spin text-sm">refresh</span>Mengirim...</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
