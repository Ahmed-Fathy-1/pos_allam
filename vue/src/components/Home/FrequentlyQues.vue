<template>
  <div class="questions container pt-5 pb-5">
    <div class="title text-center">
      <h1>Frequently asked questions</h1>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse
        <br />
        varius enim in eros elementum tristique.
      </p>
    </div>

    <div class="row gy-3">
      <div
        class="col-lg-6 col-md-12 col-12"
        v-for="(item, outerIndex) in toRaw(data)"
        :key="outerIndex"
      >
        <div class="accordion mt-1" :id="`accordionExample${outerIndex}`">
          <div
            class="accordion-item"
          >
            <h2 class="accordion-header">
              <button
                class="accordion-button"
                type="button"
                data-bs-toggle="collapse"
                :data-bs-target="`#collapse${outerIndex}${innerIndex}`"
                aria-expanded="true"
                :aria-controls="`collapse${outerIndex}${innerIndex}`"
              >
                {{ item?.question }}
              </button>
            </h2>
            <div
              :id="`collapse${outerIndex}${innerIndex}`"
              class="accordion-collapse collapse"
              :data-bs-parent="`#accordionExample${outerIndex}`"
            >
              <div class="accordion-body">
                {{ item?.answer }}
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- group 2-->
     <!---- <div
        class="col-lg-6 col-md-12 col-12"
        v-for="(item, outerIndex) in toRaw(data)"
        :key="outerIndex"
      >
        <div class="accordion mt-1" :id="`accordionExample${outerIndex}`">
          <div
            class="accordion-item"
          >
            <h2 class="accordion-header">
              <button
                class="accordion-button"
                type="button"
                data-bs-toggle="collapse"
                :data-bs-target="`#collapse${outerIndex}${innerIndex}`"
                aria-expanded="true"
                :aria-controls="`collapse${outerIndex}${innerIndex}`"
              >
                {{ item?.question }}
              </button>
            </h2>
            <div
              :id="`collapse${outerIndex}${innerIndex}`"
              class="accordion-collapse collapse"
              :data-bs-parent="`#accordionExample${outerIndex}`"
            >
              <div class="accordion-body">
                {{ item?.answer }}
              </div>
            </div>
          </div>
        </div>
      </div>-->

    </div>
  </div>
</template>

<script setup>
import { onMounted, ref, toRaw } from "vue";
import { url } from "@/config";
import axios from "axios";
import fetchPageData from "@/api/get/fetchPageData";
const questions = ref([]);

const getQuestions = () => {
  axios.get(`${url}/questions`).then((response) => {
    questions.value = response.data;
  });
};

const data = ref([]);
const rating = ref(5);

onMounted(async () => {
  try {
    data.value = await fetchPageData('faqs');
  } catch (error) {
    console.error("Error fetching page data:", error);
  }
});

</script>
