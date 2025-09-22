<template>
    <div
        v-if="consultations.length"
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
                <i class="bi bi-x-lg text-xl"></i>
            </button>
        </div>

        <!-- Tabs + Download PDF -->
        <div class="border-b border-gray-200 print:hidden">
            <nav class="flex items-center px-4 sm:px-6 w-full">
                <div class="flex">
                    <button
                        @click="activeTab = 'info'"
                        :class="tabClass('info')"
                        class="py-3 px-4 border-b-2 font-medium text-sm transition-colors"
                    >
                        Patient Info
                    </button>
                    <button
                        @click="activeTab = 'history'"
                        :class="tabClass('history')"
                        class="py-3 px-4 border-b-2 font-medium text-sm transition-colors"
                    >
                        Consultation History
                    </button>
                    <button
                        @click="activeTab = 'new'"
                        :class="tabClass('new', true)"
                        class="py-3 px-4 border-b-2 font-medium text-sm transition-colors"
                    >
                        + New Consultation
                    </button>
                </div>

                <!-- Download PDF button on the far right -->
                <div class="ml-auto">
                    <a
                        :href="downloadLink"
                        class="w-10 h-10 flex items-center justify-center text-gray-600 hover:bg-gray-100 hover:text-gray-800 transition-colors"
                    >
                        <i class="bi bi-download text-lg"></i>
                    </a>
                </div>
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
                            <InfoField
                                label="Pet Name"
                                :value="consultations[0].pet_name"
                            />
                            <InfoField
                                label="Species"
                                :value="consultations[0].pet_species"
                            />
                            <InfoField
                                label="Breed"
                                :value="consultations[0].pet_breed"
                            />
                        </div>
                        <div class="space-y-4">
                            <InfoField
                                label="Sex"
                                :value="consultations[0].pet_sex"
                            />
                            <InfoField
                                label="Date of Birth"
                                :value="
                                    formatDate(consultations[0].date_of_birth)
                                "
                            />
                            <InfoField
                                label="Owner"
                                :value="consultations[0].owner_name"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Consultation History -->
            <div v-show="activeTab === 'history'" class="p-4 sm:p-6">
                <div v-if="consultations[0].consultations.length">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        Consultation History
                    </h3>

                    <!-- Date selector -->
                    <div class="flex flex-wrap gap-2 mb-6">
                        <button
                            v-for="c in consultations[0].consultations"
                            :key="c.id"
                            @click="selected = c.created_at"
                            :class="
                                selected === c.created_at
                                    ? 'bg-blue-600 text-white shadow-sm'
                                    : 'bg-white text-gray-700 hover:bg-gray-50 border-gray-300'
                            "
                            class="px-4 py-2 border rounded-lg text-sm font-medium transition-colors"
                        >
                            {{
                                formatDate(c.created_at, {
                                    month: "short",
                                    day: "numeric",
                                    year: "numeric",
                                })
                            }}
                        </button>
                    </div>

                    <!-- Consultation details -->
                    <div class="space-y-6">
                        <div
                            v-for="c in consultations[0].consultations"
                            :key="c.id"
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
                                    <VitalField
                                        label="Body Weight"
                                        :value="
                                            c.body_weight
                                                ? c.body_weight + ' kg'
                                                : null
                                        "
                                    />
                                    <VitalField
                                        label="Respiratory Rate"
                                        :value="
                                            c.respiratory_rate
                                                ? c.respiratory_rate + ' bpm'
                                                : null
                                        "
                                    />
                                    <VitalField
                                        label="Temperature"
                                        :value="
                                            c.temperature
                                                ? c.temperature + '°C'
                                                : null
                                        "
                                    />
                                </div>
                            </div>

                            <!-- Clinical Info -->
                            <div class="space-y-4">
                                <ClinicalField
                                    label="Chief Complaint"
                                    :value="c.complaint"
                                />
                                <ClinicalField
                                    label="Medication"
                                    :value="c.medication"
                                />
                                <ClinicalField
                                    label="Prescription"
                                    :value="c.prescription"
                                />
                            </div>

                            <!-- Veterinarian Info -->
                            <div class="pt-4 border-t border-gray-100">
                                <div
                                    class="flex items-center text-sm text-gray-600"
                                >
                                    <i class="bi bi-person-circle mr-2"></i>
                                    <span
                                        ><strong>Veterinarian:</strong>
                                        {{ c.vet_name }}</span
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Empty state -->
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
                <form class="space-y-6" @submit.prevent="saveConsultation">
                    <textarea
                        v-model="form.complaint"
                        placeholder="Complaint"
                        class="border p-2 rounded w-full"
                        rows="3"
                    ></textarea>

                    <textarea
                        v-model="form.medication"
                        placeholder="Medication"
                        class="border p-2 rounded w-full"
                        rows="3"
                    ></textarea>

                    <textarea
                        v-model="form.prescription"
                        placeholder="Prescription"
                        class="border p-2 rounded w-full"
                        rows="3"
                    ></textarea>

                    <div class="flex justify-end">
                        <button class="btn btn-green">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal Footer -->
        <div
            class="border-t border-gray-200 p-4 sm:p-6 bg-gray-50 print:hidden"
        >
            <div class="flex flex-col sm:flex-row justify-between gap-3">
                <div class="text-sm text-gray-600">
                    <span class="font-medium">{{
                        consultations.filter((c) => c.consultation_id).length
                    }}</span>
                    total consultations
                </div>
            </div>
        </div>
    </div>

    <div v-else class="p-6 text-center text-gray-600">
        <h3 class="text-lg font-medium mb-2">No patient data</h3>
        <p>Please select a pet with consultation records.</p>
    </div>
</template>

<script setup>
import { ref, computed } from "vue";
import axios from "axios";

const props = defineProps({
    consultations: { type: Array, required: true },
});

const activeTab = ref("info");
const selected = ref(
    props.consultations.find((c) => c.consultation_id)?.created_at || null
);

const form = ref({
    complaint: "",
    medication: "",
    prescription: "",
});

function formatDate(
    date,
    opts = { month: "long", day: "numeric", year: "numeric" }
) {
    return date
        ? new Date(date).toLocaleDateString("en-US", opts)
        : "Not available";
}

function tabClass(tab, isNew = false) {
    if (activeTab.value === tab) {
        return isNew
            ? "border-green-500 text-green-600"
            : "border-blue-500 text-blue-600";
    }
    return "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300";
}

async function saveConsultation() {
    try {
        const petId = props.consultations[0].pet_id;
        const response = await axios.post(`/api/consultations`, {
            pet_id: petId,
            ...form.value,
        });

        if (response.data.success) {
            const newConsultation = response.data.consultation;
            props.consultations.push(newConsultation); // update immediately
            activeTab.value = "history";
            selected.value = newConsultation.created_at;
            form.value = { complaint: "", medication: "", prescription: "" };
        }
    } catch (err) {
        console.error(err);
        alert("Failed to save consultation.");
    }
}

const downloadLink = computed(() =>
    props.consultations.length
        ? `/consultations/download/${props.consultations[0].pet_id}`
        : "#"
);
</script>

<script>
export default {
    components: {
        InfoField: {
            props: ["label", "value"],
            template: `
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">{{ label }}</label>
                    <div class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900">
                        {{ value || 'Not available' }}
                    </div>
                </div>
            `,
        },
        VitalField: {
            props: ["label", "value"],
            template: `
                <div class="bg-gray-50 rounded-lg p-3">
                    <label class="block text-xs font-medium text-gray-600 mb-1">{{ label }}</label>
                    <div class="text-sm font-medium text-gray-900">
                        {{ value || 'Not recorded' }}
                    </div>
                </div>
            `,
        },
        ClinicalField: {
            props: ["label", "value"],
            template: `
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">{{ label }}</label>
                    <div class="bg-gray-50 rounded-lg p-3 text-sm text-gray-900 min-h-[60px]">
                        {{ value || 'No ' + label.toLowerCase() + ' recorded' }}
                    </div>
                </div>
            `,
        },
    },
};
</script>
