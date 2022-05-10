require('./bootstrap');

import { createApp } from "vue";
import router from "./router";

import Chantierindex from "./components/ChantierDoss/Chantierindex.vue";
import Qualiteindex from "./components/QualiteDoss/Qualiteindex.vue";
import Employeeindex from "./components/EmployeeDoss/Employeeindex.vue";

import PointageCreate from "./components/PointageDoss/PointageCreate.vue";
import PointageEdit from "./components/PointageDoss/PointageEdit.vue";

import TypeMaterielindex from "./components/MaterielDoss/TypeMaterielDoss/TypeMaterielindex.vue";

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();



createApp({
    components: {
        Chantierindex,
        Qualiteindex,
        Employeeindex,
        PointageCreate,
        PointageEdit,
        TypeMaterielindex,
    }
})
.use(router)
.mount('#app');

