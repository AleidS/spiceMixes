window.addEventListener('load', () => {
    setTimeout(() => {
        window.scrollTo(0, 1); // Scroll slightly to hide the address bar
    }, 0);
});

import '../css/app.css';
import './bootstrap.js';

import { createInertiaApp } from '@inertiajs/svelte';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { hydrate, mount } from 'svelte';

createInertiaApp({
    resolve: (name) =>
        resolvePageComponent(`./Pages/${name}.svelte`, import.meta.glob('./Pages/**/*.svelte')),
    setup({ el, App, props }) {
        if (!el) {
            console.error('Target element not found');
            return;
        }
        if (el.dataset.serverRendered === 'true') {
            hydrate(App, { target: el, props });
        } else {
            mount(App, { target: el, props });
        }
    }
});
