import { createRouter, createWebHistory } from "vue-router";

import Chantierindex from "../components/ChantierDoss/Chantierindex.vue";
import ChantierCreate from "../components/ChantierDoss/ChantierCreate.vue";
import ChantierEdit from "../components/ChantierDoss/ChantierEdit.vue";

import Qualiteindex from "../components/QualiteDoss/Qualiteindex.vue";
import QualiteCreate from "../components/QualiteDoss/QualiteCreate.vue";
import QualiteEdit from "../components/QualiteDoss/QualiteEdit.vue";

import Employeeindex from "../components/EmployeeDoss/Employeeindex.vue";
import EmployeeCreate from "../components/EmployeeDoss/EmployeeCreate.vue";
import EmployeeEdit from "../components/EmployeeDoss/EmployeeEdit.vue";



const routes =[
    //Routes Chantiers-------------------------------
    {
        path : '/chantiers',
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
    //Routes Qualites--------------------------------------
    {
        path : '/qualites',
        name: 'qualites.index',
        component: Qualiteindex
    },

    {
        path : '/qualites/create',
        name: 'qualites.create',
        component: QualiteCreate
    },
    {
        path : '/qualites/:id/edit',
        name: 'qualites.edit',
        component: QualiteEdit,
        props : true
    },
    //Routes Employee-----------------------------------------
    {
        path : '/employees',
        name: 'employees.index',
        component: Employeeindex
    },

    {
        path : '/employees/create',
        name: 'employees.create',
        component: EmployeeCreate
    },
    {
        path : '/employees/:id/edit',
        name: 'employees.edit',
        component: EmployeeEdit,
        props : true
    },

];

export default createRouter({
history: createWebHistory(),
routes
});
