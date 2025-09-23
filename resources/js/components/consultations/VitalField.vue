<template>
    <div class="bg-gray-50 rounded-lg p-3">
        <label class="block text-xs font-medium text-gray-600 mb-1">{{
            label
        }}</label>
        <div class="text-sm font-medium text-gray-900">
            {{ value || "Not recorded" }}
        </div>
    </div>
</template>

<script setup>
defineProps({
    label: String,
    value: [String, Number],
});
</script>
