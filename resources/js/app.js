import './bootstrap';
import './broadcasting'; // Import the broadcasting setup


import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: import.meta.env.VITE_PUSHER_APP_KEY,  // Vite variable
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    wsHost: import.meta.env.VITE_PUSHER_HOST || "env('VITE_URL')",
    wsPort: import.meta.env.VITE_PUSHER_PORT || 6001,
    wssPort: import.meta.env.VITE_PUSHER_PORT || 6001,
    forceTLS: false,  // Set to true if using HTTPS
    disableStats: true,
    enabledTransports: ['ws', 'wss'],
});



import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();
