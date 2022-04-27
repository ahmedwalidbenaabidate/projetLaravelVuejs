<template>
    <form class="space-y-6"  @submit.prevent="saveChantier" >
        <div>
            <label for="code" class="block">Code chantier </label>
            <input type="text" id="code" v-model="chantier.code" required>
        </div>
        <div>
            <label for="libelle" class="block">Libelle chantier</label>
            <input type="text" id="libelle" v-model="chantier.libelle" required>
        </div>
        <div>
            <label for="abreviation" class="block">Abreviation</label>
            <input type="text" id="abreviation" v-model="chantier.abreviation" required>
        </div>
        <button type="submit" id="btnEnreg" class="bg-blue-500 px-2 py-1 text-black rounded">Mettre à jour</button>
    </form>
</template>

<script>
import { reactive } from 'vue'
import router from "../router/index.js";
import axios from "axios";

export default {

     props: {
        id: {
            required: true,
            type: String
        }
    },


    data() {
        return {
            chantier: {}
        };
    },


    methods: {

        async  getChantier(id) {

            let response = await axios.get('/chantiers/get/' + id);
            if (response.data.status == 1)
                this.chantier = response.data.data
        },

      
        async updateChantier(){
            await axios.post('/chantiers/update',this.chantier);
        },

        async saveChantier(){
            await this.updateChantier();
            this.$router.push("/dashboard");
        },

    },
    mounted(){
        this.getChantier(this.$route.params.id)
    }


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