<template>
  <div class="custommers-needs mb-5">
    <div class="container">
      <div class="row gy-3">
        <div class="col-lg-6 col-md-12 col-12">
          <div class="title">
            <h1>{{ data?.title }}</h1>
            <p v-html="data?.desc">
            </p>
          </div>

          <div class="points mt-5">
            <div
              class="point d-flex gap-3 align-items-center"
              v-for="(need, index) in data?.sub_needs"
              :key="index"
              :class="{ 'mt-4 mb-4': index == 1 }"
            >
              <img :src="need?.image" width="50" alt="..." />

              <div class="text">
                <h6 class="fw-bold">{{ need.title }}</h6>
                <p v-html="need.desc"></p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-12 col-12">
          <div class="image d-flex justify-content-end">
            <img
              src="../../assets/images/customer-mobile.svg"
              width="400"
              alt="...."
              loading="lazy"
              :class="count"
              ref="counterRef"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, toRaw, onBeforeUnmount } from "vue";
import fetchPageData from "@/api/get/fetchPageData";

const data = ref(null);
const counterRef = ref(null);
const count = ref('not');

let isCounting = false;
let intervalId = null;



const startCount = ()=>{
    if (!isCounting) {
        isCounting = true;
        count.value = 'animated'
    }
}

const stopCounting = () => {
  if (isCounting) {
    isCounting = false;
    count.value = 'notAnimated'
  }
};



onMounted(async () => {

  try {
    data.value = await fetchPageData('main_needs');
  } catch (error) {
    console.error("Error fetching page data:", error);
  }

  const observer = new IntersectionObserver(([entry])=>{
        if (entry.isIntersecting) {
            startCount();
        } else {
            stopCounting();
        }
    },{threshold:.5})


    if (counterRef.value) {
        observer.observe(counterRef.value);
    }

    onBeforeUnmount(() => {
        if (counterRef.value) {
            observer.unobserve(counterRef.value);
            count.value = 'notAimated'
        }
    });
  
  });

</script>

<style lang="scss" scoped>
.custommers-needs {
  background-image: url(../../assets/images/customers.svg);
  background-repeat: no-repeat;
  background-size: contain;
  background-position-x: right;
  margin-top: 8rem;
  p {
    color: #505056;
  }
}

@media (max-width: 992px) {
  .custommers-needs {
    background-position-y: bottom;
    background-size: 25rem;
    margin-top: 4rem;
  }
}
</style>

<style scoped>
  .animated{
    animation: mobileAnimated .5s ease-in-out backwards infinite;
  }

  @keyframes mobileAnimated{
    0%{
      transform: rotateZ(10deg);
    }
    25%{
      transform: rotateZ(7deg);
    }
    50%{
      transform: rotateZ(5deg);
    }
    75%{
      transform: rotateZ(3deg);
    }
    100%{
      transform: rotateZ(0deg);
    }
  }

</style>
