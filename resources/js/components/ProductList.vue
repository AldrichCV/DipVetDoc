<template>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div v-for="p in products" :key="p.id" class="border p-4 rounded">
      <div class="flex justify-between items-start">
        <div>
          <div class="font-bold">{{ p.name }}</div>
          <div class="text-sm text-gray-600">{{ p.sku }}</div>
          <div class="mt-2">₱{{ formatPrice(p.price) }}</div>
        </div>
        <div class="w-40">
          <label class="block text-sm">Qty</label>
          <input type="number" v-model.number="quantities[p.id]" min="1" class="w-full border p-1 rounded">
          <button @click="requestProduct(p)" class="mt-2 w-full bg-blue-600 text-white py-1 rounded">Request</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['products'],
  data() {
    return {
      quantities: {},
      csrf: document.querySelector('#product-request-app').dataset.csrf
    }
  },
  mounted() {
    this.products.forEach(p => this.$set(this.quantities, p.id, 1));
  },
  methods: {
    formatPrice(v) { return Number(v).toFixed(2); },
    async requestProduct(product) {
      const quantity = this.quantities[product.id] || 1;
      const body = new FormData();
      body.append('product_id', product.id);
      body.append('quantity', quantity);
      // include notes if you want
      try {
        const res = await fetch('/product-requests', {
          method: 'POST',
          headers: { 'X-CSRF-TOKEN': this.csrf },
          body
        });
        if(res.redirected) {
          window.location = res.url;
          return;
        }
        // fallback: reload to show messages
        window.location.reload();
      } catch(e) {
        alert('Error submitting request');
      }
    }
  }
}
</script>
