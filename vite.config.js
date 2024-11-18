import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import {viteStaticCopy} from "vite-plugin-static-copy";

export default defineConfig({
    build: {
        minify: true,
        target: 'esnext'
    },
    plugins: [
        laravel({
            hotFile: 'public/vendor/daugt/daugt.hot',
            buildDirectory: 'vendor/daugt',
            input: ['resources/js/app.js', 'resources/js/stripped.js', 'resources/js/member-area.js', 'resources/css/app.css', 'resources/css/stripped.css'],
            refresh: true,
        }),
    ],
});
