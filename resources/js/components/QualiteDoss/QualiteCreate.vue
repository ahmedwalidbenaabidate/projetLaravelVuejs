<template>
    <form class="space-y-6"  @submit.prevent="storeQualite" >
        <div>
            <label for="libelleFonction" class="block">Qualité</label>
            <input type="text" id="libelleF" v-model="form1.libelleFonction" required>
        </div>
        
        <button type="submit" id="btnEnreg" class="bg-blue-500 px-2 py-1 text-black rounded">Enregistrer</button>
    </form>
</template>

<script>


export default {

    data() {
        return {
            qualites: [],
            form1 :{
            libelleFonction: '',
        }
        };
    },


    methods: {
      
        async createQualite(data){
           let res = await axios.post('/qualites/create',data);
           if(res.data.status == 1)
            this.$router.push("/qualites");
            else
            if (!window.confirm( 'Cette qualité exist déjà !!!!')) return;
        },

        async storeQualite(){
            await this.createQualite(this.form1);
        },

    },

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