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
                    class="w-full p-4 text-left border rounded-lg hover:bg-blue-50"
                >
                    {{ vet.name }} —
                    {{ vet.specialization ?? "No specialization" }}
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineProps, defineEmits, ref } from "vue";
import axios from "axios";

const props = defineProps({
    visible: Boolean,
    appointment: Object,
    vets: Array,
});

const emit = defineEmits(["close", "assigned"]); // <-- add "assigned"
const loading = ref(false);

async function assign(vet) {
    if (!vet?.user_id || !props.appointment?.id) {
        alert("Missing vet or appointment information.");
        return;
    }

    loading.value = true;

    try {
        const payload = { user_id: vet.user_id };

        const response = await axios.post(
            `/api/appointments/assign-vet/${props.appointment.id}`,
            payload,
            { withCredentials: true }
        );

        if (response.data.success) {
            alert("Vet assigned successfully!");
            emit("assigned"); // <-- emit this to notify parent
            emit("close"); // <-- close the modal
        } else {
            alert(response.data.message || "Failed to assign vet.");
        }
    } catch (err) {
        let message = err.response?.data?.message || err.message;
        if (err.response?.status === 422 && err.response.data.errors) {
            message = Object.values(err.response.data.errors).flat().join("\n");
        }
        alert("Error assigning vet:\n" + message);
        console.error("Assign vet error:", err.response?.data || err);
    } finally {
        loading.value = false;
    }
}
</script>
