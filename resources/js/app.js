import "./bootstrap";
import Alpine from "alpinejs";
import { userStatusControl } from "./user_status_control";

import { createApp } from "vue";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
import "vuetify/styles";
// import axios from "./plugins/axios";
// app.config.globalProperties.$axios = axios;*/

import Consultations from "./components/consultations/Consultations.vue";
import Appointments from "./components/appointments/AppointmentPage.vue";
import Users from "./components/users/UserPage.vue";

// -----------------------
// 1️⃣ Create Vuetify instance
// -----------------------
const vuetify = createVuetify({
    components,
    directives,
});

// -----------------------
// 2️⃣ Create Vue app
// -----------------------
const app = createApp({});

// Register components globally
app.component("consultations", Consultations);
app.component("appointments", Appointments);
app.component("users", Users);

// Install Vuetify
app.use(vuetify);

// Mount **once** on the root element
app.mount("#app");

// -----------------------
// 3️⃣ Alpine.js setup
// -----------------------
window.Alpine = Alpine;
Alpine.data("userStatusControl", userStatusControl);
Alpine.start();
