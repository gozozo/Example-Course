import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"

import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { library } from "@fortawesome/fontawesome-svg-core";
import { faSchool } from "@fortawesome/free-solid-svg-icons";


import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store"



library.add(faSchool);

createApp(App).use(store).use(router).component("font-awesome-icon", FontAwesomeIcon).mount("#app");