<template>
    <div class="p-1">
        <!-- Appointments Table -->
        <div
            class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm"
        >
            <!-- If there are appointments -->
            <table
                v-if="filteredAppointments.length > 0"
                class="min-w-full divide-y divide-gray-200"
            >
                <thead class="bg-gray-50">
                    <tr>
                        <th
                            class="px-6 py-3 text-center text-sm font-semibold text-gray-700"
                        >
                            Pet Name
                        </th>
                        <!-- Only admin can see owner column -->
                        <th
                            v-if="isAdmin"
                            class="px-6 py-3 text-center text-sm font-semibold text-gray-700"
                        >
                            Owner Name
                        </th>
                        <th
                            class="px-6 py-3 text-center text-sm font-semibold text-gray-700"
                        >
                            Date
                        </th>
                        <th
                            class="px-6 py-3 text-center text-sm font-semibold text-gray-700"
                        >
                            Time
                        </th>
                        <th
                            class="px-6 py-3 text-center text-sm font-semibold text-gray-700"
                        >
                            Service
                        </th>
                        <th
                            class="px-6 py-3 text-center text-sm font-semibold text-gray-700"
                        >
                            Status
                        </th>
                        <th
                            v-if="isAdmin"
                            class="px-6 py-3 text-center text-sm font-semibold text-gray-700"
                        >
                            Assigned Vet
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    <tr
                        v-for="appt in filteredAppointments"
                        :key="appt.id"
                        class="hover:bg-gray-50 transition-colors"
                    >
                        <!-- Pet -->
                        <td class="px-6 py-4 text-sm text-gray-700 text-center">
                            {{ appt.pet_name }}
                        </td>

                        <!-- Owner (admin only) -->
                        <td
                            v-if="isAdmin"
                            class="px-6 py-4 text-sm text-gray-700 text-center"
                        >
                            {{ appt.owner_name }}
                        </td>

                        <!-- Date / Time / Service -->
                        <td class="px-6 py-4 text-sm text-gray-700 text-center">
                            {{
                                new Date(
                                    appt.appointment_date
                                ).toLocaleDateString("en-US", {
                                    month: "long",
                                    day: "numeric",
                                    year: "numeric",
                                })
                            }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700 text-center">
                            {{
                                new Date(
                                    "1970-01-01T" + appt.appointment_time
                                ).toLocaleTimeString("en-US", {
                                    hour: "numeric",
                                    minute: "2-digit",
                                    hour12: true,
                                })
                            }}
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-700 text-center">
                            {{ appt.reason_name }}
                        </td>

                        <!-- Status -->
                        <td class="px-6 py-4 text-sm text-center">
                            <span
                                :class="{
                                    'bg-yellow-100 text-yellow-800':
                                        appt.status === 'pending',
                                    'bg-green-100 text-green-800':
                                        appt.status === 'completed',
                                    'bg-red-100 text-red-800':
                                        appt.status === 'cancelled',
                                }"
                                class="px-2 py-1 rounded-full font-medium text-xs"
                            >
                                {{ appt.status }}
                            </span>
                        </td>

                        <!-- Vet actions (admin only) -->
                        <td
                            v-if="isAdmin"
                            class="px-6 py-4 text-sm text-center"
                        >
                            <button
                                v-if="appt.vet_name"
                                @click="$emit('show-vet', appt)"
                                class="text-blue-600 hover:underline font-medium"
                            >
                                {{ appt.vet_name }}
                            </button>
                            <button
                                v-else
                                @click="$emit('assign-vet', appt)"
                                class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 transition"
                            >
                                Assign Vet
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Empty State -->
            <div
                v-else
                class="flex flex-col items-center justify-center py-16 px-4 text-center text-gray-500"
            >
                <i
                    class="fa-regular fa-calendar text-6xl mb-4 text-gray-400"
                ></i>
                <p class="text-lg font-medium">No appointments found</p>
                <p class="text-sm text-gray-400">
                    Try selecting another date or clearing your filters.
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
    appointments: { type: Array, default: () => [] },
    isAdmin: Boolean,
    selectedDate: String, // Date filter
    selectedService: String, // New service filter
    searchTerm: String,
    statusFilter: String,
});

const emit = defineEmits(["assign-vet", "show-vet"]);

const filteredAppointments = computed(() => {
    const term = (props.searchTerm || "").toLowerCase().trim();

    return props.appointments.filter((a) => {
        // Flexible search across multiple fields
        const matchesSearch =
            (a.pet_name || "").toLowerCase().includes(term) ||
            (a.owner_name || "").toLowerCase().includes(term) ||
            (a.status || "").toLowerCase().includes(term) ||
            (a.vet_name || "").toLowerCase().includes(term);

        // Status filter
        const matchesStatus =
            !props.statusFilter ||
            (a.status || "").toLowerCase() === props.statusFilter.toLowerCase();

        // Date filter
        const matchesDate =
            !props.selectedDate ||
            (a.appointment_date &&
                (() => {
                    const d = new Date(a.appointment_date);
                    const mm = String(d.getMonth() + 1).padStart(2, "0");
                    const dd = String(d.getDate()).padStart(2, "0");
                    const yyyy = d.getFullYear();
                    return `${mm}-${dd}-${yyyy}`;
                })() === props.selectedDate);

        // Service filter
        const matchesService =
            !props.selectedService || a.service_id === props.selectedService;

        return matchesSearch && matchesStatus && matchesDate && matchesService;
    });
});
</script>
