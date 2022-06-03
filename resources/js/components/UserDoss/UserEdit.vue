<template>
<menu__2 />
    <form class="f___ space-y-6"  @submit.prevent="saveUser" >
        <div>
        <label for="name" class="block">Nom utilisateur</label>
        <input type="text" class="inp1" id="name" v-model="user.name" maxlength="10" required>
    </div>
    <div>
        <label for="email" class="block">E-mail utilisateur</label>
        <input type="email" name="email" class="inp1" id="nom" disabled :value="user.email" pattern="(^[a-z0-9]+)@([a-z0-9])+(\.)([a-z]{2,4})" 
     placeholder="Entrez e-mail" required>
    </div>
    <div>
        <label for="password" class="block">Password</label>
        <input type="password" class="inp1" id="password" v-model="user.password" placeholder="Entrez password..." minlength="6"  maxlength="10">
        <span id="spPass">Entrez le nouveau password</span>
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
            user: {}
        };
    },


    methods: {

        async  getUser(id) {

            let response = await axios.get('/users/get/' + id);
            if (response.data.status == 1)
                this.user = response.data.data
        },

      
        // async updateUser(){
        //     await axios.post('/users/update',this.user);
        // },

        async saveUser(){
            // await this.updateUser();
         let res =   await axios.post('/users/update',this.user);
         if(res.data.status == 1){
            this.$router.push("/users");
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Modification réussie',
                showConfirmButton: false,
                timer: 2200
            })
            }
            else
                 Swal.fire(
                'Attention !',
                'Cette adresse email exist déjà !!!!',
                'info'
            )

        },

       

    },
    mounted(){
        this.getUser(this.$route.params.id)
    }


}

</script>

<style>
.f___  form{
    text-align: center;
    
    
}

#code ,#libelle, #abreviation{
    border-radius: 10px;
}
.inp1{
    border-radius: 10px;
}
#btnEnreg{
    background-color: aqua;
    margin-top: 10px;
    
}
.f___ #password{
    margin-left: 220px;
    margin-right: 10px;
}
.f___ #spPass{
    font-family: cursive;
    color: blue;
}
</style>