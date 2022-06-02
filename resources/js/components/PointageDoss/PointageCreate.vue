<template>
<menu__2 />
<div class="flex flex-col" v-if="list_create_pointage.length">
    <!-- <div class="flex ">
        <router-link :to="{name: 'pointages.edit'}" id="rlink1" class="bg-green-500  px-2 py-1 text-balck  rounded">Modifier Pointage</router-link>
    </div> -->
    <div class="flex " id="divCreer">

        <div class="box" style="    margin-right: 40px;">
            <div class="container-4">
                <input type="search" v-model="search" id="search" placeholder="Search..." />
                <button class="icon" id="btnsearch"><i class="fa fa-search"></i></button>
            </div>
        </div>
        <!-- <router-link :to="{name: 'employees.create'}" id="rlink11" class="bg-green-500  px-2 py-1 text-balck  rounded">Créer un employé</router-link> -->
        <button id="rlink1" class="custom-btn btn-1Employee" @click="$router.push('/pointages/edit')"><i id="iAddEmpl" class="bx bx-edit icon_table"></i>Modifier un Pointage</button>

    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Id Employee
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nom
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Prenom
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Qualité
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Présence
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Heurs Supplémentaire
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Remarque
                    </th>
                    <!-- <th scope="col" class="px-6 py-3">
                        Date
                    </th> -->
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <template v-for="employee,i in employees_filter" :key="i">
                    <tr id="trl1" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            {{employee.id_employee}}
                        </th>
                        <td class="px-6 py-4">
                            {{employee.nom}}<!-- {{chantier.libelle}} -->
                        </td>
                        <td class="px-6 py-4">
                            {{employee.prenom}}
                        </td>
                        <td class="px-6 py-4">
                            {{employee.libelleFonction}}
                        </td>

                        <!-- <form v-on:submit.prevent="create_pointage(i)"> -->
                        <td class="px-6 py-4">
                            <select class="inp1" v-model="employee.presence" required>
                                <option value="0">ABSENT</option>
                                <option value="1">PRÉSENT</option>
                                <option value="0.5">DEMI JOURNÉE</option>
                                <option value="1.5">UN JOUR ET DEMI</option>
                            </select>
                        </td>
                        <td class="px-6 py-4">
                            <input type="number" v-model="employee.heurs_suppl" min="0" class="inp1" required>
                        </td>
                        <td class="px-6 py-4">
                            <textarea class="inp1" v-model="employee.remarque" name="textarea1" id="txtare1" cols="30" rows="4" placeholder="Remarque" required></textarea>
                        </td>

                        <!-- <td class="px-6 py-4">
                            <input type="date" class="inp1" v-model="list_create_pointage[i].date_pointage">
                        </td> -->

                        <td class="px-6 py-4 text-right">

                            <button id="btnEnr1" @click="create_pointage(employee.id_employee)" class="custom-btn btn-1Employee"><i id="iAddEmpl" class="bx bx-save icon_table"></i>Enregistrer</button>
                        </td>
                        <!-- </form>                 -->

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
import Swal from 'sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css';


export default {
    components: {
        menu__2
    },
    data() {
        return {
            employees: [],
            search: '',
            list_create_pointage: [],
            Object_pointage: {
                //date_pointage: '',
                id_employee: -1,
                presence: '',
                remarque: '',
                heurs_suppl: '0',
                nom:"",
                prenom:"",
                libelleFonction:"",


            }
        };
    },
    computed: {
        employees_filter() {
            let res = this.list_create_pointage;
            //   let searchBy = this.search.toLocaleLowerCase();
            if (this.search.toLocaleLowerCase() != "") {
                res = res.filter(item => item.nom.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()) || item.prenom.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()));
            }
            return res;
        }
    },
    methods: {
        async getEmployee() {

            let response = await axios.get('/pointages/allAbs');
            if (response.data.status == 1) {
                this.employees = response.data.data
                let i = 0;
                for (i = 0; i < this.employees.length; i++) {
                    let item__ = Object.assign({}, this.Object_pointage)
                    item__.id_employee = this.employees[i].id;
                    item__.nom = this.employees[i].nom;

                    item__.prenom = this.employees[i].prenom;
              item__.libelleFonction = this.employees[i].libelleFonction;
                    this.list_create_pointage.push(item__)
                }

            }
        },
        async createpointData(data) {
            await axios.post('/pointages/create', data);
            this.$router.push("/pointages");
        },
        search__id(id) {
            let i = 0;

            for (i = 0; i < this.list_create_pointage.length; i++)
                if (  this.list_create_pointage[i].id_employee == id)
                    return i
            return -1
        },
        async create_pointage(id) {
            let pos = this.search__id(id);
// alert(pos)
            if (this.list_create_pointage[pos].presence != '' && this.list_create_pointage[pos].heurs_suppl !== '' && this.list_create_pointage[pos].remarque != '') {
                await this.createpointData(this.list_create_pointage[pos]);
                this.list_create_pointage.splice(pos, 1);
                this.employees.splice(pos, 1);
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Pointage enregistrer',
                showConfirmButton: false,
                timer: 2200
            })

            } else
                // alert("Veuillez remplir les champs vide");
                Swal.fire(
                    'Attention !',
                    'Veuillez remplir les champs vide!!!',
                    'info'
                );

            // this.$router.push("/pointages");
            //console.log(this.list_create_pointage[i])
        }
    },
    mounted() {
        this.getEmployee()
    }

}
</script>

<style scoped>
#btnEnr1 {
    width: 170px !important;
    height: 50px !important;
}

.inp1 {
    border-radius: 10px;

}
</style>
