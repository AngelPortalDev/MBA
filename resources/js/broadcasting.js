import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    wsHost: window.location.hostname,
    wsPort: 6001,
    forceTLS: false,
    disableStats: true,
});
    

// Listening to the event
// window.Echo.channel('dashboard')
//     .listen('AdminDashboardUpdated', (event) => {
//         console.log('Event received:', event.data);
//         console.log('Total Sales:', event.data.totalSales);
//         // Add other logs as needed
//     });
