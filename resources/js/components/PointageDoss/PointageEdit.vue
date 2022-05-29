<template>
<menu__2 />
<div class="flex flex-col">
    <div class="DivRecherche">
        <button @click="export_()" class="custom-btn btn-2" id="btn2Impr" value="export"><i id="iImpri" class='bx bx-printer'></i><i>Imprimer</i> </button>
        <!-- <input type="button" @click="export_()" class="custom-btn btn-2" value="export"  name="" id="imprimer"> -->
        <!-- <i class='bx bx-printer'></i> -->
        <input type="date" v-model="$datePP" style="background-color:rgb(214, 205, 228);" class="inp1" name="datePointage" id="dateP">
        <button id="btnRech" @click="getEmployeeParDate($datePP)" class="custom-btn btn-1"><i id="iRech" class='bx bx-search-alt'></i><i>Recherche</i></button>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">

        <table  class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
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
                            <button id="rlinkEdit" @click="savePointage(i)" class="font-medium text-black-600 dark:text-black-500 hover:underline"><i class="bx bx-edit icon_table"></i>Modifier</button>
                            <button id="btnSupp" @click="destroyPointage(employee.id,i)" class="font-medium text-black-600 dark:text-black-500 hover:underline"><i class="bx bx-trash icon_table"></i>Supprimer</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>

        <!-- ------------------------------- -->
         <table v-show="false" id="table_export" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
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
                        Qualite
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Presence
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
                </tr>
            </thead>
            <tbody>
                <template v-for="employee,i in employees" :key="i">
                    <tr id="trl1" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            {{employee.id_employee}}
                        </th>
                        <td class="px-6 py-4">
                            {{employee.nom}}
                        </td>
                        <td class="px-6 py-4">
                            {{employee.prenom}}
                        </td>
                        <td class="px-6 py-4">
                            {{employee.libelleFonction}}
                        </td>
                        <td class="px-6 py-4">
                                <label v-if="employee.presence=='0'" >ABSENT</label >
                                <label v-else-if="employee.presence=='1'">PRESENT</label >
                                <label v-else-if="employee.presence=='0.5'">DEMI JOURNEE</label >
                                <label v-else-if="employee.presence=='1.5'" >UN JOUR ET DEMI</label >
                           {{employee.presence}}
                        </td>
                        <td class="px-6 py-4">
                            {{employee.heurs_suppl}}
                        </td>
                        <td class="px-6 py-4">
                            {{employee.remarque}}
                        </td>
                        <td class="px-6 py-4">
                            <label for="dateP">{{employee.date_pointage}}</label>
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
import menu__2 from "../menu/menu.vue";

export default {
    components: {
        menu__2
    },
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
            if ($date_pointage) {
                let response = await axios.get('/pointages/allAbsDate/' + $date_pointage);
                if (response.data.status == 1) {
                    this.employees = response.data.data
                }
            } else
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

        async destroyPointage(id, pos) {
            if (!window.confirm('Voulez vous supprimer ce pointage ?')) return;

            await axios.delete('/pointages/delete/' + id);

            this.employees.splice(pos, 1)
            //pos c'est l'index du ligne sur le tableau d'affichage(html) et le 1 est pour combien de fois se trouve cet employée
        },
        export_() {
            alert("ok");
            this.exportTableToExcel("table_export","test")
           
        },
        exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
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
