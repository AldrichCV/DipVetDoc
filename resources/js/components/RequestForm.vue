<template>
  <div class="max-w-4xl mx-auto p-6">
    <div class="bg-card rounded-lg border border-border overflow-hidden">
      <!-- Header -->
      <div class="bg-primary text-primary-foreground px-6 py-4">
        <h2 class="text-xl font-semibold">New Product Request</h2>
        <p class="text-primary-foreground/80 text-sm">Submit a request for veterinary products</p>
      </div>

      <!-- Form -->
      <form @submit.prevent="submitRequest" class="p-6 space-y-6">
        <!-- Requester Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium text-foreground mb-2">Veterinarian Name</label>
            <input
              v-model="form.veterinarianName"
              type="text"
              required
              class="w-full px-3 py-2 border border-border rounded-lg bg-input focus:ring-2 focus:ring-ring focus:border-transparent"
              placeholder="Dr. Smith"
            />
          </div>
          <div>
            <label class="block text-sm font-medium text-foreground mb-2">Clinic Name</label>
            <input
              v-model="form.clinicName"
              type="text"
              required
              class="w-full px-3 py-2 border border-border rounded-lg bg-input focus:ring-2 focus:ring-ring focus:border-transparent"
              placeholder="Animal Care Clinic"
            />
          </div>
        </div>

        <!-- Contact Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium text-foreground mb-2">Email</label>
            <input
              v-model="form.email"
              type="email"
              required
              class="w-full px-3 py-2 border border-border rounded-lg bg-input focus:ring-2 focus:ring-ring focus:border-transparent"
              placeholder="doctor@clinic.com"
            />
          </div>
          <div>
            <label class="block text-sm font-medium text-foreground mb-2">Phone</label>
            <input
              v-model="form.phone"
              type="tel"
              required
              class="w-full px-3 py-2 border border-border rounded-lg bg-input focus:ring-2 focus:ring-ring focus:border-transparent"
              placeholder="(555) 123-4567"
            />
          </div>
        </div>

        <!-- Product Selection -->
        <div>
          <label class="block text-sm font-medium text-foreground mb-2">Select Products</label>
          <div class="space-y-3">
            <div
              v-for="product in availableProducts"
              :key="product.id"
              class="flex items-center justify-between p-4 border border-border rounded-lg hover:bg-accent/50 transition-colors"
            >
              <div class="flex items-center space-x-3">
                <input
                  :id="`product-${product.id}`"
                  v-model="selectedProducts"
                  :value="product.id"
                  type="checkbox"
                  class="w-4 h-4 text-primary border-border rounded focus:ring-ring"
                />
                <label :for="`product-${product.id}`" class="flex-1 cursor-pointer">
                  <div class="font-medium text-foreground">{{ product.name }}</div>
                  <div class="text-sm text-muted-foreground">{{ product.description }}</div>
                  <div class="text-sm font-medium text-primary">${{ product.price }}</div>
                </label>
              </div>
              <div v-if="selectedProducts.includes(product.id)" class="flex items-center space-x-2">
                <label class="text-sm text-foreground">Qty:</label>
                <input
                  v-model.number="productQuantities[product.id]"
                  type="number"
                  min="1"
                  :max="product.stock"
                  class="w-16 px-2 py-1 border border-border rounded text-center bg-input focus:ring-2 focus:ring-ring"
                />
              </div>
            </div>
          </div>
        </div>

        <!-- Priority Level -->
        <div>
          <label class="block text-sm font-medium text-foreground mb-2">Priority Level</label>
          <select
            v-model="form.priority"
            class="w-full px-3 py-2 border border-border rounded-lg bg-input focus:ring-2 focus:ring-ring focus:border-transparent"
          >
            <option value="low">Low - Standard delivery</option>
            <option value="medium">Medium - Within 3 days</option>
            <option value="high">High - Within 24 hours</option>
            <option value="urgent">Urgent - Emergency delivery</option>
          </select>
        </div>

        <!-- Justification -->
        <div>
          <label class="block text-sm font-medium text-foreground mb-2">Justification</label>
          <textarea
            v-model="form.justification"
            rows="4"
            required
            class="w-full px-3 py-2 border border-border rounded-lg bg-input focus:ring-2 focus:ring-ring focus:border-transparent resize-none"
            placeholder="Please provide justification for this request, including patient needs and urgency..."
          ></textarea>
        </div>

        <!-- Expected Delivery -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium text-foreground mb-2">Expected Delivery Date</label>
            <input
              v-model="form.expectedDelivery"
              type="date"
              required
              class="w-full px-3 py-2 border border-border rounded-lg bg-input focus:ring-2 focus:ring-ring focus:border-transparent"
            />
          </div>
          <div>
            <label class="block text-sm font-medium text-foreground mb-2">Delivery Location</label>
            <select
              v-model="form.deliveryLocation"
              class="w-full px-3 py-2 border border-border rounded-lg bg-input focus:ring-2 focus:ring-ring focus:border-transparent"
            >
              <option value="clinic">Main Clinic</option>
              <option value="warehouse">Warehouse Pickup</option>
              <option value="emergency">Emergency Location</option>
            </select>
          </div>
        </div>

        <!-- Cost Summary -->
        <div v-if="selectedProducts.length > 0" class="bg-muted rounded-lg p-4">
          <h3 class="font-medium text-foreground mb-3">Cost Summary</h3>
          <div class="space-y-2">
            <div
              v-for="productId in selectedProducts"
              :key="productId"
              class="flex justify-between text-sm"
            >
              <span class="text-muted-foreground">
                {{ getProductById(productId).name }} × {{ productQuantities[productId] || 1 }}
              </span>
              <span class="text-foreground">
                ${{ (getProductById(productId).price * (productQuantities[productId] || 1)).toFixed(2) }}
              </span>
            </div>
            <div class="border-t border-border pt-2 flex justify-between font-medium">
              <span class="text-foreground">Total Estimated Cost:</span>
              <span class="text-primary">${{ totalCost.toFixed(2) }}</span>
            </div>
          </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end space-x-4">
          <button
            type="button"
            @click="resetForm"
            class="px-6 py-2 border border-border rounded-lg text-foreground hover:bg-accent hover:text-accent-foreground transition-colors"
          >
            Reset
          </button>
          <button
            type="submit"
            :disabled="selectedProducts.length === 0 || isSubmitting"
            class="px-6 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
          >
            {{ isSubmitting ? 'Submitting...' : 'Submit Request' }}
          </button>
        </div>
      </form>
    </div>

    <!-- Success Modal -->
    <div v-if="showSuccessModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
      <div class="bg-card rounded-lg p-6 max-w-md mx-4">
        <div class="text-center">
          <div class="w-16 h-16 bg-accent rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-accent-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
          </div>
          <h3 class="text-lg font-semibold text-card-foreground mb-2">Request Submitted Successfully!</h3>
          <p class="text-muted-foreground mb-4">Your request has been sent for approval. You'll receive an email confirmation shortly.</p>
          <p class="text-sm text-muted-foreground mb-6">Request ID: <span class="font-mono text-primary">{{ requestId }}</span></p>
          <button
            @click="closeSuccessModal"
            class="w-full bg-primary text-primary-foreground py-2 rounded-lg hover:bg-primary/90 transition-colors"
          >
            Close
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, reactive } from 'vue'

const availableProducts = ref([
  {
    id: 1,
    name: 'NP6 Vaccine',
    description: 'Multi-component vaccine for comprehensive protection',
    price: 45.99,
    stock: 25
  },
  {
    id: 2,
    name: 'Activim Injectable',
    description: 'Advanced antibiotic solution for bacterial infections',
    price: 78.50,
    stock: 12
  },
  {
    id: 3,
    name: 'Septaplex Formula',
    description: 'Seven-way protection vaccine for livestock',
    price: 52.25,
    stock: 8
  },
  {
    id: 4,
    name: 'VitaBoost Supplement',
    description: 'Essential vitamin and mineral supplement',
    price: 29.99,
    stock: 35
  }
])

const form = reactive({
  veterinarianName: '',
  clinicName: '',
  email: '',
  phone: '',
  priority: 'medium',
  justification: '',
  expectedDelivery: '',
  deliveryLocation: 'clinic'
})

const selectedProducts = ref([])
const productQuantities = reactive({})
const isSubmitting = ref(false)
const showSuccessModal = ref(false)
const requestId = ref('')

const totalCost = computed(() => {
  return selectedProducts.value.reduce((total, productId) => {
    const product = getProductById(productId)
    const quantity = productQuantities[productId] || 1
    return total + (product.price * quantity)
  }, 0)
})

const getProductById = (id) => {
  return availableProducts.value.find(product => product.id === id)
}

const submitRequest = async () => {
  isSubmitting.value = true
  
  // Simulate API call
  await new Promise(resolve => setTimeout(resolve, 2000))
  
  // Generate request ID
  requestId.value = 'REQ-' + Date.now().toString().slice(-6)
  
  isSubmitting.value = false
  showSuccessModal.value = true
}

const resetForm = () => {
  Object.keys(form).forEach(key => {
    if (key === 'priority') form[key] = 'medium'
    else if (key === 'deliveryLocation') form[key] = 'clinic'
    else form[key] = ''
  })
  selectedProducts.value = []
  Object.keys(productQuantities).forEach(key => {
    delete productQuantities[key]
  })
}

const closeSuccessModal = () => {
  showSuccessModal.value = false
  resetForm()
}

// Initialize quantities for selected products
const initializeQuantity = (productId) => {
  if (!productQuantities[productId]) {
    productQuantities[productId] = 1
  }
}

// Watch for product selection changes
const handleProductSelection = (productId) => {
  if (selectedProducts.value.includes(productId)) {
    initializeQuantity(productId)
  } else {
    delete productQuantities[productId]
  }
}
</script>
