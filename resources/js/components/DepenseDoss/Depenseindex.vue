<template>
<div class="flex flex-col">
    <!-- <div class="flex ">
        <router-link :to="{name: 'depenses.create'}" id="rlink1" class="bg-green-500  px-2 py-1 text-balck  rounded">Ajouter des dépenses</router-link>
    </div> -->
    <div class="flex " id="divCreer">
    
        <div class="box" style="    margin-right: 40px;">
            <div class="container-4">
                <input type="search" v-model="search" id="search" placeholder="Search..." />
                <button class="icon" id="btnsearch"><i class="fa fa-search"></i></button>
            </div>
        </div>
                <!-- <router-link :to="{name: 'employees.create'}" id="rlink11" class="bg-green-500  px-2 py-1 text-balck  rounded">Créer un employé</router-link> -->
                <button id="rlink1" @click="$router.push('/depenses/create')">Ajouter des dépenses</button>

    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Déscription dépenses
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
                        Date dépenses
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Matériel
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total T.T.C
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Bon des dépenses
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <template v-for="depense,i in depenses_filter" :key="i">
                    <tr id="trl1" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <div v-text="depense.description"></div>
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <div v-text="depense.reference"></div>
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <div v-text="depense.nom"></div>
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <div v-text="depense.prenom"></div>
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <div v-text="depense.dateDepense"></div>
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                         <!-- pour afficher sur le tableau des dépenses "Autre dépenses si le id_materiel dans la base de données égale à -1" -->
                         <div v-if="depense.id_materiel==-1" > Autre dépenses</div>
                         <div v-else v-text="depense.marqueM"></div>
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <div v-text="depense.totalTCC"></div>
                        </th>
                        <th scope="row" id="proceV" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <!-- <div v-text="typeM.photo"></div> -->
                            <!-- <img width="140" height="160" :src="typeM.photo" name="photo" id="photo2"  alt="vide"> -->
                            <button @click="afficherDocument(depense.bonDepense)" id="previewPDF">Aperçu document</button>
                            <br><img id="imgDoc1" src="/storage/images/imgDoc2.png" alt="vide">
                        </th>

                        <td class="px-6 py-4 text-right">
                            <router-link :to="{name: 'depenses.edit', params:{id: depense.id}}" id="rlinkEdit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Modifier</router-link>
                        <button  @click="destroyDepenses(depense.id,i)" id="btnSupp" class="font-medium text-red-600 dark:text-black-500 hover:underline">Supprimer</button>
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

export default {
    data() {
        return {
            depenses: [],
            search:"",
        };
    },
    computed:{
      depenses_filter(){
          let res = this.depenses;
        //   let searchBy = this.search.toLocaleLowerCase();
          if(this.search.toLocaleLowerCase() != ""){
              res = res.filter(item=>item.description.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()) ||   item.nom.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()) || item.prenom.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()) || item.reference.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()));
          }
          return res;
      }
    },
    methods: {
        async getDepenses() {

            let response = await axios.get('/depenses/all');
            if (response.data.status == 1)
                this.depenses = response.data.data
            
        },

        async destroyDepenses(id,pos){
             if (!window.confirm( 'Supprimer ce enregistrement ?')) return;

            await axios.delete('/depenses/delete/' + id);

            this.depenses.splice(pos,1)
        },

        afficherDocument(u) {
            window.open(u)
        },

    },
    mounted() {
        this.getDepenses()

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
