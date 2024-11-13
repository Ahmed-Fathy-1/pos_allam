<template>
    <div v-if="visible" class="snackbar" :class="type">
      {{ message }}
      <button class="close-toast" @click="close">X</button>
    </div>
</template>

<script>
export default {
  data() {
    return {
      visible: false,
      message: "",
      type: "success",
    };
  },
  methods: {
    open(msg, type = "success") {
      this.message = msg;
      this.type = type;
      this.visible = true;
     //setTimeout(this.close, 3000);
    },
    close() {
      this.visible = false;
    },
  },
};
</script>


<style scoped>
.snackbar {
  position: fixed;
  bottom: 20px;
  left: 20px;
  min-width:250px;
  padding: 1rem .5rem;
  display: flex;
  justify-content: space-between;
  align-items:flex-start;
  gap: 1rem;
  font-weight: 500;
  border-radius: 4px;
  color: white;
  transition: opacity 0.3s ease;
  z-index: 1000;
  background-color:red;
}
.success {
  background-color: #080;
  border-top: 3px solid #055205;
}
.error {
  background-color: #ff0000d6;
  border-top: 3px solid #930303;
}
.warning {
  font-weight: 600;
  border-top: 3px solid #a36c09;
  background-color: orange;
  color: #1c1c1c;
}
.close-toast{
  font-weight: 500;
  width: 22px;
  height: 20px;
  margin: 0 0 0 auto;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius:3px;
  border: 2px solid #fff;
}
.warning .close-toast{
  font-weight: 700;
  color: #111;
  border: 2px solid #111;
}
</style>


  