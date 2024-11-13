<template>
  <div class="feed-back pt-5 pb-5">
    <div class="container">
      <div class="title text-center">
        <h1>Feedback from our customers</h1>
      </div>

      <Carousel
        :autoplay="2000"
        v-bind="settings"
        :breakpoints="breakpoints"
        navigationEnabled: true
        class="mt-5"
      >
        <Slide v-for="(slide, index) in rawData" :key="index">
          <div class="carousel__item">
            <div class="card m-3 text-start">
              <div class="card-body py-1 px-4">
                <v-rating
                  v-model="rating"
                  class="ma-2"
                  color="yellow"
                  density="compact"
                  size="small"
                ></v-rating>

                <p>
                  {{ slide?.content }} 
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui, ea praesentium deleniti voluptate.
                </p>

                <div class="writer d-flex align-items-center gap-2">
                  <img src="../../assets/images/writer.png" width="30" alt="" />
                  <div class="name">
                    <span class="fw-bold">{{ slide?.name }}</span>
                    <p class="mb-0">{{ slide?.email }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </Slide>

        <Slide v-for="(slide, index) in rawData" :key="index">
          <div class="carousel__item">
            <div class="card m-3 text-start">
              <div class="card-body py-1 px-4">
                <v-rating
                  v-model="rating"
                  class="ma-2"
                  color="yellow"
                  density="compact"
                  size="small"
                ></v-rating>

                <p>
                  {{ slide?.content }} 
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui, ea praesentium deleniti voluptate.
                </p>

                <div class="writer d-flex align-items-center gap-2">
                  <img src="../../assets/images/writer.png" width="30" alt="" />
                  <div class="name">
                    <span class="fw-bold">{{ slide?.name }}</span>
                    <p class="mb-0">{{ slide?.email }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </Slide>

        <template #addons>
          <Navigation />
        </template>
      </Carousel>
    </div>
  </div>
</template>

<script setup>
import "vue3-carousel/dist/carousel.css";
import { Carousel, Navigation, Slide } from "vue3-carousel";
import { ref, onMounted, computed, toRaw } from "vue"; // Import toRaw
import fetchPageData from "@/api/get/fetchPageData";

const data = ref(null);
const rating = ref(5);

onMounted(async () => {
  try {
    data.value = await fetchPageData('feedbacks');    
  } catch (error) {
    console.error("Error fetching page data:", error);
  }
});

const rawData = computed(() => toRaw(data.value) || []); 

const settings = {
  itemsToShow: 1,
  snapAlign: "center",
};

const breakpoints = {
  700: {
    itemsToShow: 2,
    snapAlign: "center",
  },
  1024: {
    itemsToShow: 3,
    snapAlign: "start",
  },
};
</script>

<style lang="scss" scoped>
.feed-back {
  background-color: var(--bs-info);
  margin: 2rem 0;
}

.writer {
  .name {
    span,
    p {
      font-size: 12px;
    }
  }
}
</style>
