<!-- Counter.vue -->
<template>
    <article ref="counterRef">
        <h6>{{ title }}</h6>
        <p class="fs-1 fw-bold">{{ count }}k</p>
    </article>
  </template>

  
  <script setup>
  import { ref, onMounted, onBeforeUnmount } from 'vue';
  
  const props = defineProps({
    targetCount: {
      type: Number,
      default: 200,
    },
    title: {
      type: String,
      default: '',
    },
  });
  
const counterRef = ref(null);
const count = ref(0);

let isCounting = false;
let intervalId = null;

  const parseCount = ()=>{
    return parseInt(props.targetCount.replace('k',''));
  }

const startCount = ()=>{
    if (!isCounting) {

        isCounting = true;
        intervalId = setInterval(() => {

            if (count.value < parseCount()) {
                count.value++;
            }
            else{
                clearInterval(intervalId);
                isCounting = false;
            }
        }, 100);  
    }
}

const stopCounting = () => {
  if (isCounting) {
    clearInterval(intervalId);
    isCounting = false;
    count.value = 0;
  }
};
  
  onMounted(() => {
    
    const observer = new IntersectionObserver(([entry])=>{
        if (entry.isIntersecting) {
            startCount();
        } else {
            stopCounting();
        }
    },{threshold:1})


    if (counterRef.value) {
        observer.observe(counterRef.value);
    }

    onBeforeUnmount(() => {
        if (counterRef.value) {
            observer.unobserve(counterRef.value);
        }
        clearInterval(intervalId);
    });

  });
  </script>
  