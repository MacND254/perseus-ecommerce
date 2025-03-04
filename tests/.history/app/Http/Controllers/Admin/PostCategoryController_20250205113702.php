<?php

namespace App\Http\Controller\Admin;

use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;


class PostCategoryController extends Controller
{
    /**
     * Display a listing of the post categories.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = PostCategory::all();
        return view('admin.post_categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new post category.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.post_categories.create');
    }

    /**
     * Store a newly created post category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:post_categories,name',
        ]);

        PostCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('post_categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified post category.
     *
     * @param  \App\Models\PostCategory  $postCategory
     * @return \Illuminate\View\View
     */
    public function edit(PostCategory $postCategory)
    {
        return view('admin.post_categories.edit', compact('postCategory'));
    }

    /**
     * Update the specified post category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostCategory  $postCategory
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, PostCategory $postCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:post_categories,name,' . $postCategory->id,
        ]);

        $postCategory->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('post_categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified post category from storage.
     *
     * @param  \App\Models\PostCategory  $postCategory
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(PostCategory $postCategory)
    {
        $postCategory->delete();
        return redirect()->route('post_categories.index')->with('success', 'Category deleted successfully.');
    }
}
