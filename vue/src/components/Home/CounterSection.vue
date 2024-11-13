<template>
  <div class="counter text-white mb-5">
    <div class="container">
      <div class="row gy-5">
        <div
          class="col-lg-4 col-md-12 col-12 text-center"
          v-for="(item, index) in numbers"
          :key="index"
        >
         <Counter :title="item.title" :targetCount="item.count"/>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { url } from "@/config";
import Counter from "./Counter.vue";

const counter = ref([]);

const props = defineProps({
  numbers: {
    type: Array,
    required: false,
  },
});

console.log(props.numbers);


</script>

<style lang="scss" scoped>
.counter {
  background-image: url(../../assets/images/counter-bg.svg);
  background-repeat: no-repeat;
  background-size: cover;
  padding: 8rem 0;
}
</style>
