<template>
  <div>
      <VueSidebarMenuAkahon menuTitle="BTP" menuLogo="/storage/images/logo1.png" profileRole="" profileImg="/storage/images/deconnexion.png" :profileName="''" :menuItems="vars_" />
  </div>
</template>

<script>
  import VueSidebarMenuAkahon from "vue-sidebar-menu-akahon";
  import menuItems from './menuItems.js';
  export default {
    name: 'component.vue',
    components: {VueSidebarMenuAkahon},
    data() {
      return {
          vars_:menuItems,
      }
    }
  }
</script>