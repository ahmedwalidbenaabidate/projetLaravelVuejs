<template>
<menu__2 />
<div v-if="load" class="flex flex-col">
    <!-- <div class="flex ">
        <router-link :to="{name: 'accidents.create'}" id="rlink1" class="bg-green-500  px-2 py-1 text-balck  rounded">Ajouter un accident</router-link>
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
                <button class="custom-btn btn-1Employee" id="rlink1" @click="$router.push('/accidents/create')"><i id="iAddEmpl" class='bx bxs-user-plus'></i> Ajouter un accident</button>

    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">

        <table v-if="accidents_filter.length" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Déscription
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Réference employee
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nom employee
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Prenom employee
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date d'accident
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
                <template v-for="accident,i in accidents_filter" :key="i">
                    <tr id="trl1" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <div v-text="accident.description"></div>
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <div v-text="accident.reference"></div>
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <div v-text="accident.nom"></div>
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <div v-text="accident.prenom"></div>
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <div v-text="accident.dateA"></div>
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <div v-text="accident.marqueM"></div>
                        </th>
                        <th scope="row" id="proceV" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <!-- <div v-text="typeM.photo"></div> -->
                            <!-- <img width="140" height="160" :src="typeM.photo" name="photo" id="photo2"  alt="vide"> -->
                            <button @click="afficherDocument(accident.proceV)" id="previewPDF">Aperçu document</button>
                            <br><img id="imgDoc1" src="/storage/images/imgDoc1.png" alt="vide">
                        </th>

                        <td class="px-6 py-4 text-right">
                            <!-- <router-link :to="{name: 'accidents.edit', params:{id: accident.id}}" id="rlinkEdit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Modifier</router-link> -->
                            <button @click="$router.push('/accidents/'+accident.id+'/edit')" id="rlinkEdit" class="font-medium text-red-600 dark:text-black-500 hover:underline"> <i class="bx bx-edit icon_table"></i> Modifier</button>
                        <button  @click="destroyAccident(accident.id)" id="btnSupp" class="font-medium text-red-600 dark:text-black-500 hover:underline"><i class="bx bx-trash icon_table"></i> Supprimer</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
        <!-- ----------------Image-- pour afficher que les données pas trouver---------------------- -->
        <div v-else>
            <div v-if="!accidents.length" id="divImgLab">
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

        <table v-show="false" v-if="accidents_filter.length" id="table_exportACC" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Reference employee
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nom employee
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Prenom employee
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date d'accident
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Materiel
                    </th>
                </tr>
            </thead>
            <tbody>
                <template v-for="accident,i in accidents_filter" :key="i">
                    <tr id="trl1" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <div v-text="accident.description"></div>
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <div v-text="accident.reference"></div>
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <div v-text="accident.nom"></div>
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <div v-text="accident.prenom"></div>
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <div v-text="accident.dateA"></div>
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <div v-text="accident.marqueM"></div>
                        </th>
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
            accidents: [],
            search:'',
            load: false
        };
    },
    computed:{
      accidents_filter(){
          let res = this.accidents;
        //   let searchBy = this.search.toLocaleLowerCase();
          if(this.search.toLocaleLowerCase() != ""){
              res = res.filter(item=>item.nom.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()) || item.prenom.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()) || item.description.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()) || item.reference.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()) || item.marqueM.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()) );
          }
          return res;
      }
    },
    methods: {
        async getAccidents() {

            let response = await axios.get('/accidents/all');
            if (response.data.status == 1)
            this.load = true
                this.accidents = response.data.data
        },
        search__id(id) {
            let i = 0;

            for (i = 0; i < this.accidents.length; i++)
                if (this.accidents[i].id == id)
                    return i
            return -1
        },

        async MethodAxios(id) {
            let pos = this.search__id(id);
            await axios.delete('/accidents/delete/' + id);
            this.accidents.splice(pos,1)
        },

        async destroyAccident(id){
            //  if (!window.confirm( 'Supprimer cet enregistrement ?')) return;
            

            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Voulez vous vraîment supprimer cet enregistrement ?",
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
                    this.exportTableToExcel("table_exportACC", "test")
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
        },
        //-----------------------------------------------------------------------

        afficherDocument(u) {
            window.open(u)
        },

    },
    mounted() {
        this.getAccidents()

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
#previewPDF:hover{
    color: red;
}
#imgDoc1{
    width: 60px;
    height: 70px;
    text-align: center;
    display: inline-block;
}
</style>
