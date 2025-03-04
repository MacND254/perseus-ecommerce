<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    // Display all career positions (for the public)
    public function index()
    {
        // Fetch all career positions with pagination (10 per page)
        $positions = Position::paginate(10);

        // Return the public view for career positions
        return view('career.index', compact('positions'));
    }

    // Show the details of a single career position
    public function show($id)
    {
        $position = Position::findOrFail($id);
        return view('career.show', compact('position'));
    }

    public function apply($id)
    {
        $position = Position::findOrFail($id);
        return view('career.apply', compact('position'));
    }

    // Method to handle the application form submission
    public function submitApplication(Request $request, $id)
    {
        // Handle form validation and submission logic (e.g., save application data)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            // Add other application form fields as needed
        ]);

        // Example: You can store the application data in a table
        // Application::create([
        //     'position_id' => $id,
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     // other fields
        // ]);

        return redirect()->route('career.show', $id)->with('success', 'Application submitted successfully!');
    }
}


