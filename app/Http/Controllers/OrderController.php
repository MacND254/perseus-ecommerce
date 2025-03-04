<?php

// app/Http/Controllers/OrderController.php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Constructor for middleware, ensuring only logged-in users can access order routes
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Method to display all orders for an authenticated user
    public function index()
    {
        // Retrieve orders for the authenticated user
        $orders = Order::where('user_id', Auth::id())->get();

        // Return a view with the user's orders
        return view('orders.index', compact('orders'));
    }

    // Method to show details of a specific order
    public function show($orderId)
    {
        // Load the order with its order items and related products
        $order = Order::with('orderItems.product')->findOrFail($orderId);

        // Return a view with the order details
        return view('orders.show', compact('order'));
    }

    // Method to show the order creation form (cart checkout)
    public function create(Request $request)
    {
        // You can return a view with the cart items here if needed
        return view('orders.create');
    }

    // Method to store a new order
    public function store(Request $request)
    {
        // Begin a database transaction to ensure atomicity
        DB::beginTransaction();

        try {
            // Validate the incoming request
            $request->validate([
                'cartItems' => 'required|array',
                'total_price' => 'required|numeric',
            ]);

            // Create the order (assuming the user is logged in)
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_price' => $request->total_price, // Total price of the cart
                'status' => 'pending', // Default status (to be updated later)
            ]);

            // Loop through the cart items, create order items, and update product stock
            foreach ($request->cartItems as $cartItem) {
                $product = Product::find($cartItem['product_id']);

                // Check if there's enough stock for the product
                if ($product->quantity < $cartItem['quantity']) {
                    throw new \Exception('Insufficient stock for ' . $product->name);
                }

                // Deduct the product stock
                $product->quantity -= $cartItem['quantity'];
                $product->save();

                // Create an order item
                $order->orderItems()->create([
                    'product_id' => $cartItem['product_id'],
                    'quantity' => $cartItem['quantity'],
                    'price' => $product->price,
                ]);
            }

            // Commit the transaction after successful order creation
            DB::commit();

            // Return a success message along with the order data
            return response()->json(['message' => 'Order placed successfully', 'order' => $order], 200);

        } catch (\Exception $e) {
            // Rollback the transaction if anything goes wrong
            DB::rollback();

            // Return an error message
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    // Method to update the order status (e.g., from pending to shipped or delivered)
    public function updateStatus(Request $request, $orderId)
    {
        // Find the order by ID
        $order = Order::findOrFail($orderId);

        // Validate the request to ensure the status is correct
        $request->validate([
            'status' => 'required|in:pending,shipped,delivered,cancelled',
        ]);

        // Update the order status
        $order->status = $request->status;
        $order->save();

        // Return a success message
        return response()->json(['message' => 'Order status updated successfully']);
    }

    // Method to display the user's order history
    public function orderHistory()
    {
        // Retrieve all orders for the logged-in user
        $orders = Order::where('user_id', auth()->id())->get();

        // Return the view displaying the list of orders
        return view('orders.history', compact('orders'));
    }
}
