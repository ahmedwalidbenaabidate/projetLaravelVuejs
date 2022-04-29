<template>
    <form class="space-y-6"  @submit.prevent="saveQualite" >
        <div>
            <label for="libelleFonction" class="block">Qualité</label>
            <input type="text" id="libelleF" v-model="qualite.libelleFonction" required>
        </div>
        
        <button type="submit" id="btnEnreg" class="bg-blue-500 px-2 py-1 text-black rounded">Mettre à jour</button>
    </form>
</template>

<script>
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
            qualite: {}
        };
    },


    methods: {

        async  getQualite(id) {

            let response = await axios.get('/qualites/get/' + id);
            if (response.data.status == 1)
                this.qualite = response.data.data
        },

      
        async updateQualite(){
            let res = await axios.post('/qualites/update',this.qualite);
            if(res.data.status == 1)
            this.$router.push("/qualites");
            else
            if (!window.confirm( 'Cette qualité exist déjà !!!!')) return;
        },

        async saveQualite(){
            await this.updateQualite();
            this.$router.push("/qualites");
        },

    },
    mounted(){
        this.getQualite(this.$route.params.id)
    }


}

</script>

<style>
form{
    text-align: center;
    
    
}

#libelleF{
    border-radius: 10px;
}
#btnEnreg{
    background-color: aqua;
    margin-top: 10px;
    
}

</style>