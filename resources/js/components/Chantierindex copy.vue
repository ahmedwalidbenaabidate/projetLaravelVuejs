<template>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Code chantier
                </th>
                <th scope="col" class="px-6 py-3">
                    Libelle chantier
                </th>
                <th scope="col" class="px-6 py-3">
                    Abreviation
                </th>
                
                <!-- <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th> -->
            </tr>
        </thead>
        <tbody>
            <template v-for="chantier in chantiers" :key="chantier.id">
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        <div v-text="chantier.code"></div>
                    </th>
                    <td class="px-6 py-4">
                        <div v-text="chantier.libelle"></div>
                    </td>
                    <td class="px-6 py-4">
                        <div v-text="chantier.abreviation"></div>
                    </td>
                    <!-- <td class="px-6 py-4">
                        $2999
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </td> -->
                </tr>
            </template>
        </tbody>
    </table>
</div>
</template>

<script>
import {
    onMounted
} from "vue";
import useChantiers from "../services/chantierservices.js";

export default {

    setup() {
        const {
            chantiers,
            getChantiers
        } = useChantiers;

        onMounted(getChantiers());

        return {
            chantiers
        };
    },
}
</script>
