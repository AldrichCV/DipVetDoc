/*import axios from "axios";
import router from "@/router";

axios.defaults.baseURL = "/api";

axios.interceptors.response.use(
    (response) => response,
    (error) => {
        if (
            error.response &&
            (error.response.status === 401 || error.response.status === 419)
        ) {
            localStorage.removeItem("user");
            if (router.currentRoute.value.name !== "logged-out") {
                router.replace({ name: "logged-out" });
            }
        }
        return Promise.reject(error);
    }
);

export default axios;*/
