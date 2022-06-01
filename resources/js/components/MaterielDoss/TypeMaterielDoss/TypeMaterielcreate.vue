<template>
<menu__2 />
<form class="space-y-6" @submit.prevent="storeTypeMateriel">
    <div>
        <label for="libelleMateriel" class="block">Libelle Materiel</label>
        <input type="text" id="libelleM" v-model="form1.libelleMateriel" required>
    </div>
    <div>
        <label for="photo" class="block">Photo</label>
        <input type="file" name="photo" id="photo1" ref="photo" required>
    </div>

    <button type="submit" id="btnEnreg" class="bg-blue-500 px-2 py-1 text-black rounded">Enregistrer</button>
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

            form1: {
                libelleMateriel: '',
                photo: '',
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

        

        async storeTypeMateriel() {

            let formData = new FormData();
            const file = this.$refs.photo.files[0];
            formData.append("photo", file);
            formData.append("libelleMateriel", this.form1.libelleMateriel);
            let res = await axios.post('/typemarteriels/create', formData);
            if (res.data.status == 1)
                this.$router.push("/typemarteriels");
                else
            alert("Cet type exist déjà !!!!");
            // if (!window.confirm('Cet type exist déjà !!!!')) return;
        },

    },

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
}

#btnEnreg {
    background-color: aqua;
    margin-top: 10px;

}
</style>
