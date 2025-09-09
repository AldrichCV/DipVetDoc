<template>
    <!-- Users Grid -->
    <div
        v-if="users.length"
        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
    >
        <div
            v-for="user in users"
            :key="user.id"
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
                            @click="$emit('open-modal', user)"
                        >
                            <h3
                                class="text-lg font-semibold text-gray-900 truncate transition-colors duration-200 flex items-center gap-2"
                                :class="{
                                    'text-blue-600': hovered === user.id,
                                }"
                            >
                                {{ user.name }}
                            </h3>
                            <!-- Animated underline -->
                            <div
                                class="h-0.5 bg-blue-600 transition-all duration-200 mt-1"
                                :style="{
                                    width: hovered === user.id ? '100%' : '0%',
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
                <div class="flex items-center gap-2 text-sm text-gray-600">
                    <svg
                        class="w-4 h-4 text-gray-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"
                        ></path>
                    </svg>
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
                    <svg
                        class="w-4 h-4 text-gray-400 hover:text-blue-500 transition-colors duration-200"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5l7 7-7 7"
                        ></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div v-else class="text-center py-12 text-gray-500">No users found</div>
</template>

<script setup>
import { ref } from "vue";

const props = defineProps({
    users: { type: Array, default: () => [] },
});

const emit = defineEmits(["open-modal"]);

const hovered = ref(null);
</script>
