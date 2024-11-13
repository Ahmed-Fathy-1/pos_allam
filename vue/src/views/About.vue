<template>
  <div class="about-us">
    <div class="title text-center">
      <h1>{{ data?.aboutUs?.intro_title}} </h1>
      <p>
        {{data?.aboutUs?.intro_desc}}
      </p>
    </div>

    <CustomerNeeds />
    <CounterSection  :numbers="data?.aboutUs?.numbers"/>
    <HowWork :workflow="data?.aboutUs?.workflow"/>
    <!-- <OurExperience /> -->
  </div>
</template>

<script setup>
import CustomerNeeds from "@/components/Home/CustomerNeeds.vue";
import HowWork from "@/components/About/HowWork.vue";
import CounterSection from "@/components/Home/CounterSection.vue";
import fetchPageData from "@/api/get/fetchPageData";
import {ref,onMounted} from 'vue';

const data = ref([]);

onMounted(async () => {
  try {
    data.value = await fetchPageData('about-us');
  } catch (error) {
    console.error("Error fetching page data:", error);
  }
});




</script>

<style lang="scss" scoped>
.about-us {
  margin: 6rem 0;
  color: #1c1c1c;
  transition: none;
  animation: none;
}

.custommers-needs {
  margin-top: 5rem;
}
</style>


