import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from 'vue';
import App from './App.vue';

// mount Vue to #app (or any div you choose in Blade)
createApp(App).mount('#app');
