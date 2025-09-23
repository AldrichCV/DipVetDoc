<template>
    <teleport to="body">
        <div
            v-show="visible"
            class="fixed inset-0 bg-black/60 backdrop-blur-md flex items-center justify-center z-50 p-4"
        >
            <div
                class="bg-white rounded-2xl shadow-2xl w-full max-w-6xl max-h-[90vh] flex flex-col"
            >
                <!-- Modal Header -->
                <div
                    class="flex items-center justify-between p-6 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-t-2xl"
                >
                    <h2 class="text-xl font-semibold">
                        Schedule New Appointment
                    </h2>
                    <button
                        @click="$emit('close')"
                        class="text-white/80 hover:text-white hover:bg-white/20 rounded-lg p-2 transition-all duration-200"
                    >
                        ✕
                    </button>
                </div>

                <!-- FORM -->
                <form
                    @submit.prevent="submitAppointment"
                    class="flex-1 flex flex-col"
                >
                    <!--  Added responsive layout: desktop split-screen, mobile steps -->
                    <!-- Desktop: Split Layout -->
                    <div class="hidden md:flex flex-1">
                        <!-- Left Side: Pet Information -->
                        <div class="flex-1 p-6 border-r border-gray-200">
                            <h4
                                class="text-lg font-semibold text-gray-900 mb-6 pb-2 border-b border-gray-100"
                            >
                                Pet Information
                            </h4>
                            <div class="space-y-4">
                                <input
                                    v-model="form.name"
                                    type="text"
                                    placeholder="Pet Name *"
                                    required
                                    class="input"
                                />
                                <select
                                    v-model="form.species"
                                    required
                                    class="input"
                                >
                                    <option value="">
                                        -- Select Species --
                                    </option>
                                    <option value="Dog">Dog</option>
                                    <option value="Cat">Cat</option>
                                    <option value="Rabbit">Rabbit</option>
                                    <option value="Guinea Pig">
                                        Guinea Pig
                                    </option>
                                    <option value="Hamster">Hamster</option>
                                    <option value="Ferret">Ferret</option>
                                    <option value="Parakeet">
                                        Parakeet (Budgie)
                                    </option>
                                    <option value="Lovebird">Lovebird</option>
                                    <option value="Cockatiel">Cockatiel</option>
                                    <option value="Canary">Canary</option>
                                    <option value="Turtle">
                                        Turtle / Tortoise
                                    </option>
                                    <option value="Gecko">Gecko</option>
                                    <option value="Iguana">Iguana</option>
                                    <option value="Snake">
                                        Snake (non-venomous)
                                    </option>
                                </select>
                                <input
                                    v-model="form.breed"
                                    type="text"
                                    placeholder="Breed (optional)"
                                    class="input"
                                />
                                <select
                                    v-model="form.sex"
                                    required
                                    class="input"
                                >
                                    <option value="">-- Select Sex --</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <input
                                    v-model="form.date_of_birth"
                                    type="date"
                                    class="input"
                                    :max="today"
                                />
                            </div>
                        </div>

                        <!-- Right Side: Appointment Details -->
                        <div class="flex-1 p-6">
                            <h4
                                class="text-lg font-semibold text-gray-900 mb-6 pb-2 border-b border-gray-100"
                            >
                                Appointment Details
                            </h4>
                            <div class="space-y-4">
                                <input
                                    v-model="form.appointment_date"
                                    type="date"
                                    required
                                    :min="today"
                                    class="input"
                                    @change="updateTimeRange"
                                />
                                <input
                                    v-model="form.appointment_time"
                                    type="time"
                                    required
                                    :min="minTime"
                                    :max="maxTime"
                                    class="input"
                                />
                                <select
                                    v-model="form.reason"
                                    required
                                    class="input"
                                >
                                    <option value="">
                                        -- Select Service --
                                    </option>
                                    <option
                                        v-for="service in services"
                                        :key="service.id"
                                        :value="service.id"
                                    >
                                        {{ service.name }}
                                    </option>
                                </select>
                                <textarea
                                    v-model="form.notes"
                                    placeholder="Notes (Optional)"
                                    rows="4"
                                    class="input resize-none"
                                ></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile: Step-by-Step -->
                    <div class="md:hidden flex-1 flex flex-col">
                        <!-- Step Indicator -->
                        <div
                            class="flex items-center justify-center p-4 bg-gray-50"
                        >
                            <div class="flex items-center space-x-2">
                                <div
                                    :class="[
                                        'w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium',
                                        currentStep === 1
                                            ? 'bg-blue-600 text-white'
                                            : 'bg-gray-300 text-gray-600',
                                    ]"
                                >
                                    1
                                </div>
                                <div class="w-8 h-0.5 bg-gray-300"></div>
                                <div
                                    :class="[
                                        'w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium',
                                        currentStep === 2
                                            ? 'bg-blue-600 text-white'
                                            : 'bg-gray-300 text-gray-600',
                                    ]"
                                >
                                    2
                                </div>
                            </div>
                        </div>

                        <!-- Step 1: Pet Information -->
                        <div v-show="currentStep === 1" class="flex-1 p-6">
                            <h4
                                class="text-lg font-semibold text-gray-900 mb-6"
                            >
                                Pet Information
                            </h4>
                            <div class="space-y-4">
                                <input
                                    v-model="form.name"
                                    type="text"
                                    placeholder="Pet Name *"
                                    required
                                    class="input"
                                />
                                <select
                                    v-model="form.species"
                                    required
                                    class="input"
                                >
                                    <option value="">
                                        -- Select Species --
                                    </option>
                                    <option value="Dog">Dog</option>
                                    <option value="Cat">Cat</option>
                                    <option value="Rabbit">Rabbit</option>
                                    <option value="Guinea Pig">
                                        Guinea Pig
                                    </option>
                                    <option value="Hamster">Hamster</option>
                                    <option value="Ferret">Ferret</option>
                                    <option value="Parakeet">
                                        Parakeet (Budgie)
                                    </option>
                                    <option value="Lovebird">Lovebird</option>
                                    <option value="Cockatiel">Cockatiel</option>
                                    <option value="Canary">Canary</option>
                                    <option value="Turtle">
                                        Turtle / Tortoise
                                    </option>
                                    <option value="Gecko">Gecko</option>
                                    <option value="Iguana">Iguana</option>
                                    <option value="Snake">
                                        Snake (non-venomous)
                                    </option>
                                </select>
                                <input
                                    v-model="form.breed"
                                    type="text"
                                    placeholder="Breed (optional)"
                                    class="input"
                                />
                                <select
                                    v-model="form.sex"
                                    required
                                    class="input"
                                >
                                    <option value="">-- Select Sex --</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <input
                                    v-model="form.date_of_birth"
                                    type="date"
                                    class="input"
                                    :max="today"
                                />
                            </div>
                        </div>

                        <!-- Step 2: Appointment Details -->
                        <div v-show="currentStep === 2" class="flex-1 p-6">
                            <h4
                                class="text-lg font-semibold text-gray-900 mb-6"
                            >
                                Appointment Details
                            </h4>
                            <div class="space-y-4">
                                <input
                                    v-model="form.appointment_date"
                                    type="date"
                                    required
                                    :min="today"
                                    class="input"
                                    @change="updateTimeRange"
                                />
                                <input
                                    v-model="form.appointment_time"
                                    type="time"
                                    required
                                    :min="minTime"
                                    :max="maxTime"
                                    class="input"
                                />
                                <select
                                    v-model="form.reason"
                                    required
                                    class="input"
                                >
                                    <option value="">
                                        -- Select Service --
                                    </option>
                                    <option
                                        v-for="service in services"
                                        :key="service.id"
                                        :value="service.id"
                                    >
                                        {{ service.name }}
                                    </option>
                                </select>
                                <textarea
                                    v-model="form.notes"
                                    placeholder="Notes (Optional)"
                                    rows="4"
                                    class="input resize-none"
                                ></textarea>
                            </div>
                        </div>

                        <!-- Mobile Navigation -->
                        <div class="p-4 border-t border-gray-200">
                            <div
                                v-if="currentStep === 1"
                                class="flex justify-end"
                            >
                                <button
                                    type="button"
                                    @click="nextStep"
                                    :disabled="!canProceedToStep2"
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg disabled:bg-gray-300 disabled:cursor-not-allowed"
                                >
                                    Next
                                </button>
                            </div>
                            <div
                                v-if="currentStep === 2"
                                class="flex justify-between"
                            >
                                <button
                                    type="button"
                                    @click="prevStep"
                                    class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg"
                                >
                                    Back
                                </button>
                                <button
                                    type="submit"
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg"
                                >
                                    Schedule
                                </button>
                            </div>
                        </div>
                    </div>

                    <!--  Updated footer with right-aligned buttons and proper padding -->
                    <!-- Desktop Footer -->
                    <div
                        class="hidden md:block border-t border-gray-200 px-6 py-4"
                    >
                        <div class="flex justify-end gap-3">
                            <button
                                type="button"
                                @click="$emit('close')"
                                class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                class="px-6 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all"
                            >
                                Schedule Appointment
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </teleport>
</template>

<script setup>
import { reactive, ref, computed } from "vue";
import axios from "axios";

const props = defineProps({
    visible: Boolean,
});

const emit = defineEmits(["close", "appointment-added"]);

//  Added mobile step navigation state
const currentStep = ref(1);

const form = reactive({
    name: "",
    species: "",
    breed: "",
    sex: "",
    date_of_birth: "",
    appointment_date: "",
    appointment_time: "",
    reason: "",
    notes: "",
});

const today = new Date().toISOString().split("T")[0];

const services = [
    { id: 1, name: "Check-up" },
    { id: 2, name: "Deworming" },
    { id: 3, name: "Home Service" },
    { id: 4, name: "Laboratories" },
    { id: 5, name: "Non-Surgical Procedures" },
    { id: 6, name: "Surgical Procedures" },
    { id: 7, name: "Therapies" },
    { id: 8, name: "Tick & Flea Preventive" },
    { id: 9, name: "Vaccinations" },
];

const minTime = "08:00";
const maxTime = "17:00";

//  Added step validation and navigation functions
const canProceedToStep2 = computed(() => {
    return form.name && form.species && form.sex;
});

function nextStep() {
    if (canProceedToStep2.value) {
        currentStep.value = 2;
    }
}

function prevStep() {
    currentStep.value = 1;
}

function updateTimeRange() {
    // optional future validation
}

// async function submitAppointment() {
//     try {
//         const payload = { ...form };

//         const response = await axios.post("/api/appointments", payload);

//         console.log("Saved!", response.data);

//         // Show success alert
//         await Swal.fire({
//             title: "Appointment Scheduled!",
//             text: "Your appointment has been saved successfully.",
//             icon: "success",
//             confirmButtonText: "OK",
//         }).then(() => {
//             // only runs after user clicks OK
//             emit("appointment-added");
//             emit("close");

//             // reset form
//             Object.keys(form).forEach((key) => (form[key] = ""));
//             currentStep.value = 1; //  Reset step on form reset
//         });
//     } catch (error) {
//         console.error(
//             "Error saving appointment",
//             error.response?.data || error
//         );

//         Swal.fire({
//             title: "Error!",
//             text: error.response?.data?.message || "Something went wrong.",
//             icon: "error",
//             confirmButtonText: "OK",
//         });
//     }
// }
async function submitAppointment() {
    try {
        const payload = { ...form };

        const response = await axios.post("/api/appointments", payload);

        console.log("Saved!", response.data);

        // Emit events and reset form without Swal
        emit("appointment-added");
        emit("close");

        // reset form
        Object.keys(form).forEach((key) => (form[key] = ""));
        currentStep.value = 1; // Reset step on form reset
    } catch (error) {
        console.error(
            "Error saving appointment",
            error.response?.data || error
        );

        // Optional: handle error in your UI here instead of Swal
        // e.g., set an error variable to show a message in template
    }
}
</script>

<style scoped>
.input {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.input:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}
</style>
