<template>
<menu__2 />
<div v-if="load" class="flex flex-col">
    <div class="flex " id="divCreer">

        <div class="box" style="    margin-right: 40px;">
            <div class="container-4">
                <input type="search" v-model="search" id="search" placeholder="Chercher..." />
                <button class="icon" id="btnsearch"><i class="fa fa-search"></i></button>
            </div>
        </div>
        <!-- <router-link :to="{name: 'employees.create'}" id="rlink11" class="bg-green-500  px-2 py-1 text-balck  rounded">Créer un employé</router-link> -->
        <button class="custom-btn btn-1Employee" id="rlink1" @click="$router.push('/users/create')"><i id="iAddEmpl" class="bx bx-user-check icon_table"></i>Créer un utilisateur</button>

    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
        
        <table v-if="users_filter.length" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nom utilisateur
                    </th>
                    <th scope="col" class="px-6 py-3">
                        E-mail utilisateur
                    </th>

                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <template v-for="user,i in users_filter" :key="i">
                    <tr id="trl1" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <div v-text="user.name"></div>
                        </th>
                        <td class="px-6 py-4">
                            <div v-text="user.email"></div>
                        </td>

                        <td class="px-6 py-4 text-right">
                            <!-- <router-link :to="{name: 'employees.edit', params:{id: employee.id}}" id="rlinkEdit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"><i class="bx bx-edit icon_table"></i>Modifier</router-link> -->
                            <button @click="$router.push('/users/'+user.id+'/edit')" id="rlinkEdit" class="font-medium text-red-600 dark:text-black-500 hover:underline"> <i class="bx bx-edit icon_table"></i> Modifier</button>
                            <button @click="destroyUser(user.id)" id="btnSupp" class="font-medium text-red-600 dark:text-black-500 hover:underline"> <i class="bx bx-trash icon_table"></i> Supprimer</button>
                            <!-- $router.push('/employees/edit') -->
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
        <!-- ----------------Image-- pour afficher que les données pas trouver---------------------- -->
        <div v-else>
            <div v-if="!users.length" id="divImgLab">
                <img id="imgRech1" src="/storage/images/Rech1.png" alt="Vide">
                <p id="paraRech1">Aucune données</p>
            </div>
            <div v-else>
                <div id="divImgLab">
                    
                    <img id="imgRech1" src="/storage/images/Rech1.png" alt="Vide">
                     <p id="paraRech1">Aucune données commencer par: <b id="lb1"> {{search}} </b></p>   
                </div>
            </div>

        </div>
        <!-- ------------------------------------ -->
    </div>
</div>
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
            users: [],
            search: "",
            load: false
        };
    },
    computed: {
        users_filter() {
            let res = this.users;
            //   let searchBy = this.search.toLocaleLowerCase();
            if (this.search.toLocaleLowerCase() != "") {
                res = res.filter(item => item.name.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()) || item.email.toLocaleLowerCase().includes(this.search.toLocaleLowerCase()));
            }
            return res;
        }
    },
    methods: {
        async getUser() {

            let response = await axios.get('/users/all');
            if (response.data.status == 1)
                this.load = true
            this.users = response.data.data
        },
        search__id(id) {
            let i = 0;

            for (i = 0; i < this.users.length; i++)
                if (this.users[i].id == id)
                    return i
            return -1
        },
        async MethodAxios(id) {
            let pos = this.search__id(id);
            await axios.delete('/users/delete/' + id);
            this.users.splice(pos, 1)
        },

        async destroyUser(id) {
            // if (!window.confirm('Supprimer cet utilisateur ?')) return;

            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Voulez vous vraîment supprimer cet utilisateur!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, Supprime-le!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.MethodAxios(id),

                        Swal.fire(
                            'Supprimé!',
                            'Utilisateur a été supprimé.',
                            'success'
                        )
                }
            })
            //pos c'est l'index du ligne sur le tableau d'affichage(html) et le 1 est pour combien de fois se trouve cet user
        },

    },
    mounted() {
        this.getUser()

    }
}
</script>

<style>
#rlink1 {
    background-color: aqua;
    align-content: center;
    border-radius: 6px;
    width: 220px;
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

/* ---------------------------------- */
/* input Rechercher */
.container-4 {
    overflow: hidden;
    width: 300px;
    vertical-align: middle;
    white-space: nowrap;
}

.container-4 input#search {
    width: 300px;
    height: 50px;
    background: #2b303b;
    border: none;
    font-size: 10pt;
    float: left;
    color: #fff;
    padding-left: 15px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
}

.container-4 input#search::-webkit-input-placeholder {
    color: #65737e;
}

.container-4 input#search:-moz-placeholder {
    /* Firefox 18- */
    color: #65737e;
}

.container-4 input#search::-moz-placeholder {
    /* Firefox 19+ */
    color: #65737e;
}

.container-4 input#search:-ms-input-placeholder {
    color: #65737e;
}

.container-4 button.icon {
    -webkit-border-top-right-radius: 5px;
    -webkit-border-bottom-right-radius: 5px;
    -moz-border-radius-topright: 5px;
    -moz-border-radius-bottomright: 5px;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;

    border: none;
    background: #232833;
    height: 50px;
    width: 50px;
    color: #4f5b66;
    opacity: 0;
    font-size: 10pt;

    -webkit-transition: all .55s ease;
    -moz-transition: all .55s ease;
    -ms-transition: all .55s ease;
    -o-transition: all .55s ease;
    transition: all .55s ease;
}

.container-4:hover button.icon,
.container-4:active button.icon,
.container-4:focus button.icon {
    outline: none;
    opacity: 1;
    margin-left: -50px;
}

.container-4:hover button.icon:hover {
    background: white;
}

/* ---------------------------------- */
/* #divCreer{
        justify-content: flex-end;

}
#search{
    width: 100% !important;
    height: 100% !important;
}
#divCreer .container-4{
    width: 900px !important;
    height: 80px !important;
}
#divCreer .container-4 .icon{
    height: 100% !important;
} */

/* ----------------------------------------------- */
/* table {
  width: 800px;
  border-collapse: collapse;
  overflow: hidden;
  box-shadow: 0 0 20px rgba(51, 62, 87, 0.986);
}

th,
td {
  padding: 15px;
  background-color: rgba(107, 99, 99, 0.2);
  color: rgb(0, 0, 0);
}

thead th {
  background-color: #1d1b31;
  height: 90px;
  color: white;
}
tbody{
    background: #65737e !important;
}
tbody tr:hover {
  background-color: rgba(255, 255, 255, 0.3);
}
tbody td {
  position: relative;
}
tbody td:hover:before {
  content: "";
  position: absolute;
  left: 0;
  right: 0;
  top: -9999px;
  bottom: -9999px;
  background-color: rgb(255, 0, 0);
  z-index: -1;
} */
/* ------------------------------------------------------- */
</style>
