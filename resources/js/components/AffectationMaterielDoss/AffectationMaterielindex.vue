<template>
<menu__2 />
<div class="flex flex-col">
    <!-- <div class="flex ">
        <router-link :to="{name: 'affectationMateriels.create'}" id="rlink1" class="bg-green-500  px-2 py-1 text-balck  rounded">Créer un pointage</router-link>
    </div> -->
    <div class="flex " id="divCreer">

        <div class="box" style="    margin-right: 40px;">
            <div class="container-4">
                <input type="search" v-model="search" id="search" placeholder="Search..." />
                <button class="icon" id="btnsearch"><i class="fa fa-search"></i></button>
            </div>
        </div>
        <!-- <router-link :to="{name: 'employees.create'}" id="rlink11" class="bg-green-500  px-2 py-1 text-balck  rounded">Créer un employé</router-link> -->
        <button id="rlink1" @click="$router.push('/affectationMateriels/create')">Créer un pointage</button>

    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Référence employee
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nom
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Prenom
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date début
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date fin
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Matériel
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Statut
                    </th>

                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <template v-for="affectMat,i in affectMats_filter" :key="i">
                    <tr id="trl1" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <div v-text="affectMat.reference"></div>
                        </th>
                        <td class="px-6 py-4">
                            <div v-text="affectMat.nom"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div v-text="affectMat.prenom"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div v-text="affectMat.date_debut"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div v-text="affectMat.date_fin"></div>
                        </td>
                        <td class="px-6 py-4">
                            <div v-text="affectMat.marqueM"></div>
                        </td>
                        <td class="px-6 py-4">
                            <!-- <div style="background:brown" v-text="affectMat.statut"></div> -->
                            <span id="spanStatut" v-text="affectMat.statut"></span>
                        </td>

                        <td class="px-6 py-4 text-right">
                            <button :class="affectMat.statut=='pas encore' ? 'pas_encore__'  : 'retour__'" @click="saveStatut(i)" id="btnStatut">Statut</button>
                            <router-link :to="{name: 'affectationMateriels.edit', params:{id: affectMat.id}}" id="rlinkEdit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Modifier</router-link>
                            <button @click="destroyAffectationM(affectMat.id)" id="btnSupp" class="font-medium text-red-600 dark:text-black-500 hover:underline">Supprimer</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</div>
</template>

<script>
import axios from "axios";
import menu__2 from "../menu/menu.vue";


export default {
    components: {
        menu__2
    },
    data() {
        return {
            affectMats: [],
            search: '',
        };
    },
    computed: {
        affectMats_filter() {
            let res = this.affectMats;
            //   let searchBy = this.search.toLocaleLowerCase();
            if (this.search.toLocaleLowerCase() != "") {
                res = res.filter(item => item.nom.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()) || item.prenom.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()) || item.reference.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()) || item.marqueM.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()) || item.statut.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()));
            }
            return res;
        }
    },
    methods: {
        async saveStatut(index) {
            if (!window.confirm('Voulez vous changer le statut de ce pointage?')) return;
            if (this.affectMats[index].statut == "pas encore")
                this.affectMats[index].statut = "retour"
            else
                this.affectMats[index].statut = "pas encore"
            await axios.post('/affectationMateriels/update', this.affectMats[index]);

            // alert("Le pointage matériel à été fait avec succes");
        },

        async getAffectationM() {

            let response = await axios.get('affectationMateriels/all');
            if (response.data.status == 1)
                this.affectMats = response.data.data
        },
        search__id(id) {
            let i = 0;

            for (i = 0; i < this.affectMats.length; i++)
                if (this.affectMats[i].id == id)
                    return i
            return -1
        },
        async destroyAffectationM(id) {
            if (!window.confirm('Supprimer cette affectation de matériel?')) return;

            let pos = this.search__id(id)
            await axios.delete('/affectationMateriels/delete/' + id);

            this.affectMats.splice(pos, 1)
            //pos c'est l'index du ligne sur le tableau d'affichage(html) et le 1 est pour combien de fois se trouve cet employée
        },

    },
    mounted() {
        this.getAffectationM()

    }
}
</script>

<style>
.pas_encore__ {
    background: rgb(255, 166, 0);
}

.retour__ {
    background: blue;

}

#rlink1 {
    background-color: aqua;
}

#btnStatut {
    margin-right: 20px;
    /* background-color: rgb(0, 110, 255); */
    color: aliceblue;
    border-radius: 10px;
    width: 50px;
}

#rlinkEdit {
    margin-right: 20px;
}

#btnSupp {
    margin-left: 10px;

}

#trl1 {
    text-align: center;
}
</style>
