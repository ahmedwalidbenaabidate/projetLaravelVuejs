<template>
<menu__2 />
<form class="space-y-6" @submit.prevent="storeEmployee">
    <div>
        <label for="reference" class="block">Référence</label>
        <input type="text" class="inp1" id="reference" v-model="form1.reference" maxlength="6" required>
    </div>
    <div>
        <label for="nom" class="block">Nom</label>
        <input type="text" class="inp1" id="nom" v-model="form1.nom" required>
    </div>
    <div>
        <label for="prenom" class="block">Prenom</label>
        <input type="text" class="inp1" id="prenom" v-model="form1.prenom" required>
    </div>
    <div>
        <label for="adresse" class="block">Adresse</label>
        <input type="text" class="inp1" id="adresse" v-model="form1.adresse" required>
    </div>
    <div>
        <label for="cin" class="block">CIN</label>
        <input type="text" class="inp1" id="cin" v-model="form1.cin" required>
    </div>
    <div>
        <label for="salaire" class="block">Salaire</label>
        <input type="number" step="any" class="inp1" id="salaire" v-model="form1.salaire" required>
    </div>
    <div>
        <label for="type_salaire" class="block">Type salaire</label>
        <!-- <input type="text" class="inp1" id="type_salaire" v-model="form1.type_salaire" required> -->
        <select name="type_salaire" class="inp1" id="type_salaire" v-model="form1.type_salaire" required>
            <option value="">Choisir le type</option>
            <option value="Journalier">Journalier</option>
            <option value="Mensuel">Mensuel</option>
        </select>
    </div>
    <div>
        <label for="type_salaire" class="block">Qualite</label>
        <!-- <input type="text" class="inp1" id="type_salaire" v-model="form1.type_salaire" required> -->
        <select name="type_salaire" class="inp1" id="type_salaire" v-model="form1.qualite_id" required>
            <option v-for="c in Qualites" :value="c.id" :key="c.id">{{c.libelleFonction}}</option>
        </select>
    </div>
    <div>
        <label for="permisDate" class="block">        <input type="checkbox" v-model="SansPermis" id=""> 
Date du permis</label>

        <div>
            <input type="date" class="inp1" id="permisDate" :disabled="!SansPermis" v-model="form1.permisDate">
        </div>

    </div>
    <!-- <div>
            <label for="qualite_id" class="block">Id du qualité</label>
            <input type="text" id="qualite_id" class="inp1" v-model="form1.qualite_id" required>

        </div> -->
    <button type="submit" id="btnEnreg" class="custom-btn btn-1Employee"><i id="iAddEmpl" class="bx bx-save icon_table"></i>Enregistrer</button>
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

    data() {
        return {
            SansPermis: true,
            Qualites: [],

            form1: {
                reference: '',
                nom: '',
                prenom: '',
                adresse: '',
                cin: '',
                salaire: '',
                type_salaire: '',
                permisDate: '',
                qualite_id: '',

            }
        };
    },
    watch: {
        SansPermis(value) {
           if(!value)
             this.form1.permisDate= ''
        }
    },

    methods: {

        async createEmployee(data) {
            await axios.post('/employees/create', data);
        },

        async storeEmployee() {
            await this.createEmployee(this.form1);
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Employé a été enregistrer!!!',
                showConfirmButton: false,
                timer: 2200
            })
            this.$router.push("/employees");
        },

        async getQualites() {

            let response = await axios.get('/qualites/all');
            if (response.data.status == 1)
                this.Qualites = response.data.data
        },

    },

    mounted() {
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
    height: 50px !important;

}

.space-y-6 {
    border: 2px;
    border-color: black;
    background-color: #1c0c30;
    border-radius: 10px;
    width: 50%;
    margin-left: auto;
    margin-right: auto;
    text-align: center !important;
    display: block !important;
    padding-bottom: 10px;
    padding-top: 10px;
    font-family: "fantasy" !important;
    color: rgb(31, 26, 59);
}

.block {
    color: rgb(255, 255, 255);
    font-family: cursive;
    padding-bottom: 10px;
}
</style>
