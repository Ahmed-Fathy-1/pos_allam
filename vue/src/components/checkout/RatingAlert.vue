<template>
    <v-card class="p-3 mt-3 rating-card border-1 p-relative" elevation="0">
        <p class="p-3 fw-semibold rate">
            Please do not hisitate to confirm us any suggestions or contact us to inquire about the status of your request.
        </p>

        <router-link to="/contact" class="contact d-none">
            For contact click here
        </router-link>

    </v-card>
</template>


<script setup>
</script>


<style>
.rating-card{
    overflow: visible;
    padding-bottom: 2rem;
}
.rate{
    border-left: 4px solid var(--bs-primary);
    background-color: #ffebd7;
}

.contact{
    position: absolute;
    bottom: -12px;
    left: 50%;
    transform: translateX(-50%);
    width: fit-content;
    padding:0 .75rem;
    background-color: #fff;

    font-size: 1.5rem;
    font-weight: 500;
    z-index: 1;
    color: #1c1c1c;
    text-wrap: nowrap;
}
</style>