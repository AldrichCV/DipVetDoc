<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import UserPage from "@/components/users/UserPage.vue";
import { onMounted } from "vue";

onMounted(() => {
    console.log("Full page loaded");
});
</script>
<template>
    <AppLayout title="Users">
        <UserPage />
    </AppLayout>
</template>
