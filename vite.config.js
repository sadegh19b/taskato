import { defineConfig } from 'vite';
import { svelte } from '@sveltejs/vite-plugin-svelte';
import laravel from 'laravel-vite-plugin';
import sveltePreprocess from 'svelte-preprocess';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js'],
            refresh: true,
            //buildDirectory: 'static'
        }),
        svelte({
            preprocess: sveltePreprocess({
                postcss: true
            }),
            experimental: {
                prebundleSvelteLibraries: true
            }
        })
    ],
    build: {
        //outDir: './public/static'
    },
    optimizeDeps: {
        include: ['@inertiajs/inertia']
    }
});
