<template>
    <div>
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
            />
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
import { ref, onMounted } from "vue";
import axios from "axios";
import UsersGrid from "./UsersGrid.vue";
import UserModal from "./UserModal.vue";
import { VPagination } from "vuetify/components";

const paginatedUsers = ref([]);
const totalPages = ref(1);
const currentPage = ref(1);
const modalUser = ref(null);

// Fetch users
const fetchUsers = async (page = 1) => {
    try {
        const res = await axios.get(`/api/users?page=${page}`);
        paginatedUsers.value = res.data.data;
        totalPages.value = res.data.last_page;
        currentPage.value = res.data.current_page;
    } catch (err) {
        console.error("Error fetching users:", err);
    }
};

// Call on mount
onMounted(() => {
    fetchUsers();
});

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
