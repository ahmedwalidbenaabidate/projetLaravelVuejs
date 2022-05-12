<template>
<div class="flex flex-col">
    <div class="flex ">
        <router-link :to="{name: 'typemarteriels.create'}" id="rlink1" class="bg-green-500  px-2 py-1 text-balck  rounded">Créer une type</router-link>
    </div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
    
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
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
            <template v-for="typeM,i in typesMat" :key="i">
                <tr id="trl1" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        <div v-text="typeM.libelleMateriel"></div>
                    </th>
                    <th scope="row"  id="photo1" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        <!-- <div v-text="typeM.photo"></div> -->
                        <img width="140" height="160" :src="typeM.photo" name="photo" id="photo2"  alt="vide">
                    </th>
                    
                    <td class="px-6 py-4 text-right">
                        <router-link :to="{name: 'typemarteriels.edit', params:{id: typeM.id}}" id="rlinkEdit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editer</router-link>
                        <button  @click="destroyTypeMateriel(typeM.id,i)" id="btnSupp" class="font-medium text-red-600 dark:text-black-500 hover:underline">Supprimer</button>
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
            typesMat: []
        };
    },
    methods: {
      async  getTypeMat() {

            let response = await axios.get('/typemarteriels/all');
            if (response.data.status == 1)
                this.typesMat = response.data.data
        },

        async destroyTypeMateriel(id,pos){
             if (!window.confirm( 'Supprimer ce type de matériel ?')) return;

            await axios.delete('/typemarteriels/delete/' + id);
            
            this.typesMat.splice(pos,1)
        },
       


    },
    mounted(){
        this.getTypeMat()
                    

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
/* #photo1{
    margin: auto;
    width: 100%;
    
}
#photo1 img{
        text-align: center;
        display: inline-block;
    } */
    #photo2{
        /* text-align: center; */
        display: inline-block;
    }
</style>