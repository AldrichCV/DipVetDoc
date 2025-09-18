@extends('layouts.app')

@section('title', 'Request ' . $product->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Request Product</h1>
            <a href="{{ route('products.show', $product) }}" 
               class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                ← Back to Product
            </a>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md p-6">
            <!-- Product Summary -->
            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                        <p class="text-gray-600">{{ $product->category }}</p>
                        @if($product->description)
                            <p class="text-gray-600 text-sm mt-2">{{ $product->description }}</p>
                        @endif
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-green-600">₱{{ number_format($product->price, 2) }}</p>
                        <p class="text-sm text-gray-500">Stock: {{ $product->stock_quantity }}</p>
                    </div>
                </div>
            </div>

            <!-- Request Form -->
            <form method="POST" action="{{ route('product-requests.store') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                
                <div class="mb-6">
                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">
                        Quantity <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="quantity" name="quantity" min="1" max="{{ $product->stock_quantity }}" 
                           value="{{ old('quantity', 1) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-sm text-gray-500 mt-1">Maximum available: {{ $product->stock_quantity }}</p>
                </div>
                
                <div class="mb-6">
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                        Notes (Optional)
                    </label>
                    <textarea id="notes" name="notes" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Any special instructions, urgency, or additional information...">{{ old('notes') }}</textarea>
                    <p class="text-sm text-gray-500 mt-1">Maximum 500 characters</p>
                </div>
                
                <!-- Total Calculation -->
                <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-medium text-gray-700">Unit Price:</span>
                        <span class="text-gray-800">₱{{ number_format($product->price, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-medium text-gray-700">Quantity:</span>
                        <span id="displayQuantity" class="text-gray-800">1</span>
                    </div>
                    <hr class="my-2 border-blue-200">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-semibold text-gray-800">Estimated Total:</span>
                        <span id="totalAmount" class="text-xl font-bold text-blue-600">₱{{ number_format($product->price, 2) }}</span>
                    </div>
                    <p class="text-sm text-gray-600 mt-2">
                        * This is an estimate. Final amount will be confirmed upon approval.
                    </p>
                </div>

                <!-- Important Notice -->
                <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <h4 class="font-semibold text-yellow-800 mb-2">Important Information:</h4>
                    <ul class="text-sm text-yellow-700 space-y-1">
                        <li>• Your request will be reviewed by our staff</li>
                        <li>• You will be notified once approved or if additional information is needed</li>
                        <li>• Approved products must be picked up at our clinic</li>
                        <li>• Payment is due upon pickup</li>
                    </ul>
                </div>
                
                <div class="flex space-x-4">
                    <button type="submit" 
                            class="flex-1 px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                        Submit Request
                    </button>
                    <a href="{{ route('products.show', $product) }}" 
                       class="px-6 py-3 bg-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-400 transition-colors">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const quantityInput = document.getElementById('quantity');
    const displayQuantity = document.getElementById('displayQuantity');
    const totalAmountSpan = document.getElementById('totalAmount');
    const unitPrice = parseFloat("{{ $product->price }}");
    
    function updateTotal() {
        const quantity = parseInt(quantityInput.value) || 1;
        const total = unitPrice * quantity;
        displayQuantity.textContent = quantity;
        totalAmountSpan.textContent = '₱' + total.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
    }
    
    quantityInput.addEventListener('input', updateTotal);
    updateTotal(); // Initial calculation
});
</script>
@endsection
