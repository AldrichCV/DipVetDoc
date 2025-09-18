<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductRequestController extends Controller
{
    public function index()
    {
        $requests = ProductRequest::with(['product', 'customer'])
                                 ->where('customer_id', Auth::id())
                                 ->latest()
                                 ->get();
        
        return view('ProductRequests.ProductRequestList', compact('requests'));
    }

    public function create(Product $product)
    {
        return view('ProductRequests.ProductCreateRequest', compact('product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:500',
        ]);

        $product = Product::findOrFail($request->product_id);
        
        // Check stock availability
        if ($product->stock_quantity < $request->quantity) {
            return back()->withErrors(['quantity' => 'Insufficient stock available.']);
        }

        $totalAmount = $product->price * $request->quantity;

        ProductRequest::create([
            'customer_id' => Auth::id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_amount' => $totalAmount,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);

        return redirect()->route('product-requests.index')
                        ->with('success', 'Product request submitted successfully!');
    }

    public function show(ProductRequest $productRequest)
{
    $user = Auth::user();

    if (!$user) {
        abort(403);
    }

    if ($productRequest->customer_id !== $user->id && !$user->isAdmin()) {
        abort(403);
    }

    return view('ProductRequests.ProductShow', compact('productRequest'));
}


    public function cancel(ProductRequest $productRequest)
    {
        // Only allow cancellation of pending requests by the customer
        if ($productRequest->customer_id !== Auth::id() || $productRequest->status !== 'pending') {
            abort(403);
        }

        $productRequest->update(['status' => 'cancelled']);

        return redirect()->route('product-requests.index')
                        ->with('success', 'Request cancelled successfully.');
    }
}
