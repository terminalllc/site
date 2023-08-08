import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';


export default defineConfig({
    plugins: [
        laravel({
            input: [

                'resources/assets/sass/front.scss',
                'resources/assets/js/front.js',
            ],
            refresh: [
                ...refreshPaths,
            ],
            buildDirectory: '/frontend',
        }),
    ],
    css: {
        postcss: {
        },
    },
});
