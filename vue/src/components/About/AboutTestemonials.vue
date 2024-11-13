<template>
    <section class="about-testemonials">
        <div class="bg-wavy">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#ff9f43" fill-opacity="1" d="M0,192L17.1,176C34.3,160,69,128,103,96C137.1,64,171,32,206,58.7C240,85,274,171,309,176C342.9,181,377,107,411,69.3C445.7,32,480,32,514,48C548.6,64,583,96,617,96C651.4,96,686,64,720,42.7C754.3,21,789,11,823,32C857.1,53,891,107,926,133.3C960,160,994,160,1029,144C1062.9,128,1097,96,1131,106.7C1165.7,117,1200,171,1234,170.7C1268.6,171,1303,117,1337,85.3C1371.4,53,1406,43,1423,37.3L1440,32L1440,320L1422.9,320C1405.7,320,1371,320,1337,320C1302.9,320,1269,320,1234,320C1200,320,1166,320,1131,320C1097.1,320,1063,320,1029,320C994.3,320,960,320,926,320C891.4,320,857,320,823,320C788.6,320,754,320,720,320C685.7,320,651,320,617,320C582.9,320,549,320,514,320C480,320,446,320,411,320C377.1,320,343,320,309,320C274.3,320,240,320,206,320C171.4,320,137,320,103,320C68.6,320,34,320,17,320L0,320Z"></path>
            </svg>

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#ff9f43" fill-opacity="1" d="M0,96L30,85.3C60,75,120,53,180,90.7C240,128,300,224,360,266.7C420,309,480,299,540,282.7C600,267,660,245,720,224C780,203,840,181,900,160C960,139,1020,117,1080,128C1140,139,1200,181,1260,192C1320,203,1380,181,1410,170.7L1440,160L1440,0L1410,0C1380,0,1320,0,1260,0C1200,0,1140,0,1080,0C1020,0,960,0,900,0C840,0,780,0,720,0C660,0,600,0,540,0C480,0,420,0,360,0C300,0,240,0,180,0C120,0,60,0,30,0L0,0Z"></path>
            </svg>
        </div>


        <div class="feed-back pt-3 pb-4">
            <div class="container">
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
    </section>
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

    .about-testemonials{
        position: relative;
        min-height: 0px;
        z-index: 0;
        margin-bottom:50px;

        @media (max-width:667px) {
            max-height: 600px;
            overflow: hidden;
            margin-bottom:30px;
        }

        @media (min-width:1090px) {
          margin-bottom:150px;
        }

        @media (min-width:1200px) {
          margin-bottom:200px;
        }
        
    }

    .bg-wavy{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 400px;
        overflow: hidden;
        z-index: 0;

        @media (max-width:667px) {
            width: 400%;
        }
    }
</style>

<style lang="scss" scoped>
.feed-back {
    position: relative;
    top: 50px;
    background-color:transparent;


    @media (min-width:767px) {
      top: -40px;
    }

    @media (min-width:900px) {
      top: 4px;
    }

    @media (min-width:1250px) {
      top: 100px;
    }
}

.writer {
    color: #1c1c1c;
  .name {
    span,
    p {
      font-size: 12px;
    }
  }
}
</style>
