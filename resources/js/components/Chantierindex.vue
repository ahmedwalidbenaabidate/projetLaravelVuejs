<template>
<div class="flex flex-col">
    <div class="flex ">
        <router-link :to="{name: 'chantiers.create'}" id="rlink1" class="bg-green-500  px-2 py-1 text-balck  rounded">Créer un chantier</router-link>
    </div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
    
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Code chantier
                </th>
                <th scope="col" class="px-6 py-3">
                    Libelle chantier
                </th>
                <th scope="col" class="px-6 py-3">
                    Abreviation
                </th>
                
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>
            <template v-for="chantier,i in chantiers" :key="i">
                <tr id="trl1" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        <div v-text="chantier.code"></div>
                    </th>
                    <td class="px-6 py-4">
                        <div v-text="chantier.libelle"></div>
                    </td>
                    <td class="px-6 py-4">
                        <div v-text="chantier.abreviation"></div>
                    </td>
                    <!-- <td class="px-6 py-4">
                        $2999
                    </td> -->
                    <td class="px-6 py-4 text-right">
                        <router-link :to="{name: 'chantiers.edit', params:{id: chantier.id}}" id="rlinkEdit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editer</router-link>
                        <button  @click="destroyChantier(chantier.id,i)" id="btnSupp" class="font-medium text-red-600 dark:text-black-500 hover:underline">Supprimer</button>
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
            chantiers: []
        };
    },
    methods: {
      async  getC() {

            let response = await axios.get('/chantiers');
            if (response.data.status == 1)
                this.chantiers = response.data.data
        },
        async destroyChantier(id,pos){
             if (!window.confirm( 'Supprimer ce chantier ?')) return;

            await axios.delete('/chantiers/delete/' + id);
            
            this.chantiers.splice(pos,1)
        },
       


    },
    mounted(){
        this.getC()
                    

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