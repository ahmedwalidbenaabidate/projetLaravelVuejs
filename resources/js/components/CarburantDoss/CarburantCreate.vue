<template>
<menu__2 />
<form class="space-y-6" @submit.prevent="storeCarburant">
    <div>
        <label for="marqueM" class="block">MARQUE MATÉRIEL</label>
        <select name="marqueM" class="inp1" id="marqueM" v-model="form1.id_materiel" required>
            <option v-for="c in Materiels" :value="c.id" :key="c.id">{{c.marqueM}}</option>
        </select>
    </div>
    <div>
        <label for="quantiteC" class="block">QUANTITÉ DE CARBURANT<b id="L1"> (Litre)</b></label>
        <input type="number" min="0" step="any" class="inp1" id="quantiteC" v-model="form1.quantiteC" maxlength="6" required>
    </div>
    <div>
        <label for="typeC" class="block">TYPE CARBURANT</label>
        <select name="typeC" class="inp1" id="typeC" v-model="form1.typeC" required>
            <option value="">Choisir le type</option>
            <option value="Essence">Essence</option>
            <option value="Diesel">Diesel</option>
        </select>
    </div>
     <div>
        <label for="dateC" class="block">DATE DE REMPLISSAGE</label>
        <input type="date" class="inp1" id="dateC" v-model="form1.dateC" required>
    </div>
    <div>
        <label for="observation" class="block">OBSERVATIONS</label>
        <!-- <input type="text" class="inp1" id="observation" v-model="form1.observation" required> -->
        <textarea class="inp1" v-model="form1.observation" name="textarea1" id="txtare1" cols="30" rows="4" placeholder="Observation" required></textarea>
    </div>
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
            Materiels: [],
            
            form1: {
                id_materiel: '',
                quantiteC: '',
                typeC: '',
                dateC: '',
                observation: '',
                
            }
        };
    },

    methods: {

        async createCarburant(data) {
            await axios.post('/carburants/create', data);
        },

        async storeCarburant() {
            await this.createCarburant(this.form1);
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Remplissage a été enregistrer!!!',
                showConfirmButton: false,
                timer: 2200
            })
            this.$router.push("/carburants");
        },

        async getMateriels() {

            let response = await axios.get('/materiels/all');
            if (response.data.status == 1)
                this.Materiels = response.data.data
        },

    },

    mounted() {
        this.getMateriels()
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
    width: 270px;

}

#btnEnreg {
    background-color: aqua;
    margin-top: 10px;

}
#L1{
    color: blue;
}
</style>
