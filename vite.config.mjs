import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/js/app.js", "resources/css/app.css"],
            refresh: true,
        }),
    ],
    server: {
        host: "192.168.1.39", // Use APP_URL from .env
        port: 5173, // Default Vite port
        hmr: {
            protocol: "ws", // or 'wss' for secure
            host: "192.168.1.39", // Use APP_URL from .env
        },
    },
});
