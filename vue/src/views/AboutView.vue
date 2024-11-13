<template>
    <div class="about" v-if="sections.length > 1">
        <AboutCover :data="sections[0]"/>
        <AboutSummary :data="sections[1]"/>
        <AboutServices :data="[sections[2],sections[3],sections[4]]"/>
        <AboutTestemonials/>
        <AboutTechnologies />
    </div>
    <p v-else>loading</p>
</template>

<script setup>
import AboutCover from '@/components/About/AboutCover.vue';
import AboutSummary from '@/components/About/AboutSummary.vue';
import AboutServices from '@/components/About/AboutServices.vue';
import AboutTestemonials from '@/components/About/AboutTestemonials.vue';
import AboutTechnologies from '@/components/About/AboutTech.vue';
import { onMounted, ref, toRaw } from 'vue';
import axios from 'axios';

const sections = ref([]);

onMounted(async()=>{
    try {
        await axios.get(('http://localhost:7001/sections'))
        .then((response)=>{
            sections.value = response.data;
        })
    } catch (error) {
        console.log(error);  
    }
})

</script>

<style scoped lang="scss">
    .about{
        padding-top: 50px;

        @media (min-width:767px) {
            padding-top: 100px;
        }
    }
</style>

