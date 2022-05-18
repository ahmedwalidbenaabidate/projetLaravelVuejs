<template>
<form class="space-y-6" @submit.prevent="saveDepenses">
    
    <div>
        <label for="description" class="block">Déscription dépenses</label>
        <textarea class="inp1" v-model="depense.description" name="textarea1" id="txtare1" cols="30" rows="4" placeholder="Remarque" required></textarea>
    </div>
    <div>
        <label for="nomEmploye" class="block">Employées</label>
        <!-- <input type="text" class="inp1" id="type_salaire" v-model="form1.type_salaire" required> -->
        <select name="nomEmploye" class="inp1" id="nomEmploye" v-model="depense.id_employee" required>
            <option v-for="c in Employees" :value="c.id" :key="c.id">{{c.nom}} {{c.prenom}}</option>
        </select>
    </div>

    <div>
        <label for="dateDepense" class="block">Date dépenses</label>
        <input type="date" id="dateDepense" v-model="depense.dateDepense" required>
    </div>

    <div>
        <label for="marqueM" class="block">Matériels</label>
        <!-- <input type="text" class="inp1" id="type_salaire" v-model="form1.type_salaire" required> -->
        <select name="marqueM" class="inp1" id="marqueM" v-model="depense.id_materiel" required>
            <option value="-1">Autre dépenses</option>
            <option v-for="c in Materiels" :value="c.id" :key="c.id">{{c.marqueM}}</option>
        </select>
    </div>
    <div>
        <label for="totalTCC" class="block">TOTAL T.T.C</label>
        <input type="number" step="any" id="totalTCC" v-model="depense.totalTCC" required>
    </div>

    <div>
        <label for="bonDepense" class="block">Bon des dépenses</label>
        <input type="file" name="bonDepense" id="bonDepense" ref="bonDepense" >
    </div>

    <button type="submit" id="btnEnreg" class="bg-blue-500 px-2 py-1 text-black rounded">Enregistrer</button>
</form>
</template>

<script>
export default {

    data() {
        return {
            Employees : [],
            Materiels : [],
            depense: {},
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

        async getDepense(id) {

            let response = await axios.get('/depenses/get/' + id);
            if (response.data.status == 1)
                this.depense = response.data.data

        },

        async saveDepenses() {

            let formData = new FormData();
            const file = this.$refs.bonDepense.files[0];
            formData.append("bonDepense", file);
            formData.append("description", this.depense.description);
            formData.append("id_employee", this.depense.id_employee);
            formData.append("dateDepense", this.depense.dateDepense);
            formData.append("id_materiel", this.depense.id_materiel);
            formData.append("totalTCC", this.depense.totalTCC);
            let res = await axios.post('/depenses/create', formData);
            if (res.data.status == 1){
                this.depense.bonDepense = res.data.image
                 alert("Modification à été bien fait");
                this.$router.push("/depenses");
            }
            //     else
            // alert("Cet type exist déjà !!!!");
            // // if (!window.confirm('Cet type exist déjà !!!!')) return;
        },

    },

    mounted(){
        this.getDepense(this.$route.params.id);
        this.getEmployees();
        this.getMateriel();
    },

}
</script>

<style>
form {
    text-align: center;

}
#dateDepense,#totalTCC{
    border-radius: 10px;
    width: 250px;
}

#libelleM {
    border-radius: 10px;
    margin-bottom: 10px;
    margin-top: 10px;
}

#bonDepense {
    margin-left: 110px;
    margin-top: 10px;
    border-radius: 4px;
}

#btnEnreg {
    background-color: aqua;
    margin-top: 10px;

}
</style>
