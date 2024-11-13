import { ref, onMounted, onBeforeUnmount } from "vue";

export const useScroll = () => {
  const nav = ref(false);

  const handleScroll = () => {
    const scrollTop = window.scrollY || document.documentElement.scrollTop;
    const viewportHeight = window.innerHeight;
    nav.value = scrollTop > viewportHeight * 0.05;
  };

  onMounted(() => {
    window.addEventListener("scroll", handleScroll);
  });

  onBeforeUnmount(() => {
    window.removeEventListener("scroll", handleScroll);
  });

  return {
    nav,
  };
};
