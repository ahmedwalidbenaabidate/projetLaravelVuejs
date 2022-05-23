<template>
  <div>
      <VueSidebarMenuAkahon menuTitle="mebuuu" :menuItems="vars_" />
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