<template>
<menu__2 />
<form class="space-y-6" @submit.prevent="storeDepenses">
    
    <div>
        <label for="description" class="block">Déscription dépenses</label>
        <textarea class="inp1" v-model="form1.description" name="textarea1" id="txtare1" cols="30" rows="4" placeholder="Remarque" required></textarea>
    </div>
    <div>
        <label for="nomEmploye" class="block">Employées</label>
        <!-- <input type="text" class="inp1" id="type_salaire" v-model="form1.type_salaire" required> -->
        <select name="nomEmploye" class="inp1" id="nomEmploye" v-model="form1.id_employee" required>
            <option v-for="c in Employees" :value="c.id" :key="c.id">{{c.nom}} {{c.prenom}}</option>
        </select>
    </div>

    <div>
        <label for="dateDepense" class="block">Date dépenses</label>
        <input type="date" id="dateDepense" v-model="form1.dateDepense" required>
    </div>

    <div>
        <label for="marqueM" class="block">Matériels</label>
        <!-- <input type="text" class="inp1" id="type_salaire" v-model="form1.type_salaire" required> -->
        <select name="marqueM" class="inp1" id="marqueM" v-model="form1.id_materiel" required>
            <option value="-1">Autre dépenses</option>
            <option v-for="c in Materiels" :value="c.id" :key="c.id">{{c.marqueM}}</option>
        </select>
    </div>
    <div>
        <label for="totalTCC" class="block">TOTAL T.T.C</label>
        <input type="number" step="any" id="totalTCC" v-model="form1.totalTCC" required>
    </div>

    <div>
        <label for="bonDepense" class="block">Bon des dépenses</label>
        <input type="file" name="bonDepense" id="bonDepense" ref="bonDepense" >
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
            Employees : [],
            Materiels : [],
            form1: {
                description:'',
                id_employee:'',
                dateDepense:'',
                id_materiel:'',
                totalTCC:'',
                bonDepense:'',
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

        async storeDepenses() {

            let formData = new FormData();
            const file = this.$refs.bonDepense.files[0];
            formData.append("bonDepense", file);
            formData.append("description", this.form1.description);
            formData.append("id_employee", this.form1.id_employee);
            formData.append("dateDepense", this.form1.dateDepense);
            formData.append("id_materiel", this.form1.id_materiel);
            formData.append("totalTCC", this.form1.totalTCC);
            let res = await axios.post('/depenses/create', formData);
            if (res.data.status == 1)
                this.$router.push("/depenses");
            //     else
            // alert("Cet type exist déjà !!!!");
            // // if (!window.confirm('Cet type exist déjà !!!!')) return;
        },

    },

    mounted(){
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
    color: blue;
}

#btnEnreg {
    background-color: aqua;
    margin-top: 10px;

}
</style>
