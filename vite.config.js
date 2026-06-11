import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/kabupaten/init.js',
                'resources/js/stable/init.js',
                'resources/js/stable/show/init.js',
                'resources/js/kuda/init.js',
                'resources/js/pengguna/init.js',
                'resources/js/pelatih/init.js',
            ],
            refresh: true,
        }),
    ],
});
