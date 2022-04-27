<template>
    <form class="space-y-6"  @submit.prevent="storeChantier" >
        <div>
            <label for="code" class="block">Code chantier </label>
            <input type="text" id="code" v-model="form1.code" required>
        </div>
        <div>
            <label for="libelle" class="block">Libelle chantier</label>
            <input type="text" id="libelle" v-model="form1.libelle" required>
        </div>
        <div>
            <label for="abreviation" class="block">Abreviation</label>
            <input type="text" id="abreviation" v-model="form1.abreviation" required>
        </div>
        <button type="submit" id="btnEnreg" class="bg-blue-500 px-2 py-1 text-black rounded">Enregistrer</button>
    </form>
</template>

<script>
import { reactive } from 'vue'
import router from "../router/index.js";

export default {

    data() {
        return {
            chantiers: [],
            form1 :{
            code: '',
            libelle: '',
            abreviation: '',
        }
        };
    },


    methods: {
      
        async createChantier(data){
            await axios.post('/chantiers/create',data);
        },

        async storeChantier(){
            await this.createChantier(this.form1);
            this.$router.push("/dashboard");
        },

    },

}

</script>

<style>
form{
    text-align: center;
    
    
}

#code ,#libelle, #abreviation{
    border-radius: 10px;
}
#btnEnreg{
    background-color: aqua;
    margin-top: 10px;
    
}

</style>