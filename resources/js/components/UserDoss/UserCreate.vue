<template>
<menu__2 />
<form class="space-y-6" @submit.prevent="storeUser">
    <div>
        <label for="name" class="block">Nom utilisateur</label>
        <input type="text" class="inp1" id="name" v-model="form1.name" placeholder="Entrez votre nom" maxlength="50" required>
    </div>
    <div>
        <label for="email" class="block">E-mail utilisateur</label>
        <input type="email" name="email" class="inp1" id="nom" v-model="form1.email" pattern="(^[a-z0-9]+)@([a-z0-9])+(\.)([a-z]{2,4})" 
     placeholder="Entrez e-mail" required>
    </div>
    <div>
        <label for="password" class="block">Password</label>
        <input type="password"  class="inp1" id="password" v-model="form1.password" placeholder="Entrez password..." minlength="8" required>
    </div>
    
    <button type="submit" id="btnEnreg" class="custom-btn btn-1Employee"><i id="iAddEmpl" class="bx bx-save icon_table"></i>Enregistrer</button>
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

    data() {
        return {
          
            
            form1: {
                name: '',
                email: '',
                password:'',
            }
        };
    },

    methods: {

        async createUser(data) {
            let res = await axios.post('/users/create', data);
            if (res.data.status == 1) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Création réussie',
                    showConfirmButton: false,
                    timer: 2200
                })
                this.$router.push("/users");
            }else
            {
            Swal.fire(
                'Attention !',
                'Cet email exist déjà !!!!',
                'info'
            )
            }
        },

        async storeUser() {
            await this.createUser(this.form1);
            
        },
    },

    mounted() {
        //
    }
}
</script>

<style>
form {
    text-align: center;

}

#code,
#libelle,
#abreviation {
    border-radius: 10px;
}

.inp1 {
    border-radius: 10px;

}

#btnEnreg {
    background-color: aqua;
    margin-top: 10px;

}
</style>
