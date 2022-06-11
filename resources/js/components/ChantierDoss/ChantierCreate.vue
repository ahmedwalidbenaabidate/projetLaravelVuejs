<template>
<menu__2 />
    <form class="space-y-6"  @submit.prevent="storeChantier" >
        <div>
            <label for="code" class="block">Code chantier </label>
            <input type="text" id="code" v-model="form1.code" required>
        </div>
        <div>
            <label for="libelle" class="block">Libelle chantier</label>
            <input type="text" id="libelle" v-model="form1.libelle" required>
        </div>
        <div>
            <label for="abreviation" class="block">Abreviation</label>
            <input type="text" id="abreviation" v-model="form1.abreviation" required>
        </div>
        <button type="submit" id="btnEnreg" class="custom-btn btn-1Employee"><i id="iAddEmpl" class="bx bx-save icon_table"></i>Enregistrer</button>
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
            chantiers: [],
            form1 :{
            code: '',
            libelle: '',
            abreviation: '',
        }
        };
    },


    methods: {
      
        async createChantier(data){
            await axios.post('/chantiers/create',data);
        },

        async storeChantier(){
            await this.createChantier(this.form1);
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Chantier a été enregistrer!!!',
                showConfirmButton: false,
                timer: 2200
            })
            this.$router.push("/chantiers");
        },

    },

}

</script>

<style>
form{
    text-align: center;
    
    
}

#code ,#libelle, #abreviation{
    border-radius: 10px;
}
#btnEnreg{
    background-color: aqua;
    margin-top: 10px;
    
}

</style>