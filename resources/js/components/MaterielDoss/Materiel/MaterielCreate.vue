<template>
<form class="space-y-6" @submit.prevent="storeMateriel">
    <div>
        <label for="marqueM" class="block">MARQUE MATÉRIEL</label>
        <input type="text" class="inp1" id="marqueM" v-model="form1.marqueM"  required>
    </div>
    <div>
        <label for="modelM" class="block">MODEL MATÉRIEL</label>
        <input type="text" class="inp1" id="modelM" v-model="form1.modelM" required>
    </div>
    <div>
        <label for="etatM" class="block">ÉTAT MATÉRIEL</label>
        <select name="etatM" class="inp1" id="etatM" v-model="form1.etatM" required>
            <option value="">Choisir l'état du matériel</option>
            <option value="Ancien">Ancien</option>
            <option value="Nouveau">Nouveau</option>
        </select>
    </div>
    <div>
        <label for="date_AchatM" class="block">DATE ACHAT</label>
        <input type="date" class="inp1" id="date_AchatM" v-model="form1.date_AchatM" required>
    </div>
    <div>
        <label for="date_FonctionM" class="block">DATE FONCTIONNEMENT</label>
        <input type="date" class="inp1" id="date_FonctionM" v-model="form1.date_FonctionM" required>
    </div>
    <div>
        <label for="libelleMateriel" class="block">TYPE MATÉRIEL</label>
        <select name="libelleMateriel" class="inp1" id="libelleMateriel" v-model="form1.typeMateriel_id" required>
            <option value="">Choisir le type du matériel</option>
            <option v-for="c in typeMateriels" :value="c.id" :key="c.id">{{c.libelleMateriel}}</option>
        </select>
    </div>
    
    <button type="submit" id="btnEnreg" class="bg-blue-500 px-2 py-1 text-black rounded">Enregistrer</button>
</form>
</template>

<script>
import axios from "axios";

export default {

    data() {
        return {
            typeMateriels: [],
            
            form1: {
                marqueM: '',
                modelM: '',
                etatM: '',
                date_AchatM: '',
                date_FonctionM: '',
                typeMateriel_id: '',
                

            }
        };
    },

    methods: {

        async createMateriel(data) {
            await axios.post('/materiels/create', data);
        },

        async storeMateriel() {
            await this.createMateriel(this.form1);
            this.$router.push("/materiels");
        },

        async getTypeMateriel() {

            let response = await axios.get('/typemarteriels/all');
            if (response.data.status == 1)
                this.typeMateriels = response.data.data
        },

    },

    mounted() {
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
    width: 250px;
    margin-bottom: 10px;

}

#btnEnreg {
    background-color: aqua;
    margin-top: 10px;

}
</style>
