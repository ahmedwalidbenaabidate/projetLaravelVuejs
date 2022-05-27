<template>
<form class="space-y-6" @submit.prevent="storeUser">
    <div>
        <label for="name" class="block">Nom utilisateur</label>
        <input type="text" class="inp1" id="name" v-model="form1.name" placeholder="Entrez le votre nom" maxlength="10" required>
    </div>
    <div>
        <label for="email" class="block">E-mail utilisateur</label>
        <input type="email" name="email" class="inp1" id="nom" v-model="form1.email" pattern="(^[a-z0-9]+)@([a-z0-9])+(\.)([a-z]{2,4})" 
     placeholder="Entrez e-mail" required>
    </div>
    <div>
        <label for="password" class="block">Password</label>
        <input type="password" class="inp1" id="password" v-model="form1.password" placeholder="Entrez password..." maxlength="10" required>
    </div>
    
    <button type="submit" id="btnEnreg" class="bg-blue-500 px-2 py-1 text-black rounded">Enregistrer</button>
</form>
</template>

<script>
import axios from "axios";

export default {

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
            await axios.post('/users/create', data);
        },

        async storeUser() {
            await this.createUser(this.form1);
            this.$router.push("/users");
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
