<template>
  <div class="package mt-4">
    <div class="col-10 mr-auto ml-auto">
      <div class="row gy-3">
        <!-- button to switch packages -->

        <div class="d-flex justify-content-center mt-6">
          <div
            class="button-switch d-flex gap-3 align-items-center position-relative"
          >
            <span>Pay Monthly </span>

            <div class="form-check form-switch">
              <input
                class="form-check-input"
                type="checkbox"
                role="switch"
                v-model="active"
                id="flexSwitchCheckDefault"
              />
            </div>

            <img
              src="../assets/images/arrow.svg"
              class="arrow"
              alt=""
              loading="lazy"
            />

            <p class="mb-0 text-primary position-absolute right-0 descount">
              Save 25%
            </p>
            <span>Pay Yearly</span>
          </div>
        </div>

        <div
          class="col-lg-4 col-md-12 col-12 plan"
          v-for="(item, index) in toRaw(data)"
          :key="index"
        >
          <div
            class="card border-0"
            :class="['', index === 1 ? 'recommended-package' : '']"
          >
            <div class="card-body">
              <h4>{{ item.title }}</h4>
              <p>
                {{ item?.description }}
              </p>

              <h3 class="price" v-if="active == false">
                ${{ item?.package_details?.Price_monthly }} <sub>/Month</sub>
              </h3>

              <h3 class="price" v-if="active == true">
                ${{ item?.package_details?.Price_annually }} <sub>/Year</sub>
              </h3>

              <v-btn
                :class="{
                  'text-white': index == 1,
                  'text-primary': index == 0 || index == 2,
                }"
                @click="$router.push({name : 'stripe' , params : {packageId : item.id }})"
                class="text-capitalize elevation-0 mt-3 w-100"
                variant="outlined"
                >get start now</v-btn>
              

              <!-- package details -->
              <div class="points mt-4">
                <div
                  class="point  mb-2"
                >
                  
                  <article v-if="active == true">
                    <h3>Price annually </h3>
                    <p class="mb-0">
                     {{ item?.package_details?.Price_annually }}
                    </p>
                  </article>
                  <article v-else>
                    <h3>Price monthly </h3>
                    <p class="mb-0">
                      {{ item?.package_details?.Price_monthly }}
                    </p>
                 </article>
                 <article>
                    <h3>custom branding </h3>
                    <p class="mb-0">
                      {{ item?.package_details?.custom_branding }}
                    </p>
                  </article>
                  <article>
                    <h3>interactive archives </h3>  
                    <p class="mb-0">
                      {{ item?.package_details?.interactive_archives}}
                    </p>
                 </article>
                 <article>
                  <h3>main search </h3>
                  <p class="mb-0">
                    {{ item?.package_details?.main_search }}
                  </p>
                </article>
                <article>
                  <h3>main show </h3>
                  <p class="mb-0">
                    {{ item?.package_details?.main_show }}
                  </p>
                </article>
                <article>
                  <h3> priority </h3>
                  <p class="mb-0">
                   {{ item?.package_details?.priority }}
                  </p>
                </article>
                <article>
                  <h3>statics </h3>
                  <p class="mb-0">
                    {{ item?.package_details?.statics }}
                  </p>
                </article>
                <article  v-if="active == true">
                  <h3>storage annually </h3>
                  <p class="mb-0">
                    {{ item?.package_details?.storage_annually}}
                  </p>
                </article>
                <article v-else>
                  <h3>storage monthly </h3>
                  <p class="mb-0">
                    {{ item?.package_details?.storage_monthly }}
                  </p>
                </article>      
                <article>
                  <h3>Messages </h3>
                  <p class="mb-0">
                    {{ item?.package_details?.messages}}
                  </p>
                </article>
                </div>
              </div>
            </div>
          </div>
        </div>

        
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, toRaw } from "vue";
import { url } from "@/config";
import axios from "axios";
import fetchPageData from "@/api/get/fetchPageData";
import { useRouter } from "vue-router";

const active = ref(true);


const data = ref(null);
const router = useRouter();


// const navigateToCheckout = (id) => {
//   console.log(`${id}`);
  
//   router.push(`/check-out/${id}`);
// };

onMounted(async() => {
 try {
    data.value = await fetchPageData('packages');
    console.log(data.value);
    
  } catch (error) {
    console.error("Error fetching page data:", error);
  }
});
</script>

<style lang="scss" scoped>

.plan{
 border: 1px solid #eee;
 border-radius: 15px;

 p{
  color: #555;
 }

 &:has(.recommended-package){
  border: none;
  p{
    color: #fff;
  }
 }
}

article{
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: .75rem;
  padding-left: .5rem;
  gap: 7px;

  h3{
    margin: 0;
    padding: 0;
    font-size: .925rem;
    font-weight: 500;
    //color: #1c1c1c;
  }

  p{
    margin-block-start:0;
    margin-block-end:0;
    font-weight: 500;
  }
}






.price {
  sub {
    color: #4b5768;
    font-size: 15px;
  }
}

.points {
  .point {
    p {
      font-size: 15px;
    }
  }
}

.descount {
  top: -20px;
}

.arrow {
  width: 50px;
  position: absolute;
  right: 69px;
  top: -35px;
}

.recommended-package {
  border: none;
  background-color: var(--bs-primary);
  color: var(--bs-white);
  box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
  border-radius: 15px;
  h3 {
    sub {
      color: var(--bs-white);
    }
  }

  .points {
    .point {
      img {
        background-color: var(--bs-white);
        padding: 2px;
        border-radius: 50%;
      }
    }
  }
}
</style>
