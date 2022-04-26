require('./bootstrap');

import { createApp } from "vue";
import router from "./router";

import Chantierindex from "./components/Chantierindex.vue";


import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();



createApp({
    components: {
        Chantierindex
    }
})
.use(router)
.mount('#app');

