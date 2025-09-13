<template>
    <div class="py-6 lg:py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div
                class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6"
            >
                <button
                    v-if="!isAdmin"
                    @click="showNewAppointmentModal = true"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition-colors duration-200"
                >
                    + New Appointment
                </button>
            </div>

            <!-- Appointments Table -->
            <appointments-table
                :appointments="appointments"
                :is-admin="isAdmin"
                @assign-vet="openAssignVetModal"
                @show-vet="openVetDetailsModal"
            ></appointments-table>
        </div>

        <!-- Modals -->
        <new-appointment-modal
            :visible="showNewAppointmentModal"
            @close="showNewAppointmentModal = false"
            @appointment-added="fetchAppointments"
        ></new-appointment-modal>

        <assign-vet-modal
            :visible="showAssignVet"
            :appointment="selectedAppointment"
            :vets="availableVets"
            @close="closeAssignVetModal"
            @assign="assignVet"
        ></assign-vet-modal>

        <assign-vet-modal
            v-if="showVetDetails"
            :visible="showVetDetails"
            :appointment="selectedAppointment"
            :vets="[selectedAppointment?.vet]"
        >
            @close="closeVetDetailsModal" @assign="reassignVet"
            ></assign-vet-modal
        >
    </div>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";
import NewAppointmentModal from "./NewAppointment.vue";
import AppointmentsTable from "./AppointmentsTable.vue";
import AssignVetModal from "./AssignVetModal.vue";

// Props from parent Blade
const props = defineProps({
    initialAppointments: Array,
    isAdmin: Boolean,
    availableVets: Array,
});

// State
const appointments = ref([...props.initialAppointments]);

const showNewAppointmentModal = ref(false);
const showAssignVet = ref(false);
const showVetDetails = ref(false);
const selectedAppointment = ref(null);

// Methods
async function fetchAppointments() {
    try {
        const response = await axios.get("/api/appointments");
        appointments.value = response.data.data; // reactive replacement

        // ✅ Show SweetAlert after fetching appointments
        Swal.fire({
            icon: "success",
            title: "Appointments refreshed",
            text: "The table has been updated successfully!",
            timer: 1500,
            showConfirmButton: false,
        });
    } catch (error) {
        console.error("Failed to fetch appointments:", error);
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Failed to fetch appointments.",
        });
    }
}

function openAssignVetModal(appointment) {
    selectedAppointment.value = appointment;
    showAssignVet.value = true;
}

function closeAssignVetModal() {
    selectedAppointment.value = null;
    showAssignVet.value = false;
}
// Vue / JS
async function assignVet({ vet, appointment }) {
    try {
        const payload = {
            appointment_id: appointment.id,
            vet_id: vet.id,
        };

        // Assign the vet
        const response = await axios.post(
            `/api/appointments/assign-vet/${appointment.id}`,
            payload,
            { withCredentials: true } // ensures session/auth cookies are sent
        );

        if (response.data.success) {
            const updated = response.data.appointment;

            // Replace old appointment with full updated object
            const index = appointments.value.findIndex(
                (a) => a.id === updated.id
            );
            if (index !== -1) {
                appointments.value[index] = updated;
            } else {
                appointments.value.push(updated);
            }

            // Optional: short delay to ensure DB commit before refetch
            await new Promise((resolve) => setTimeout(resolve, 50));

            // Refetch all appointments for consistency
            await fetchAppointments();

            closeAssignVetModal();
        }
    } catch (err) {
        console.error("Failed to assign vet:", err);
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Failed to assign vet or refresh appointments.",
        });
    }
}

function openVetDetailsModal(appointment) {
    selectedAppointment.value = appointment;
    showVetDetails.value = true;
}

function closeVetDetailsModal() {
    selectedAppointment.value = null;
    showVetDetails.value = false;
}

function reassignVet({ vet, appointment }) {
    appointment.vet_name = vet.name;
    appointment.vet_id = vet.id;
    closeVetDetailsModal();
}
</script>
