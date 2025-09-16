<template>
    <!-- User Modal -->
    <v-dialog
        :model-value="!!user"
        @update:model-value="(value) => !value && $emit('close')"
        max-width="600"
        persistent
        transition="fade-transition"
        class="enhanced-user-modal"
    >
        <v-card class="rounded-xl overflow-hidden" elevation="24">
            <!-- Header Section -->
            <div
                class="relative bg-gradient-to-br from-blue-50 to-indigo-100 p-4 pb-6"
            >
                <div class="flex items-center gap-3">
                    <!-- Avatar -->
                    <v-avatar
                        size="80"
                        class="border-4 border-white shadow-lg bg-gradient-to-br from-blue-500 to-indigo-600 text-white font-bold text-2xl flex items-center justify-center"
                    >
                        {{
                            user?.name ? user.name.charAt(0).toUpperCase() : "?"
                        }}
                    </v-avatar>

                    <!-- User Info + Close Button -->
                    <div class="flex-1">
                        <div class="flex items-start justify-between gap-2">
                            <h2 class="text-2xl font-bold text-gray-800">
                                {{ user?.name }}
                            </h2>
                            <v-btn
                                icon="mdi-close"
                                variant="text"
                                size="small"
                                class="text-gray-600 hover:text-gray-800 -mt-1"
                                @click="$emit('close')"
                            />
                        </div>

                        <!-- Role + Cog -->
                        <div class="flex items-center gap-2 mt-1">
                            <v-chip
                                color="primary"
                                variant="tonal"
                                size="small"
                                class="font-medium"
                            >
                                <v-icon start size="14"
                                    >mdi-account-badge</v-icon
                                >
                                {{ capitalize(user?.role) }}
                            </v-chip>

                            <v-btn
                                icon="mdi-cog"
                                variant="text"
                                size="small"
                                class="text-gray-500 hover:text-primary transition-colors duration-200"
                                @click="openStatus"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <v-card-text class="p-4">
                <div class="space-y-3">
                    <!-- Full Name -->
                    <v-card
                        variant="tonal"
                        color="blue-grey-lighten-5"
                        class="p-2 border border-gray-100 hover:shadow-sm transition-shadow"
                    >
                        <div class="flex items-center gap-2">
                            <v-icon color="primary" size="18"
                                >mdi-account</v-icon
                            >
                            <div>
                                <p
                                    class="text-sm font-medium text-gray-600 mb-0.5"
                                >
                                    Full Name
                                </p>
                                <p class="text-gray-900 font-semibold">
                                    {{ getFullName(user) }}
                                </p>
                            </div>
                        </div>
                    </v-card>

                    <!-- Email and Contact -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <v-card
                            variant="tonal"
                            color="green-lighten-5"
                            class="p-2 border border-gray-100 hover:shadow-sm"
                        >
                            <div class="flex items-center gap-2">
                                <v-icon color="success" size="18"
                                    >mdi-email</v-icon
                                >
                                <div class="min-w-0 flex-1">
                                    <p
                                        class="text-sm font-medium text-gray-600 mb-0.5"
                                    >
                                        Email
                                    </p>
                                    <p
                                        class="text-gray-900 font-medium truncate"
                                    >
                                        {{ user?.email || "N/A" }}
                                    </p>
                                </div>
                            </div>
                        </v-card>

                        <v-card
                            variant="tonal"
                            color="orange-lighten-5"
                            class="p-2 border border-gray-100 hover:shadow-sm"
                        >
                            <div class="flex items-center gap-2">
                                <v-icon color="warning" size="18"
                                    >mdi-phone</v-icon
                                >
                                <div class="min-w-0 flex-1">
                                    <p
                                        class="text-sm font-medium text-gray-600 mb-0.5"
                                    >
                                        Contact
                                    </p>
                                    <p
                                        class="text-gray-900 font-medium truncate"
                                    >
                                        {{ user?.contact_number || "N/A" }}
                                    </p>
                                </div>
                            </div>
                        </v-card>
                    </div>

                    <!-- Address -->
                    <v-card
                        variant="tonal"
                        color="purple-lighten-5"
                        class="p-2 border border-gray-100 hover:shadow-sm"
                    >
                        <div class="flex items-start gap-2">
                            <v-icon color="purple" size="18" class="mt-0.5"
                                >mdi-map-marker</v-icon
                            >
                            <div class="min-w-0 flex-1">
                                <p
                                    class="text-sm font-medium text-gray-600 mb-0.5"
                                >
                                    Address
                                </p>
                                <p
                                    class="text-gray-900 font-medium leading-snug break-words"
                                >
                                    {{ user?.address || "N/A" }}
                                </p>
                            </div>
                        </div>
                    </v-card>

                    <!-- Specialization -->
                    <v-card
                        v-if="user?.role === 'vet' && user?.specialization"
                        variant="tonal"
                        color="teal-lighten-5"
                        class="p-2 border border-gray-100 hover:shadow-sm"
                    >
                        <div class="flex items-center gap-2">
                            <v-icon color="teal" size="18"
                                >mdi-medical-bag</v-icon
                            >
                            <div>
                                <p
                                    class="text-sm font-medium text-gray-600 mb-0.5"
                                >
                                    Specialization
                                </p>
                                <p class="text-gray-900 font-medium">
                                    {{ user?.specialization }}
                                </p>
                            </div>
                        </div>
                    </v-card>
                </div>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script setup>
import { ref } from "vue";

const props = defineProps({
    user: Object,
});

const emit = defineEmits([
    "close",
    "open-status-control", // declare the custom event
]);

const openStatus = () => {
    emit("open-status-control", props.user);
};

const showStatusModal = ref(false);
const selectedUser = ref(null);

const capitalize = (str) =>
    str ? str.charAt(0).toUpperCase() + str.slice(1) : "";

const getFullName = (u) => {
    if (!u) return "N/A";
    const parts = [u.first_name, u.middle_name, u.last_name].filter(Boolean);
    return parts.length ? parts.join(" ") : "N/A";
};

const openUserStatusControl = (user) => {
    selectedUser.value = user;
    showStatusModal.value = true;
};

const deactivateUser = (id) => {
    console.log("Deactivate user", id);
    showStatusModal.value = false;
};
</script>
