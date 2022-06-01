<template>
<menu__2 />
<form class="space-y-6" @submit.prevent="saveAffectationM">
    <div>
        <label for="nomEmploye" class="block">Employées</label>
        <select name="nomEmploye" class="inp1" id="nomEmploye" v-model="affectationM.id_employee" required>
            <option v-for="c in Employees" :value="c.id" :key="c.id">{{c.nom}} {{c.prenom}}</option>
        </select>
    </div>
    <div>
        <label for="marqueM" class="block">Matériels</label>
        <select name="marqueM" class="inp1" id="marqueM" v-model="affectationM.id_materiel" required>
            <option v-for="c in Materiels" :value="c.id" :key="c.id">{{c.marqueM}}</option>
        </select>
    </div>
    <div>
        <label for="date_debut" class="block">Date début</label>
        <input type="date" class="inp1" id="date_debut" v-model="affectationM.date_debut" required>
    </div>
    <div>
        <label for="date_fin" class="block">Date fin</label>
        <input type="date" class="inp1" id="date_fin" v-model="affectationM.date_fin" required>
    </div> 
    <!-- <div>
        <label for="statut" class="block">Statut</label>
        <select name="statut" class="inp1" id="statut" v-model="form1.statut" required>
            <option value="">Choisir le statut</option>
            <option value="disponible">Disponible</option>
            <option value="non-disponible">Non-disponible</option>
        </select>
    </div> -->
   
    <button type="submit" id="btnEnreg" class="custom-btn btn-1Employee"><i id="iAddEmpl" class="bx bx-save icon_table"></i>Mettre à jour</button>
</form>
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
            Employees: [],
            Materiels: [],

            affectationM: {},
        };
    },

    methods: {

       async  getAffectationM(id) {

            let response = await axios.get('/affectationMateriels/get/' + id);
            if (response.data.status == 1)
                this.affectationM = response.data.data
        },

      
        async updateAffectationM(){
            await axios.post('/affectationMateriels/update',this.affectationM);
        },

        async saveAffectationM(){
            await this.updateAffectationM();
            this.$router.push("/affectationMateriels");
            alert("Le pointage matériel à été fait avec succes");
        },

        async getEmployees() {

            let response = await axios.get('/employees/all');
            if (response.data.status == 1)
                this.Employees = response.data.data
        },

        async getMateriel() {

            let response = await axios.get('/materiels/all');
            if (response.data.status == 1)
                this.Materiels = response.data.data
        },

    },

    mounted() {
        this.getAffectationM(this.$route.params.id);
        this.getEmployees();
        this.getMateriel();
    }
}
</script>

<style>
form {
    text-align: center;

}

#code,
#libelle,
#abreviation {
    border-radius: 10px;
}

.inp1 {
    border-radius: 10px;

}

#btnEnreg {
    background-color: aqua;
    margin-top: 10px;

}
</style>
