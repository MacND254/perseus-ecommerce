<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all categories to display in the dropdown
        $categories = Category::all();

        // Start the query for products that are active
        $query = Product::where('is_active', 1);

        // Filter by category if selected
        if ($request->has('category') && $request->category != '') {
            $categoryId = $request->category;
            $query->where('category_id', $categoryId)
                  ->orWhere('description', 'LIKE', '%' . Category::find($categoryId)->name . '%'); // Check description for category mention
        }

        // Sort by price if selected
        if ($request->has('sort')) {
            if ($request->sort == 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort == 'price_desc') {
                $query->orderBy('price', 'desc');
            }
        }

        // Fetch products with pagination
        $products = $query->paginate(12);

        // Return the view with the products and categories
        return view('products.index', compact('products', 'categories'));
    }

    public function show($id)
{
    // Fetch the product by ID
    $product = Product::with(['reviews.user'])->find($id);

    // Handle the case where the product is not found
    if (!$product) {
        abort(404, 'Product not found');
    }

    // Prepare additional images (assuming stored as JSON or similar)
    $product->additional_images = $product->additional_images ? json_decode($product->additional_images, true) : [];

    // Fetch frequently bought together products (same category, excluding the current product)
    $frequentlyBoughtTogether = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->limit(4)
        ->get();

    // Fetch related products (same category, excluding the current product)
    $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->limit(4)
        ->get();

    return view('products.show', compact('product', 'frequentlyBoughtTogether', 'relatedProducts'));
}

}
