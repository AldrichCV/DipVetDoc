@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6">
  <h1 class="text-2xl font-bold mb-4">Available Products</h1>

  <div id="product-request-app" data-products='@json($products)' data-csrf="{{ csrf_token() }}">
      <product-list :products='@json($products)'></product-list>
  </div>
</div>
@endsection

@push('scripts')
<script type="module">
import { initProductRequestApp } from '/resources/js/vue-app.js'

const el = document.getElementById('product-request-app')
const products = JSON.parse(el.dataset.products)

initProductRequestApp(products)
</script>
@endpush
