<template>
    <div
        class="bg-white rounded-xl shadow-2xl relative w-full max-w-4xl max-h-[90vh] overflow-auto"
    >
        <!-- Modal Header -->
        <div
            class="flex justify-between items-center p-4 sm:p-6 border-b border-gray-200 print:hidden"
        >
            <div>
                <h2 class="text-xl font-semibold text-gray-900">
                    {{ consultations[0].pet_name }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Medical Records</p>
            </div>
            <button
                @click="$emit('close')"
                class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors"
            >
                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>
        </div>

        <!-- Tabs -->
        <div class="border-b border-gray-200 print:hidden">
            <nav class="flex px-4 sm:px-6">
                <button
                    @click="activeTab = 'info'"
                    :class="
                        activeTab === 'info'
                            ? 'border-blue-500 text-blue-600'
                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                    "
                    class="py-3 px-4 border-b-2 font-medium text-sm transition-colors"
                >
                    Patient Info
                </button>
                <button
                    @click="activeTab = 'history'"
                    :class="
                        activeTab === 'history'
                            ? 'border-blue-500 text-blue-600'
                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                    "
                    class="py-3 px-4 border-b-2 font-medium text-sm transition-colors"
                >
                    Consultation History
                </button>
                <button
                    @click="activeTab = 'new'"
                    :class="
                        activeTab === 'new'
                            ? 'border-green-500 text-green-600'
                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                    "
                    class="py-3 px-4 border-b-2 font-medium text-sm transition-colors"
                >
                    + New Consultation
                </button>
            </nav>
        </div>

        <!-- Tab Content -->
        <div
            class="overflow-y-auto flex-1"
            style="max-height: calc(90vh - 180px)"
        >
            <!-- Patient Info -->
            <div v-show="activeTab === 'info'" class="p-4 sm:p-6">
                <div class="max-w-2xl">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">
                        Patient Information
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                    >Pet Name</label
                                >
                                <div
                                    class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900"
                                >
                                    {{ consultations[0].pet_name }}
                                </div>
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                    >Species</label
                                >
                                <div
                                    class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900"
                                >
                                    {{ consultations[0].pet_species }}
                                </div>
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                    >Breed</label
                                >
                                <div
                                    class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900"
                                >
                                    {{ consultations[0].pet_breed }}
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                    >Sex</label
                                >
                                <div
                                    class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900"
                                >
                                    {{ consultations[0].pet_sex }}
                                </div>
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                    >Date of Birth</label
                                >
                                <div
                                    class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900"
                                >
                                    {{
                                        new Date(
                                            consultations[0].date_of_birth
                                        ).toLocaleDateString("en-US", {
                                            month: "long",
                                            day: "numeric",
                                            year: "numeric",
                                        })
                                    }}
                                </div>
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2"
                                    >Owner</label
                                >
                                <div
                                    class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900"
                                >
                                    {{ consultations[0].owner_name }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Consultation History -->
            <div v-show="activeTab === 'history'" class="p-4 sm:p-6">
                <div v-if="consultations.some((c) => c.consultation_id)">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        Consultation History
                    </h3>
                    <div class="flex flex-wrap gap-2 mb-6">
                        <button
                            v-for="c in consultations.filter(
                                (c) => c.consultation_id
                            )"
                            :key="c.consultation_id"
                            @click="selected = c.created_at"
                            :class="
                                selected === c.created_at
                                    ? 'bg-blue-600 text-white shadow-sm'
                                    : 'bg-white text-gray-700 hover:bg-gray-50 border-gray-300'
                            "
                            class="px-4 py-2 border rounded-lg text-sm font-medium transition-colors"
                        >
                            {{
                                new Date(c.created_at).toLocaleDateString(
                                    "en-US",
                                    {
                                        month: "short",
                                        day: "numeric",
                                        year: "numeric",
                                    }
                                )
                            }}
                        </button>
                    </div>

                    <div class="space-y-6">
                        <div
                            v-for="c in consultations.filter(
                                (c) => c.consultation_id
                            )"
                            :key="c.consultation_id"
                            v-show="selected === c.created_at"
                            class="bg-white border border-gray-200 rounded-xl p-6 space-y-6"
                        >
                            <div
                                class="flex items-center justify-between pb-4 border-b border-gray-100"
                            >
                                <h4 class="text-lg font-semibold text-gray-900">
                                    Consultation Details
                                </h4>
                                <div class="text-sm text-gray-500">
                                    {{
                                        new Date(c.created_at).toLocaleString()
                                    }}
                                </div>
                            </div>

                            <!-- Vital Signs -->
                            <div>
                                <h5
                                    class="text-sm font-semibold text-gray-900 mb-3"
                                >
                                    Vital Signs
                                </h5>
                                <div
                                    class="grid grid-cols-1 sm:grid-cols-3 gap-4"
                                >
                                    <div class="bg-gray-50 rounded-lg p-3">
                                        <label
                                            class="block text-xs font-medium text-gray-600 mb-1"
                                            >Body Weight</label
                                        >
                                        <div
                                            class="text-sm font-medium text-gray-900"
                                        >
                                            {{
                                                c.body_weight
                                                    ? c.body_weight + " kg"
                                                    : "Not recorded"
                                            }}
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 rounded-lg p-3">
                                        <label
                                            class="block text-xs font-medium text-gray-600 mb-1"
                                            >Respiratory Rate</label
                                        >
                                        <div
                                            class="text-sm font-medium text-gray-900"
                                        >
                                            {{
                                                c.respiratory_rate
                                                    ? c.respiratory_rate +
                                                      " bpm"
                                                    : "Not recorded"
                                            }}
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 rounded-lg p-3">
                                        <label
                                            class="block text-xs font-medium text-gray-600 mb-1"
                                            >Temperature</label
                                        >
                                        <div
                                            class="text-sm font-medium text-gray-900"
                                        >
                                            {{
                                                c.temperature
                                                    ? c.temperature + "°C"
                                                    : "Not recorded"
                                            }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Clinical Info -->
                            <div class="space-y-4">
                                <div>
                                    <label
                                        class="block text-sm font-semibold text-gray-900 mb-2"
                                        >Chief Complaint</label
                                    >
                                    <div
                                        class="bg-gray-50 rounded-lg p-3 text-sm text-gray-900 min-h-[60px]"
                                    >
                                        {{
                                            c.complaint ||
                                            "No complaint recorded"
                                        }}
                                    </div>
                                </div>
                                <div>
                                    <label
                                        class="block text-sm font-semibold text-gray-900 mb-2"
                                        >Medication</label
                                    >
                                    <div
                                        class="bg-gray-50 rounded-lg p-3 text-sm text-gray-900 min-h-[60px]"
                                    >
                                        {{
                                            c.medication ||
                                            "No medication recorded"
                                        }}
                                    </div>
                                </div>
                                <div>
                                    <label
                                        class="block text-sm font-semibold text-gray-900 mb-2"
                                        >Prescription</label
                                    >
                                    <div
                                        class="bg-gray-50 rounded-lg p-3 text-sm text-gray-900 min-h-[60px]"
                                    >
                                        {{
                                            c.prescription ||
                                            "No prescription recorded"
                                        }}
                                    </div>
                                </div>
                            </div>

                            <!-- Veterinarian Info -->
                            <div class="pt-4 border-t border-gray-100">
                                <div
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <svg
                                        class="w-4 h-4 mr-2"
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
                                    <span
                                        ><strong>Veterinarian:</strong>
                                        {{ c.vet_name }}</span
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else class="text-center py-12">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">
                        No consultation history
                    </h3>
                    <p class="text-gray-500">
                        Start by adding the first consultation record.
                    </p>
                </div>
            </div>

            <!-- New Consultation -->
            <div v-show="activeTab === 'new'" class="p-4 sm:p-6">
                <form class="space-y-6">
                    <input
                        type="text"
                        placeholder="Complaint"
                        class="border p-2 rounded w-full"
                    />
                    <input
                        type="text"
                        placeholder="Medication"
                        class="border p-2 rounded w-full"
                    />
                    <input
                        type="text"
                        placeholder="Prescription"
                        class="border p-2 rounded w-full"
                    />
                    <button
                        type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded"
                    >
                        Save
                    </button>
                </form>
            </div>
        </div>

        <!-- Modal Footer -->
        <div
            class="border-t border-gray-200 p-4 sm:p-6 bg-gray-50 print:hidden"
        >
            <div class="flex flex-col sm:flex-row justify-between gap-3">
                <div class="text-sm text-gray-600">
                    <span class="font-medium">{{ consultations.length }}</span>
                    total consultations
                </div>
                <div class="flex gap-2">
                    <a
                        :href="downloadLink"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors"
                    >
                        <svg
                            class="w-4 h-4 mr-2"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                            />
                        </svg>
                        Download PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from "vue";

const props = defineProps({
    consultations: { type: Array, required: true },
});

const activeTab = ref("info");
const selected = ref(
    props.consultations.find((c) => c.consultation_id)?.created_at || null
);

// Replace this with your actual route function or pass it as a prop
const downloadLink = computed(
    () => `/consultations/download/${props.consultations[0].pet_id}`
);
</script>
