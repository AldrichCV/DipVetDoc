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

            <!-- Vuetify Pagination -->

            <v-pagination
                v-if="pagination.last_page > 1"
                v-model="pagination.current_page"
                :length="pagination.last_page"
                :total-visible="7"
                color="primary"
                rounded
                class="mt-4"
                @update:modelValue="fetchAppointments"
            ></v-pagination>
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
            @close="closeVetDetailsModal"
            @assign="reassignVet"
        ></assign-vet-modal>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
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

const appointments = ref([...(props.initialAppointments || [])]);

const pagination = ref({
    current_page: 1,
    last_page: 1,
    per_page: 10,
    total: 0,
});

const showNewAppointmentModal = ref(false);
const showAssignVet = ref(false);
const showVetDetails = ref(false);
const selectedAppointment = ref(null);

// Fetch appointments with pagination
async function fetchAppointments(page = pagination.value.current_page) {
    try {
        const response = await axios.get("/api/appointments", {
            params: { page, per_page: pagination.value.per_page },
        });

        const paginator = response.data.data;

        appointments.value = paginator.data; // Array of appointments
        pagination.value.current_page = paginator.current_page;
        pagination.value.last_page = paginator.last_page;
        pagination.value.per_page = paginator.per_page;
        pagination.value.total = paginator.total;
    } catch (err) {
        console.error("Failed to fetch appointments:", err);
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Failed to fetch appointments.",
        });
    }
}

// Open/Close Modals
function openAssignVetModal(appointment) {
    selectedAppointment.value = appointment;
    showAssignVet.value = true;
}
function closeAssignVetModal() {
    selectedAppointment.value = null;
    showAssignVet.value = false;
}

async function assignVet({ vet, appointment }) {
    try {
        const payload = {
            appointment_id: appointment.id,
            vet_id: vet.id,
        };

        const response = await axios.post(
            `/api/appointments/assign-vet/${appointment.id}`,
            payload,
            { withCredentials: true }
        );

        if (response.data.success) {
            const updated = response.data.appointment;

            const index = appointments.value.findIndex(
                (a) => a.id === updated.id
            );
            if (index !== -1) appointments.value[index] = updated;
            else appointments.value.push(updated);

            await new Promise((resolve) => setTimeout(resolve, 50));
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

// Initial fetch
onMounted(() => fetchAppointments());
</script>
