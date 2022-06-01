<template>
<menu__2 />
<form class="space-y-6" @submit.prevent="saveAccident">
    
    <div>
        <label for="description" class="block">Déscription</label>
        <textarea class="inp1" v-model="accident.description" name="textarea1" id="txtare1" cols="30" rows="4" placeholder="Remarque" required></textarea>
    </div>
    <div>
        <label for="nomEmploye" class="block">Employées</label>
        <!-- <input type="text" class="inp1" id="type_salaire" v-model="form1.type_salaire" required> -->
        <select name="nomEmploye" class="inp1" id="nomEmploye" v-model="accident.id_employee" required>
            <option v-for="c in Employees" :value="c.id" :key="c.id">{{c.nom}} {{c.prenom}}</option>
        </select>
    </div>

    <div>
        <label for="dateA" class="block">Date d'accident</label>
        <input type="date" id="dateA" v-model="accident.dateA" required>
    </div>

    <div>
        <label for="nomEmploye" class="block">Matériels</label>
        <!-- <input type="text" class="inp1" id="type_salaire" v-model="form1.type_salaire" required> -->
        <select name="marqueM" class="inp1" id="marqueM" v-model="accident.id_materiel" required>
            <option v-for="c in Materiels" :value="c.id" :key="c.id">{{c.marqueM}}</option>
        </select>
    </div>

    <div>
        <label for="proceV" class="block">Procès verbal</label>
        <input type="file" name="proceV" id="proceV" ref="proceV" >
    </div>

    <button type="submit" id="btnEnreg" class="bg-blue-500 px-2 py-1 text-black rounded">Enregistrer</button>
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
            Employees : [],
            Materiels : [],
            accident: {},
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

        async getEmployees() {

            let response = await axios.get('/employees/all');
            if (response.data.status == 1)
                this.Employees = response.data.data
        },

        async getMateriel() {

            let response = await axios.get('/materiels/all');
            if (response.data.status == 1)
                this.Materiels = response.data.data
        },

        async getAccident(id) {

            let response = await axios.get('/accidents/get/' + id);
            if (response.data.status == 1)
                this.accident = response.data.data

        },

        async saveAccident() {
            let formData = new FormData();
            const file = this.$refs.proceV.files[0];
            formData.append("proceV", file);
            formData.append("id", this.accident.id);
            formData.append("description", this.accident.description);
            formData.append("id_employee", this.accident.id_employee);
            formData.append("dateA", this.accident.dateA);
            formData.append("id_materiel", this.accident.id_materiel);
            let res = await axios.post('/accidents/update', formData);
            if (res.data.status == 1){
                this.accident.proceV = res.data.image
                 alert("Modification à été bien fait");
                this.$router.push("/accidents");
            }
        },
        

    },

    mounted(){
        this.getEmployees();
        this.getMateriel();
        this.getAccident(this.$route.params.id)
    },

}
</script>

<style>
form {
    text-align: center;

}
#dateA{
    border-radius: 10px;
}

#libelleM {
    border-radius: 10px;
    margin-bottom: 10px;
    margin-top: 10px;
}

#proceV {
    margin-left: 110px;
    margin-top: 10px;
    border-radius: 4px;
}

#btnEnreg {
    background-color: aqua;
    margin-top: 10px;

}
</style>
