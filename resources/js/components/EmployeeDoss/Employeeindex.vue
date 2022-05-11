<template>
<div class="flex flex-col">
    <div class="flex ">
        <router-link :to="{name: 'employees.create'}" id="rlink1" class="bg-green-500  px-2 py-1 text-balck  rounded">Créer un employé</router-link>
    </div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
    
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Référence
                </th>
                <th scope="col" class="px-6 py-3">
                    Nom
                </th>
                <th scope="col" class="px-6 py-3">
                    Prenom
                </th>
                <th scope="col" class="px-6 py-3">
                    Adresse
                </th>
                <th scope="col" class="px-6 py-3">
                    CIN
                </th>
                <th scope="col" class="px-6 py-3">
                    Salaire
                </th>
                <th scope="col" class="px-6 py-3">
                    Type salaire
                </th>
                <th scope="col" class="px-6 py-3">
                    Date du permis
                </th>
                <th scope="col" class="px-6 py-3">
                    Qualité
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>
            <template v-for="employee,i in employees" :key="i">
                <tr id="trl1" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        <div v-text="employee.reference"></div>
                    </th>
                    <td class="px-6 py-4">
                        <div v-text="employee.nom"></div>
                    </td>
                    <td class="px-6 py-4">
                        <div v-text="employee.prenom"></div>
                    </td>
                    <td class="px-6 py-4">
                        <div v-text="employee.adresse"></div>
                    </td>
                    <td class="px-6 py-4">
                        <div v-text="employee.cin"></div>
                    </td>
                    <td class="px-6 py-4">
                        <div v-text="employee.salaire"></div>
                    </td>
                    <td class="px-6 py-4">
                        <div v-text="employee.type_salaire"></div>
                    </td>
                    <td class="px-6 py-4">
                        <div v-text="employee.permisDate"></div>
                    </td>
                    <td class="px-6 py-4">
                        <div v-text="employee.libelleFonction"></div>
                    </td>
                   
                    <td class="px-6 py-4 text-right">
                        <router-link :to="{name: 'employees.edit', params:{id: employee.id}}" id="rlinkEdit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editer</router-link>
                        <button  @click="destroyEmployee(employee.id,i)" id="btnSupp" class="font-medium text-red-600 dark:text-black-500 hover:underline">Supprimer</button>
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
            employees: []
        };
    },
    methods: {
      async  getEmployee() {

            let response = await axios.get('employees/all');
            if (response.data.status == 1)
                this.employees = response.data.data
        },
        async destroyEmployee(id,pos){
             if (!window.confirm( 'Supprimer cet employee ?')) return;

            await axios.delete('/employees/delete/' + id);
            
            this.employees.splice(pos,1)
            //pos c'est l'index du ligne sur le tableau d'affichage(html) et le 1 est pour combien de fois se trouve cet employée
        },
       


    },
    mounted(){
        this.getEmployee()
                    

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