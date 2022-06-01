<template>
<menu__2 />
<div class="flex ">
    <!-- <router-link :to="{name: 'typemarteriels.index'}" id="rlink1" class="bg-green-500  px-2 py-1 text-balck  rounded">List des types</router-link> -->
</div>
<form class="space-y-6" @submit.prevent="saveTypeMateriel">
    <div>
        <label for="libelleMateriel" class="block">Libelle Materiel</label>
        <input type="text" id="libelleM" v-model="typeMateriel.libelleMateriel" required>
    </div>
    <div>
        <label for="photo" class="block">Photo</label>

        <input type="file" class="doc_1" name="photo" id="photo1" ref="photo">
    </div>
    <div>
        <img :src="typeMateriel.photo" alt="vide" id="img1">
    </div>

    <button type="submit" id="btnEnreg" class="custom-btn btn-1Employee"><i id="iAddEmpl" class="bx bx-save icon_table"></i>Mettre à jour</button>
</form>
</template>

<script>
import menu__2 from "../../menu/menu.vue";

export default {
    components: {
        menu__2
    },

    data() {
        return {
            typeMateriel: {}
        };
    },

    methods: {

        async getTypeMateriel(id) {

            let response = await axios.get('/typemarteriels/get/' + id);
            if (response.data.status == 1)
                this.typeMateriel = response.data.data

        },

        // async updateTypeMateriel(){
        //     await axios.post('/typemarteriels/update',this.typeMateriel);
        // },

        async saveTypeMateriel() {
            let formData = new FormData();
            const file = this.$refs.photo.files[0];
            formData.append("photo", file);
            formData.append("id", this.typeMateriel.id);
            formData.append("libelleMateriel", this.typeMateriel.libelleMateriel);
            let res = await axios.post('/typemarteriels/update', formData);
            if (res.data.status == 1) {
                this.typeMateriel.photo = res.data.image
                alert("Modification à été bien fait");
                // this.$router.push("/typemarteriels");

            } else if (res.data.status == -1)
                alert("Cet type exist déjà !!!!");

        },

    },

    mounted() {
        this.getTypeMateriel(this.$route.params.id)

    }

}
</script>

<style>
form {
    text-align: center;

}

#libelleM {
    border-radius: 10px;
    margin-bottom: 10px;
    margin-top: 10px;
}

#photo1 {
    margin-left: 110px;
    margin-top: 10px;
    border-radius: 4px;
    margin-bottom: 10px;
}

#btnEnreg {
    background-color: aqua;
    margin-top: 10px;

}

#img1 {
    text-align: center;
    display: inline-block;
    width: 100px;
    height: 110px;
}

#rlink1 {
    background-color: aqua;
}
</style>
