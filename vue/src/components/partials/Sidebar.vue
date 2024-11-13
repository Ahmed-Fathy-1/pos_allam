<template>
    <div class="mobile-menu-container" :class="{ 'menu-active': isSidebarActive }">
        <div class="mobile-menu d-flex justify-content-center align-items-center">
        <v-icon class="close-icon" color="#fff" @click="closeMenu">mdi-close</v-icon>
        <ul>
            <li><router-link to="/">Home</router-link></li>
            <li><router-link to="/about">About Us</router-link></li>
            <li><router-link to="/pricing">Pricing</router-link></li>
            <li><router-link to="/contact">Contact Us</router-link></li>
            <li>
              <UserAuth />
            </li>
        </ul>
        </div>
    </div>
</template>

<script setup>
import { ref , inject} from 'vue';
import UserAuth from './UserAuth.vue';

    const   isSidebarActive =   inject('isSidebarActive');
    const   toggleSidebar =  inject('toggleSidebar');
    const   closeSidebar =  inject('closeSidebar');

    const closeMenu = ()=>{
        closeSidebar()
    }

</script>

<style>
.mobile-menu {
  position: fixed;
  background-color: rgba(0, 0, 0, 0.65);
  width: 94%;
  height: 97vh;
  left: 0;
  top: 0;
  margin: 13px;
  border-radius: 12px;
  border: 1px solid rgba(255, 255, 255, 0.45);
  backdrop-filter: blur(4px);
}

.mobile-menu-container {
  position: fixed;
  width: 100%;
  height: 100vh;
  left: -100%;
  top: 0;
  backdrop-filter: blur(4px);
  transition: all 0.3s ease;
  z-index: 1000;
}

.mobile-menu-container.menu-active {
  left: 0;
}

.mobile-menu-container li{
  text-align: center;
}

.close-icon {
  position: absolute;
  top: 16px;
  color: #fff;
  right: 15px;
  border: 1px solid;
  border-radius: 50%;
  padding: 14px;
  cursor: pointer;
}

.mobile-menu-container ul{
  list-style: none;
}

.mobile-menu-container ul a{
  display: block;
  padding: .5rem;
  color: #fff;
  font-weight: 500;
}

.mobile-menu-container ul a:hover{
  color:#00b9eb;
}
</style>