<template>
<form class="space-y-6" @submit.prevent="storeAffectationM">
    <div>
        <label for="nomEmploye" class="block">Employées</label>
        <select name="nomEmploye" class="inp1" id="nomEmploye" v-model="form1.id_employee" required>
            <option v-for="c in Employees" :value="c.id" :key="c.id">{{c.nom}} {{c.prenom}}</option>
        </select>
    </div>
    <div>
        <label for="nomEmploye" class="block">Matériels</label>
        <select name="marqueM" class="inp1" id="marqueM" v-model="form1.id_materiel" required>
            <option v-for="c in Materiels" :value="c.id" :key="c.id">{{c.marqueM}}</option>
        </select>
    </div>
    <div>
        <label for="date_debut" class="block">Date début</label>
        <input type="date" class="inp1" id="date_debut" v-model="form1.date_debut" required>
    </div>
    <div>
        <label for="date_fin" class="block">Date fin</label>
        <input type="date" class="inp1" id="date_fin" v-model="form1.date_fin" required>
    </div> 
    <!-- <div>
        <label for="statut" class="block">Statut</label>
        <select name="statut" class="inp1" id="statut" v-model="form1.statut" required>
            <option value="">Choisir le statut</option>
            <option value="disponible">Disponible</option>
            <option value="non-disponible">Non-disponible</option>
        </select>
    </div> -->
   
    <button type="submit" id="btnEnreg" class="bg-blue-500 px-2 py-1 text-black rounded">Enregistrer</button>
</form>
</template>

<script>
import axios from "axios";

export default {

    data() {
        return {
            Employees: [],
            Materiels: [],

            form1: {
                id_employee: '',
                id_materiel: '',
                date_debut: '',
                date_fin: '',
                statut: '',
            }
        };
    },

    methods: {

        async createAffectationM(data) {
            await axios.post('/affectationMateriels/create', data);
        },

        async storeAffectationM() {
            await this.createAffectationM(this.form1);
            this.$router.push("/affectationMateriels");
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
