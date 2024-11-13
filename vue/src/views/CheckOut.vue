<template>
    <div class="payment-page pt-5 pb-5 container">
      <div class="row g-3">
        <!-- left section -->
        <div class="col-lg-12">
          <!-- drosat logo  -->
          <h2 class="fw-bold">Kashear Checkout</h2>
  
          <!-- breadcrump -->
          <div class="bread-crumb d-flex align-items-center">
            <router-link to="/" class="text-black text-decoration-none"
              >Kashear</router-link
            >
            <v-icon>mdi-chevron-right</v-icon>
            <router-link class="text-black text-decoration-none"
              >Checkout
            </router-link>
          </div>
  
          <div class="row">
            <div class="col-lg-6 col-md-12 col-12">
              <!-- payment card -->
              <v-card class="p-3 mt-3 payment-card border-1" elevation="0">
                <!-- package name -->
                <h4 class="text-center fw-bold mb-4 mt-2">Package Name</h4>
  
                <div
                  class="d-flex flex-lg-row flex-md-column flex-column text-md-center text-lg-start text-center justify-content-between"
                >
                  <!-- left side -->
                  <div class="left-side pb-lg-0 pb-md-4 pb-4">
                    <h5 class="fw-bold">Payment Amount</h5>
                    <p class="mb-0">
                      All Transactions Are Secure <br />
                      in both ways card and cash payment
                    </p>
                  </div>
  
                  <!-- Amount per year and per month -->
                  <div
                    class="right-side d-flex gap-4 align-items-center justify-content-center"
                  >
                    <!-- month -->
                    <div class="text-center">
                      <v-progress-circular
                        :model-value="package.Price_monthly"
                        :rotate="360"
                        :size="70"
                        :width="2"
                        color="yellow"
                      >
                        <template v-slot:default> {{ package.Price_monthly }} LE</template>
                      </v-progress-circular>
                      <p class="mb-0 pt-2">Month</p>
                    </div>
  
                    <!-- year -->
                    <div class="text-center">
                      <v-progress-circular
                        :model-value="package.Price_annually"
                        :rotate="360"
                        :size="70"
                        :width="2"
                        color="yellow"
                      >
                        <template v-slot:default> {{ package.Price_annually }} LE</template>
                      </v-progress-circular>
                      <p class="mb-0 pt-2">Year</p>
                    </div>
                  </div>
                </div>
              </v-card>
  
              <!-- subdomain card -->
              <v-card class="p-3 mt-3 payment-card border-1" elevation="0">
                <!-- check subdomain button -->
                <div>
                  <div class="check-input">
                  <label
                    for="subDomain"
                    class="form-label text-dark fw-semibold mb-2 mt-3"
                  >
                    Enter Sub Domain* :</label
                  >
                  
                  <div class="d-flex gap-2 align-items-center">
                    <input
                      class="form-control rounded-5 py-2"
                      v-model="subDomain"
                      type="text"
                      required
                      v-on:change="domainError = ''"
                    />
                  </div>
                  <p class="text-error"> {{ domainError }} </p>
                </div>
                  
                  <!-- <p :class="color" class="pt-2">{{ errorMsg }}</p> -->
  
                  <!-- select plan -->
                  <label
                    for="subDomain"
                    class="form-label text-dark fw-semibold mb-2 mt-3 d-flex justify-content-between align-items-center"
                  >
                    <span>Select Plan* :</span>
                    <span v-if="type == 1" class="fw-bold text-success pe-4"
                      >{{ valueMonth }} LE</span
                    >
                    <span v-if="type == 2" class="fw-bold text-success pe-4"
                      >{{ valueYear }} LE</span
                    >
                  </label>
  
                  <select
                    class="form-select rounded-5 pt-2"
                    aria-label="Default select example"
                    v-model="type"
                    v-on:change="planError = ''"
                    required
                  >
                    <option value="" selected>Select Your Plan</option>
                    <option value="1">Monthly</option>
                    <option value="2">Yearly</option>
                  </select>
  
                  <p class="text-error"> {{ planError }} </p>
                </div>
                <!----
                <input
                  class="btn btn-primary w-100 elevation-0 mt-2 text-white"
                  type="button"
                  value="submit"
                />
              -->
              </v-card>
  
              <v-btn
                class="elevation-0 mt-4 bg-primary text-capitalize d-lg-flex d-md-none d-none"
                prepend-icon="mdi-chevron-left"
                @click="$router.push('/')"
                >Go Back</v-btn
              >
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
                <div class="mt-0">
                  <input
                    class="w-100 btn btn-warning text-white"
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
                  <p class="text-danger text-center pt-3">
                    {{ domainMsg }}
                  </p> 
               
                </div>
  
                <div class="mt-3 bg-white p-3 rounded-4">
                  <div class="d-flex gap-5">
                    <form class="mt-3">
                      <div id="card-element">
  
                      </div>
                      <div class="d-flex justify-content-center gap-3 mt-4">
                        <button class="btn btn-primary" type="submit">
                          Confirm Payment
                        </button>
  
                        <div class="btn btn-danger">Cancel</div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
  
              <!-- customer servece -->
              <h6 class="fw-bold pt-3">
                <div
                  class="phone d-flex align-items-center gap-2 justify-content-center"
                >
                  <span class="text-center">
                    For Customer Servece :
                    <a href="tel:01110010489" class="text-primary">
                      <v-icon size="small" color="green">mdi-phone</v-icon
                      >01110010489</a
                    >
                    <br />
                    <span>OR</span>
                    <br />
                    <a href="mailto:omaradelbakry375@gmail.com">
                      <v-icon size="small" color="green">mdi-email</v-icon>
                      omaradelbakry375@gmail.com</a
                    >
                  </span>
                </div>
              </h6>
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
  export default {
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
      domainMsg: "",
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
      stripeKey: 'process.env.STRIPE_KEY'
        
    }),
  
    methods : {
      getSinglrPackage () {
        axios.get(`${extrnalUrl}packages/${this.$route.params.packageId}`, {
          headers : {
            Authorization : `Bearer ${localStorage.getItem("token")}`
          }
        }).then((response) => {
          this.package = response.data.data.package_details;
          this.valueYear = this.package.Price_annually;
          this.valueMonth = this.package.Price_monthly;
  
          console.log("single package", this.package)
        })
      },
  
      checkStripeFields(){
          if (this.subDomain === '') {
            this.domainError = 'Fill this field.';
          }
  
          if (this.type === '') {
            this.planError = 'Fill this field.';
          }
  
          if (this.subDomain === '' || this.type === '') {
            return false
          }
  
          return true
      },
  
      proceedToPayment() {
          // this.isLoading = true;
            console.log('hit');
            
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
                
               // return Promiserr.reject(error);
              }
  
              this.isPaying = true;
              // this.isLoading = false;

              console.log(response);
              
  
              this.paymentIntentId = response.data.data.id;
              this.paymentIntent = response.data.data.payment_intent;
              this.clientSecret = response.data.data.client_secret;
  
              // Initialize Stripe
              return loadStripe(process.env.STRIPE_KEY);
            })
            .then((stripe) => {
              this.stripe = stripe;
              const elements = this.stripe.elements();
              this.cardElement = elements.create("card");
              this.cardElement.mount("#card-element");
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
    padding: 4px 0 4px .5rem !important;
    margin-top: 4px;
  }
  
  .InputElement{
    padding: .5rem !important;
    border: 1px solid #000 !important;
    font-size: 3rem !important;
  }
  </style>
  