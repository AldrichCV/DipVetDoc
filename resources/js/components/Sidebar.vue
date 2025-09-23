<script setup>
import { ref, computed } from "vue";
import { usePage, Link } from "@inertiajs/vue3";

const sidebarExpanded = ref(true);

// Use reactive Inertia page URL instead of window.location
const { url, props } = usePage();
const activeRoute = computed(() => url.value);

const links = [
    {
        name: "dashboard",
        label: "Dashboard",
        url: "/dashboard",
        icon: "fa-solid fa-home text-lg",
        roles: ["admin", "vet", "user"],
    },
    {
        name: "appointments",
        label: "Appointments",
        url: "/appointments",
        icon: "fa-solid fa-calendar text-lg",
        roles: ["admin", "vet", "user"],
    },
    {
        name: "users",
        label: "Users",
        url: "/users",
        icon: "fa-solid fa-users text-lg",
        roles: ["admin"],
    },
    {
        name: "consultations",
        label: "Consultations",
        url: "/consultations",
        icon: "fa-solid fa-clipboard-list text-lg",
        roles: ["admin", "vet"],
    },
];

// Get authenticated user role from Inertia props
const { auth } = props;

const canAccess = (roles) => roles.includes(auth.user.role);
</script>

<template>
    <div class="flex flex-col h-full w-full">
        <!-- Navigation -->
        <nav
            class="flex-1 overflow-y-auto overflow-x-hidden px-1 sm:px-2 py-4 space-y-1"
        >
            <template v-for="link in links" :key="link.name">
                <Link
                    v-if="canAccess(link.roles)"
                    :href="link.url"
                    :class="[
                        'flex items-center px-3 py-2 rounded-lg transition-colors animate-nav-item',
                        activeRoute === link.url
                            ? 'bg-blue-100 text-blue-800'
                            : 'text-gray-700 hover:bg-blue-100',
                    ]"
                    :aria-current="
                        activeRoute === link.url ? 'page' : undefined
                    "
                >
                    <div class="flex items-center w-full">
                        <div class="w-6 text-center flex-shrink-0">
                            <i :class="link.icon"></i>
                        </div>
                        <span v-if="sidebarExpanded" class="truncate ml-3">
                            {{ link.label }}
                        </span>
                    </div>
                </Link>
            </template>
        </nav>

        <!-- Logout -->
        <div class="p-4 border-t border-gray-200">
            <form method="POST" action="/logout">
                <button
                    type="submit"
                    class="flex items-center w-full px-3 py-2 rounded-lg text-gray-700 hover:bg-red-100 hover:text-red-600 focus:bg-red-200 transition-colors animate-nav-item"
                >
                    <div class="flex items-center w-full">
                        <div class="w-6 text-center flex-shrink-0">
                            <i class="fa-solid fa-sign-out-alt text-lg"></i>
                        </div>
                        <span v-if="sidebarExpanded" class="truncate ml-3"
                            >Logout</span
                        >
                    </div>
                </button>
            </form>
        </div>
    </div>
</template>
