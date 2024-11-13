<template>
    <button v-if="isLogined" class="user-auth" v-on:click="handleLogout">
        <div class="image-parent">
            <img src="/images/logos/user.png" alt="">
        </div>
        <div>
            <div>Hello, {{user?.name?.split(' ')[0] }}</div>
            <div class="log">
               <span>Logout </span> 
               <!--img src="../../assets/images/logout2.png" width="20" alt="Sign Out" /-->
            </div>
        </div>
    </button>

    <button v-else class="user-auth" v-on:click="handleLogin">
        <div class="image-parent">
            <img src="/images/logos/user.png" alt="">
        </div>
        <div>
            <div>Hi ,User</div>
            <div class="log">
               <span>Login</span> 
               <!--img src="../../assets/images/login2.png" width="20" alt="Sign In" /-->
            </div>
        </div>
    </button>


</template>

<style scoped lang="scss">
    .user-auth{
       padding: 4px .75rem; 
       font-size:10px;
       font-weight: 600;

        display: flex;
        justify-content: center;
        align-items: center;
        gap:7px;
        border-radius: 7px;
        color:#222;

        @media(max-width:990px){
            color: #fff;
            margin-top: 10px;
            padding: .5rem 2rem;
            border: 1px solid #fff;
        }
    }

    .image-parent{
            width:45px;
            height: 40px;

            display: flex;
            justify-content: center;
            align-items: center;

            border-radius: 50%;
            padding: 4px;
            overflow: hidden;
            background: #fff;
        }

    img{
        max-width:35px;
        max-height:30px;
    }

    .user-auth > div:last-child {
        text-align: start;
    }

    .user-auth > div:last-child > div:last-child{
        text-decoration: underline;
    }

    .log img{
        opacity: .9;
    }
</style>


<script setup>
import { useAuthStore } from '@/store/store';
import { computed, onMounted, ref, toRaw } from 'vue';
import { useRouter } from 'vue-router';

const authStore = useAuthStore();
const router = useRouter();

const handleLogout = () => {
    authStore.logout();
    router.push('/login');
};

const handleLogin = ()=>{
    router.push('/login');
};

const isLogined = computed(()=>{
    if (localStorage.getItem('token') && localStorage.getItem('token') !== 'undefined') {
        return true
    }
    else{
        return false
    }
});

const user = ref(null);

 onMounted(async()=>{
    user.value = await authStore.getUser();
})
</script>