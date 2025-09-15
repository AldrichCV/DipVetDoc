<template>
    <div
        class="consultation-card bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden group"
    >
        <!-- Card Header -->
        <div class="p-4 sm:p-6 border-b border-gray-100">
            <div class="flex items-start justify-between mb-3">
                <div class="flex-1 min-w-0">
                    <h3 class="text-lg font-semibold text-gray-900 truncate">
                        {{ consultation.pet_name }}
                    </h3>
                    <p class="text-sm text-gray-600 mt-1">
                        {{ consultation.pet_species }} •
                        {{ consultation.pet_breed }}
                    </p>
                </div>
                <div class="flex-shrink-0 ml-3">
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800"
                    >
                        {{ consultation.visit_count || 1 }}
                        {{
                            (consultation.visit_count || 1) > 1
                                ? "visits"
                                : "visit"
                        }}
                    </span>
                </div>
            </div>

            <div class="space-y-2">
                <div class="flex items-center text-sm text-gray-600">
                    <svg
                        class="w-4 h-4 mr-2 flex-shrink-0"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                        />
                    </svg>
                    <span class="truncate">{{ consultation.owner_name }}</span>
                </div>
                <div class="flex items-center text-sm text-gray-500">
                    <svg
                        class="w-4 h-4 mr-2 flex-shrink-0"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                        />
                    </svg>
                    <span>Last visit: {{ lastConsultDateFormatted }}</span>
                </div>
            </div>
        </div>

        <!-- Card Actions -->
        <div class="p-4 sm:p-6 bg-gray-50">
            <button
                @click="openModal"
                class="w-full px-4 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200"
            >
                View Records
            </button>
        </div>

        <!-- Modal -->
        <div
            v-if="openConsultationModal"
            class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50 p-4"
        >
            <ConsultationModal
                :consultations="[consultation]"
                @close="openConsultationModal = false"
            />
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from "vue";
import ConsultationModal from "./ConsultationModal.vue";

const props = defineProps({
    consultation: { type: Object, required: true }, // single consultation object
});

const openConsultationModal = ref(false);
function openModal() {
    openConsultationModal.value = true;
}

// Format last visit date
const lastConsultDateFormatted = computed(() => {
    return new Date(props.consultation.created_at).toLocaleDateString("en-US", {
        month: "short",
        day: "numeric",
        year: "numeric",
    });
});

// Aliases for template
const consultation = props.consultation;
</script>
