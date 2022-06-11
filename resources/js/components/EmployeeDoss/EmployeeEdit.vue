<template>
<menu__2 />
<form class="space-y-6" @submit.prevent="saveEmployee">
    <div>
        <label for="reference" class="block">Référence</label>
        <input type="text" class="inp1" id="reference" v-model="employee.reference" maxlength="6" required>
    </div>
    <div>
        <label for="nom" class="block">Nom</label>
        <input type="text" class="inp1" id="nom" v-model="employee.nom" required>
    </div>
    <div>
        <label for="prenom" class="block">Prenom</label>
        <input type="text" class="inp1" id="prenom" v-model="employee.prenom" required>
    </div>
    <div>
        <label for="adresse" class="block">Adresse</label>
        <input type="text" class="inp1" id="adresse" v-model="employee.adresse" required>
    </div>
    <div>
        <label for="cin" class="block">CIN</label>
        <input type="text" class="inp1" id="cin" v-model="employee.cin" required>
    </div>
    <div>
        <label for="salaire" class="block">Salaire</label>
        <input type="number" min="0" step="any" class="inp1" id="salaire" v-model="employee.salaire" required>
    </div>
    <div>
        <label for="type_salaire" class="block">Type salaire</label>
        <!-- <input type="text" class="inp1" id="type_salaire" v-model="employee.type_salaire" required> -->
        <select name="type_salaire" class="inp1" id="type_salaire" v-model="employee.type_salaire" required>
            <option value="">Choisir le type</option>
            <option value="Journalier">Journalier</option>
            <option value="Mensuel">Mensuel</option>
        </select>
    </div>
    <div>
        <label for="type_salaire" class="block">Qualite</label>
        <!-- <input type="text" class="inp1" id="type_salaire" v-model="form1.type_salaire" required> -->
        <select name="type_salaire" class="inp1" id="type_salaire" v-model="employee.qualite_id" required>
            <option v-for="c in Qualites" :value="c.id" :key="c.id">{{c.libelleFonction}}</option>
        </select>
    </div>
    <div>
        <label for="permisDate" class="block">Date du permis</label>
        <input type="date" class="inp1" id="permisDate" v-model="employee.permisDate" >
    </div>
    <!-- <div>
            <label for="qualite_id" class="block">Id du qualité</label>
            <input type="text" id="qualite_id" class="inp1" v-model="employee.qualite_id" disabled required>

        </div> -->
    <button type="submit" id="btnEnreg" class="custom-btn btn-1Employee"><i id="iAddEmpl" class="bx bx-save icon_table"></i>Mettre à jour</button>
</form>
</template>

<script>
import axios from "axios";
import menu__2 from "../menu/menu.vue";
import Swal from 'sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css';

export default {
    components: {
        menu__2
    },

    props: {
        id: {
            required: true,
            type: String
        }
    },

    data() {
        return {
            Qualites: [],
            employee: {}
        };
    },

    methods: {

        async getEmployee(id) {

            let response = await axios.get('/employees/get/' + id);
            if (response.data.status == 1)
                this.employee = response.data.data
        },

        async updateEmployee() {
            await axios.post('/employees/update', this.employee);
        },

        async saveEmployee() {
            await this.updateEmployee();
            this.$router.push("/employees");

            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Modification réussie',
                showConfirmButton: false,
                timer: 2200
            })
        },

        async getQualites() {

            let response = await axios.get('/qualites/all');
            if (response.data.status == 1)
                this.Qualites = response.data.data
        },

    },
    mounted() {
        this.getEmployee(this.$route.params.id),
            this.getQualites()
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
