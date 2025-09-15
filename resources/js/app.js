import "./bootstrap";
import Alpine from "alpinejs";
import { userStatusControl } from "./user_status_control";
//import "./ajax-navigation.js";
import "./sidebar-state.js";

import { createApp } from "vue";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
import "vuetify/styles";

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
// 2️⃣ Expose a function to mount Vue
// -----------------------
function mountVueApp() {
    if (document.querySelector("#app")) {
        // Unmount any existing app
        if (window.vueApp) {
            window.vueApp.unmount();
        }

        // Create a fresh Vue app
        window.vueApp = createApp({});

        // Register components globally
        window.vueApp.component("consultations", Consultations);
        window.vueApp.component("appointments", Appointments);
        window.vueApp.component("users", Users);

        // Install Vuetify
        window.vueApp.use(vuetify);

        // Mount
        window.vueApp.mount("#app");
    }
}

// Mount once on initial page load
mountVueApp();

// Make available for AJAX script
window.mountVueApp = mountVueApp;

// -----------------------
// 3️⃣ Alpine.js setup
// -----------------------
window.Alpine = Alpine;
Alpine.data("userStatusControl", userStatusControl);
Alpine.start();
