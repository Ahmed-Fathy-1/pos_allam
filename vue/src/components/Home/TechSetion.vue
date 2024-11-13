<template>
  <div class="tech mb-3">
    <div class="container">
      <h2 class="text-center">Our Tecnologies That We Work By</h2>
      <p class="text-center">
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Autem hic non et quod odio eos asperiores dicta ratione nul.
      </p>

      <div class=" tech__wrapper row gy-5 mt-1">
        <div
          class="col-lg-3 col-md-6 col-6"
          v-for="(item, index) in toRaw(data)"
          :key="index"
        >
          <div :class="{ 'd-flex justify-content-center': pageSize > 992 }">
            <div class="tech-logo d-flex align-items-center gap-3">
              <img :src="item.image_with_full_path" width="60" alt="vue-logo" loading="lazy" />

              <span>{{ item.name }}</span>
            </div>
          </div>
        </div>
      </div>

      <p class="end-text">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem, doloribus, ab obcaecati deserunt nobis asperiores blanditiis cumque at quia corporis eveniet ad iste optio fugiat.
      </p>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, toRaw } from "vue";
import axios from "axios";
import { url } from "@/config";
import { useSidebarWidth } from "@/compasaples/media";
import fetchPageData from "@/api/get/fetchPageData";

const { pageSize } = useSidebarWidth();


const data = ref(null);

onMounted(async () => {
  try {
    data.value = await fetchPageData('technologies');
  } catch (error) {
    console.error("Error fetching page data:", error);
  }
});

</script>

<style lang="scss" scoped>
  .tech__wrapper{
    @media (max-width:500px) {
      display: block;
      & *{
        margin:1.5rem auto;
      }
    }
  }
</style>

<style lang="scss" scoped>
h2{
  margin-bottom: 1.5rem;
  color: #1c1c1c;
  font-size: 1.5rem;
  font-weight: bold;
}
p {
  color: #667085;
}

.tech-logo {
  span {
    font-size: 21px;
    font-weight: bold;
  }
}

.end-text{
  max-width: 800px;
  margin:3.5rem auto;
  text-align: center;
}
</style>
