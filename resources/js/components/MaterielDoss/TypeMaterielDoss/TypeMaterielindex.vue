<template>
<menu__2 />
<div v-if="load" class="flex flex-col">
    <!-- <div class="flex ">
        <router-link :to="{name: 'typemarteriels.create'}" id="rlink1" class="bg-green-500  px-2 py-1 text-balck  rounded">Créer une type</router-link>
    </div> -->
    <div class="flex " id="divCreer">

        <div class="box" style="    margin-right: 40px;">
            <div class="container-4">
                <input type="search" v-model="search" id="search" placeholder="Chercher..." />
                <button class="icon" id="btnsearch"><i class="fa fa-search"></i></button>
            </div>
        </div>
        <!-- <router-link :to="{name: 'employees.create'}" id="rlink11" class="bg-green-500  px-2 py-1 text-balck  rounded">Créer un employé</router-link> -->
        <button id="rlink1" @click="$router.push('/typemarteriels/create')" class="custom-btn btn-1Employee"><i id="iAddEmpl" class='bx bxs-add-to-queue'></i>Créer un type</button>

    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">

        <table v-if="typeMateriel_filter.length" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        libelle Materiel
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Photo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <template v-for="typeM,i in typeMateriel_filter" :key="i">
                    <tr id="trl1" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <div v-text="typeM.libelleMateriel"></div>
                        </th>
                        <th scope="row" id="photo1" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <!-- <div v-text="typeM.photo"></div> -->
                            <img width="140" height="160" :src="typeM.photo" name="photo" id="photo2" alt="vide">
                        </th>

                        <td class="px-6 py-4 text-right">
                            <!-- <router-link :to="{name: 'typemarteriels.edit', params:{id: typeM.id}}" id="rlinkEdit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editer</router-link> -->
                            <button @click="$router.push('/typemarteriels/'+typeM.id+'/edit')" id="rlinkEdit" class="font-medium text-red-600 dark:text-black-500 hover:underline"> <i class="bx bx-edit icon_table"></i> Modifier</button>
                            <button @click="destroyTypeMateriel(typeM.id)" id="btnSupp" class="font-medium text-red-600 dark:text-black-500 hover:underline"><i class="bx bx-trash icon_table"></i>Supprimer</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
        <!-- ----------------Image-- pour afficher que les données pas trouver---------------------- -->
        <div v-else>
            <div v-if="!typesMat.length" id="divImgLab">
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
    </div>
</div>
</template>

<script>
import axios from "axios";
import menu__2 from "../../menu/menu.vue";
import Swal from 'sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css';


export default {
    components: {
        menu__2
    },
    data() {
        return {
            typesMat: [],
            search:'',
            load: false
        };
    },
    computed:{
      typeMateriel_filter(){
          let res = this.typesMat;
        //   let searchBy = this.search.toLocaleLowerCase();
          if(this.search.toLocaleLowerCase() != ""){
              res = res.filter(item=>item.libelleMateriel.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()) );
          }
          return res;
      }
    },
    methods: {
        async getTypeMat() {

            let response = await axios.get('/typemarteriels/all');
            if (response.data.status == 1)
                this.load = true
                this.typesMat = response.data.data
        },
        search__id(id) {
            let i = 0;

            for (i = 0; i < this.typesMat.length; i++)
                if (  this.typesMat[i].id == id)
                    return i
            return -1
        },

        async MethodAxios(id) {
            let pos = this.search__id(id);
            await axios.delete('/typemarteriels/delete/' + id);
            this.typesMat.splice(pos, 1)

        },

        async destroyTypeMateriel(id) {
            // if (!window.confirm('Supprimer ce type de matériel ?')) return;
            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Voulez vous vraîment supprimer ce type de matériel ?",
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
                            'Type a été supprimé.',
                            'success'
                        )
                }
            })
        },

    },
    mounted() {
        this.getTypeMat()

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
</style>
