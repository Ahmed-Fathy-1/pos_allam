<template>
  <div class="login-pag">
    <div class="row">
      <div class="col-lg-5 mt-4">
        <div class="container">
          <div class="image d-flex justify-content-center" @click="$router.push('/')">
            <img src="../assets/images/logos/logo.png" width="220" alt="Logo" />
          </div>

          <div class="content w-100 pt-5">
            <h2>Sign In</h2>
            <p>Access the Dreamspos panel using your email and passcode.</p>

            <form @submit.prevent="handleSubmit" class="form pt-3 pb-3">
              <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <div class="position-relative">
                  <v-icon class="email-icon position-absolute" size="small" color="#808080">mdi-email-outline</v-icon>
                  <input
                    type="email"
                    id="email"
                    class="form-control"
                    name="email"
                    placeholder="Enter Email"
                    v-model="email"
                    v-on:change="emailError = ''"
                  />
                  <p class="text-error">{{ emailError }}</p>
                </div>
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="position-relative">
                  <v-icon @click="showPassword" class="eye-icon position-absolute" size="small" color="#808080">
                    {{ show ? 'mdi-eye' : 'mdi-eye-off' }}
                  </v-icon>
                  <input
                    :type="show ? 'text' : 'password'"
                    id="password"
                    class="form-control"
                    name="password"
                    placeholder="Enter Password"
                    v-model="password"
                    v-on:change="passwordError = ''"
                  />
                  <p class="text-error">{{ passwordError }}</p>
                </div>
              </div>

              <!----<div class="remember-me d-flex justify-content-between align-items-center">
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    id="rememberMe"
                  />
                  <label class="form-check-label" for="rememberMe">Remember Me</label>
                </div>
                <p class="mb-0">Forget Password?</p>
              </div>-->

              <button type="submit" class="btn btn-primary text-white w-100 mt-4 fw-bold">Submit</button>
            </form>

            <p>
              New on our platform?
              <router-link to="/register" class="text-black">Create an account</router-link>
            </p>
          </div>
        </div>
      </div>

      <div class="col-lg-7 p-0 d-lg-block d-md-none d-none">
        <img src="../assets/images/login-cover.jpg" width="100%" class="vh-100" alt="Cover" />
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref, toRaw } from 'vue';
import { useAuthStore } from '@/store/store';
import { useRouter } from 'vue-router';

const show = ref(true);

//const userLoggined =  ref({name: "",email: ""});

const email = ref('');
const password = ref('');

const passwordError = ref('');
const emailError = ref('');

const router = useRouter();

const authStore = useAuthStore();

const { initialize } = authStore;

const handleChange = (e)=>{
  const {name,value} = e.target;
  userLoggined.value[name] = value
}


const showPassword = () => {
  show.value = !show.value;
};


const checkIsInputFilled = ()=>{
  if (email.value === '') {
      emailError.value = 'Fill this input'
    if (password.value === '') {
      passwordError.value = 'Fill this input'
    }

    return false;
  }

  return true;
}

const handleSubmit = async () => {
 // const email = "SuperAdmin@admin.com";
 // const password = "12345678";

 if (!checkIsInputFilled()) {
    return false;
 }
   const data = await authStore.login({ email: email.value, password: password.value });
   router.push('/')
};
</script>

<style lang="scss" scoped>
.eye-icon,
.email-icon {
  z-index: 1;
  bottom: 8px;
  right: 10px;
}

.col-lg-5 {
  max-height: 100vh;
  overflow-y: scroll;
}

.col-lg-5::-webkit-scrollbar {
  width: 5px;
}

.col-lg-5::-webkit-scrollbar-track {
  background: #fff;
}

.col-lg-5::-webkit-scrollbar-thumb {
  background: var(--bs-primary);
  border-radius: 1px;
}

.col-lg-5::-webkit-scrollbar-thumb:hover {
  background: #7e7e7e;
}
</style>
