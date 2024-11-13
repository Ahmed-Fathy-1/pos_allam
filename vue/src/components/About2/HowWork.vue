<template>
  <section class="how-it-work container">
    <div class="title text-center">
      <h6>{{ workflow?.title }}</h6>
      <h1>{{ workflow?.description }}</h1>
    </div>

    <div class="row mt-5 g-4">
      <div
        class="col-lg-4 col-md-12 col-12 text-center"
        v-for="(item, index) in workflow?.details"
        :key="index"
      >
        <div class="image">
          <img :src="item?.image" alt="..." />
        </div>

        <div class="content pt-3">
          <h3>{{ item?.title }}</h3>

          <div class="w-100 d-flex justify-content-center">
            <div
              class="number d-flex justify-content-center align-items-center"
            >
              <h3 class="m-0">{{ item.number }}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref} from "vue";

const props = defineProps({
  workflow: {
    type: Object,
    required: false,
  },
});


</script>

<style lang="scss" scoped>
.image {
  height: 160px;
  width: 170px;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #f0f6ff;
  margin-left: auto;
  margin-right: auto;
  background-image: url(../../assets/images/flow-bg.png);
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;
}

.number {
  background-color: #ff9f43;
  color: #fff;
  padding: 20px;
  width: 65px;
  height: 65px;
  border-radius: 50%;
  border: 1px solid #0000004a;
  box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
  h3 {
    font-weight: 700;
  }
}
</style>
