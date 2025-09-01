<template>
  <div class="p-6 text-center">
    <h1 class="text-3xl font-bold text-blue-600">Hello Vue + Alpine + Tailwind 🚀</h1>
    <button @click="count++" class="mt-4 px-4 py-2 bg-green-600 text-white rounded">
      Count: {{ count }}
    </button>
  </div>
</template>

<script setup>
import { ref } from 'vue';
const count = ref(0);
</script>
