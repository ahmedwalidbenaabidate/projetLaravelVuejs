<template>
<menu__2 />
<form class="space-y-6" @submit.prevent="saveCarburant">
    <div>
        <label for="marqueM" class="block">MARQUE MATÉRIEL</label>
        <select name="marqueM" class="inp1" id="marqueM" v-model="carburant.id_materiel" required>
            <option v-for="c in Materiels" :value="c.id" :key="c.id">{{c.marqueM}}</option>
        </select>
    </div>
    <div>
        <label for="quantiteC" class="block">QUANTITÉ DE CARBURANT<b id="L1"> (Litre)</b></label>
        <input type="number" step="any" class="inp1" id="quantiteC" v-model="carburant.quantiteC" maxlength="6" required>
    </div>
    <div>
        <label for="typeC" class="block">TYPE CARBURANT</label>
        <select name="typeC" class="inp1" id="typeC" v-model="carburant.typeC" required>
            <option value="">Choisir le type</option>
            <option value="Essence">Essence</option>
            <option value="Diesel">Diesel</option>
        </select>
    </div>
     <div>
        <label for="dateC" class="block">DATE DE REMPLISSAGE</label>
        <input type="date" class="inp1" id="dateC" v-model="carburant.dateC" required>
    </div>
    <div>
        <label for="observation" class="block">OBSERVATIONS</label>
        <!-- <input type="text" class="inp1" id="observation" v-model="form1.observation" required> -->
        <textarea class="inp1" v-model="carburant.observation" name="textarea1" id="txtare1" cols="30" rows="4" placeholder="Observation" required></textarea>
    </div>
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
            Materiels: [],
            
            carburant: {},
        };
    },

    methods: {

         async  getCarburant(id) {

            let response = await axios.get('/carburants/get/' + id);
            if (response.data.status == 1)
                this.carburant = response.data.data
        },
         
         async updateCarburant(){
            await axios.post('/carburants/update',this.carburant);
        },

        async saveCarburant(){
            await this.updateCarburant();
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
        this.getCarburant(this.$route.params.id)
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
