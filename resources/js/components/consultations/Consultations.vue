<template>
    <div>
        <!-- Empty state -->
        <div
            v-if="props.consultations.length === 0"
            class="text-center py-8 sm:py-12 lg:py-16"
        >
            <div class="mx-auto h-24 w-24 text-gray-300 mb-4">
                <i class="fa-solid fa-file text-6xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">
                No consultations found
            </h3>
            <p class="text-gray-500">
                Get started by adding your first consultation record.
            </p>
        </div>

        <!-- Filters + Cards -->
        <div v-else>
            <!-- Filters -->
            <div
                class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 mb-6 flex flex-col lg:flex-row gap-4"
            >
                <!-- Species Filter -->
                <div class="lg:w-1/3">
                    <label
                        for="species-filter"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Species
                    </label>
                    <select
                        id="species-filter"
                        v-model="selectedSpecies"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    >
                        <option value="">All Species</option>
                        <option
                            v-for="species in props.allSpecies"
                            :key="species"
                            :value="species"
                        >
                            {{ species }}
                        </option>
                    </select>
                </div>

                <!-- Search -->
                <div class="lg:w-2/3">
                    <label
                        for="search-input"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Search
                    </label>
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                        >
                            <i
                                class="fa-solid fa-magnifying-glass text-gray-400 text-lg"
                            ></i>
                        </div>
                        <input
                            id="search-input"
                            type="text"
                            v-model="searchTerm"
                            placeholder="Search by pet, owner, species, breed..."
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        />
                    </div>
                </div>

                <!-- Clear Filters -->
                <div class="lg:w-auto">
                    <!-- Empty label for alignment -->
                    <label class="block text-sm font-medium text-gray-700 mb-2"
                        >&nbsp;</label
                    >
                    <button
                        @click="clearFilters"
                        class="px-3 py-2 bg-gray-100 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors font-medium flex items-center gap-2"
                    >
                        <i class="fa-solid fa-filter-circle-xmark text-lg"></i>
                        <span class="sr-only">Clear Filters</span>
                    </button>
                </div>
            </div>

            <!-- Consultation Cards -->
            <div
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6"
            >
                <div
                    v-for="consultation in filteredConsultations"
                    :key="consultation.id || consultation.pet_id"
                >
                    <ConsultationCard :consultation="consultation" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from "vue";
import ConsultationCard from "./ConsultationCard.vue";

// Note: Ensure Font Awesome is included in your project (e.g., via CDN: <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">)

// Props from Blade
const props = defineProps({
    consultations: {
        type: Array,
        default: () => [],
        validator: (consultations) => {
            return consultations.every(
                (c) =>
                    typeof c === "object" &&
                    "pet_id" in c &&
                    "pet_name" in c &&
                    "owner_name" in c &&
                    "pet_species" in c &&
                    "pet_breed" in c
            );
        },
    },
    allSpecies: { type: Array, default: () => [] },
});

const searchTerm = ref("");
const selectedSpecies = ref("");

// Filtered consultations
const filteredConsultations = computed(() => {
    const search = searchTerm.value.trim().toLowerCase();

    return props.consultations.filter((consultation) => {
        if (!consultation) return false;

        const matchesSpecies = selectedSpecies.value
            ? consultation.pet_species?.trim() === selectedSpecies.value
            : true;

        const matchesSearch = search
            ? consultation.pet_name?.toLowerCase()?.includes(search) ||
              false ||
              consultation.owner_name?.toLowerCase()?.includes(search) ||
              false ||
              consultation.pet_species?.toLowerCase()?.includes(search) ||
              false ||
              consultation.pet_breed?.toLowerCase()?.includes(search) ||
              false
            : true;

        return matchesSpecies && matchesSearch;
    });
});

function clearFilters() {
    searchTerm.value = "";
    selectedSpecies.value = "";
}
</script>
