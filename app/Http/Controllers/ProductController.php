<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::active()->inStock()->get();
        return view('ProductRequests.ProductList', compact('products'));
    }

    public function show(Product $product)
    {
        return view('ProductRequests.ProductView', compact('product'));
    }

    public function search(Request $request)
    {
        $query = $request->get('search');
        $category = $request->get('category');
        
        $products = Product::active()->inStock();
        
        if ($query) {
            $products->where('name', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%");
        }
        
        if ($category) {
            $products->where('category', $category);
        }
        
        $products = $products->get();
        $categories = Product::distinct()->pluck('category');
        
        return view('products.index', compact('products', 'categories', 'query', 'category'));
    }
}
