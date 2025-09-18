import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

import { createApp } from 'vue'
import ProductList from './components/ProductList.vue'

export function initProductRequestApp(products) {
  const app = createApp({
    components: { ProductList },
    data() {
      return { products }
    }
  })
  app.mount('#product-request-app')
}
