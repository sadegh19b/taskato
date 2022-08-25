import '~js/bootstrap';
import '~css/app.css';

import { createInertiaApp } from '@inertiajs/inertia-svelte';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { InertiaProgress } from '@inertiajs/progress';

createInertiaApp({
    resolve: name => resolvePageComponent(`../svelte/pages/${name.replaceAll('.', '/')}.svelte`, import.meta.glob('../svelte/pages/**/*.svelte')),
    setup({ el, App, props }) {
        new App({ target: el, props });
    },
});

InertiaProgress.init({ includeCSS: false });
