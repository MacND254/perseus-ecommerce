<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryTagController extends Controller
{
    /**
     * Display a listing of categories and tags.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.categories_tags.index');
    }

    /**
     * Show the form for creating a new category or tag.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.categories_tags.create');
    }

    /**
     * Store a newly created category or tag in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Implement storing logic here
        return redirect()->route('admin.categories.tags')->with('status', 'Category/Tag created successfully!');
    }

    /**
     * Show the form for editing the specified category or tag.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        return view('admin.categories_tags.edit', compact('id'));
    }

    /**
     * Update the specified category or tag in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Implement updating logic here
        return redirect()->route('admin.categories.tags')->with('status', 'Category/Tag updated successfully!');
    }

    /**
     * Remove the specified category or tag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Implement deleting logic here
        return redirect()->route('admin.categories.tags')->with('status', 'Category/Tag deleted successfully!');
    }
}
