<template>
<div class="flex flex-col" v-if="list_create_pointage.length">
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
                    <!-- <th scope="col" class="px-6 py-3">
                        Date
                    </th> -->
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <template v-for="employee,i in employees" :key="i">
                    <tr id="trl1" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            {{employee.id}}
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
                            <select class="inp1" v-model="list_create_pointage[i].presence">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="0.5">0.5</option>
                                <option value="1.5">1.5</option>
                            </select>
                        </td>
                        <td class="px-6 py-4">
                            <input type="number" v-model="list_create_pointage[i].heurs_suppl" min="0" class="inp1">
                        </td>
                        <td class="px-6 py-4">
                            <textarea class="inp1" v-model="list_create_pointage[i].remarque" name="textarea1" id="txtare1" cols="30" rows="4" placeholder="Remarque"></textarea>
                        </td>
                        <!-- <td class="px-6 py-4">
                            <input type="date" class="inp1" v-model="list_create_pointage[i].date_pointage">
                        </td> -->

                        <td class="px-6 py-4 text-right">

                            <button id="btnEnr" @click="create_pointage(i)" class="font-medium text-black-600 dark:text-black-500 hover:underline">Enregistrer</button>
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
            list_create_pointage: [],
            Object_pointage: {
                //date_pointage: '',
                id_employee: -1,
                presence: '',
                remarque: '',
                heurs_suppl: '0',

            }
        };
    },
    methods: {
        async getEmployee() {

            let response = await axios.get('/pointages/allAbs');
            if (response.data.status == 1) {
                this.employees = response.data.data
                let i = 0;
                for (i = 0; i < this.employees.length; i++) {
                    let item__ = Object.assign({}, this.Object_pointage)
                    item__.id_employee = this.employees[i].id;
                    this.list_create_pointage.push(item__)
                }

            }
        },
        async createpointData(data) {
            await axios.post('/pointages/create', data);
            this.$router.push("/pointages");
        },

        async create_pointage(i) {
            await this.createpointData(this.list_create_pointage[i]);
            this.list_create_pointage.splice(i,1);
            this.employees.splice(i,1);
            // this.$router.push("/pointages");
            //console.log(this.list_create_pointage[i])
        }
    },
    mounted() {
        this.getEmployee()
    }

}
</script>

<style>
#btnEnr {
    background-color: aqua;
}

.inp1 {
    border-radius: 10px;

}
</style>
