<template>
<div class="flex flex-col">
    <div class="flex " id="divCreer">

        <div class="box" style="    margin-right: 40px;">
            <div class="container-4">
                <input type="search" v-model="search" id="search" placeholder="Search..." />
                <button class="icon" id="btnsearch"><i class="fa fa-search"></i></button>
            </div>
        </div>
        <!-- <router-link :to="{name: 'employees.create'}" id="rlink11" class="bg-green-500  px-2 py-1 text-balck  rounded">Créer un employé</router-link> -->
        <button id="rlink1" @click="$router.push('/employees/create')"><i class="bx bx-user-check icon_table"></i>Créer un employé</button>

    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
        <menu__2 />
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Référence
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nom
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Prenom
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Adresse
                    </th>
                    <th scope="col" class="px-6 py-3">
                        CIN
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Salaire
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Type salaire
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date du permis
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Qualité
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <template v-for="employee,i in employees_filter" :key="i">
                    <tr id="trl1" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <div v-text="employee.reference"></div>
                        </th>
                        <td class="px-6 py-4">
                            <div v-text="employee.nom"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div v-text="employee.prenom"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div v-text="employee.adresse"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div v-text="employee.cin"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div v-text="employee.salaire"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div v-text="employee.type_salaire"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div v-text="employee.permisDate"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div v-text="employee.libelleFonction"></div>
                        </td>

                        <td class="px-6 py-4 text-right">
                            <!-- <router-link :to="{name: 'employees.edit', params:{id: employee.id}}" id="rlinkEdit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"><i class="bx bx-edit icon_table"></i>Modifier</router-link> -->
                            <button @click="$router.push('/employees/'+employee.id+'/edit')" id="rlinkEdit" class="font-medium text-red-600 dark:text-black-500 hover:underline"> <i class="bx bx-edit icon_table"></i> Modifier</button>
                            <button @click="destroyEmployee(employee.id,i)" id="btnSupp" class="font-medium text-red-600 dark:text-black-500 hover:underline"> <i class="bx bx-trash icon_table"></i> Supprimer</button>
                            <!-- $router.push('/employees/edit') -->
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</div>
</template>

<script>
import axios from "axios";
import menu__2 from "../menu/menu.vue";

export default {
    components: {
        menu__2
    },
    data() {
        return {
            employees: [],
            search: "",
        };
    },
    computed: {
        employees_filter() {
            let res = this.employees;
            //   let searchBy = this.search.toLocaleLowerCase();
            if (this.search.toLocaleLowerCase() != "") {
                res = res.filter(item => item.nom.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()) || item.prenom.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()));
            }
            return res;
        }
    },
    methods: {
        async getEmployee() {

            let response = await axios.get('employees/all');
            if (response.data.status == 1)
                this.employees = response.data.data
        },
        async destroyEmployee(id, pos) {
            Swal.fire(
                'The Internet?',
                'That thing is still around?',
                'question'
            )
            if (!window.confirm('Supprimer cet employee ?')) return;

            await axios.delete('/employees/delete/' + id);

            this.employees.splice(pos, 1)
            //pos c'est l'index du ligne sur le tableau d'affichage(html) et le 1 est pour combien de fois se trouve cet employée
        },

    },
    mounted() {
        this.getEmployee()

    }
}
</script>

<style>
#rlink1 {
    background-color: aqua;
    align-content: center;
    border-radius: 6px;
    width: 220px;
}

#rlinkEdit {
    margin-right: 20px;
}

#btnSupp {
    margin-left: 10px;

}

#trl1 {
    text-align: center;
}

/* ---------------------------------- */
/* input Rechercher */
.container-4 {
    overflow: hidden;
    width: 300px;
    vertical-align: middle;
    white-space: nowrap;
}

.container-4 input#search {
    width: 300px;
    height: 50px;
    background: #2b303b;
    border: none;
    font-size: 10pt;
    float: left;
    color: #fff;
    padding-left: 15px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
}

.container-4 input#search::-webkit-input-placeholder {
    color: #65737e;
}

.container-4 input#search:-moz-placeholder {
    /* Firefox 18- */
    color: #65737e;
}

.container-4 input#search::-moz-placeholder {
    /* Firefox 19+ */
    color: #65737e;
}

.container-4 input#search:-ms-input-placeholder {
    color: #65737e;
}

.container-4 button.icon {
    -webkit-border-top-right-radius: 5px;
    -webkit-border-bottom-right-radius: 5px;
    -moz-border-radius-topright: 5px;
    -moz-border-radius-bottomright: 5px;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;

    border: none;
    background: #232833;
    height: 50px;
    width: 50px;
    color: #4f5b66;
    opacity: 0;
    font-size: 10pt;

    -webkit-transition: all .55s ease;
    -moz-transition: all .55s ease;
    -ms-transition: all .55s ease;
    -o-transition: all .55s ease;
    transition: all .55s ease;
}

.container-4:hover button.icon,
.container-4:active button.icon,
.container-4:focus button.icon {
    outline: none;
    opacity: 1;
    margin-left: -50px;
}

.container-4:hover button.icon:hover {
    background: white;
}

/* ---------------------------------- */
/* #divCreer{
        justify-content: flex-end;

}
#search{
    width: 100% !important;
    height: 100% !important;
}
#divCreer .container-4{
    width: 900px !important;
    height: 80px !important;
}
#divCreer .container-4 .icon{
    height: 100% !important;
} */

/* ----------------------------------------------- */
/* table {
  width: 800px;
  border-collapse: collapse;
  overflow: hidden;
  box-shadow: 0 0 20px rgba(51, 62, 87, 0.986);
}

th,
td {
  padding: 15px;
  background-color: rgba(107, 99, 99, 0.2);
  color: rgb(0, 0, 0);
}

thead th {
  background-color: #1d1b31;
  height: 90px;
  color: white;
}
tbody{
    background: #65737e !important;
}
tbody tr:hover {
  background-color: rgba(255, 255, 255, 0.3);
}
tbody td {
  position: relative;
}
tbody td:hover:before {
  content: "";
  position: absolute;
  left: 0;
  right: 0;
  top: -9999px;
  bottom: -9999px;
  background-color: rgb(255, 0, 0);
  z-index: -1;
} */
/* ------------------------------------------------------- */
</style>
