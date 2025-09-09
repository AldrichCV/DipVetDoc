<template>
    <div
        v-if="user"
        class="fixed inset-0 z-50 flex items-center justify-center"
    >
        <!-- Blurred overlay -->
        <div
            class="absolute inset-0 bg-black/60 backdrop-blur-sm"
            @click="$emit('close')"
        ></div>

        <!-- Modal content -->
        <div
            class="relative bg-white rounded-xl shadow-2xl w-11/12 md:w-2/3 lg:w-1/2 p-6 max-h-[90vh] overflow-y-auto"
        >
            <!-- Close button -->
            <button
                @click="$emit('close')"
                class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl font-bold"
            >
                &times;
            </button>

            <!-- Header with name, role, status -->
            <div class="flex items-center gap-4 mb-6">
                <div
                    class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center text-xl font-semibold text-gray-500"
                >
                    {{ user.name ? user.name.charAt(0) : "?" }}
                </div>

                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <h2 class="text-2xl font-bold text-gray-800">
                            {{ user.name }}
                        </h2>
                        <span
                            class="px-3 py-1 rounded-full text-xs font-semibold"
                            :class="
                                user.status === 'approved'
                                    ? 'bg-green-100 text-green-800'
                                    : 'bg-red-100 text-red-800'
                            "
                        >
                            {{
                                user.status === "approved"
                                    ? "Active"
                                    : capitalize(user.status) || "N/A"
                            }}
                        </span>
                    </div>

                    <!-- Role + Gear button -->
                    <div class="flex items-center gap-2 mt-1">
                        <p class="text-gray-500">{{ capitalize(user.role) }}</p>
                        <button
                            @click="openUserStatusControl(user)"
                            class="text-gray-400 hover:text-gray-600"
                        >
                            <i class="bi bi-gear-fill w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- User info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
                <div
                    class="col-span-1 md:col-span-2 bg-gray-50 p-3 rounded-lg border border-gray-200 flex items-center gap-2"
                >
                    <span class="text-sm font-medium text-gray-500"
                        >Full Name:</span
                    >
                    <span class="text-gray-900">{{ getFullName(user) }}</span>
                </div>

                <div
                    class="bg-gray-50 p-3 rounded-lg border border-gray-200 flex items-center gap-2"
                >
                    <span class="text-sm font-medium text-gray-500"
                        >Email:</span
                    >
                    <span class="text-gray-900">{{ user.email || "N/A" }}</span>
                </div>

                <div
                    class="bg-gray-50 p-3 rounded-lg border border-gray-200 flex items-center gap-2"
                >
                    <span class="text-sm font-medium text-gray-500"
                        >Contact Number:</span
                    >
                    <span class="text-gray-900">{{
                        user.contact_number || "N/A"
                    }}</span>
                </div>

                <div
                    class="col-span-1 md:col-span-2 bg-gray-50 p-3 rounded-lg border border-gray-200 flex items-center gap-2"
                >
                    <span class="text-sm font-medium text-gray-500"
                        >Address:</span
                    >
                    <span class="text-gray-900">{{
                        user.address || "N/A"
                    }}</span>
                </div>

                <div
                    v-if="user.role === 'vet' && user.specialization"
                    class="col-span-1 md:col-span-2 bg-gray-50 p-3 rounded-lg border border-gray-200 flex items-center gap-2"
                >
                    <span class="text-sm font-medium text-gray-500"
                        >Specialization:</span
                    >
                    <span class="text-gray-900">{{ user.specialization }}</span>
                </div>
            </div>
        </div>

        <!-- UserStatusControl Modal -->
        <UserStatusControl v-model="showStatusModal" :user="selectedUser">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                    Deactivate Account
                </h2>
                <p class="text-sm text-gray-600 mb-6">
                    Are you sure you want to deactivate
                    <span class="font-semibold">{{ selectedUser?.name }}</span
                    >?
                </p>
                <div class="flex justify-end gap-3">
                    <button
                        @click="showStatusModal = false"
                        class="px-4 py-2 rounded-lg border text-gray-600 hover:bg-gray-100"
                    >
                        Cancel
                    </button>
                    <button
                        @click="deactivateUser(selectedUser.id)"
                        class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700"
                    >
                        Deactivate
                    </button>
                </div>
            </div>
        </UserStatusControl>
    </div>
</template>

<script setup>
import { ref } from "vue";
import UserStatusControl from "./UserStatusControl.vue";

const props = defineProps({
    user: Object,
});

const emit = defineEmits(["close"]);

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
