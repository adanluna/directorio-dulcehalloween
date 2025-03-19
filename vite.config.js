import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { chunkSplitPlugin } from 'vite-plugin-chunk-split';

export default defineConfig({
    build: {
        minify: 'terser',
        target: 'esnext',
        terserOptions: {
            output: {
                comments: false, // This will remove all comments from the output files
            },
        },
    },
    optimizeDeps: {
        exclude: ['vue3-google-map']
    },
    plugins: [
        chunkSplitPlugin({
            strategy: 'default',
        }),
        laravel({
            input: [
                'resources/css/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
