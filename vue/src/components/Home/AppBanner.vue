<template>
  <section class="banner">
    <div
      class="container h-70 d-flex flex-lg-row flex-md-column-reverse flex-column-reverse align-items-center"
    >
      <div class="banner-text">
        <h1 class="mb-0">{{ data?.title }}</h1>
        <p class="mb-0 mt-4" v-html="data?.description">
       
        </p>

        <div class="buttons d-flex gap-3 align-items-center mt-4">
          <v-btn class="elevation-0 text-capitalize rounded-5" color="#000"
            >Start Now</v-btn
          >

          <v-btn
            class="elevation-0 text-capitalize rounded-5"
            variant="outlined"
            color="#000"
            >Contact Us</v-btn
          >
        </div>
      </div>

      <div class="banner-image">
       <img src="../../assets/images/machene2.png" alt="" />
       <!---- <img :src="data?.image" alt="">-->
      </div>
    </div>
  </section>
</template>



<script setup>
import { ref, onMounted, toRaw } from "vue";
import fetchPageData from "@/api/get/fetchPageData";

const data = ref(null);

onMounted(async () => {
  try {
    data.value = await fetchPageData('homecovers');
  } catch (error) {
    console.error("Error fetching page data:", error);
  }
});

</script>

<style lang="scss" scoped>
.banner {
  height: 100vh;
  padding-top: 270px !important;
  background-image: url(../../assets/images/banner-svg.svg);
  background-repeat: no-repeat;
  background-position-x: right;
  background-size: contain;
  position: relative;
  top: -100px;
}

.banner-image {
  img {
    position: relative;
    right: -96px;
    top: -19px;
    width: 689px;
  }
}

.banner-text {
    position: relative;
    top: -95px;
    @media (min-width:900px){
      top: -45px;
      min-width:350px;
    }

    @media (min-width:1200px){
      min-width:600px;
    }
  }

@media (max-width: 767px) {
  .banner {
    background-size: 36rem;
  }

  .banner-image {
    img {
      right: -2px;
      top: -154px;
      width: 455px;
    }
  }
}

@media (min-width: 768px) and (max-width: 991px) {
  .banner {
    background-size: 36rem;
    min-width: 600px;
  }

  .banner-image {
    img {
      width: 825px;
      right: -36px;
      top: -127px;
    }
  }

  .banner-text {
    position: relative;
    top: -95px;
  }
}

@media (min-width: 1820px) {
  .banner-image {
    img {
      width: 831px;
      right: -156px;
    }
  }
}
</style>
