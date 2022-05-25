<template>
<div class="flex flex-col">
    <!-- <div class="flex ">
        <router-link :to="{name: 'qualites.create'}" id="rlink1" class="bg-green-500  px-2 py-1 text-balck  rounded">Créer une qualité</router-link>
    </div> -->
    <div class="flex " id="divCreer">
    
        <div class="box" style="    margin-right: 40px;">
            <div class="container-4">
                <input type="search" v-model="search" id="search" placeholder="Search..." />
                <button class="icon" id="btnsearch"><i class="fa fa-search"></i></button>
            </div>
        </div>
                <!-- <router-link :to="{name: 'employees.create'}" id="rlink11" class="bg-green-500  px-2 py-1 text-balck  rounded">Créer un employé</router-link> -->
                <button id="rlink1" @click="$router.push('/qualites/create')">Créer une qualité</button>

    </div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
    
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Qualité
                </th>
                
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>
            <template v-for="qualite,i in qualites_filter" :key="i">
                <tr id="trl1" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        <div v-text="qualite.libelleFonction"></div>
                    </th>
                    
                    
                    <td class="px-6 py-4 text-right">
                        <router-link :to="{name: 'qualites.edit', params:{id: qualite.id}}" id="rlinkEdit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editer</router-link>
                        <button  @click="destroyQualite(qualite.id,i)" id="btnSupp" class="font-medium text-red-600 dark:text-black-500 hover:underline">Supprimer</button>
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
            qualites: [],
            search:"",
        };
    },
    computed:{
      qualites_filter(){
          let res = this.qualites;
        //   let searchBy = this.search.toLocaleLowerCase();
          if(this.search.toLocaleLowerCase() != ""){
              res = res.filter(item=>item.libelleFonction.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()) );
          }
          return res;
      }
    },
    methods: {
      async  getQualite() {

            let response = await axios.get('qualites/all');
            if (response.data.status == 1)
                this.qualites = response.data.data
        },
        async destroyQualite(id,pos){
             if (!window.confirm( 'Supprimer cette qualité ?')) return;

            await axios.delete('/qualites/delete/' + id);
            
            this.qualites.splice(pos,1)
        },
       


    },
    mounted(){
        this.getQualite()
                    

    }
}
</script>

<style>

#rlink1{
    background-color: aqua;
}
#rlinkEdit{
    margin-right: 20px;
}
#btnSupp{
    margin-left: 10px;
    
}

#trl1{
    text-align: center;
}
</style>