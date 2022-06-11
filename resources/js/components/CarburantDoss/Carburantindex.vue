<template>
<menu__2 />
<div class="flex flex-col">
    <!-- <div class="flex ">
        <router-link :to="{name: 'carburants.create'}" id="rlink1" class="bg-green-500  px-2 py-1 text-balck  rounded">Créer un remplissage</router-link>
    </div> -->
    <div class="flex " id="divCreer">

        <div class="box" style="    margin-right: 40px;">
            <div class="container-4">
                <input type="search" v-model="search" id="search" placeholder="Search..." />
                <button class="icon" id="btnsearch"><i class="fa fa-search"></i></button>
            </div>
        </div>
        <!-- <router-link :to="{name: 'employees.create'}" id="rlink11" class="bg-green-500  px-2 py-1 text-balck  rounded">Créer un employé</router-link> -->
        <button class="custom-btn btn-1Employee" id="rlink1" @click="$router.push('/carburants/create')"><i id="iAddEmpl" class='bx bx-gas-pump'></i>+ Créer un remplissage</button>

    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        MARQUE MATÉRIEL
                    </th>
                    <th scope="col" class="px-6 py-3">
                        TYPE MATÉRIEL
                    </th>
                    <th scope="col" class="px-6 py-3">
                        ÉTAT MATÉRIEL
                    </th>
                    <th scope="col" class="px-6 py-3">
                        QUANTITÉ DE CARBURANT<b id="L1"> (Litre)</b>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        TYPE CARBURANT
                    </th>
                    <th scope="col" class="px-6 py-3">
                        DATE DE REMPLISSAGE
                    </th>
                    <th scope="col" class="px-6 py-3">
                        OBSERVATIONS
                    </th>

                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <template v-for="carburant,i in carburants_filter" :key="i">
                    <tr id="trl1" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <div v-text="carburant.marqueM"></div>
                        </th>
                        <td class="px-6 py-4">
                            <div v-text="carburant.libelleMateriel"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div v-text="carburant.etatM"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div v-text="carburant.quantiteC"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div v-text="carburant.typeC"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div v-text="carburant.dateC"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div v-text="carburant.observation"></div>
                        </td>

                        <td class="px-6 py-4 text-right">
                            <!-- <router-link :to="{name: 'carburants.edit', params:{id: carburant.id}}" id="rlinkEdit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Modifier</router-link> -->
                            <button @click="$router.push('/carburants/'+carburant.id+'/edit')" id="rlinkEdit" class="font-medium text-red-600 dark:text-black-500 hover:underline"> <i class="bx bx-edit icon_table"></i> Modifier</button>
                            <button @click="destroyCarburant(carburant.id)" id="btnSupp" class="font-medium text-red-600 dark:text-black-500 hover:underline"><i class="bx bx-trash icon_table"></i> Supprimer</button>
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
import Swal from 'sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css';

export default {
    components: {
        menu__2
    },
    data() {
        return {
            carburants: [],
            search: '',
        };
    },
    computed: {
        carburants_filter() {
            let res = this.carburants;
            //   let searchBy = this.search.toLocaleLowerCase();
            if (this.search.toLocaleLowerCase() != "") {
                res = res.filter(item => item.marqueM.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()) || item.libelleMateriel.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()) || item.etatM.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()) || item.libelleMateriel.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()) || item.observation.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()));
            }
            return res;
        }
    },
    methods: {
        async getCarburants() {

            let response = await axios.get('carburants/all');
            if (response.data.status == 1)
                this.carburants = response.data.data
        },
        search__id(id) {
            let i = 0;

            for (i = 0; i < this.carburants.length; i++)
                if (this.carburants[i].id == id)
                    return i
            return -1
        },
        async MethodAxios(id) {
            let pos = this.search__id(id);
            await axios.delete('/carburants/delete/' + id);
            this.carburants.splice(pos, 1)

        },

        async destroyCarburant(id) {
            //  if (!window.confirm( 'Voulez vous supprimer cette enregistrement ?')) return;

            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Voulez vous vraîment supprimer cet enregistrement!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, Supprime-le!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.MethodAxios(id),

                        Swal.fire(
                            'Supprimé!',
                            'Enregistrement a été supprimé.',
                            'success'
                        )
                }
            })
            //pos c'est l'index du ligne sur le tableau d'affichage(html) et le 1 est pour combien de fois se trouve ce carburant
        },

    },
    mounted() {
        this.getCarburants()

    }
}
</script>

<style>
#rlink1 {
    background-color: aqua;
}

#rlinkEdit {
    margin-right: 20px;
}

#btnSupp {
    margin-left: 10px;

}

#L1 {
    color: blue;
}

#trl1 {
    text-align: center;
}
</style>
