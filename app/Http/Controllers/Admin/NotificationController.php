<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index()
    {
        // Your logic to fetch and display notifications
        return view('admin.notifications.index');
    }
}

