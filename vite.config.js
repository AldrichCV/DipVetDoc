import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue(),
    ],
      /* server: {
        host: true,             // listen on all interfaces
        port: 5173,             // dev server port
        hmr: {
            host: '192.168.137.1', // your laptop's IP on hotspot
            protocol: 'ws',         // WebSocket for hot reload
        },
    },*/
});
