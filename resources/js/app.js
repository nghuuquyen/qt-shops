import './bootstrap';
import './theme'
import Alpine from 'alpinejs'
import ApexCharts from 'apexcharts'
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;
 
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

window.Alpine = Alpine
window.ApexCharts = ApexCharts;

Alpine.start();