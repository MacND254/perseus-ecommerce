<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload image if provided
        $imagePath = null;
        if ($request->hasFile('category_image')) {
            $imagePath = $request->file('category_image')->store('categories', 'public');
        }

        // Store category with image path
        Category::create([
            'name' => $request->name,
            'category_image' => $imagePath, // Stores only the path
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category added successfully.');
    }

    /**
     * Show the form for editing the category.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category = Category::findOrFail($id);

        // Handle image update
        if ($request->hasFile('category_image')) {
            // Delete old image if exists
            if ($category->category_image) {
                Storage::disk('public')->delete($category->category_image);
            }

            // Store new image
            $imagePath = $request->file('category_image')->store('categories', 'public');
        } else {
            $imagePath = $category->category_image; // Keep the existing image
        }

        // Update category
        $category->update([
            'name' => $request->name,
            'category_image' => $imagePath,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Delete category image if exists
        if ($category->category_image) {
            Storage::disk('public')->delete($category->category_image);
        }

        // Delete the category
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
