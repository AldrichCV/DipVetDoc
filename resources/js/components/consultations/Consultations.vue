<template>
    <div>
        <!-- Empty state -->
        <div v-if="consultations.length === 0" class="text-center py-16">
            <div class="mx-auto h-24 w-24 text-gray-300 mb-4">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                    />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">
                No consultations found
            </h3>
            <p class="text-gray-500">
                Get started by adding your first consultation record.
            </p>
        </div>

        <!-- Filters -->
        <div v-else>
            <div
                class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 mb-6 flex flex-col lg:flex-row gap-4"
            >
                <!-- Species Filter -->
                <div class="lg:w-48">
                    <label class="block text-sm font-medium text-gray-700 mb-2"
                        >Species</label
                    >
                    <select
                        v-model="selectedSpecies"
                        class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    >
                        <option value="">All</option>
                        <option
                            v-for="species in allSpecies"
                            :key="species"
                            :value="species"
                        >
                            {{ species }}
                        </option>
                    </select>
                </div>

                <!-- Visit Count Filter -->
                <div class="lg:w-48">
                    <label class="block text-sm font-medium text-gray-700 mb-2"
                        >Visit Count</label
                    >
                    <select
                        v-model="selectedVisitRange"
                        class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    >
                        <option value="">All</option>
                        <option value="1">1 Visit</option>
                        <option value="2-5">2-5 Visits</option>
                        <option value="6+">6+ Visits</option>
                    </select>
                </div>

                <!-- Search -->
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2"
                        >Search</label
                    >
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                        >
                            <svg
                                class="h-5 w-5 text-gray-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                />
                            </svg>
                        </div>
                        <input
                            type="text"
                            v-model="searchTerm"
                            placeholder="Search by pet, owner, species, breed..."
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        />
                    </div>
                </div>

                <!-- Clear Filters -->
                <div class="lg:w-auto flex items-end">
                    <button
                        @click="clearFilters"
                        class="relative group px-4 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors font-medium"
                    >
                        <i class="fa-solid fa-filter-circle-xmark"></i>
                        <span
                            class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block bg-gray-800 text-white text-xs rounded py-1 px-2 whitespace-nowrap shadow-md"
                        >
                            Clear Filters
                        </span>
                    </button>
                </div>
            </div>

            <!-- Consultation Cards -->
            <div
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6"
            >
                <div
                    v-for="(petConsultations, index) in filteredConsultations"
                    :key="index"
                >
                    <ConsultationCard :consultations="petConsultations" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from "vue";
import ConsultationCard from "./ConsultationCard.vue"; // Separate card component

// Props: passed from Blade via JSON
const props = defineProps({
    consultations: { type: Array, default: () => [] },
});

// Filters
const searchTerm = ref("");
const selectedSpecies = ref("");
const selectedVisitRange = ref("");

// Computed: unique species
const allSpecies = computed(() => {
    const species = [];
    props.consultations.forEach((pet) => {
        species.push(pet[0].pet_species); // first consultation
    });
    return [...new Set(species)].sort();
});

// Filtered consultations
const filteredConsultations = computed(() => {
    return props.consultations.filter((pet) => {
        const first = pet[0];
        const visitCount = pet.length;

        const matchesSpecies = selectedSpecies.value
            ? first.pet_species === selectedSpecies.value
            : true;
        const matchesVisit = selectedVisitRange.value
            ? selectedVisitRange.value === "1"
                ? visitCount === 1
                : selectedVisitRange.value === "2-5"
                ? visitCount >= 2 && visitCount <= 5
                : visitCount >= 6
            : true;
        const matchesSearch = searchTerm.value
            ? first.pet_name
                  .toLowerCase()
                  .includes(searchTerm.value.toLowerCase()) ||
              first.owner_name
                  .toLowerCase()
                  .includes(searchTerm.value.toLowerCase()) ||
              first.pet_species
                  .toLowerCase()
                  .includes(searchTerm.value.toLowerCase()) ||
              first.pet_breed
                  .toLowerCase()
                  .includes(searchTerm.value.toLowerCase())
            : true;

        return matchesSpecies && matchesVisit && matchesSearch;
    });
});

// Clear filters
function clearFilters() {
    searchTerm.value = "";
    selectedSpecies.value = "";
    selectedVisitRange.value = "";
}
</script>
