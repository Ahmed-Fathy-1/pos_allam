<template>
  
  <div class="layout stiky">
    <NavBar v-if="$route.path == '/'" />
    <NavBar2 v-if="$route.path != '/'" />
  </div>  
    <router-view></router-view>
    <Footer />
  
</template>



<script setup>
import NavBar from "@/components/partials/NavBar.vue";
import NavBar2 from "@/components/partials/NavBar2.vue";
import { useScroll } from "@/compasaples/scroll";
import Footer from "@/components/partials/Footer.vue";
const { nav } = useScroll();
</script>

<style lang="scss" scoped>
.stiky{
  position: sticky;
  top: 0;
  left: 0;
  height:auto;
  z-index: 10000;
}
</style>
