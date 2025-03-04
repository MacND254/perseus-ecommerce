<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    // Ensure the user is authenticated
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Display the user dashboard
    public function index()
    {
        // Get the authenticated user
        $user = auth()->user();

        // Retrieve all orders for the authenticated user
        $orders = Order::where('user_id', $user->id)->get();

        // Return the view with user and orders data
        return view('user.dashboard', compact('user', 'orders'));
    }
}
