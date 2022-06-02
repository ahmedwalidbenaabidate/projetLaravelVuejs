<template>
<menu__2 />

<form class="space-y-6" @submit.prevent="saveMateriel">
    <div>
        <label for="marqueM" class="block">MARQUE MATÉRIEL</label>
        <input type="text" class="inp1" id="marqueM" v-model="materiel.marqueM" required>
    </div>
    <div>
        <label for="modelM" class="block">MODEL MATÉRIEL</label>
        <input type="text" class="inp1" id="modelM" v-model="materiel.modelM" required>
    </div>
    <div>
        <label for="etatM" class="block">ÉTAT MATÉRIEL</label>
        <select name="etatM" class="inp1" id="etatM" v-model="materiel.etatM" required>
            <option value="">Choisir l'état du matériel</option>
            <option value="Ancien">Ancien</option>
            <option value="Nouveau">Nouveau</option>
        </select>
    </div>
    <div>
        <label for="date_AchatM" class="block">DATE ACHAT</label>
        <input type="date" class="inp1" id="date_AchatM" v-model="materiel.date_AchatM" required>
    </div>
    <div>
        <label for="date_FonctionM" class="block">DATE FONCTIONNEMENT</label>
        <input type="date" class="inp1" id="date_FonctionM" v-model="materiel.date_FonctionM" required>
    </div>
    <div>
        <label for="libelleMateriel" class="block">TYPE MATÉRIEL</label>
        <select name="libelleMateriel" class="inp1" id="libelleMateriel" v-model="materiel.typeMateriel_id" required>
            <option value="">Choisir le type du matériel</option>
            <option v-for="c in typeMateriels" :value="c.id" :key="c.id">{{c.libelleMateriel}}</option>
        </select>
    </div>

    <button type="submit" id="btnEnreg" class="custom-btn btn-1Employee"><i id="iAddEmpl" class="bx bx-save icon_table"></i>Mettre à jour</button>
</form>
</template>

<script>
import axios from "axios";
import menu__2 from "../../menu/menu.vue";
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
            typeMateriels: [],
            materiel: {}
        };
    },

    methods: {

        async getMateriel(id) {

            let response = await axios.get('/materiels/get/' + id);
            if (response.data.status == 1)
                this.materiel = response.data.data
        },

        async updateMateriel() {
            await axios.post('/materiels/update', this.materiel);
        },

        async saveMateriel() {
            await this.updateMateriel();
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Modification réussie',
                showConfirmButton: false,
                timer: 2200
            })
            this.$router.push("/materiels");
        },

        async getTypeMateriel() {

            let response = await axios.get('/typemarteriels/all');
            if (response.data.status == 1)
                this.typeMateriels = response.data.data
        },

    },
    mounted() {
        this.getMateriel(this.$route.params.id),
            this.getTypeMateriel()
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
