<template>
  <div class="why-us">
    <div class="container">
      <div class="title text-center">
        <h1>{{ data?.features[0]?.main_title }}</h1>
        <div class="w-100 d-flex justify-content-center">
          <p class="w-lg-50 w-md-100" v-html="data?.features[0]?.main_description">
          </p>
        </div>
      </div>

    
      
      <div class="row gy-3">
        <div
          class="col-lg-4 col-md-12 col-12"
          v-for="(future, index) in toRaw(data?.features[0]?.features)"
          :key="index"
        >
          <div
            class="border-0 text-center"
            :class="{ 'text-white': index == 0 && pageSize > 992 }"
          >
            <div class="card-body">
              <img
                :src="future?.image"
                width="60"
                height="60"
                alt=""
                loading="lazy"
              />

              <h3>{{ future?.title }}</h3>

              <p v-html="future?.description"></p>
            </div>
          </div>
        </div>
      </div>
     
     
     
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, toRaw } from "vue";
import { useSidebarWidth } from "@/compasaples/media";
import fetchPageData from "@/api/get/fetchPageData";

const { pageSize } = useSidebarWidth();
const data = ref(null)

onMounted(async () => {
  try {
    data.value = await fetchPageData('features');
  } catch (error) {
    console.error("Error fetching page data:", error);
  }
});
</script>



<style lang="scss" scoped>
.why-us {
  background-image: url(../../assets/images/why-us.svg);
  padding-bottom: 230px;
  background-size: 500px;
  background-position-x: left;
  .row {
    padding-top: 100px;
  }
}

@media (max-width: 767px) {
  .title {
    h1 {
      font-size: 26px;
    }

    p {
      font-size: 14px;
    }
  }

  .why-us {
    padding-bottom: 100px;
    background-image: none;
    .row {
      padding-top: 50px;
    }
  }
}

@media (min-width: 768px) and (max-width: 991px) {
  .why-us {
    background-image: none;
    .row {
      padding-top: 50px;
    }
  }
}

// @media (min-width: 1850px) {
//   .why-us {
//     background-image: none;
//   }
// }
</style>
