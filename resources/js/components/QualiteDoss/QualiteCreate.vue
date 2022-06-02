<template>
<menu__2 />
<form class="space-y-6" @submit.prevent="storeQualite">
    <div>
        <label for="libelleFonction" class="block">Qualité</label>
        <input type="text" id="libelleF" v-model="form1.libelleFonction" required>
    </div>

    <button type="submit" id="enregQual" class="custom-btn btn-1Employee"><i id="iAddEmpl" class="bx bx-save icon_table"></i>Enregistrer</button>
</form>
</template>

<script>
import menu__2 from "../menu/menu.vue";
import Swal from 'sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css';

export default {
    components: {
        menu__2
    },

    data() {
        return {
            qualites: [],
            form1: {
                libelleFonction: '',
            }
        };
    },

    methods: {

        async createQualite(data) {
            let res = await axios.post('/qualites/create', data);
            if (res.data.status == 1) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Modification réussie',
                    showConfirmButton: false,
                    timer: 2200
                })

                this.$router.push("/qualites");
            } else
            // if (!window.confirm('Cette qualité exist déjà !!!!')) return;
             Swal.fire(
                'Attention !',
                'Cette qualité exist déjà !!!!',
                'info'
            )

        },

        async storeQualite() {
            await this.createQualite(this.form1);
        },

    },

}
</script>

<style>
form {
    text-align: center;

}

#libelleF {
    border-radius: 10px;
}

#btnEnreg {
    background-color: aqua;
    margin-top: 10px;

}

#enregQual {
    width: 160px;
    height: 50px !important;
    margin-top: 20px;
    margin-bottom: 20px;
}
</style>
