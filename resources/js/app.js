require('./bootstrap');

import { createApp } from "vue";
import router from "./router";
import App from './App.vue'

import Chantierindex from "./components/ChantierDoss/Chantierindex.vue";
import Qualiteindex from "./components/QualiteDoss/Qualiteindex.vue";
import Employeeindex from "./components/EmployeeDoss/Employeeindex.vue";

import PointageCreate from "./components/PointageDoss/PointageCreate.vue";
import PointageEdit from "./components/PointageDoss/PointageEdit.vue";

import TypeMaterielindex from "./components/MaterielDoss/TypeMaterielDoss/TypeMaterielindex.vue";

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import VueSidebarMenuAkahon from "vue-sidebar-menu-akahon";
import Swal from 'sweetalert2'

// CommonJS
createApp({
    components: {
        Chantierindex,
        Qualiteindex,
        Employeeindex,
        PointageCreate,
        PointageEdit,
        TypeMaterielindex,
        Swal,
        'vue-sidebar-menu-akahon' : VueSidebarMenuAkahon
    }
})
.use(router)
.mount('#app');

