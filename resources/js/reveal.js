// resources/js/reveal.js

/**
 * Clean, elegant animation system based on IntersectionObserver.
 * Focuses on fade-up, blur reduction, and slight scaling.
 */

export function initReveal() {
    // Add js class to html for animation scoping
    document.documentElement.classList.add('js');

    // No-JS fallback / Safety timeout
    const fallbackTimeout = setTimeout(() => {
        document.querySelectorAll('.reveal').forEach(el => {
            el.classList.add('is-visible');
        });
    }, 1500);

    const isReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (isReducedMotion) {
        clearTimeout(fallbackTimeout);
        return; // Let CSS handle the instant reveal
    }

    // Process staggered groups (Projects, Skills, Achievements, Gallery, Contact icons)
    const groups = document.querySelectorAll('[data-reveal-group]');
    const isMobile = window.innerWidth < 768;
    
    groups.forEach(group => {
        const items = group.querySelectorAll('.reveal');
        // On mobile, stagger is generally faster to prevent waiting too long
        const baseStagger = parseInt(group.getAttribute('data-stagger')) || 90;
        const stagger = isMobile ? Math.min(baseStagger, 50) : baseStagger;
        
        items.forEach((item, index) => {
            // Cap the maximum stagger so the last item doesn't wait forever
            const clampedIndex = Math.min(index, 6); 
            item.style.setProperty('--stagger', clampedIndex * stagger);
        });
    });

    const observerOptions = {
        root: null,
        rootMargin: '0px 0px -8% 0px',
        threshold: 0.15
    };

    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                obs.unobserve(entry.target); // Play once
            }
        });
    }, observerOptions);

    // Observe all reveal elements
    document.querySelectorAll('.reveal').forEach(el => {
        observer.observe(el);
    });
}

export function initHeroAnimation() {
    // Typing effect for subtitle
    const typingElement = document.querySelector('.hero-typing');
    if (!typingElement) return;

    const textToType = typingElement.getAttribute('data-text') || '';
    typingElement.textContent = '';
    
    // Wait for hero title to finish entering (approx 800ms) before typing
    setTimeout(() => {
        let i = 0;
        const speed = 40; // ms per character
        
        function typeWriter() {
            if (i < textToType.length) {
                typingElement.textContent += textToType.charAt(i);
                i++;
                setTimeout(typeWriter, speed);
            } else {
                // Done typing, wait a bit then remove blinking cursor
                setTimeout(() => {
                    typingElement.classList.add('done');
                }, 2000);
            }
        }
        
        typeWriter();
    }, 800);
}

// Back to top button visibility (Simple, elegant)
document.addEventListener('DOMContentLoaded', () => {
    const topBtn = document.getElementById('back-to-top');
    if (!topBtn) return;
    
    window.addEventListener('scroll', () => {
        if (window.scrollY > 600) {
            topBtn.classList.remove('opacity-0', 'translate-y-10', 'pointer-events-none');
            topBtn.classList.add('opacity-100', 'translate-y-0');
        } else {
            topBtn.classList.add('opacity-0', 'translate-y-10', 'pointer-events-none');
            topBtn.classList.remove('opacity-100', 'translate-y-0');
        }
    }, { passive: true });
});

export function initThumbnails() {
    const thumbs = document.querySelectorAll('.thumb-container');
    if (!thumbs.length) return;

    // 1. Toggled by visibility (for Ken Burns and pulse animations)
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-playing');
            } else {
                entry.target.classList.remove('is-playing');
            }
        });
    }, { rootMargin: '50px' });

    thumbs.forEach(thumb => observer.observe(thumb));

    // Pause all when tab is inactive to save performance
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            thumbs.forEach(t => t.classList.remove('is-playing'));
        } else {
            thumbs.forEach(t => {
                const rect = t.getBoundingClientRect();
                if (rect.top < window.innerHeight && rect.bottom > 0) {
                    t.classList.add('is-playing');
                }
            });
        }
    });

    // 2. Internal Parallax on pointer move
    const isReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (isReduced) return;

    thumbs.forEach(thumb => {
        const img = thumb.querySelector('.img-loading');
        if (!img) return;

        let rafId = null;
        let bounds = null;

        thumb.addEventListener('mouseenter', () => {
            bounds = thumb.getBoundingClientRect();
        });

        thumb.addEventListener('pointermove', (e) => {
            if (!bounds) bounds = thumb.getBoundingClientRect();
            // normalized coordinates from center: -0.5 to 0.5
            const x = (e.clientX - bounds.left) / bounds.width - 0.5;
            const y = (e.clientY - bounds.top) / bounds.height - 0.5;
            
            if (rafId) cancelAnimationFrame(rafId);
            rafId = requestAnimationFrame(() => {
                // max parallax offset ±10px
                img.style.setProperty('--px', `${x * 20}px`);
                img.style.setProperty('--py', `${y * 20}px`);
            });
        });

        thumb.addEventListener('mouseleave', () => {
            if (rafId) cancelAnimationFrame(rafId);
            rafId = requestAnimationFrame(() => {
                img.style.setProperty('--px', `0px`);
                img.style.setProperty('--py', `0px`);
            });
            bounds = null;
        });
    });
}
