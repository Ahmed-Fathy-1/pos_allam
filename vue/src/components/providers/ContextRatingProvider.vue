<template>
    <div>
        <slot></slot>
    </div>
</template>


<script>
import { provide, ref } from 'vue';

export default {
    name: 'ContextRatingProvider',
    setup(props, { slots }) {
        const isRatingModalOpen = ref(false);
        const isSidebarActive = ref(false);

        const openRatingModal = () => {
            isRatingModalOpen.value = false;
        };
        const closeRatingModal = () => {
            isRatingModalOpen.value = false;
        };


        const toggleSidebar = ()=>{
            isSidebarActive.value = !isSidebarActive.value
        }
        const closeSidebar = ()=>{
            isSidebarActive.value = false;
        }

        provide('isRatingModalOpen', isRatingModalOpen);
        provide('openRatingModal', openRatingModal);
        provide('closeRatingModal', closeRatingModal);

        provide('isSidebarActive', isSidebarActive);
        provide('toggleSidebar', toggleSidebar);
        provide('closeSidebar', closeSidebar);

        return () => slots.default();
    }
};
</script>