import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { svelte } from '@sveltejs/vite-plugin-svelte';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        svelte(),
        
    ],
      server: {
        host: '0.0.0.0', // Allow access from other devices
        port: 5173,      // Default Vite port
        strictPort: true, // Fail if the port is already in use
        cors: true,       // Enable CORS
        hmr: {
            host: '192.168.2.12', // Replace with your machine's local IP address
        },                                                                                  
    },
     optimizeDeps: {
        exclude: ['js-big-decimal']
    },
    //  build: {
    //     outDir: 'static', // Output directory for the static build
    //     rollupOptions: {
    //         input: 'resources/index.html', // Entry point for the app
    //     },
    // },
});