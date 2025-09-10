<template>
    <!-- Users Grid -->
    <v-container fluid>
        <v-row v-if="users.length" dense>
            <v-col v-for="user in users" :key="user.id" cols="12" md="6" lg="4">
                <div
                    class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg hover:border-gray-300 transition-all duration-300 overflow-hidden"
                    @mouseenter="hovered = user.id"
                    @mouseleave="hovered = null"
                >
                    <div class="p-6 pb-4">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1 min-w-0">
                                <!-- Clickable Name -->
                                <button
                                    class="text-left w-full"
                                    type="button"
                                    @click="openUserModal(user)"
                                >
                                    <h3
                                        class="text-lg font-semibold text-gray-900 truncate transition-colors duration-200 flex items-center gap-2"
                                        :class="{
                                            'text-blue-600':
                                                hovered === user.id,
                                        }"
                                    >
                                        {{ user.name }}
                                    </h3>
                                    <!-- Animated underline -->
                                    <div
                                        class="h-0.5 bg-blue-600 transition-all duration-200 mt-1"
                                        :style="{
                                            width:
                                                hovered === user.id
                                                    ? '100%'
                                                    : '0%',
                                        }"
                                    ></div>
                                </button>

                                <!-- Role Badge -->
                                <div class="flex items-center gap-2 mt-2">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-medium flex-shrink-0 transition-colors duration-200"
                                        :class="
                                            user.role === 'vet'
                                                ? 'bg-blue-600 text-white hover:bg-blue-700'
                                                : 'bg-blue-100 text-blue-800 hover:bg-blue-200'
                                        "
                                    >
                                        {{
                                            user.role.charAt(0).toUpperCase() +
                                            user.role.slice(1)
                                        }}
                                    </span>
                                </div>
                            </div>

                            <!-- Status indicator -->
                            <div class="relative flex-shrink-0 ml-4">
                                <div
                                    class="w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center"
                                >
                                    <div
                                        class="w-3 h-3 rounded-full transition-all duration-200"
                                        :class="
                                            user.status === 'active'
                                                ? 'bg-green-500 shadow-green-200 shadow-lg'
                                                : 'bg-red-500 shadow-red-200 shadow-lg'
                                        "
                                        :title="user.status || 'N/A'"
                                    ></div>
                                </div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div
                            class="flex items-center gap-2 text-sm text-gray-600"
                        >
                            <v-icon size="16" class="text-gray-400"
                                >mdi-email</v-icon
                            >
                            <span class="truncate">{{ user.email }}</span>
                        </div>
                    </div>

                    <!-- Card Footer -->
                    <div
                        class="px-6 py-3 bg-gray-50 border-t border-gray-100 hover:bg-gray-100 transition-colors duration-200"
                    >
                        <div
                            class="flex items-center justify-between text-xs text-gray-500"
                        >
                            <span>Click name to view details</span>
                            <v-icon
                                size="16"
                                class="text-gray-400 hover:text-blue-500 transition-colors duration-200"
                            >
                                mdi-chevron-right
                            </v-icon>
                        </div>
                    </div>
                </div>
            </v-col>
        </v-row>

        <div v-else class="text-center py-12 text-gray-500">No users found</div>

        <!-- User Modal -->
        <UserModal
            v-if="selectedUser"
            :user="selectedUser"
            @close="selectedUser = null"
            @open-status-control="openUserStatusControl"
        />

        <!-- Mount status control here (outside UserModal) -->
        <UserStatusControl v-model="showStatusModal" :user="statusUser" />
    </v-container>
</template>

<script setup>
import { ref } from "vue";
import UserModal from "./UserModal.vue";
import UserStatusControl from "./UserStatusControl.vue";

const props = defineProps({
    users: { type: Array, default: () => [] },
});

const hovered = ref(null);
const selectedUser = ref(null); // controls UserModal
const statusUser = ref(null); // which user is being de/activated
const showStatusModal = ref(false); // controls UserStatusControl

const openUserModal = (user) => {
    selectedUser.value = user;
};

const openUserStatusControl = (user) => {
    statusUser.value = user;
    showStatusModal.value = true;
};
</script>
