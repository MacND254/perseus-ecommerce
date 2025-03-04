<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCareerController extends Controller
{
    // Display all career positions (with pagination)
    public function index()
    {
        // Fetch all career positions for the admin panel with pagination (10 per page)
        $positions = Position::paginate(10);

        return view('admin.pages.careers.index', compact('positions'));
    }

    // Show the form to create a new career position
    public function create()
    {
        return view('admin.pages.careers.create');
    }

    // Store the newly created career position
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'roles_responsibilities' => 'required|string',
        'requirements' => 'required|string',
        'apply_button_text' => 'required|string|max:255',
    ]);

    Position::create([
        'title' => $request->title,
        'description' => $request->description,
        'roles_responsibilities' => strip_tags($request->roles_responsibilities), // Strip HTML tags
        'requirements' => strip_tags($request->requirements), // Strip HTML tags
        'apply_button_text' => $request->apply_button_text,
    ]);

    return redirect()->route('admin.careers.index')->with('success', 'Career created successfully!');
}


    // Show the form to edit an existing career position
    public function edit($id)
{
    $position = Position::findOrFail($id);
    return view('admin.pages.careers.edit', compact('position'));
}


    // Update an existing career position
    public function update(Request $request, $id)
{
    // Validate the incoming request
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'roles_responsibilities' => 'required|string',
        'requirements' => 'required|string',
        'apply_button_text' => 'required|string|max:255',
    ]);

    // Strip HTML tags from roles_responsibilities and requirements
    $validated['roles_responsibilities'] = strip_tags($validated['roles_responsibilities']);
    $validated['requirements'] = strip_tags($validated['requirements']);

    // Find the Position by ID and update it
    $position = Position::findOrFail($id);
    $position->update($validated);

    // Redirect back with a success message
    return redirect()->route('admin.careers.index')->with('success', 'Career updated successfully!');
}

    // Delete a career position
    public function destroy($id)
    {
        $position = Position::findOrFail($id);
        $position->delete();

        return redirect()->route('admin.careers.index')->with('success', 'Career deleted successfully!');
    }
}
