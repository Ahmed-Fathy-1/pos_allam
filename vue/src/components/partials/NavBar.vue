<template>
  <div
    class="header w-100"
    :class="[ scrolledHeader , {' z-3 ': $route.path === '/' }]"
  >
    <div class="container py-3 d-flex gap-5 align-items-center justify-content-between">
      <div class="nav-bar d-flex gap-5 w-100 align-items-center justify-content-between">
        <div class="logo-wrapper">
          <img src="@/assets/images/logos/logo.png" class="logo" alt="Logo" />
        </div>

        <!-- Links for large screens -->
        <ul class="d-none gap-4 align-items-center list-unstyled d-lg-flex d-md-none">
          <li><router-link to="/">Home</router-link></li>
          <li><router-link to="/about">About Us</router-link></li>
          <li><router-link to="/pricing">Pricing</router-link></li>
          <li><router-link to="/contact">Contact Us</router-link></li>
          <li> <UserAuth /> </li>
        </ul> 

        <!----------  user  ---------------->


        <!-- Toggle button for small screens -->
        <ToggleBtn @click="toggleMenu" />

        <!-- Mobile menu -->
       <Sidebar/>



      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent, inject, } from 'vue';
import ToggleBtn from './ToggleBtn.vue';
import Sidebar from './Sidebar.vue';
import UserAuth from './UserAuth.vue';
import { ref } from 'vue';


 

export default defineComponent({
  components: { ToggleBtn , Sidebar , UserAuth },
  setup() {
    const toggleSidebar =  inject('toggleSidebar');
    const scrolledHeader = ref('ddddddddd');

    window.addEventListener('scroll', function() {
      if (window.scrollY > 200) {
        scrolledHeader.value = 'frist-header'
      } else {
         scrolledHeader.value = ''
      }
    });

    const toggleMenu = () => {
      toggleSidebar()
    };

    return {
      toggleMenu,
      scrolledHeader
    };
  },
});
</script>


<style lang="scss" scoped>
.frist-header{
  background-color: var(--bs-primary);
}
ul {
  margin-bottom: -8px;
}

.logo {
  width: auto;
  height: 50px;
}

a {
  text-decoration: none;
  color: var(--bs-white);
}

/*.frist-header{
    position: fixed;
    z-index: 5;
    top: 0;
    left: 0;
    width: 100%;
    height: 80px;
    backdrop-filter: blur(6px);
    border-bottom: 3px solid #ff9f43;
    top: 0;
    transition: all 1s ease;
}*/

</style>
