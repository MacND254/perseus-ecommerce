<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category; // Add Category model
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ProductController extends Controller
{
    // Display the product list
    public function index()
{
    $products = Product::paginate(10); // Display 10 products per page
    return view('admin.products.index', compact('products'));
}


    // Show the form to create a new product
    public function create()
    {
        // Pass categories to the view
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // Store a new product


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id', // Ensure the category exists
            'product_images' => 'nullable|array',  // Ensure it's an array of images
            'product_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each image
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id; // Save the selected category

        // Handle multiple image uploads
        $imagePaths = [];
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $image) {
                // Use the 'public' disk and store the images in the 'products' folder within storage
                $imagePath = $image->store('products', 'public');  // Store image in public/products
                $imagePaths[] = $imagePath;  // Add image path to the array
            }
        }

        // Save the product with the JSON-encoded image paths
        $product->product_image = json_encode($imagePaths);

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully.');
    }



    // Show the form to edit a product
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all(); // Get categories for editing
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Update a product
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id', // Ensure the category exists
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id; // Update the category_id

        // Handle image update
        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('products', 'public');
            $product->product_image = $imagePath;
        }

        $product->save();
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }


}
