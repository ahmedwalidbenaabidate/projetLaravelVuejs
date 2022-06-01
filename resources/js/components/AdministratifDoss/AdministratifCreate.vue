<template>
<menu__2 />
<form class="space-y-6" @submit.prevent="storeAdministratifs">
    
    <div>
        <label for="description" class="block">Déscription</label>
        <textarea class="inp1" v-model="form1.descriptionA" name="textarea1" id="txtare1" cols="30" rows="4" placeholder="Remarque" required></textarea>
    </div>

    <div>
        <label for="marqueM" class="block">Matériels</label>
        <select name="marqueM" class="inp1" id="marqueM" v-model="form1.id_materiel" required>
            <option v-for="c in Materiels" :value="c.id" :key="c.id">{{c.marqueM}}</option>
        </select>
    </div>

    <div>
        <label for="documentA" class="block">Procès verbal</label>
        <input type="file" class="doc_1" name="documentA" id="documentA" ref="documentA" >
    </div>

    <button type="submit" id="btnEnreg" class="custom-btn btn-1Employee"><i id="iAddEmpl" class="bx bx-save icon_table"></i>Enregistrer</button>
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
            form1: {
                descriptionA:'',
                id_materiel:'',
                documentA:'',
            }
        };
    },

    methods: {

        // async createTypeMateriel(data, file_photo) {
        //     //  let res = await axios.post('/typemarteriels/create', data );
        //     let res = await axios.post('/typemarteriels/create', file_photo);
        //     if (res.data.status == 1)
        //         this.$router.push("/typemarteriels");
        //     else
        //     if (!window.confirm('Cet type exist déjà !!!!')) return;
        // },

        

        async getMateriel() {

            let response = await axios.get('/materiels/all');
            if (response.data.status == 1)
                this.Materiels = response.data.data
        },

        async storeAdministratifs() {

            let formData = new FormData();
            const file = this.$refs.documentA.files[0];
            formData.append("documentA", file);
            formData.append("descriptionA", this.form1.descriptionA);
            formData.append("id_materiel", this.form1.id_materiel);
            let res = await axios.post('/administratifs/create', formData);
            if (res.data.status == 1)
                this.$router.push("/administratifs");
            //     else
            // alert("Cet type exist déjà !!!!");
            // // if (!window.confirm('Cet type exist déjà !!!!')) return;
        },

    },

    mounted(){
        this.getMateriel();
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
    color: darkgray;
}

#btnEnreg {
    background-color: aqua;
    margin-top: 30px !important;
    margin-bottom: 40px !important;

}
</style>
