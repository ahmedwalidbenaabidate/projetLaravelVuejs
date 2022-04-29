require('./bootstrap');

import { createApp } from "vue";
import router from "./router";

import Chantierindex from "./components/ChantierDoss/Chantierindex.vue";
import Qualiteindex from "./components/QualiteDoss/Qualiteindex.vue";


import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();



createApp({
    components: {
        Chantierindex,
        Qualiteindex

    }
})
.use(router)
.mount('#app');

