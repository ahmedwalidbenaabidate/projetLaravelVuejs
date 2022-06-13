<template>
    <menu__2 />

<div v-if="load" class="flex flex-col">
    <!-- <div class="flex ">
        <router-link :to="{name: 'administratifs.create'}" id="rlink1" class="bg-green-500  px-2 py-1 text-balck  rounded">Ajouter un document</router-link>
    </div> -->
    <div class="flex " id="divCreer">

        <div class="box" style="    margin-right: 40px;">
            <div class="container-4">
                <input type="search" v-model="search" id="search" placeholder="Search..." />
                <button class="icon" id="btnsearch"><i class="fa fa-search"></i></button>
            </div>
        </div>
        <!-- <router-link :to="{name: 'employees.create'}" id="rlink11" class="bg-green-500  px-2 py-1 text-balck  rounded">Créer un employé</router-link> -->
        <button class="custom-btn btn-1Employee" id="rlink1" @click="$router.push('/administratifs/create')"><i id="iAddEmpl" class="bx bxs-file-plus"></i> Ajouter un document</button>

    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">

        <table v-if="documents_filter.length" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Déscription
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Matériel
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Document
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <template v-for="administratif,i in documents_filter" :key="i">
                    <tr id="trl1" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <!-- <div v-text="administratif.descriptionA"></div> -->
                            <textarea class="inp1" v-model="administratif.descriptionA" disabled name="textarea1" id="txtare1" cols="30" rows="4" placeholder="Observation" required></textarea>
                        </th>

                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <div v-text="administratif.marqueM"></div>
                        </th>
                        <th scope="row" id="proceV" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <!-- <div v-text="typeM.photo"></div> -->
                            <!-- <img width="140" height="160" :src="typeM.photo" name="photo" id="photo2"  alt="vide"> -->
                            <button @click="afficherDocument(administratif.documentA)" id="previewPDF">Aperçu document</button>
                            <br><img id="imgDoc1" src="/storage/images/imgDoc1.png" alt="vide">
                        </th>

                        <td class="px-6 py-4 text-right">
                            <!-- <router-link :to="{name: 'administratifs.edit', params:{id: administratif.id}}" id="rlinkEdit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Modifier</router-link> -->
                            <button @click="$router.push('/administratifs/'+administratif.id+'/edit')" id="rlinkEdit" class="font-medium text-red-600 dark:text-black-500 hover:underline"> <i class="bx bx-edit icon_table"></i> Modifier</button>
                            <button @click="destroyAdministratif(administratif.id)" id="btnSupp" class="font-medium text-red-600 dark:text-black-500 hover:underline"><i class="bx bx-trash icon_table"></i>Supprimer</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
        <div v-else>
            <div v-if="!administratifs.length">
                <img id="imgRech1" src="/storage/images/Rech1.png" alt="Vide">
                <p>Aucune données</p>
            </div>
            <div v-else>
                <div id="divImgLab">

                    <img id="imgRech1" src="/storage/images/Rech1.png" alt="Vide">
                    <p id="paraRech1">Aucune données commencer par: <b id="lb1"> {{search}} </b></p>
                </div>
            </div>

        </div>
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
            administratifs: [],
            search: "",
            load: false
        };
    },
    computed: {
        documents_filter() {
            let res = this.administratifs;
            //   let searchBy = this.search.toLocaleLowerCase();
            if (this.search.toLocaleLowerCase() != "") {
                res = res.filter(item => item.marqueM.toLocaleLowerCase().includes(this.search.toLocaleLowerCase())|| item.descriptionA.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()));
            }
            return res;
        }
    },
    methods: {
        async getAdministratifs() {

            let response = await axios.get('/administratifs/all');
            if (response.data.status == 1) {
                this.load = true
                this.administratifs = response.data.data
            }
        },
        search__id(id) {
            let i = 0;

            for (i = 0; i < this.administratifs.length; i++)
                if (this.administratifs[i].id == id)
                    return i
            return -1
        },
        async MethodAxios(id) {
            await axios.delete('/administratifs/delete/' + id);
        },

        async destroyAdministratif(id) {
            // if (!window.confirm('Supprimer ce enregistrement ?')) return;

            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "voulez vous vraîment supprimer cette enregistrement!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, Supprimer!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let pos = this.search__id(id);
                    this.MethodAxios(id);

                    this.administratifs.splice(pos, 1)
                    //-----------Instruction---------------//
                    Swal.fire(
                        'Supprimé!',
                        'Votre fichier a été supprimé.',
                        'Succès'
                    )
                }
            })

        },

        afficherDocument(u) {
            window.open(u)
        },

    },
    mounted() {
        this.getAdministratifs()

    }
}
</script>

<style>
#rlink1 {
    background-color: aqua;
}

#trl1 {
    text-align: center;
}

/* #photo1{
    margin: auto;
    width: 100%;

}
#photo1 img{
        text-align: center;
        display: inline-block;
    } */
#photo2 {
    /* text-align: center; */
    display: inline-block;
}

#previewPDF {
    color: blue;
    text-decoration: underline;
}

#previewPDF:hover {
    color: red;
}

#imgDoc1 {
    width: 60px;
    height: 70px;
    text-align: center;
    display: inline-block;
}
</style>
