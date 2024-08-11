import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    build: {
        /*rollupOptions: {
            output: {
                entryFileNames: `[name].js`,
                chunkFileNames: `[name].js`,
                assetFileNames: `[name].[ext]`,
                manualChunks: {}
            }
        },*/
        minify: true
    },
    plugins: [
        laravel({
            hotFile: 'public/vendor/daugt/daugt.hot',
            buildDirectory: 'vendor/daugt',
            input: ['resources/js/app.js', 'resources/js/stripped.js', 'resources/js/member-area.js', 'resources/css/app.css', 'resources/css/stripped.css', 'resources/css/member-area.css'],
            refresh: true,
        }),
    ],
});
