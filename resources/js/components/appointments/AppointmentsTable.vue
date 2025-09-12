<template>
    <div class="p-1">
        <!-- Appointments Table -->
        <div
            class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm"
        >
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-sm font-semibold text-gray-700"
                        >
                            Pet Name
                        </th>
                        <!-- Only admin can see owner column -->
                        <th
                            v-if="isAdmin"
                            class="px-6 py-3 text-left text-sm font-semibold text-gray-700"
                        >
                            Owner Name
                        </th>
                        <th
                            class="px-6 py-3 text-left text-sm font-semibold text-gray-700"
                        >
                            Date
                        </th>
                        <th
                            class="px-6 py-3 text-left text-sm font-semibold text-gray-700"
                        >
                            Time
                        </th>
                        <th
                            class="px-6 py-3 text-left text-sm font-semibold text-gray-700"
                        >
                            Service
                        </th>
                        <th
                            class="px-6 py-3 text-left text-sm font-semibold text-gray-700"
                        >
                            Status
                        </th>
                        <th
                            v-if="isAdmin"
                            class="px-6 py-3 text-left text-sm font-semibold text-gray-700"
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
                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ appt.pet_name }}
                        </td>

                        <!-- Owner (admin only) -->
                        <td
                            v-if="isAdmin"
                            class="px-6 py-4 text-sm text-gray-700"
                        >
                            {{ appt.owner_name }}
                        </td>

                        <!-- Date / Time / Service -->
                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ appt.appointment_date }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ appt.appointment_time }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ appt.reason_name }}
                        </td>

                        <!-- Status -->
                        <td class="px-6 py-4 text-sm">
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
                        <td v-if="isAdmin" class="px-6 py-4 text-sm">
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
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from "vue";

const props = defineProps({
    appointments: Array,
    isAdmin: Boolean,
});

const emit = defineEmits(["assign-vet", "show-vet"]);

const searchTerm = ref("");
const statusFilter = ref("");

const isAdmin = computed(() => props.mode === "admin");

const filteredAppointments = computed(() => {
    return props.appointments.filter((a) => {
        const matchesSearch = a.pet_name
            .toLowerCase()
            .includes(searchTerm.value.toLowerCase());
        const matchesStatus =
            !statusFilter.value || a.status === statusFilter.value;
        return matchesSearch && matchesStatus;
    });
});
</script>
