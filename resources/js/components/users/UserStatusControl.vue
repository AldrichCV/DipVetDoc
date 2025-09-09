<template>
    <div
        v-if="modelValue"
        class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0"
        @keydown.esc.window="close"
    >
        <!-- Overlay -->
        <div class="fixed inset-0 bg-gray-500 opacity-75" @click="close"></div>

        <!-- Modal content -->
        <div
            ref="modal"
            :class="[
                'mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full mx-auto',
                maxWidthClass,
            ]"
            tabindex="-1"
            @keydown.tab.prevent="handleTab"
            @keydown.shift.tab.prevent="handleShiftTab"
        >
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                    {{
                        user?.status === "inactive"
                            ? "Reactivate Account"
                            : "Deactivate Account"
                    }}
                </h2>
                <p class="text-sm text-gray-600 mb-6">
                    Are you sure you want to
                    <span class="font-semibold">
                        {{
                            user?.status === "inactive"
                                ? "reactivate"
                                : "deactivate"
                        }}
                    </span>
                    <span class="font-semibold">{{ user?.name }}</span
                    >?
                </p>
                <div class="flex justify-end gap-3">
                    <button
                        @click="close"
                        class="px-4 py-2 rounded-lg border text-gray-600 hover:bg-gray-100"
                    >
                        Cancel
                    </button>
                    <button
                        @click="
                            user?.status === 'inactive'
                                ? activateUser(user.id)
                                : deactivateUser(user.id)
                        "
                        :class="[
                            'px-4 py-2 rounded-lg text-white',
                            user?.status === 'inactive'
                                ? 'bg-green-600 hover:bg-green-700'
                                : 'bg-red-600 hover:bg-red-700',
                        ]"
                    >
                        {{
                            user?.status === "inactive"
                                ? "Reactivate"
                                : "Deactivate"
                        }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch, nextTick } from "vue";

const props = defineProps({
    modelValue: { type: Boolean, default: false },
    maxWidth: { type: String, default: "2xl" },
    user: Object,
});

const emit = defineEmits(["update:modelValue"]);

const modal = ref(null);

const maxWidthClass = {
    sm: "sm:max-w-sm",
    md: "sm:max-w-md",
    lg: "sm:max-w-lg",
    xl: "sm:max-w-xl",
    "2xl": "sm:max-w-2xl",
}[props.maxWidth];

// Focus trap helpers
const focusables = () => {
    if (!modal.value) return [];
    const selector =
        'a, button, input:not([type="hidden"]), textarea, select, details, [tabindex]:not([tabindex="-1"])';
    return Array.from(modal.value.querySelectorAll(selector)).filter(
        (el) => !el.disabled
    );
};
const firstFocusable = () => focusables()[0];
const lastFocusable = () => focusables().slice(-1)[0];

const handleTab = () => {
    const focusable = focusables();
    const index = focusable.indexOf(document.activeElement);
    const next = focusable[(index + 1) % focusable.length];
    next?.focus();
};
const handleShiftTab = () => {
    const focusable = focusables();
    const index = focusable.indexOf(document.activeElement);
    const prev = focusable[index - 1] || focusable[focusable.length - 1];
    prev?.focus();
};

const disableScroll = () => document.body.classList.add("overflow-hidden");
const enableScroll = () => document.body.classList.remove("overflow-hidden");

watch(
    () => props.modelValue,
    (val) => {
        if (val) disableScroll();
        else enableScroll();
    }
);

// Close modal
const close = () => {
    emit("update:modelValue", false);
    enableScroll();
};

// Deactivate user
const deactivateUser = async (userId) => {
    try {
        const token = document.querySelector('meta[name="csrf-token"]').content;
        const res = await fetch(`/api/users/${userId}/deactivate`, {
            method: "PATCH",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
            },
            body: JSON.stringify({ status: "inactive" }),
        });

        const data = await res.json();
        if (!res.ok)
            throw new Error(data.message || "Failed to deactivate user");

        Swal.fire(
            "User Deactivated!",
            "The user has been successfully deactivated.",
            "success"
        );
        close();
    } catch (err) {
        Swal.fire("Error!", err.message, "error");
    }
};

// Activate user
const activateUser = async (userId) => {
    try {
        const token = document.querySelector('meta[name="csrf-token"]').content;
        const res = await fetch(`/api/users/${userId}/activate`, {
            method: "PATCH",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
            },
            body: JSON.stringify({ status: "active" }),
        });

        const data = await res.json();
        if (!res.ok) throw new Error(data.message || "Failed to activate user");

        Swal.fire(
            "User Reactivated!",
            "The user has been successfully reactivated.",
            "success"
        );
        close();
    } catch (err) {
        Swal.fire("Error!", err.message, "error");
    }
};
</script>
