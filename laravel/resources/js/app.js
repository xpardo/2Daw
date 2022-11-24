import './bootstrap';

import Alpine from 'alpinejs';

import './bootstrap';

import '../sass/app.scss'


window.Alpine = Alpine;

Alpine.start();


import {createApp} from 'vue'

import App from './App.vue'

createApp(App).mount("#app")