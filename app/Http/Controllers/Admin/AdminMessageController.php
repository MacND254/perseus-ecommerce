<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enquiry; // Assuming the model name is `Enquiry`

class AdminMessageController extends Controller
{
    /**
     * Display a listing of the messages.
     */
    public function index()
    {
        $messages = Enquiry::latest()->paginate(10); // Retrieve messages with pagination
        return view('admin.pages.messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new message (not required in this case).
     */
    public function create()
    {
        abort(404); // Not applicable for this feature
    }

    /**
     * Store a newly created message in storage (not required in this case).
     */
    public function store(Request $request)
    {
        abort(404); // Not applicable for this feature
    }

    /**
     * Display the specified message.
     */
    public function show($id)
    {
        $message = Enquiry::findOrFail($id);
        return view('admin.pages.messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified message (not required in this case).
     */
    public function edit($id)
    {
        abort(404); // Not applicable for this feature
    }

    /**
     * Update the specified message in storage (not required in this case).
     */
    public function update(Request $request, $id)
    {
        abort(404); // Not applicable for this feature
    }

    /**
     * Remove the specified message from storage.
     */
    public function destroy($id)
    {
        $message = Enquiry::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Message deleted successfully.');
    }
}
