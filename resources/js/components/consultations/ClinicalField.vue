<template>
    <div>
        <label class="block text-sm font-semibold text-gray-900 mb-2">{{
            label
        }}</label>
        <div
            class="bg-gray-50 rounded-lg p-3 text-sm text-gray-900 min-h-[60px]"
        >
            {{ value || "No " + label.toLowerCase() + " recorded" }}
        </div>
    </div>
</template>

<script setup>
defineProps({
    label: String,
    value: [String, Number],
});
</script>
