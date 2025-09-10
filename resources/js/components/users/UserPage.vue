<template>
    <div class="py-6 sm:py-4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Users Grid -->
        <UsersGrid :users="paginatedUsers" @open-modal="openModal" />

        <!-- Vuetify Pagination -->
        <div class="flex justify-center mt-6">
            <v-pagination
                v-model="currentPage"
                :length="totalPages"
                color="primary"
                rounded
                total-visible="7"
                @update:model-value="fetchUsers"
            ></v-pagination>
        </div>

        <!-- User Modal -->
        <UserModal
            v-if="modalUser"
            :user="modalUser"
            @close="modalUser = null"
            @user-updated="onUserUpdated"
        />
    </div>
</template>

<script setup>
import { ref, computed } from "vue";
import axios from "axios";
import UsersGrid from "./UsersGrid.vue";
import UserModal from "./UserModal.vue";

// Props
const props = defineProps({
    initialUsers: { type: Object, required: true }, // Laravel paginated response
    page: { type: String, default: "users" },
});

// State
const paginatedUsers = ref([...props.initialUsers.data]);
const totalPages = ref(props.initialUsers.last_page || 1);
const currentPage = ref(props.initialUsers.current_page || 1);
const modalUser = ref(null);

// Axios instance
const token = document.querySelector('meta[name="csrf-token"]').content;
const api = axios.create({
    baseURL: "http://127.0.0.1:8000",
    headers: {
        "X-CSRF-TOKEN": token,
        "Content-Type": "application/json",
    },
});

// Fetch users
const fetchUsers = async (page = 1) => {
    try {
        const res = await api.get(`/api/users?page=${page}`);
        paginatedUsers.value = res.data.data;
        totalPages.value = res.data.last_page;
        currentPage.value = res.data.current_page;
    } catch (err) {
        console.error(err);
        Swal.fire({
            title: "Error",
            text: err.response?.data?.message || err.message,
            icon: "error",
        });
    }
};

// Open modal
const openModal = (user) => {
    modalUser.value = user;
};

// Handle updated user from modal
const onUserUpdated = (updatedUser) => {
    const index = paginatedUsers.value.findIndex(
        (u) => u.id === updatedUser.id
    );
    if (index !== -1) paginatedUsers.value[index] = updatedUser;
};
</script>
