import './bootstrap';
import Alpine from 'alpinejs';
import { initReveal, initHeroAnimation, initThumbnails } from './reveal';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    initReveal();
    initHeroAnimation();
    initThumbnails();
});

