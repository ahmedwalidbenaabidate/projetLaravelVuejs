import { createRouter, createWebHistory } from "vue-router";

import Chantierindex from "../components/Chantierindex.vue";
import ChantierCreate from "../components/ChantierCreate.vue";
import ChantierEdit from "../components/ChantierEdit.vue";

const routes =[
    {
        path : '/dashboard',
        name: 'chantiers.index',
        component: Chantierindex
    },
    {
        path : '/chantiers/create',
        name: 'chantiers.create',
        component: ChantierCreate
    },
    
    {
        path : '/chantiers/:id/edit',
        name: 'chantiers.edit',
        component: ChantierEdit,
        props : true
    },
    
];

export default createRouter({
history: createWebHistory(),
routes
});
