<template>
    <div
        v-if="visible"
        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4"
    >
        <div
            class="bg-white rounded-xl shadow-xl w-full max-w-md max-h-[90vh] overflow-y-auto"
        >
            <div
                class="flex items-center justify-between p-6 border-b border-gray-200"
            >
                <h2 class="text-xl font-semibold">Assign Veterinarian</h2>
                <button
                    @click="$emit('close')"
                    class="text-gray-400 hover:text-gray-600"
                >
                    ✕
                </button>
            </div>

            <div class="p-6 space-y-3">
                <p class="text-sm text-gray-600">Select a veterinarian for:</p>
                <p class="font-medium text-gray-900">
                    {{ appointment.pet_name }}
                </p>

                <button
                    v-for="vet in vets"
                    :key="vet.id"
                    @click="assign(vet)"
                    class="w-full p-4 text-left border rounded-lg"
                >
                    {{ vet.name }} - {{ vet.specialization }}
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    visible: Boolean,
    appointment: Object,
    vets: Array,
});
const emit = defineEmits(["close", "assign"]);

function assign(vet) {
    emit("assign", { vet, appointment: props.appointment });
}
</script>
