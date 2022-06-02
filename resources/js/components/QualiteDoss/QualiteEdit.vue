<template>
<menu__2 />
<form class="space-y-6" @submit.prevent="saveQualite">
    <div>
        <label for="libelleFonction" class="block">Qualité</label>
        <input type="text" id="libelleF" v-model="qualite.libelleFonction" required>
    </div>

    <button type="submit" id="btnEnreg" class="custom-btn btn-1Employee"><i id="iAddEmpl" class="bx bx-save icon_table"></i>Mettre à jour</button>
</form>
</template>

<script>
import axios from "axios";
import menu__2 from "../menu/menu.vue";
import Swal from 'sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css';

export default {
    components: {
        menu__2
    },

    props: {
        id: {
            required: true,
            type: String
        }
    },

    data() {
        return {
            qualite: {},
            name: "",
        };
    },

    methods: {

        async getQualite(id) {

            let response = await axios.get('/qualites/get/' + id);
            if (response.data.status == 1) {
                this.qualite = response.data.data
                //Sauvegarder libelleFonction pour éviter le probléme "cette qualité exist déjà"
                this.name =  response.data.data.libelleFonction
            }
        },

        async saveQualite() {
            if (this.name != this.qualite.libelleFonction) {

                let res = await axios.post('/qualites/update', this.qualite);
                if (res.data.status == 1) {
                    this.$router.push("/qualites")
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Modification réussie',
                        showConfirmButton: false,
                        timer: 2200
                    })
                } else
                    // if (!window.confirm( 'Cette qualité exist déjà !!!!')) return;
                    Swal.fire(
                        'Attention !',
                        'Cette qualité exist déjà !!!!',
                        'info'
                    )
            } else
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Modification réussie',
                    showConfirmButton: false,
                    timer: 2200
                })

        },

    },
    mounted() {
        this.getQualite(this.$route.params.id)
    }

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
</style>
