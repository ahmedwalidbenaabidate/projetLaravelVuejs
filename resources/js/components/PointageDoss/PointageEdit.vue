<template>
<div class="flex flex-col" >
    <div class="DivRecherche">
        <input type="date" v-model="$datePP" class="inp1" name="datePointage" id="dateP">
        <button id="btnRech" @click="getEmployeeParDate($datePP)" class="font-medium text-black-600 dark:text-black-500 hover:underline">Recherche</button>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Id Employee
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nom
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Prenom
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Qualité
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Présence
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Heurs Supplémentaire
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Remarque
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date
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
                            {{employee.id_employee}}
                        </th>
                        <td class="px-6 py-4">
                            {{employee.nom}}<!-- {{chantier.libelle}} -->
                        </td>
                        <td class="px-6 py-4">
                            {{employee.prenom}}
                        </td>
                        <td class="px-6 py-4">
                            {{employee.libelleFonction}}
                        </td>
                        <td class="px-6 py-4">
                            <select class="inp1" v-model="employee.presence">
                                <option value="0">ABSENT</option>
                                <option value="1">PRÉSENT</option>
                                <option value="0.5">DEMI JOURNÉE</option>
                                <option value="1.5">UN JOUR ET DEMI</option>
                            </select>
                        </td>
                        <td class="px-6 py-4">
                            <!-- <input type="number" v-model="list_create_pointage[i].heurs_suppl" min="0" class="inp1"> -->
                            <input type="number" v-model="employee.heurs_suppl" min="0" class="inp1">
                        </td>
                        <td class="px-6 py-4">
                            <textarea class="inp1" v-model="employee.remarque" name="textarea1" id="txtare1" cols="30" rows="4" placeholder="Remarque"></textarea>
                        </td>
                        <td class="px-6 py-4">
                            <!-- <input type="date" class="inp1" v-model="list_create_pointage[i].date_pointage"> -->
                            <label for="dateP">{{employee.date_pointage}}</label>
                        </td>

                        <td class="px-6 py-4 text-right">
                            <!-- <button id="btnEnr" @click="create_pointage(i)" class="font-medium text-black-600 dark:text-black-500 hover:underline">Enregistrer</button>  -->
                            <button id="btnEnr" @click="savePointage(i)" class="font-medium text-black-600 dark:text-black-500 hover:underline">Modifier</button>
                            <button id="btnSupp" @click="destroyPointage(employee.id,i)" class="font-medium text-black-600 dark:text-black-500 hover:underline">Supprimer</button>
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
            employees: [],
        };
    },
    methods: {
        async getEmployee() {

            let response = await axios.get('/pointages/all');
            if (response.data.status == 1) {
                this.employees = response.data.data
            }
        },

        async getEmployeeParDate($date_pointage) {
            if($date_pointage){
            let response = await axios.get('/pointages/allAbsDate/' + $date_pointage);
            if (response.data.status == 1) {
                this.employees = response.data.data
            }
            }else
            alert("Veuillez choisir une date");
        },

        async savePointage(i) {
            console.log(this.employees[i].remarque)
            if (this.employees[i].presence === '' || this.employees[i].heurs_suppl === '' || this.employees[i].remarque == '') {
                alert("Veuillez remplir les champs vide");

            } else {
                await axios.post('/pointages/update', this.employees[i]);
                alert("Modification à été bien fait");
            }
        },

        async destroyPointage(id,pos){
             if (!window.confirm( 'Voulez vous supprimer ce pointage ?')) return;

            await axios.delete('/pointages/delete/' + id);
            
            this.employees.splice(pos,1)
            //pos c'est l'index du ligne sur le tableau d'affichage(html) et le 1 est pour combien de fois se trouve cet employée
        },

    },
    mounted() {
        this.getEmployee()
    }

}
</script>

<style scoped>
#btnEnr {
    background-color: lime;
    color: black;
    border-radius: 8px;
    font-size: 18px;
    width: 85px;
    margin-bottom: 20px;
    margin-left: 10px;
}

#btnSupp {
    background-color: red;
    color: black;
    border-radius: 8px;
    font-size: 18px;
}

#btnRech {
    background-color: aqua;
    margin-left: 40px;
}

.inp1 {
    border-radius: 10px;

}

.DivRecherche {
    margin-left: 30%;
    margin-bottom: 50px;
}
</style>
