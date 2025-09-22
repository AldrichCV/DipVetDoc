<template>
    <div>
        <!-- Filters -->
        <div
            class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 mb-6 flex flex-col sm:flex-row sm:items-center gap-4"
        >
            <!-- Left: New Appointment -->
            <div class="flex-shrink-0">
                <button
                    @click="showNewAppointment = true"
                    class="h-12 px-6 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600 focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 transition-colors duration-200 whitespace-nowrap"
                >
                    New Appointment
                </button>
            </div>

            <!-- Middle + Right: Search + Filters -->
            <div
                class="flex flex-col sm:flex-row sm:items-center flex-grow gap-4 w-full sm:w-auto"
            >
                <!-- Search Bar -->
                <div class="flex-grow min-w-[200px]">
                    <input
                        type="text"
                        v-model="searchTerm"
                        placeholder="Search appointments..."
                        class="w-full h-12 px-4 bg-gray-100 text-gray-700 border border-gray-300 rounded-lg font-medium hover:bg-gray-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                    />
                </div>

                <!-- Date + Today + Clear -->
                <div class="flex flex-wrap items-center gap-2">
                    <!-- Date Picker -->
                    <div class="flex-shrink-0">
                        <v-menu
                            v-model="dateMenu"
                            :close-on-content-click="false"
                            transition="scale-transition"
                            offset-y
                            min-width="240"
                        >
                            <template #activator="{ props }">
                                <button
                                    v-bind="props"
                                    class="h-12 px-4 sm:px-6 bg-gray-100 text-gray-700 border border-gray-300 rounded-lg font-medium hover:bg-gray-200 active:bg-gray-300 focus-visible:ring-2 focus-visible:ring-gray-500 focus-visible:ring-offset-2 whitespace-nowrap flex items-center gap-2"
                                >
                                    <i class="fa-regular fa-calendar"></i>
                                    <span>{{
                                        dateDisplay || "Select Date"
                                    }}</span>
                                </button>
                            </template>

                            <v-date-picker
                                v-model="selectedDate"
                                type="date"
                                @update:model-value="onDateSelected"
                                show-current
                            />
                        </v-menu>
                    </div>

                    <!-- Today Button -->
                    <button
                        @click="goToToday"
                        class="h-12 px-4 sm:px-6 bg-gray-100 text-gray-700 border border-gray-300 rounded-lg font-semibold hover:bg-gray-200 active:bg-gray-300 focus-visible:ring-2 focus-visible:ring-gray-500 focus-visible:ring-offset-2 whitespace-nowrap"
                    >
                        Today
                    </button>

                    <!-- Clear Filters Button -->
                    <button
                        @click="clearFilters"
                        class="h-12 px-4 sm:px-6 bg-gray-100 text-gray-700 border border-gray-300 rounded-lg font-semibold hover:bg-gray-200 active:bg-gray-300 focus-visible:ring-2 focus-visible:ring-gray-500 focus-visible:ring-offset-2 flex items-center gap-2 whitespace-nowrap"
                    >
                        <i
                            class="fa-solid fa-filter-circle-xmark text-lg"
                            aria-hidden="true"
                        ></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Appointments Table -->
        <appointments-table
            :appointments="appointments"
            :is-admin="isAdmin"
            :selected-date="selectedDate"
            :search-term="searchTerm"
            :status-filter="statusFilter"
            @assign-vet="openAssignVetModal"
            @show-vet="showVetDetails"
        />

        <!-- Pagination -->
        <div class="flex justify-center mt-6" v-if="totalPages > 1">
            <v-pagination
                v-model="currentPage"
                :length="totalPages"
                color="primary"
                rounded
                total-visible="7"
                @update:model-value="fetchAppointments"
            />
        </div>

        <!-- Assign Vet Modal -->
        <assign-vet-modal
            :visible="showAssignVet"
            :appointment="selectedAppointment"
            :vets="availableVets"
            @close="closeAssignVetModal"
            @assign="assignVet"
        />

        <!-- New Appointment Modal -->
        <new-appointment
            :visible="showNewAppointment"
            @close="closeNewAppointment"
            @appointment-added="fetchAppointments"
        />
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";
import axios from "axios";
import AppointmentsTable from "./AppointmentsTable.vue";
import AssignVetModal from "./AssignVetModal.vue";
import NewAppointment from "./NewAppointment.vue";

// --- State ---
const appointments = ref([]);
const availableVets = ref([]);
const services = ref([]); // all services from services table
const isAdmin = ref(false);
const selectedAppointment = ref(null);
const showAssignVet = ref(false);
const showNewAppointment = ref(false);

const selectedDate = ref("");
const dateDisplay = ref("");
const dateMenu = ref(false);

const selectedService = ref("");
const serviceMenu = ref(false);

const currentPage = ref(1);
const totalPages = ref(1);

const searchTerm = ref("");
const statusFilter = ref("");

// --- Date Helpers ---
function formatToMMDDYYYY(date) {
    const mm = String(date.getMonth() + 1).padStart(2, "0");
    const dd = String(date.getDate()).padStart(2, "0");
    const yyyy = date.getFullYear();
    return `${mm}-${dd}-${yyyy}`;
}

function formatToMMMMDDYYYY(date) {
    const options = { year: "numeric", month: "long", day: "numeric" };
    return date.toLocaleDateString("en-US", options);
}

// --- Date Picker Handlers ---
function onDateSelected() {
    if (selectedDate.value) {
        const d = new Date(selectedDate.value);
        selectedDate.value = formatToMMDDYYYY(d);
        dateDisplay.value = formatToMMMMDDYYYY(d);
    } else {
        dateDisplay.value = "";
    }
    dateMenu.value = false;
    applyFilters();
}

function goToToday() {
    const today = new Date();
    selectedDate.value = formatToMMDDYYYY(today);
    dateDisplay.value = formatToMMMMDDYYYY(today);
    applyFilters();
}

// --- Filters ---
function applyFilters() {
    currentPage.value = 1;
    fetchAppointments(currentPage.value);
}

function clearFilters() {
    selectedDate.value = "";
    dateDisplay.value = "";
    selectedService.value = "";
    searchTerm.value = ""; // <-- reset the search bar
    currentPage.value = 1;
    fetchAppointments(currentPage.value);
}

// --- Fetch Appointments ---
async function fetchAppointments(page = 1) {
    try {
        const res = await axios.get("/api/appointments", {
            params: {
                page,
                date: selectedDate.value || null,
                service: selectedService.value || null,
            },
        });
        const paginator = res.data.data;
        appointments.value = paginator.data;
        currentPage.value = paginator.current_page;
        totalPages.value = paginator.last_page;
        isAdmin.value = res.data.is_admin ?? false;
    } catch (err) {
        console.error("Failed to fetch appointments:", err);
        alert("Failed to load appointments.");
    }
}

// --- Fetch Services from Services Table ---
async function fetchServices() {
    try {
        const res = await axios.get("/api/appointments/services"); // Adjust endpoint
        services.value = res.data || [];
    } catch (err) {
        console.error("Failed to fetch services:", err);
        alert("Failed to load services.");
    }
}

// Computed list for dropdown
const uniqueServices = computed(() => {
    return services.value.map((s) => s.name); // Assuming service object has a `name` field
});

function selectService(service) {
    selectedService.value = service;
    serviceMenu.value = false;
    applyFilters();
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

function showVetDetails(appointment) {
    alert(`Showing vet for ${appointment.pet_name}`);
}

// --- Assign Vet ---
async function assignVet(vet) {
    if (!vet?.user_id || !selectedAppointment.value?.id) {
        alert("Missing vet or appointment info.");
        return;
    }

    try {
        const res = await axios.post(
            `/api/appointments/assign-vet/${selectedAppointment.value.id}`,
            { vet_id: vet.user_id },
            { withCredentials: true }
        );
        if (res.data.success) {
            alert("Vet assigned successfully!");
            closeAssignVetModal();
            await fetchAppointments(currentPage.value);
        } else {
            alert(res.data.message || "Assignment failed.");
        }
    } catch (err) {
        let message = err.response?.data?.message || err.message;
        alert("Error assigning vet:\n" + message);
        console.error(err);
    }
}

// --- Mounted ---
onMounted(() => {
    fetchAppointments();
    fetchVets();
    fetchServices(); // Fetch services on mount
});
</script>
