<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all(); // Fetch all contacts
        return view('contact-us.index', compact('contacts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required',
            'subject' => 'required|string|max:255',
            'message' => 'required',
        ]);

        Enquiry::create($request->all());

        return redirect()->route('contact-us.index')->with('success', 'Your message has been sent!');
    }
}
