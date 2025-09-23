<template>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">{{
            label
        }}</label>
        <div
            class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900"
        >
            {{ value || "Not available" }}
        </div>
    </div>
</template>

<script setup>
defineProps({
    label: String,
    value: [String, Number],
});
</script>
