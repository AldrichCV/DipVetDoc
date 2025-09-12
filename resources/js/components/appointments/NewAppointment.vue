<template>
    <teleport to="body">
        <div
            v-show="visible"
            class="fixed inset-0 bg-black/60 backdrop-blur-md flex items-center justify-center z-50 p-4"
        >
            <div
                class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto"
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
                <form @submit.prevent="submitAppointment" class="p-6">
                    <!-- Pet Info -->
                    <div class="space-y-8">
                        <div>
                            <h4 class="text-lg font-medium text-gray-900 mb-4">
                                Pet Information
                            </h4>
                            <div
                                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4"
                            >
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

                        <!-- Appointment Details -->
                        <div>
                            <h4 class="text-lg font-medium text-gray-900 mb-4">
                                Appointment Details
                            </h4>
                            <div
                                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-4"
                            >
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
                            </div>
                            <textarea
                                v-model="form.notes"
                                placeholder="Notes (Optional)"
                                rows="4"
                                class="input resize-none"
                            ></textarea>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3 mt-8">
                        <button
                            type="button"
                            @click="$emit('close')"
                            class="btn-cancel"
                        >
                            Cancel
                        </button>
                        <button type="submit" class="btn-submit">
                            Schedule Appointment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </teleport>
</template>

<script setup>
import { reactive } from "vue";
import axios from "axios";

const props = defineProps({
    visible: Boolean,
});

const emit = defineEmits(["close", "appointment-added"]);

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

function updateTimeRange() {
    // optional future validation
}

async function submitAppointment() {
    try {
        const payload = { ...form };

        const response = await axios.post("/api/appointments", payload);

        console.log("Saved!", response.data);

        // Show success alert
        await Swal.fire({
            title: "Appointment Scheduled!",
            text: "Your appointment has been saved successfully.",
            icon: "success",
            confirmButtonText: "OK",
        }).then(() => {
            // only runs after user clicks OK
            emit("appointment-added");
            emit("close");

            // reset form
            Object.keys(form).forEach((key) => (form[key] = ""));
        });
    } catch (error) {
        console.error(
            "Error saving appointment",
            error.response?.data || error
        );

        Swal.fire({
            title: "Error!",
            text: error.response?.data?.message || "Something went wrong.",
            icon: "error",
            confirmButtonText: "OK",
        });
    }
}
</script>

<style scoped>
.input {
    width: 100%;
    padding: 0.625rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
}
.btn-cancel {
    flex: 1;
}
.btn-submit {
    flex: 1;
    background: linear-gradient(to right, #2563eb, #1d4ed8);
    color: #fff;
}
</style>
