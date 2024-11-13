<template>
  <div class="container pb-10">
    <div class="title text-center">
      <h1>
        Get awesome for your daily needs Our <br />
        Pricing Plan, Our Features
      </h1>
      <p>
        With bolts, you can increase customer adoption, meet compliance <br />
        requirements, secure APIs, and future-proof your enterprise.
      </p>
    </div>

    <Package />
  </div>
</template>

<script setup>
import Package from "@/components/Package.vue";
</script>

<style lang="scss" scoped>
@media (max-width: 992px) {
  .title {
    p {
      font-size: 12px;
    }

    h1 {
      font-size: 22px;
    }
  }
}
</style>
