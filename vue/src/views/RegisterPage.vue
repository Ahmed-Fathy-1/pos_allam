<template>
  <div class="login-pag">
    <div class="row">
      <div class="col-lg-5 pt-4">
        <div class="container">
          <div
            class="image d-flex justify-content-center"
            @click="$router.push('/')"
          >
            <img src="../assets/images/logos/logo.png" width="220" alt="" />
          </div>

          <div class="content w-100 pt-5">
            <div>
              <h2>Register</h2>
              <p>Create New Dreamspos Account.</p>
              <div class="form pt-3">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label"
                    >Name</label
                  >
                  <div class="position-relative">
                    <v-icon
                      class="email-icon position-absolute"
                      size="small"
                      color="#808080"
                      >mdi-account</v-icon
                    >
                    <input
                      type="text"
                      class="form-control"
                      id="exampleFormControlInput1"
                      name="name"
                      @change="handleChange"
                    />
                  </div>
                </div>

                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label"
                    >mobile</label
                  >
                  <div class="position-relative">
                    <v-icon
                      class="email-icon position-absolute"
                      size="small"
                      color="#808080"
                      >mdi-account</v-icon
                    >
                    <input
                      type="text"
                      class="form-control"
                      id="exampleFormControlInput1"
                      name="mobile"
                      @change="handleChange"
                    />
                  </div>
                </div>
              </div>

              <div class="form">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label"
                    >Email address</label
                  >
                  <div class="position-relative">
                    <v-icon
                      class="email-icon position-absolute"
                      size="small"
                      color="#808080"
                      >mdi-email-outline</v-icon
                    >
                    <input
                      type="email"
                      class="form-control"
                      id="exampleFormControlInput1"
                      name="email"
                      @change="handleChange"
                    />
                  </div>
                </div>

                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label"
                    >Password</label
                  >
                  <div class="position-relative">
                    <v-icon
                      @click="showPassword"
                      v-if="show == true"
                      class="eye-icon position-absolute"
                      size="small"
                      color="#808080"
                      >mdi-eye-outline</v-icon
                    >

                    <v-icon
                      @click="showPassword"
                      v-if="show == false"
                      class="eye-icon position-absolute"
                      size="small"
                      color="#808080"
                      >mdi-eye-off-outline</v-icon
                    >
                    <input
                      :type="show ? 'text' : 'password'"
                      class="form-control"
                      id="exampleFormControlInput1"
                      name="password"
                      @change="handleChange"
                    />
                  </div>
                </div>

                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label"
                    >Confirm Password</label
                  >
                  <input
                    :type="show ? 'text' : 'password'"
                    class="form-control"
                    id="exampleFormControlInput1"
                    name="password_confirmation"
                    @change="handleChange"
                  />
                </div>

                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    value=""
                    id="flexCheckDefault"
                  />
                  <label class="form-check-label" for="flexCheckDefault">
                    Rember Me
                  </label>
                </div>

                <!-- submit button  -->
                <input
                  type="button"
                  value="Sign Up"
                  class="btn btn-primary text-white w-100 mt-4 fw-bold"
                  @click="handleSubmit"
                />
              </div>

              <p class="pt-2">
                Already have an account ?
                <router-link to="/login" class="text-black"
                  >Sign In Instead</router-link
                >
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-7 p-0 d-lg-block d-md-none d-none">
        <div class="image">
          <img
            src="../assets/images/login-cover.jpg"
            width="100%"
            class="vh-100"
            alt="..."
          />
        </div>
      </div>
    </div>
  </div>
</template>


<script setup>
import { ref,onMounted } from "vue";
import { useAuthStore } from '@/store/store';
import { useRouter } from 'vue-router';

const userRegestrated =  ref({
      name: "",
      mobile:'',
      email: "",
      password:'',
      password_confirmation:'',
});

const confirmPassword = ref(null);

const canSubmit = ref(false);

const show = ref(true);
const router = useRouter();
const authStore = useAuthStore();

const handleChange = (e)=>{
  const {name,value} = e.target;
  userRegestrated.value[name] = value
}

const handleConfirmChange = (e)=>{
  confirmPassword.value = e.target.value;
}

onMounted(() => {
   authStore.initialize();
});

const showPassword = () => {
  show.value = !show.value;
};

const handleSubmit = () => {
  const {name, mobile,email,password , password_confirmation} = userRegestrated.value;
  if (true) {
    authStore.register({
      name:name ,
      phone:mobile,
      email: email,
      password: password,
      password_confirmation:password_confirmation
     });
    router.push('/')
  }  
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
