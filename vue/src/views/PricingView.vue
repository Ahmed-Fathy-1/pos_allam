<template>
  <div class="pricing position-relative">
    <PackagesSection />

    <div class="contacts container text-center">
      <h5 class="text-capitalize">
        if you want a special package , contact us <br />
        to customize your package.
      </h5>

      <v-btn
        class="text-capitalize contact-btn text-white"
        elevation="0"
        prepend-icon="mdi-phone-hangup"
      >
        contact us</v-btn
      >
    </div>
  </div>
</template>

<script setup>
import PackagesSection from "@/components/Home/PackagesSection.vue";
</script>

<style lang="scss" scoped>
.pricing {
  margin: 6rem 0;
}

.contact-btn {
  background-color: var(--bs-primary) !important;
}
</style>
