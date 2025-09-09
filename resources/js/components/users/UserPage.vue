<template>
    <div class="py-6 sm:py-4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Users Grid -->
        <UsersGrid :users="paginatedUsers" @open-modal="openModal" />

        <!-- Pagination Controls -->
        <div class="flex justify-center items-center gap-2 mt-6 flex-wrap">
            <!-- Previous -->
            <button
                class="px-3 py-1 rounded border text-gray-600 hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed"
                :disabled="currentPage === 1"
                @click="prevPage"
            >
                Previous
            </button>

            <!-- Page numbers -->
            <button
                v-for="page in totalPages"
                :key="page"
                @click="currentPage = page"
                :class="[
                    'px-3 py-1 rounded border',
                    page === currentPage
                        ? 'bg-blue-600 text-white'
                        : 'text-gray-600 hover:bg-gray-100',
                ]"
            >
                {{ page }}
            </button>

            <!-- Next -->
            <button
                class="px-3 py-1 rounded border text-gray-600 hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed"
                :disabled="currentPage === totalPages"
                @click="nextPage"
            >
                Next
            </button>
        </div>

        <!-- User Modal -->
        <UserModal
            v-if="modalUser"
            :user="modalUser"
            @close="modalUser = null"
        />
    </div>
</template>

<script setup>
import { ref, computed, watch } from "vue";
import UsersGrid from "./UsersGrid.vue";
import UserModal from "./UserModal.vue";

// Props
const props = defineProps({
    initialUsers: { type: Object, required: true },
    page: { type: String, default: "users" },
});

// State
const allUsers = ref([...props.initialUsers.data]);
const filteredUsers = ref([...allUsers.value]);
const modalUser = ref(null);

// Pagination
const perPage = 9; // users per page
const currentPage = ref(1);
const totalPages = computed(() =>
    Math.ceil(filteredUsers.value.length / perPage)
);

// Computed slice for current page
const paginatedUsers = computed(() => {
    const start = (currentPage.value - 1) * perPage;
    const end = start + perPage;
    return filteredUsers.value.slice(start, end);
});

// Watch filteredUsers to reset page if needed
watch(filteredUsers, () => {
    if (currentPage.value > totalPages.value) {
        currentPage.value = totalPages.value || 1;
    }
});

// Filters example
function applyFilters(filters) {
    filteredUsers.value = allUsers.value.filter((user) => {
        const matchesSearch =
            !filters.search ||
            user.name.toLowerCase().includes(filters.search.toLowerCase()) ||
            user.email.toLowerCase().includes(filters.search.toLowerCase());
        const matchesRole = !filters.role || user.role === filters.role;
        const matchesStatus = !filters.status || user.status === filters.status;
        return matchesSearch && matchesRole && matchesStatus;
    });
    currentPage.value = 1; // reset page on new filter
}

// Open modal
function openModal(user) {
    modalUser.value = user;
}

// Pagination controls
function nextPage() {
    if (currentPage.value < totalPages.value) currentPage.value++;
}

function prevPage() {
    if (currentPage.value > 1) currentPage.value--;
}
</script>
