<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import AppointmentPage from "@/components/appointments/AppointmentPage.vue";
import AppointmentsTable from "@/components/appointments/AppointmentsTable.vue";
import NewAppointment from "@/components/appointments/NewAppointment.vue";
import AssignVetModal from "@/components/appointments/AssignVetModal.vue";
</script>
<template>
    <AppLayout title="Appointments">
        <AppointmentPage />
    </AppLayout>
</template>
