import { createRouter, createWebHistory } from "vue-router";

import Chantierindex from "../components/Chantierindex.vue";

const routes =[
    {
        path : '/dashboard',
        name: 'chantiers.index',
        component: Chantierindex
    }    
];

export default createRouter({
history: createWebHistory(),
routes
});
