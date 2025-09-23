<template>
    <v-dialog
        v-model="internalValue"
        max-width="600"
        persistent
        transition="dialog-transition"
        :scrim="true"
        content-class="dialog-top"
    >
        <v-card class="rounded-lg overflow-hidden">
            <v-card-text class="p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                    {{
                        user?.status === "inactive"
                            ? "Reactivate Account"
                            : "Deactivate Account"
                    }}
                </h2>

                <p class="text-sm text-gray-600 mb-6">
                    Are you sure you want to
                    <span class="font-semibold">
                        {{
                            user?.status === "inactive"
                                ? "reactivate "
                                : "deactivate "
                        }}
                    </span>
                    <span class="font-semibold">{{ user?.name }}</span
                    >?
                </p>

                <div class="flex justify-end gap-3">
                    <v-btn variant="outlined" color="grey" @click="close">
                        Cancel
                    </v-btn>

                    <v-btn
                        :color="user?.status === 'inactive' ? 'green' : 'red'"
                        @click="
                            user?.status === 'inactive'
                                ? activateUser(user.id)
                                : deactivateUser(user.id)
                        "
                    >
                        {{
                            user?.status === "inactive"
                                ? "Reactivate"
                                : "Deactivate"
                        }}
                    </v-btn>
                </div>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script setup>
import { ref, watch } from "vue";
import axios from "axios";

const props = defineProps({
    modelValue: { type: Boolean, default: false },
    user: Object,
});

const emit = defineEmits(["update:modelValue"]);
const internalValue = ref(props.modelValue);

watch(
    () => props.modelValue,
    (val) => (internalValue.value = val)
);
watch(internalValue, (val) => emit("update:modelValue", val));

const close = () => (internalValue.value = false);

// Axios instance with CSRF token

// Deactivate user
const deactivateUser = async (userId) => {
    try {
        await api.patch(`/api/users/${userId}/deactivate`, {
            status: "inactive",
        });

        // Update local user status
        if (props.user) props.user.status = "inactive";

        Swal.fire({
            title: "User Deactivated!",
            text: "The user has been successfully deactivated.",
            icon: "success",
        });

        close();
    } catch (err) {
        Swal.fire({
            title: "Error!",
            text: err.response?.data?.message || err.message,
            icon: "error",
        });
    }
};

const activateUser = async (userId) => {
    try {
        await api.patch(`/api/users/${userId}/activate`, { status: "active" });

        // Update local user status
        if (props.user) props.user.status = "active";

        Swal.fire({
            title: "User Reactivated!",
            text: "The user has been successfully reactivated.",
            icon: "success",
        });

        close();
    } catch (err) {
        Swal.fire({
            title: "Error!",
            text: err.response?.data?.message || err.message,
            icon: "error",
        });
    }
};
</script>

<style>
/* 🔥 Ensure SweetAlert is always above Vuetify modals */
.swal2-container {
    z-index: 99999 !important;
}
</style>
