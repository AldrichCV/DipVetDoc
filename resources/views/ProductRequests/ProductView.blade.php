@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('products.index') }}" 
           class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
            ← Back to Products
        </a>
        
        @auth
            <a href="{{ route('product-requests.index') }}" 
               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                My Requests
            </a>
        @endauth
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Product Image Placeholder -->
        <div class="bg-gray-100 rounded-lg p-8 flex items-center justify-center">
            <div class="text-center">
                <div class="text-6xl text-gray-400 mb-4">📦</div>
                <p class="text-gray-600">Product Image</p>
            </div>
        </div>

        <!-- Product Details -->
        <div class="space-y-6">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="text-3xl font-bold text-gray-800">{{ $product->name }}</h1>
                    <span class="px-3 py-1 text-sm font-medium bg-blue-100 text-blue-800 rounded-full">
                        {{ $product->category }}
                    </span>
                </div>
                
                @if($product->description)
                    <p class="text-gray-600 text-lg">{{ $product->description }}</p>
                @endif
            </div>

            <div class="bg-gray-50 rounded-lg p-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <span class="text-sm font-medium text-gray-600">Price</span>
                        <p class="text-3xl font-bold text-green-600">₱{{ number_format($product->price, 2) }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-600">Available Stock</span>
                        <p class="text-2xl font-semibold text-gray-800">{{ $product->stock_quantity }}</p>
                    </div>
                </div>
            </div>

            <!-- Request Form -->
            @auth
                @if($product->stock_quantity > 0)
                    <div class="bg-white border-2 border-blue-200 rounded-lg p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Request This Product</h3>
                        
                        <form method="POST" action="{{ route('product-requests.store') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            
                            <div class="mb-4">
                                <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">
                                    Quantity
                                </label>
                                <input type="number" id="quantity" name="quantity" min="1" max="{{ $product->stock_quantity }}" 
                                       value="1" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <p class="text-sm text-gray-500 mt-1">Maximum available: {{ $product->stock_quantity }}</p>
                            </div>
                            
                            <div class="mb-4">
                                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                                    Notes (Optional)
                                </label>
                                <textarea id="notes" name="notes" rows="3"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          placeholder="Any special instructions or notes..."></textarea>
                            </div>
                            
                            <div class="mb-4 p-4 bg-blue-50 rounded-lg">
                                <div class="flex justify-between items-center">
                                    <span class="font-medium text-gray-700">Estimated Total:</span>
                                    <span id="totalAmount" class="text-xl font-bold text-blue-600">₱{{ number_format($product->price, 2) }}</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-2">
                                    * Final amount will be confirmed upon approval
                                </p>
                            </div>
                            
                            <button type="submit" 
                                    class="w-full px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                                Submit Request
                            </button>
                        </form>
                    </div>
                @else
                    <div class="bg-red-50 border border-red-200 rounded-lg p-6 text-center">
                        <div class="text-red-400 text-4xl mb-2">⚠️</div>
                        <h3 class="text-lg font-semibold text-red-800 mb-2">Out of Stock</h3>
                        <p class="text-red-600">This product is currently unavailable. Please check back later.</p>
                    </div>
                @endif
            @else
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 text-center">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Login Required</h3>
                    <p class="text-gray-600 mb-4">Please log in to request this product.</p>
                    <a href="{{ route('login') }}" 
                       class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Login
                    </a>
                </div>
            @endauth
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const quantityInput = document.getElementById('quantity');
    const totalAmountSpan = document.getElementById('totalAmount');
    const unitPrice = parseFloat("{{ $product->price }}");
    
    if (quantityInput && totalAmountSpan) {
        quantityInput.addEventListener('input', function() {
            const quantity = parseInt(this.value) || 1;
            const total = unitPrice * quantity;
            totalAmountSpan.textContent = '₱' + total.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
        });
    }
});
</script>
@endsection
