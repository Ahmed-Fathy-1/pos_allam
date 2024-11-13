<template>
    <div class="payment-page pt-5 pb-5 container">
      <div class="row g-3">
        <!-- left section -->
        <div class="col-lg-12">
          <!-- drosat logo  -->
      
          <div class="top-left">
            <header class="top-left__header">
                <img data-v-ac2307b4="" src="/images/about/plan-icon.png" alt=""> 
                <h1>
                    <span>{{ 'package Name' }}</span>
                    <span>{{ package.Price_monthly }} LE</span>
                </h1>
                <div class="triangle"></div>
                <div class="square"></div>
            </header>
          </div>





  
          <div class="row">
            <div class="col-lg-6 col-md-12 col-12">
              <!-- payment card -->
              <v-card class="p-3 mt-8 payment-card border-1" elevation="0">
                <!-- package name -->
                <h2 class="text-center fw-bold">Package details</h2>

                

                <!------------------------------------------------>


          <div
            class="card border-0"
            :class="{ 'recommended-package': index == 1 }"
          >
            <div class="card-body">
              <h4>{{ package.title }}</h4>
              <p>
                {{ package?.description }}
              </p>

              <h3 class="price" v-if="type == '1'">
                ${{ package?.Price_monthly }} <sub>/Month</sub>
              </h3>

              <h3 class="price" v-else>
                ${{ package?.Price_annually }} <sub>/Year</sub>
              </h3>

              <v-btn
                :class="{
                  'text-primary': true,
                }"
                @click="$router.push({name : 'stripe' , params : {packageId : package.id }})"
                class="text-capitalize elevation-0 mt-3 w-100 fw-bold"
                variant="outlined"
                >Change The Plan</v-btn>
              

              <!-- package details -->
              <div class="points mt-4">
                <div
                  class="point  mb-2"
                >
                  
                  <article v-if="type == '2'">
                    <h3>Price annually</h3>
                    <p class="mb-0">
                     {{ package?.Price_annually }}
                    </p>
                  </article>
                  <article v-else>
                    <h3>Price monthly</h3>
                    <p class="mb-0">
                      {{ package?.Price_monthly }}
                    </p>
                 </article>
                 <article>
                    <h3>custom branding</h3>
                    <p class="mb-0">
                      {{ package?.custom_branding }}
                    </p>
                  </article>
                  <article>
                    <h3>interactive archives</h3>  
                    <p class="mb-0">
                      {{ package?.interactive_archives}}
                    </p>
                 </article>
                 <article>
                  <h3>main search</h3>
                  <p class="mb-0">
                    {{ package?.main_search }}
                  </p>
                </article>
                <article>
                  <h3>main show</h3>
                  <p class="mb-0">
                    {{ package?.main_show }}
                  </p>
                </article>
                <article>
                  <h3> priority</h3>
                  <p class="mb-0">
                   {{ package?.priority }}
                  </p>
                </article>
                <article>
                  <h3>statics</h3>
                  <p class="mb-0">
                    {{ package?.statics }}
                  </p>
                </article>
                <article  v-if="type == '2'">
                  <h3>storage annually</h3>
                  <p class="mb-0">
                    {{ package?.storage_annually}}
                  </p>
                </article>
                <article v-else>
                  <h3>storage monthly</h3>
                  <p class="mb-0">
                    {{ package?.storage_monthly }}
                  </p>
                </article>      
                <article>
                  <h3>Messages</h3>
                  <p class="mb-0">
                    {{ package?.messages}}
                  </p>
                </article>
                </div>
              </div>
            </div>
          </div>
       



                <!------------------------------------------------------>

                
              </v-card>
  
             
            </div>
  
            <div class="col-lg-6 col-md-12 col-12">
              <!-- payment methods -->
              <div class="payment-methods mt-3">
                <div class="d-flex gap-2 align-items-center">
                  <!-- cash payment -->
  
                  <!----
                   hashed toggle way 
                  <div
                    class="card d-flex justify-content-center align-items-center p-2 w-100"
                    :class="cash == 'wallet' ? 'active-method' : 'method-card'"
                    @click="cash = 'wallet'"
                  >
                    <div class="text-center d-flex gap-2 align-items-center">
                      hashed <img
                        src="../assets/images/cash_8993357.png"
                        width="30"
                        height="30"
                        alt=""
                        class=""
                      /> 
                      <h6 class="m-0 fw-bold">Cash Payment</h6>
                    </div>
                  </div>
                -->
  
                  <!-- online payment -->
  
                  <!----
                  <div
                    class="card method-card d-flex justify-content-center align-items-center p-2 w-100"
                    @click="cash = 'card'"
                    :class="cash == 'card' ? 'active-method' : 'method-card'"
                  >
                    <div class="text-center d-flex align-items-center gap-2">
                      hashed image <img
                        src="../assets/images/shopping_13639761.png"
                        width="30"
                        height="30"
                        alt=""
                        class=""
                      /> 
                      <h6 class="fw-bold m-0">Online Payment</h6>
                    </div>
                  </div>
                -->
                </div>
              </div>
  
              <!-- wallet form -->
              <div class="form mt-4" v-if="cash == 'wallet'">
                <div class="card rounded-2 p-3">
                  <div class="card-title fw-bold text-center">
                    <h4>
                      Please Send this amount
                      <span v-if="type == 1" class="fw-bold text-success">
                        {{ valueMonth }} EGP
                      </span>
                      <span v-if="type == 2" class="fw-bold text-success">
                        {{ valueYear }} EGP
                      </span>
                      <span v-if="type == ''" class="fw-bold text-success">
                        (select_plan...)
                      </span>
                      payment and upload the receipt
                    </h4>
  
                    <div
                      class="d-flex gap-1 align-items-center justify-content-center"
                    >
                      <div class="d-flex gap-1 align-items-center">
                        <img
                          src="../assets/images/vodafone-cash.png"
                          width="50"
                          alt=""
                        />
                        <h4 class="fw-bold">+994 5567 23</h4>
                      </div>
                    </div>
                  </div>
  
                  <div class="row g-3">
                    <div class="col-12">
                      <label
                        for="name"
                        class="form-label text-dark fw-semibold mb-1"
                      >
                        Amount :</label
                      >
  
                      <input
                        class="form-control rounded-5 py-2"
                        type="text"
                        v-model="amount"
                        disabled="disable"
                      />
                    </div>
  
                    <div class="col-12">
                      <label
                        for="name"
                        class="form-label text-dark fw-semibold mb-1"
                      >
                        Receipt :</label
                      >
  
                      <input
                        type="file"
                        class="form-control rounded-5"
                        id="inputGroupFile01"
                        v-on:change="receiptError = ''"
                      />
                      <p class="text-error"> {{ receiptError }} </p>
                    </div>
                  </div>
  
                  <input
                    type="button"
                    class="btn btn-primary mt-3 text-white"
                    value="Submit"
                  />
                </div>
              </div>
  
              <!-- stripe form -->
              <div v-if="cash == 'card'">



                 <!-- subdomain card -->
              <v-card class="p-3 mt-3 payment-card border-1" elevation="0">
                <!-- check subdomain button -->
                <div>
                  <div class="check-input row">


                    <a data-v-25880f80="" href="/" class="pb-4 d-block mb-4  logo">
                        <img data-v-25880f80="" src="/src/assets/images/logos/logo.png" class="logo" alt="">
                    </a>

                  
                  <div>
                    <label for="domain" class="mb-2 mt-4 fw-semibold">
                      Enter domain name
                    </label>
                    <input
                      class="form-control rounded-5 py-2 w-full"
                      v-model="subDomain"
                      type="text"
                      required
                      placeholder="Dmain name less than 10 chracters"
                      v-on:change="domainError = ''"
                      name="domain"
                    />
                  </div>
                  <p :class="[ 'text-error' ,  domainError===''? 'd-none' : '']"> {{ domainError }} </p>
                </div>
                  
                  <!-- <p :class="color" class="pt-2">{{ errorMsg }}</p> -->
  
                  <div>
                    <!-- select plan -->
                    <label for="domain" class="mb-2 mt-4 fw-semibold">
                        Select your Plan
                      </label>
                    <select
                      class="form-select rounded-5  col col-12"
                      aria-label="Default select example"
                      v-model="type"
                      v-on:change="planError = ''"
                      required
                    >
                      <option value="" selected>Select Your Plan</option>
                      <option value="1">Monthly</option>
                      <option value="2">Yearly</option>
                    </select>
                    <p :class="[ 'text-error' ,  planError===''? 'd-none' : '']"> {{ planError }} </p>
                  </div>
                </div>

                <div class="mt-0">
                  
                    <div class="mt-0 bg-white  rounded-4">
                        <div class="">
                            <form class=" p-3">
                                <div id="card-element">
                                    
                                </div>
                            </form>
                        </div>

                        <div class="row justify-center gap-3 mb-4 " v-if="isStripeShowen">
                            <button class="btn btn-success d-block col-12 col-sm-6"  @click="handleStripePayment">
                            Confirm Payment
                            </button>
    
                            <button class="btn btn-danger d-block col-12 col-sm-5">Cancel</button>
                        </div>
                    </div>



                    <div class="pb-2">
                        <h3>For communication</h3>
                        <ul>
                            <li class="mb-2">
                                <span class="pr-1">Phone </span>
                                <a class="fw-semibold" href="tel:01110010489"> 01110010489</a>
                            </li>
                            <li>
                                <span class="pr-1">Gmail </span>
                                <a class="fw-semibold" href="#"> omaradelbakry375@gmail.com</a>
                            </li>
                        </ul>
                    </div>


                    <input
                        class="w-100 btn proceed text-white"
                        value="Proceed to Payment"
                        type="button"
                        @click="proceedToPayment"
                    />
  
                  <div
                    class="text-center text-primary fs-5 mt-3"
                    v-if="isLoading"
                  >
                    Loading...
                  </div>
                  <!-- <p class="text-danger text-center pt-3">
                    {{ domainMsg }}
                  </p> -->
                </div>

                <!----
                <input
                  class="btn btn-primary w-100 elevation-0 mt-2 text-white"
                  type="button"
                  value="submit"
                />
              -->
              </v-card>
  
              <RatingAlert/>
                
              </div>
  
              <!-- customer servece -->
              
            </div>
          </div>
        </div>
      </div>
    </div>

  </template>
  

  <script>
  import axios from 'axios';
  import { extrnalUrl } from '@/config';
  import { loadStripe } from '@stripe/stripe-js';
  import { useRoute, useRouter } from 'vue-router';
  import { toast } from 'vue3-toastify';
  import 'vue3-toastify/dist/index.css';

  import RatingAlert from '@/components/checkout/RatingAlert.vue';

  export default {

  beforeRouteEnter(to, from, next) {
    if (!localStorage.getItem('authUser') || localStorage.getItem('authUser') == 'undefined') {
      next('/login'); 
    }else{
      next()
    }
  },

   components:{RatingAlert},
    name: "checkout",
    data: () => ({
      subDomain: "",
      errorMessage: "",
      mark: false,
      disable: true,
      errorMsg: "",
      color: "",
      res: {},
      cash: "card",
      isOpen: false,
      type: "",
      amount: "",
      image: null,
      plan: {},
      walletPhone: "",
      isPaying: false,
      domainMsg: "You must enter a valid sub domain first.",
      loader: false,
      valueMonth: 300,
      valueYear: 3000,
  
      domainError:"",
      planError:"",
      receiptError:"", 
  
      package : {},
  
      // stripe data
      paymentIntentId: "",
      paymentIntent: "",
      clientSecret: "",
  
      stripe: null,
      cardElement: null,
      stripeKey:"pk_test_51OOMOtK2t4I8yGl8aqXfrvJOdLScxRJ34dCEdYRaMpwuwvaxOBDLf3SdRmUXCAHlLsG8LbTprI8IB5h8llHZLmUc007scTeX5f",
      route:useRoute(),
      router:useRouter(),
      isStripeShowen:false,
    }),
  
    methods : {

      notify(){
       return toast("Wow so easy !", {
          autoClose: 1000,
        }); // ToastOptions
      },
      
      getSinglrPackage () {
  
        axios.get(`${extrnalUrl}packages/${this.route.params.packageId}`, {
          headers : {
            Authorization : `Bearer ${localStorage.getItem("token")}`
          }
        }).then((response) => {
          this.package = response.data.data.package_details;
          this.package.user = localStorage.getItem('authUser') ? JSON.parse(localStorage.getItem('authUser')) :  null;
          this.valueYear = this.package.price_monthly;
          this.valueMonth = this.package.Price_monthly;
          console.log("single package", this.package);
        })
      },
      
      checkStripeFields(){
          if (this.subDomain === '') {
            this.domainError = 'Fill this field.';
          }
          if (this.subDomain.length > 10) {
            this.domainError = 'Domain name cannot be greater than 10 chras'
          }
          if (this.type === '') {
            this.planError = 'Fill this field.';
          }
  
          if (this.subDomain === '' || this.type === '') {
            return false
          }
  
          return true
      },
  
      handleStripePayment() {
          this.loader = true;
  
          this.stripe
            .confirmCardPayment(this.clientSecret, {
              payment_method: {
                card: this.cardElement,
              },
            })
            .then(()=>{
              return axios.post(extrnalUrl + "payment/complete", {
                  headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                  },
                  params: {
                    id: this.paymentIntentId,
                    payment_intent: this.payment_intent_id,
                    client_secret: this.client_secret,
                  },
                });
            })
            .then((response)=> {
              if (response.status == 200) {
                router.push('/success')
              }else{
                toast.error('dddddddddddd');
                console.log(response);
                
              }
            })
            .catch((error) => {
              console.error(error);
              toast.error(error.response.statusText);
            });
      },
      proceedToPayment() {
        // this.isLoading = true;

        const isFeildsFill = this.checkStripeFields();

        if (!isFeildsFill) {
          return false
        }

        const amount =
          this.type == "1"
            ? this.package.price_monthly
            : this.package.price_annually;

        axios
          .post(
            `${extrnalUrl}payment/initiate`,
            {
              package_id : this.package.id,
              package_type: this.type,
              domain_name: this.subDomain,
              user_id:this.package.user.id
            },
            {
              headers: {
                Authorization: `Bearer ${localStorage.getItem("token")}`,
              },
            }
          )
          .then((response) => {

            if (response.status != 200) {
              console.log('not 200');
              
              return Promiserr.reject(error);
            }

            this.isPaying = true;
            // this.isLoading = false;

            this.paymentIntentId = response.data.data.id;
            this.paymentIntent = response.data.data.payment_intent;
            this.clientSecret = response.data.data.client_secret;

            // Initialize Stripe
            return loadStripe(this.stripeKey);
          })
          .then((stripe) => {
            this.stripe = stripe;
            const elements = this.stripe.elements();
            this.cardElement = elements.create("card");
            this.cardElement.mount("#card-element");
            this.isStripeShowen = true
          })
          .catch((error) => {
            console.error('Error............' , error);
            this.paymentError = error.message || "An error occurred during payment processing.";
            return Promiserr.reject(error);
          });
    },
    }, 

  
    mounted () {
      this.getSinglrPackage();
    },

  
  
  
    //   components: {
    //     Loader,
    //   },
  
    //   computed: {
    //     ...mapState(useAuthStore, ["user"]),
    //   },
  
    //   methods: {
    //     domainAlert() {
    //       this.domainMsg = "You must enter a valid domain";
    //     },
  
    //     confirmDomain() {
    //       axios
    //         .post(
    //           `${url}/admin/check-subdomain`,
    //           { name: this.subDomain },
    //           {
    //             headers: {
    //               Authorization: `Bearer ${localStorage.getItem("token")}`,
    //             },
    //           }
    //         )
    //         .then((response) => {
    //           this.res = response.data;
    //           if (response.data == false) {
    //             this.errorMsg = "This is Valid Sub Domain.";
    //             this.color = "text-success";
    //             this.disable = false;
    //           }
    //         })
    //         .catch((error) => {
    //           this.errorMsg = error.response.data.message;
    //           this.color = "text-danger";
    //           this.disable = true;
    //           this.loader = false;
    //           console.log("error", error);
    //         });
    //     },
  
    //     handleImage(e) {
    //       this.image = e.target.files[0];
    //     },
  
    //     // wallet payment
    //     postWallet() {
    //       this.errorMessage = "";
    //       if (this.plan.id == 1) {
    //         this.loader = true;
  
    //         this.confirmDomain();
  
    //         axios
    //           .post(
    //             `${url}/admin/checkout-subdomain`,
    //             { id: localStorage.getItem("packageId"), name: this.subDomain },
    //             {
    //               headers: {
    //                 Authorization: `Bearer ${localStorage.getItem("token")}`,
    //               },
    //             }
    //           )
    //           .then((response) => {
    //             console.log("response", response);
    //             localStorage.setItem(
    //               "user",
    //               JSON.stringify(response.data.data.user)
    //             );
    //             localStorage.setItem(
    //               "manasa",
    //               JSON.stringify(this.user?.drosat?.name)
    //             );
    //             localStorage.setItem(
    //               "drosat",
    //               JSON.stringify(response.data.data.drosat)
    //             );
  
    //             this.$router.push(`/pricing/${localStorage.getItem("packageId")}`);
  
    //             this.loader = false;
  
    //             setTimeout(() => {
    //               window.location.reload();
    //             }, 500);
    //           })
    //           .catch((error) => {
    //             this.errorMessage = error.response.data.message;
    //             this.loader = false;
    //           });
    //       } else {
    //         this.errorMessage = "";
  
    //         const formData = new FormData();
  
    //         formData.append("id", localStorage.getItem("packageId"));
    //         formData.append("name", this.subDomain);
    //         formData.append("type", this.type);
    //         formData.append("method", "Wallet");
    //         formData.append("amount", this.amount);
    //         formData.append("receipt", this.image);
  
    //         this.loader = true;
  
    //         axios
    //           .post(`${url}/admin/checkout-subdomain`, formData, {
    //             headers: {
    //               Authorization: `Bearer ${localStorage.getItem("token")}`,
    //             },
    //           })
    //           .then((response) => {
    //             console.log("response", response);
    //             localStorage.setItem(
    //               "user",
    //               JSON.stringify(response.data.data.user)
    //             );
    //             localStorage.setItem(
    //               "manasa",
    //               JSON.stringify(this.user?.drosat?.name)
    //             );
    //             localStorage.setItem(
    //               "drosat",
    //               JSON.stringify(response.data.data.drosat)
    //             );
  
    //             this.$router.push(`/pricing/${localStorage.getItem("packageId")}`);
  
    //             this.loader = false;
  
    //             setTimeout(() => {
    //               window.location.reload();
    //             }, 500);
    //           })
    //           .catch((error) => {
    //             this.errorMessage = error.response.data.message;
    //             this.loader = false;
    //           });
    //       }
    //     },
  
    //     // git single plan
    //     getPlan() {
    //       axios
    //         .get(`${url}/drosat/package/${localStorage.getItem("packageId")}`)
    //         .then((response) => {
    //           this.plan = response.data.data.Package;
    //           this.valueMonth =
    //             response.data.data.Package.package_details.price_monthly;
    //           this.valueYear =
    //             response.data.data.Package.package_details.price_annually;
  
    //           console.log("plan", this.plan);
    //           console.log(this.valueMonth);
    //           console.log(this.valueYear);
    //         })
    //         .catch((error) => {
    //           console.error("Login error:", error);
    //         });
    //     },
  
    //     // git phone number
    //     getPhoneNumber() {
    //       axios.get(`${url}/drosat/setting`).then((response) => {
    //         this.walletPhone = response.data.data.setting.phone;
    //       });
    //     },
  
    //     // process to payment
  
  
    //     // handle payment
    //     handleStripePayment() {
    //       this.loader = true;
  
    //       this.stripe
    //         .confirmCardPayment(this.clientSecret, {
    //           payment_method: {
    //             card: this.cardElement,
    //           },
    //         })
    //         .then(({ error, paymentIntent }) => {
    //           if (error) {
    //             console.error(error);
    //             alert("Payment failed");
    //           } else if (paymentIntent.status === "succeeded") {
    //             return axios.get(url + "/admin/payment-success", {
    //               headers: {
    //                 Authorization: `Bearer ${localStorage.getItem("token")}`,
    //               },
    //               params: {
    //                 id: this.paymentIntentId,
    //                 payment_intent: this.paymentIntent,
    //                 client_secret: this.clientSecret,
    //               },
    //             });
    //           }
    //         })
    //         .then((response) => {
    //           if (response) {
    //             // window.location.reload();
  
    //             localStorage.setItem(
    //               "user",
    //               JSON.stringify(response.data.data.user)
    //             );
  
    //             if (this.user?.drosat?.name) {
    //               localStorage.setItem(
    //                 "manasa",
    //                 JSON.stringify(this.user.drosat.name)
    //               );
    //             }
  
    //             this.$router.push(`/pricing/${localStorage.getItem("packageId")}`);
  
    //             this.loader = false;
  
    //             setTimeout(() => {
    //               window.location.reload();
    //             }, 500);
    //           }
    //         })
    //         .catch((error) => {
    //           console.error(error);
    //           alert("Failed to complete payment");
    //         });
    //     },
    //   },
    //   watch: {
    //     // Watch for changes in the 'type' value (plan type)
    //     type(newValue) {
    //       if (newValue == 1) {
    //         // User selected Monthly
    //         this.amount = this.valueMonth;
    //       } else if (newValue == 2) {
    //         // User selected Yearly
    //         this.amount = this.valueYear;
    //       } else {
    //         this.amount = ""; // Reset amount if no valid plan type is selected
    //       }
    //     },
    //   },
  
    //   mounted() {
    //     this.getPlan();
    //     this.getPhoneNumber();
    //   },
  };
  </script>





<style lang="scss" scoped>
    .top-left{
        border-radius: .5rem;
        background: var(--bs-primary);
        background-color:#fff;
        border: 1px solid var(--bs-primary);


        .top-left__header{
            position: relative;
            overflow: hidden;
            padding: 4px 25px 4px 80px;
            font-size: 1.5rem;
            z-index: 0;
            
            
            .triangle{
                position: absolute;
                top: 50%;
                left: -10px;
                width: 100px;
                height:100px;
                background-color:var(--bs-primary);
                transform: rotateZ(140deg)translateY(70%);
                z-index: -1;
            }

            .square{
                position: absolute;
                top:0;
                right: -10px;
                width: 25px;
                height:100%;
                background-color:var(--bs-primary);

                z-index: -1;
            }

            h1{
                padding: 0;
                margin: 0;
                font-size: 1.5rem;
                display: flex;
                align-items: center;
                justify-content: space-between;

                span:last-of-type{
                    padding-top: 4px;
                }
            }

            img{
                position: absolute;
                top: 50%;
                left: 20px;
                transform: translateY(-50%);
                max-width: 25px;
                z-index: 1;
            }
        }

        
    }
</style>

<style lang="scss" scoped>
.proceed{
    background-color: var(--bs-primary) ;
    border: 1px solid var(--bs-primary);
    &:hover{
        color: var(--bs-primary) !important;
        background-color:#fff ;
    }
}
</style>


<style  lang="scss" scoped>

.logo{
  width: fit-content;
  margin-bottom: .75rem;
}

article{
  display: flex;
  align-items: center;
  padding-left: .5rem;
  gap: 7px;

  h3{
    width: 100%;
    margin: 0;
    padding: .75rem 0 .75rem;
    font-size: .925rem;
    font-weight: 500;

    border-bottom: 1px solid #eee;
    color: #1c1c1c;

    display: flex;
    justify-content: space-between;
  }

  p{
    margin-block-start:0;
    margin-block-end:0;
    font-weight: 500;
  }
}

</style>


  
  <style lang="scss" scoped>
  .contact-card {
    box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px !important;
  }
  
  .payment-card {
    box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px !important;
  }
  
  .line {
    h6 {
      color: #939191;
    }
  }
  
  .method-card {
    background-color: #1869cc1f !important;
    cursor: pointer;
  }
  
  .active-method {
    background-color: var(--bs-primary) !important;
    border: 1px solid #dddd !important;
    color: var(--bs-white) !important;
    cursor: pointer;
  }
  
  .text-error{
    font-size: 12px;
    color: red;
    font-weight: 500;
    padding: 4px 0 4px 1.5rem !important;
    &.hidden{
      display: none;
    }
  }
  
  .InputElement{
    padding: .5rem !important;
    border: 1px solid #000 !important;
    font-size: 3rem !important;
  }
  </style>
  