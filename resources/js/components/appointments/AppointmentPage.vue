<template>
    <div>
        <!-- Button to open New Appointment -->
        <button
            @click="showNewAppointment = true"
            class="px-6 py-2 bg-blue-600 text-white rounded-lg mb-4"
        >
            Schedule New Appointment
        </button>

        <!-- Appointments Table -->
        <appointments-table
            :appointments="appointments"
            :is-admin="isAdmin"
            @assign-vet="openAssignVetModal"
        ></appointments-table>

        <!-- Assign Vet Modal -->
        <assign-vet-modal
            :visible="showAssignVet"
            :appointment="selectedAppointment"
            :vets="availableVets"
            @close="closeAssignVetModal"
            @assign="assignVet"
        ></assign-vet-modal>

        <assign-vet-modal
            :visible="showAssignVet"
            :appointment="selectedAppointment"
            :vets="availableVets"
            @close="closeAssignVetModal"
            @assigned="fetchAppointments"
        ></assign-vet-modal>
        <!-- NEW Appointment Modal -->
        <new-appointment
            :visible="showNewAppointment"
            @close="closeNewAppointment"
            @appointment-added="fetchAppointments"
        ></new-appointment>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import NewAppointment from "./NewAppointment.vue";
import AppointmentsTable from "./AppointmentsTable.vue";
import AssignVetModal from "./AssignVetModal.vue";

// --- State ---
const appointments = ref([]);
const availableVets = ref([]);
const isAdmin = ref(false);
const selectedAppointment = ref(null);
const showAssignVet = ref(false);
const showNewAppointment = ref(false);

// --- Fetch Appointments ---
async function fetchAppointments(page = 1) {
    try {
        const res = await axios.get("/api/appointments", { params: { page } });
        const paginator = res.data.data;
        appointments.value = paginator.data;
        isAdmin.value = res.data.is_admin ?? false;
    } catch (err) {
        console.error("Failed to fetch appointments:", err);
        alert("Failed to load appointments.");
    }
}

// --- Fetch Approved Vets ---
async function fetchVets() {
    try {
        const res = await axios.get("/api/appointments/assign-vet");
        availableVets.value = res.data.approved_vets ?? [];
    } catch (err) {
        console.error("Failed to fetch vets:", err);
        alert("Failed to load available vets.");
    }
}

// --- Modal Handlers ---
function openAssignVetModal(appointment) {
    selectedAppointment.value = appointment;
    showAssignVet.value = true;
}

function closeAssignVetModal() {
    selectedAppointment.value = null;
    showAssignVet.value = false;
}

function closeNewAppointment() {
    showNewAppointment.value = false;
}

// --- Assign Vet ---
async function assignVet(vet) {
    if (!vet?.user_id || !selectedAppointment.value?.id) {
        alert("Missing vet or appointment information.");
        return;
    }

    try {
        const payload = { vet_id: vet.user_id }; // Ensure key matches backend

        const res = await axios.post(
            `/api/appointments/assign-vet/${selectedAppointment.value.id}`,
            payload,
            { withCredentials: true }
        );

        if (res.data.success) {
            alert("Vet assigned successfully!");
            closeAssignVetModal();
            await fetchAppointments(); // Refresh appointments after assignment
        } else {
            alert(res.data.message || "Assignment failed.");
        }
    } catch (err) {
        let message = err.response?.data?.message || err.message;
        if (err.response?.status === 422 && err.response.data.errors) {
            message = Object.values(err.response.data.errors).flat().join("\n");
        }
        alert("Error assigning vet:\n" + message);
        console.error("Assign vet error:", err.response?.data || err);
    }
}

// --- On Mounted ---
onMounted(() => {
    fetchAppointments();
    fetchVets();
});
</script>
