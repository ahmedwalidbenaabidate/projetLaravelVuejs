<template>
<menu__2 />
<div v-if="load" class="flex flex-col">
    <!-- <div class="flex ">
        <router-link :to="{name: 'affectationMateriels.create'}" id="rlink1" class="bg-green-500  px-2 py-1 text-balck  rounded">Créer un pointage</router-link>
    </div> -->
    <div class="flex " id="divCreer">
        <button @click="export_()" class="custom-btn btn-2" id="btn2ImprEmployee" value="export"><i id="iImpri" class='bx bx-printer'></i><i>Imprimer</i> </button>
        <div class="box" style="    margin-right: 40px;">
            <div class="container-4">
                <input type="search" v-model="search" id="search" placeholder="Chercher..." />
                <button class="icon" id="btnsearch"><i class="fa fa-search"></i></button>
            </div>
        </div>
        <!-- <router-link :to="{name: 'employees.create'}" id="rlink11" class="bg-green-500  px-2 py-1 text-balck  rounded">Créer un employé</router-link> -->
        <button class="custom-btn btn-1Employee" id="rlink1" @click="$router.push('/affectationMateriels/create')"><i id="iAddEmpl" class='bx bx-check-square'></i>Créer un pointage</button>

    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">

        <table v-if="affectMats_filter.length" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Référence employee
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nom
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Prenom
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date début
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date fin
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Matériel
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Statut
                    </th>

                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <template v-for="affectMat,i in affectMats_filter" :key="i">
                    <tr id="trl1" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <div v-text="affectMat.reference"></div>
                        </th>
                        <td class="px-6 py-4">
                            <div v-text="affectMat.nom"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div v-text="affectMat.prenom"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div v-text="affectMat.date_debut"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div v-text="affectMat.date_fin"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div v-text="affectMat.marqueM"></div>
                        </td>
                        <td class="px-6 py-4">
                            <!-- <div style="background:brown" v-text="affectMat.statut"></div> -->
                            <span id="spanStatut" v-text="affectMat.statut"></span>
                        </td>

                        <td class="px-6 py-4 text-right">
                            <button :class="affectMat.statut=='pas encore' ? 'pas_encore__'  : 'retour__'" @click="saveStatut(affectMat.id)" id="btnStatut"><i class='bx bx-repost'></i> + Statut</button>
                            <!-- <router-link :to="{name: 'affectationMateriels.edit', params:{id: affectMat.id}}" id="rlinkEdit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Modifier</router-link> -->
                            <button @click="$router.push('/affectationMateriels/'+affectMat.id+'/edit')" id="rlinkEdit" class="font-medium text-red-600 dark:text-black-500 hover:underline"> <i class="bx bx-edit icon_table"></i> Modifier</button>
                            <button @click="destroyAffectationM(affectMat.id)" id="btnSupp" class="font-medium text-red-600 dark:text-black-500 hover:underline"><i class="bx bx-trash icon_table"></i> Supprimer</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
        <!-- ----------------Image-- pour afficher que les données pas trouver---------------------- -->
        <div v-else>
            <div v-if="!affectMats.length" id="divImgLab">
                <img id="imgRech1" src="/storage/images/Rech1.png" alt="Vide">
                <p id="paraRech1">Aucune données</p>
            </div>
            <div v-else>
                <div id="divImgLab">

                    <img id="imgRech1" src="/storage/images/Rech1.png" alt="Vide">
                    <p id="paraRech1">Aucune données commencer par: <b id="lb1"> {{search}} </b></p>
                </div>
            </div>

        </div>
        <!-- ------------------------------------ -->
        <!-- ------------------------------------ -->

        <table v-show="false" v-if="affectMats_filter.length" id="table_exportAFFECT" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Reference employee
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nom
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Prenom
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date debut
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date fin
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Materiel
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Statut
                    </th>
                </tr>
            </thead>
            <tbody>
                <template v-for="affectMat,i in affectMats_filter" :key="i">
                    <tr id="trl1" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <div v-text="affectMat.reference"></div>
                        </th>
                        <td class="px-6 py-4">
                            <div v-text="affectMat.nom"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div v-text="affectMat.prenom"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div v-text="affectMat.date_debut"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div v-text="affectMat.date_fin"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div v-text="affectMat.marqueM"></div>
                        </td>
                        <td class="px-6 py-4">
                            <!-- <div style="background:brown" v-text="affectMat.statut"></div> -->
                            <span id="spanStatut" v-text="affectMat.statut"></span>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>

        <!-- ------------------------------------ -->
        
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
            affectMats: [],
            search: '',
            load: false
        };
    },
    computed: {
        affectMats_filter() {
            let res = this.affectMats;
            //   let searchBy = this.search.toLocaleLowerCase();
            if (this.search.toLocaleLowerCase() != "") {
                res = res.filter(item => item.nom.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()) || item.prenom.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()) || item.reference.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()) || item.marqueM.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()) || item.statut.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()));
            }
            return res;
        }
    },
    methods: {
        async Axios_SaveStatut(index) {
            await axios.post('/affectationMateriels/update', this.affectMats[index]);

        },
        async saveStatut(id) {
            // if (!window.confirm('Voulez vous changer le statut de ce pointage?')) return;
            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "voulez vous changer le statut!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, Changé!'
            }).then((result) => {
                if (result.isConfirmed) {
                    //-----------Instruction---------------//
                    let index = this.search__id(id)
                    if (this.affectMats[index].statut == "pas encore")
                        this.affectMats[index].statut = "retour"
                    else {
                        this.affectMats[index].statut = "pas encore"
                    }
                    this.Axios_SaveStatut(index);

                    // alert("Le pointage matériel à été fait avec succes");
                    // ----------------------------//
                    Swal.fire(
                        'Changement!',
                        'Le statut a été changé.',
                        'Succès'
                    )
                }
            })

        },

        async getAffectationM() {

            let response = await axios.get('affectationMateriels/all');
            if (response.data.status == 1)
                this.load = true
            this.affectMats = response.data.data
        },
        search__id(id) {
            let i = 0;

            for (i = 0; i < this.affectMats.length; i++)
                if (this.affectMats[i].id == id)
                    return i
            return -1
        },

        async MethodAxios(id) {
            let pos = this.search__id(id)
            await axios.delete('/affectationMateriels/delete/' + id);
            this.affectMats.splice(pos, 1)
        },

        async destroyAffectationM(id) {
            // if (!window.confirm('Supprimer cette affectation de matériel?')) return;

            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Voulez vous vraîment supprimer cette affectation de matériel?",
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
                            'Affectation a été supprimé.',
                            'success'
                        )
                }
            })

            //pos c'est l'index du ligne sur le tableau d'affichage(html) et le 1 est pour combien de fois se trouve cet employée
        },

        export_() {
            // alert("ok");
            // this.exportTableToExcel("table_export", "test")

            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "voulez vous imprimer cette liste!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, Imprimer!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.exportTableToExcel("table_exportAFFECT", "test")
                    Swal.fire(
                        'Imprimé!',
                        'Votre fichier a été imprimé.',
                        'success'
                    )
                }
            })

        },
        exportTableToExcel(tableID, filename = '') {
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

            // Specify file name
            filename = filename ? filename + '.xls' : 'excel_data.xls';

            // Create download link element
            downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);

            if (navigator.msSaveOrOpenBlob) {
                var blob = new Blob(['\ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob(blob, filename);
            } else {
                // Create a link to the file
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

                // Setting the file name
                downloadLink.download = filename;

                //triggering the function
                downloadLink.click();
            }
        }

    },
    mounted() {
        this.getAffectationM()

    }
}
</script>

<style>
.pas_encore__ {
    background: rgb(255, 166, 0);
}

.retour__ {
    background: blue;

}

#rlink1 {
    background-color: aqua;
}

#btnStatut {
    margin-right: 20px;
    /* background-color: rgb(0, 110, 255); */
    color: aliceblue;
    border-radius: 8px;
    width: 120px;
    font-size: 18px;
    padding: 10px;
    height: 70px;
    margin-bottom: 20px;
    DISPLAY: inline-block;
    padding-top: -30px;

    /* 
    background-color: lime;
    color: black;
    border-radius: 8px;
    font-size: 18px;
    width: 120px;
    margin-bottom: 20px;
    padding:10px;
    DISPLAY: inline-block;
    margin-left: 32px; */
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
</style>
