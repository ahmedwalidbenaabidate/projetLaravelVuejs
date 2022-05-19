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

import PointageCreate from "../components/PointageDoss/PointageCreate.vue";
import PointageEdit from "../components/PointageDoss/PointageEdit.vue";

import TypeMaterielindex from "../components/MaterielDoss/TypeMaterielDoss/TypeMaterielindex.vue";
import TypeMaterielcreate from "../components/MaterielDoss/TypeMaterielDoss/TypeMaterielcreate.vue";
import TypeMaterielEdit from "../components/MaterielDoss/TypeMaterielDoss/TypeMaterielEdit.vue";

import Materielindex from "../components/MaterielDoss/Materiel/Materielindex.vue";
import MaterielCreate from "../components/MaterielDoss/Materiel/MaterielCreate.vue";
import MaterielEdit from "../components/MaterielDoss/Materiel/MaterielEdit.vue";

import Accidentindex from "../components/AccidentDoss/Accidentindex.vue";
import AccidentCreate from "../components/AccidentDoss/AccidentCreate.vue";
import AccidentEdit from "../components/AccidentDoss/AccidentEdit.vue";

import AffectationMaterielindex from "../components/AffectationMaterielDoss/AffectationMaterielindex.vue";
import AffectationMaterielCreate from "../components/AffectationMaterielDoss/AffectationMaterielCreate.vue";
import AffectationMaterielEdit from "../components/AffectationMaterielDoss/AffectationMaterielEdit.vue";

import Depenseindex from "../components/DepenseDoss/Depenseindex.vue";
import DepenseCreate from "../components/DepenseDoss/DepenseCreate.vue";
import DepenseEdit from "../components/DepenseDoss/DepenseEdit.vue";

import Carburantindex from "../components/CarburantDoss/Carburantindex.vue";
import CarburantCreate from "../components/CarburantDoss/CarburantCreate.vue";
import CarburantEdit from "../components/CarburantDoss/CarburantEdit.vue";

import Administratifindex from "../components/AdministratifDoss/Administratifindex.vue";
import AdministratifCreate from "../components/AdministratifDoss/AdministratifCreate.vue";
import AdministratifEdit from "../components/AdministratifDoss/AdministratifEdit.vue";



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
    //Routes Pointage-------------------------------------------
    {
        path : '/pointages',
        name: 'pointages.create',
        component: PointageCreate
    },
    {
        path : '/pointages/edit',
        name: 'pointages.edit',
        component: PointageEdit
    },
    //Routes TypeMateriel--------------------
    {
        path : '/typemarteriels',
        name: 'typemarteriels.index',
        component: TypeMaterielindex
    },

    {
        path : '/typemarteriels/create',
        name: 'typemarteriels.create',
        component: TypeMaterielcreate
    },
    
    {
        path : '/typemarteriels/:id/edit',
        name: 'typemarteriels.edit',
        component: TypeMaterielEdit,
    },

    //Routes Materiel---------------------------
    {
        path : '/materiels',
        name: 'materiels.index',
        component: Materielindex
    },
    {
        path : '/materiels/create',
        name: 'materiels.create',
        component: MaterielCreate
    },
    {
        path : '/materiels/:id/edit',
        name: 'materiels.edit',
        component: MaterielEdit,
        
    },

    //Route Accident---------------------------
    {
        path : '/accidents',
        name: 'accidents.index',
        component: Accidentindex
    },
    {
        path : '/accidents/create',
        name: 'accidents.create',
        component: AccidentCreate
    },
    {
        path : '/accidents/:id/edit',
        name: 'accidents.edit',
        component: AccidentEdit,
        
    },
    
    //Route AffectationMateriel--------------------------------
    {
        path : '/affectationMateriels',
        name: 'affectationMateriels.index',
        component: AffectationMaterielindex
    },
    {
        path : '/affectationMateriels/create',
        name: 'affectationMateriels.create',
        component: AffectationMaterielCreate
    },
    {
        path : '/affectationMateriels/:id/edit',
        name: 'affectationMateriels.edit',
        component: AffectationMaterielEdit,
        
    },
    //Route Depense-----------------------------------------------
    {
        path : '/depenses',
        name: 'depenses.index',
        component: Depenseindex
    },
    {
        path : '/depenses/create',
        name: 'depenses.create',
        component: DepenseCreate
    },
    {
        path : '/depenses/:id/edit',
        name: 'depenses.edit',
        component: DepenseEdit,
        
    },

    //Route Carburant--------------------------------------------
    {
        path : '/carburants',
        name: 'carburants.index',
        component: Carburantindex
    },
    {
        path : '/carburants/create',
        name: 'carburants.create',
        component: CarburantCreate
    },
    {
        path : '/carburants/:id/edit',
        name: 'carburants.edit',
        component: CarburantEdit,
        
    },

    //Route Administratif-----------------------------------------
    {
        path : '/administratifs',
        name: 'administratifs.index',
        component: Administratifindex
    },
    {
        path : '/administratifs/create',
        name: 'administratifs.create',
        component: AdministratifCreate
    },
    {
        path : '/administratifs/:id/edit',
        name: 'administratifs.edit',
        component: AdministratifEdit,
        
    },

];

export default createRouter({
history: createWebHistory(),
routes
});
