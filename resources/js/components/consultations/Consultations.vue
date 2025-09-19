<template>
    <div class="relative min-h-screen">
        <!-- Loader -->
        <div
            v-if="loading"
            class="absolute inset-0 flex items-center justify-center bg-white z-50"
        >
            <div
                class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-600"
            ></div>
        </div>

        <!-- Empty state -->
        <div
            v-else-if="consultations.length === 0"
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
                            v-for="species in allSpecies"
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
import { ref, computed, onMounted } from "vue";
import axios from "axios";
import ConsultationCard from "./ConsultationCard.vue";

const loading = ref(true);
const consultations = ref([]);
const allSpecies = ref([]);

const searchTerm = ref("");
const selectedSpecies = ref("");

// Fetch consultations + species from API
async function fetchData() {
    try {
        const { data } = await axios.get("/api/consultations");
        consultations.value = data.consultations || [];
        allSpecies.value = data.all_species || [];
    } catch (error) {
        console.error("Failed to fetch consultations:", error);
    } finally {
        loading.value = false;
    }
}

// Filtered consultations
const filteredConsultations = computed(() => {
    const search = searchTerm.value.trim().toLowerCase();

    return consultations.value.filter((consultation) => {
        if (!consultation) return false;

        const matchesSpecies = selectedSpecies.value
            ? consultation.pet_species?.trim() === selectedSpecies.value
            : true;

        const matchesSearch = search
            ? consultation.pet_name?.toLowerCase()?.includes(search) ||
              consultation.owner_name?.toLowerCase()?.includes(search) ||
              consultation.pet_species?.toLowerCase()?.includes(search) ||
              consultation.pet_breed?.toLowerCase()?.includes(search)
            : true;

        return matchesSpecies && matchesSearch;
    });
});

function clearFilters() {
    searchTerm.value = "";
    selectedSpecies.value = "";
}

// ✅ Load on mount
onMounted(() => {
    fetchData();
});
</script>
