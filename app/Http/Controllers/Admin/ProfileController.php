<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        // Your logic to display the logged-in user's profile
        return view('admin.profile.index');
    }
}

