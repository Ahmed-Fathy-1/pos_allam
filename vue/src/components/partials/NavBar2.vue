<template>
  <div class="header2 w-100">
    <div
      class="container py-2 d-flex gap-5 align-items-center justify-content-between"
    >
      <div
        class="d-flex gap-5 w-100 align-items-center justify-content-between"
      >
        <!-- logo -->
         <a href="/">
          <img src="@/assets/images/logos/logo.png" class="logo" alt="" />
        </a>

        <!-- links in large screens -->
        <ul class="d-none d-lg-flex gap-4 align-items-center list-unstyled">
          <li>
            <router-link to="/">Home</router-link>
          </li>
          <li>
            <router-link to="/about"> About Us</router-link>
          </li>
          <li>
            <router-link to="/pricing"> Pricing</router-link>
          </li>
          <li>
            <router-link to="/contact"> Contact Us </router-link>
          </li>
          <li> <UserAuth /> </li>
         
        </ul>
        <!-- links in small screens -->
        <ToggleBtn @click="toggleMenu" />


        <!-- sidebar -->

        <Sidebar  :menuActive="menuActive"/>


      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent, inject, } from 'vue';
import ToggleBtn from './ToggleBtn.vue';
import Sidebar from './Sidebar.vue';
import UserAuth from './UserAuth.vue';

export default defineComponent({
  components: { ToggleBtn , Sidebar , UserAuth },
  setup() {
    const toggleSidebar =  inject('toggleSidebar');

    const toggleMenu = () => {
      toggleSidebar()
    };

    return {
      toggleMenu,
    };
  },
});
</script>

<style lang="scss" scoped>
ul {
  margin-bottom: -8px;
}

.logo {
  width: auto;
  height: 40px;
}

a {
  text-decoration: none;
  color: var(--bs-black);
  font-weight: 600;
}

// .router-link-active.router-link-exact-active {
//   color: red;
//   position: relative;
//   &::before {
//     content: "";
//     position: absolute;
//     width: 100%;
//     height: 1px;
//     background-color: var(--bs-primary);
//     bottom: 0;
//   }
// }

.header2 {
  position: fixed;
  z-index: 5;
  top: 0;
  left: 0;
  backdrop-filter: blur(6px);
  background-color: rgb(255 235 215);
  border-bottom: 3px solid #ff9f43;
  top: 0;
  transition: all 1s ease;
}

// .transition-header {
//   top: 0 !important;
// }
</style>
