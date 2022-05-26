<template>
<div>
    <VueSidebarMenuAkahon @button-exit-clicked="logout" menuTitle="BTP" menuLogo="/storage/images/logo1.png" profileRole="" profileImg="/storage/images/deconnexion.png" :profileName="''" :menuItems="vars_" />
<a ref="logout" style="display:none" href="login">logg</a>
</div>
</template>

<script>
import VueSidebarMenuAkahon from "vue-sidebar-menu-akahon";
import menuItems from './menuItems.js';
import axios from "axios";

export default {
    name: 'component.vue',
    components: {
        VueSidebarMenuAkahon
    },
    data() {
        return {
            vars_: menuItems,
        }
    },
    methods: {
       async logout() {
            await axios.post('/logout');
            this.$refs.logout.click();
            // this.$router.push("/login")
        }
    },
}
</script>
