// import "./assets/main.css";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";
import { createApp } from "vue";
import { createPinia } from "pinia";
import { plugins } from "./plugins";
// import { createMetaManager } from "vue-meta";

// const metaManager = createMetaManager();

import "./assets/scss/style.scss";

import App from "./App.vue";
import router from "./router";

const app = createApp(App);

plugins(app);

app.use(createPinia());
app.use(router);


// app.use(metaManager);

app.mount("#app");
