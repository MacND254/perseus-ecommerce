<?php

// app/Http/Controllers/Admin/OrderController.php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminOrderController extends Controller
{
    // Constructor to apply middleware to ensure only admin users can access these actions
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:viewAny,App\Models\Order'); // Use proper permissions for admins
    }

    // Method to list all orders in the admin panel
    public function index()
    {
        // Retrieve all orders from the database
        $orders = Order::with('orderItems.product')->orderBy('created_at', 'desc')->get();

        // Return a view to display all orders
        return view('admin.orders.index', compact('orders'));
    }

    // Method to show order details (view individual order)
    public function show($orderId)
    {
        // Retrieve the order along with its order items and related products
        $order = Order::with('orderItems.product')->findOrFail($orderId);

        // Return a view to display the details of the order
        return view('admin.orders.show', compact('order'));
    }

    // Method to update the status of an order (e.g., pending, shipped, delivered, cancelled)
    public function updateStatus(Request $request, $orderId)
    {
        // Validate the incoming request
        $request->validate([
            'status' => 'required|in:pending,shipped,delivered,cancelled',
        ]);

        // Find the order by ID
        $order = Order::findOrFail($orderId);

        // Update the order's status
        $order->status = $request->status;
        $order->save();

        // Redirect back to the order details page with a success message
        return redirect()->route('admin.orders.show', $orderId)
            ->with('success', 'Order status updated successfully.');
    }
}

