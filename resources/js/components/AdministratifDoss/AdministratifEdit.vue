<template>
<menu__2 />
<form class="space-y-6" @submit.prevent="saveAdministratifs">
    
    <div>
        <label for="description" class="block">Déscription</label>
        <textarea class="inp1" v-model="administratif.descriptionA" name="textarea1" id="txtare1" cols="30" rows="4" placeholder="Remarque" required></textarea>
    </div>

    <div>
        <label for="marqueM" class="block">Matériels</label>
        <select name="marqueM" class="inp1" id="marqueM" v-model="administratif.id_materiel" required>
            <option v-for="c in Materiels" :value="c.id" :key="c.id">{{c.marqueM}}</option>
        </select>
    </div>

    <div>
        <label for="documentA" class="block">Procès verbal</label>
        <input type="file" class="doc_1" name="documentA" id="documentA" ref="documentA" >
    </div>

    <button type="submit" id="btnEnreg" class="custom-btn btn-1Employee"><i id="iAddEmpl" class="bx bx-save icon_table"></i>Mettre à jour</button>
</form>
</template>

<script>
import menu__2 from "../menu/menu.vue";
export default {
    components: {
        menu__2
    },
    data() {
        return {
            
            Materiels : [],
            administratif: {},
        };
    },

    methods: {

        async getAdministratif(id) {

            let response = await axios.get('/administratifs/get/' + id);
            if (response.data.status == 1)
                this.administratif = response.data.data

        },

        async getMateriel() {

            let response = await axios.get('/materiels/all');
            if (response.data.status == 1)
                this.Materiels = response.data.data
        },

        async saveAdministratifs() {

            let formData = new FormData();
            const file = this.$refs.documentA.files[0];
            formData.append("documentA", file);
            formData.append("id", this.administratif.id);
            formData.append("descriptionA", this.administratif.descriptionA);
            formData.append("id_materiel", this.administratif.id_materiel);
            let res = await axios.post('/administratifs/update', formData);
            if (res.data.status == 1)
            this.administratif.documentA = res.data.image
                 alert("Modification à été bien fait");
                this.$router.push("/administratifs");
            //     else
            // alert("Cet type exist déjà !!!!");
            // // if (!window.confirm('Cet type exist déjà !!!!')) return;
        },

    },

    mounted(){
        this.getMateriel();
        this.getAdministratif(this.$route.params.id);
        
    },

}
</script>

<style>
form {
    text-align: center;

}
#dateA{
    border-radius: 10px;
    width: 250px;
}

#libelleM {
    border-radius: 10px;
    margin-bottom: 10px;
    margin-top: 10px;
}

#documentA {
    margin-left: 110px;
    margin-top: 10px;
    border-radius: 4px;
}

#btnEnreg {
    background-color: aqua;
    margin-top: 10px;

}
</style>
