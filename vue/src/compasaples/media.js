// this compasable to mange the sidebar in small and large width , here i use window object
// becouse there are no another solution

import { ref, onMounted, onBeforeUnmount, watch } from "vue";

export const useSidebarWidth = () => {
  let pageSize = ref(window.innerWidth);
  let listenerActive = ref(true);

  const updateWidth = () => {
    pageSize.value = window.innerWidth;
  };

  onMounted(() => {
    window.addEventListener("resize", updateWidth);
  });

  onBeforeUnmount(() => {
    window.removeEventListener("resize", updateWidth);
  });

  watch(listenerActive.value, (newVal) => {
    if (!newVal) {
      window.removeEventListener("resize", updateWidth);
    } else {
      window.addEventListener("resize", updateWidth);
    }
  });

  return { pageSize };
};
