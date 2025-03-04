<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ApplicationController extends Controller
{

    public function index()
    {
        $applications = Application::paginate(10); // Example pagination
        return view('admin.pages.applications.index', compact('applications'));
    }
    public function create($id)
    {
        $position = Position::findOrFail($id); // Fetch the position
        return view('career.apply', compact('position'));
    }

    public function store(Request $request, $id)
    {
        $position = Position::findOrFail($id);

        // Validate form data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'surname' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:15',
            'attachment' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('attachment')) {
            $validated['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        // Save application
        Application::create([
            'position_id' => $position->id,
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'surname' => $validated['surname'],
            'address' => $validated['address'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'attachment' => $validated['attachment'],
        ]);

        return redirect()->route('career.index')->with('success', 'Application submitted successfully!');
    }
    public function download($id)
    {
        $application = Application::findOrFail($id);

        // Get the file name from the 'attachment' column (no 'attachments/' prepended here)
        $fileName = $application->attachment; // This should only be the file name, not a full path
        $filePath = '/' . $fileName; // Prepend 'attachments/' to the file name

        // Debugging: Check the final file path being used
        \Log::info('Final file path: ' . $filePath);

        // Check if the file exists in the 'public' storage disk
        if (Storage::disk('public')->exists($filePath)) {
            // Assign a custom name for the file download using the applicant's first name and surname
            $customName = "{$application->first_name}_{$application->surname}.pdf";

            // Debugging: Check if the file exists and is being served
            \Log::info('Serving file: ' . $customName);

            // Serve the file with the custom name
            return Storage::disk('public')->download($filePath, $customName);
        }

        // Return an error response if the file does not exist
        \Log::error('File not found: ' . $filePath);
        return response()->json(['error' => 'File not found.'], 404);
    }

}

