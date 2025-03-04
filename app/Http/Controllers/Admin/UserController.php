<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Events\UserProfileUpdated;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10); // Paginate with 10 items per page
        return view('admin.users.index', compact('users'));


    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed', // Ensure passwords match
        ]);

        // Create user
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|min:8', // Password is optional but must be at least 8 characters if provided
    ]);

    $user = User::findOrFail($id);

    $data = $request->only(['name', 'email']);

    // Hash the password only if provided
    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $updatedFields = [];
/*
    // Determine which fields were updated
    foreach ($data as $key => $value) {
        if ($user->$key !== $value) {
            $updatedFields[] = $key;  // Add the updated field name to the array
        }
    }

    $user->update($data);

    // Dispatch the UserProfileUpdated event with the updated fields
    event(new UserProfileUpdated($user, $updatedFields));
*/
    return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
}

public function show($id)
{
    $user = User::findOrFail($id); // Find the user or throw a 404 error
    return view('admin.users.show', compact('user')); // Return the view with the user data
}



}
