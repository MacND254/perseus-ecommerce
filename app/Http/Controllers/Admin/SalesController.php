<?php

// app/Http/Controllers/Admin/SalesController.php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:viewAny,App\Models\Order'); // Ensure the user has permission to view the sales data
    }

    // Method to get sales report data
    public function index(Request $request)
    {
        // Get total sales, top-selling products, and sales count
        $totalSales = Order::where('status', 'delivered')->sum('total_price');
        $totalOrders = Order::where('status', 'delivered')->count();

        // Get the top-selling products
        $topSellingProducts = OrderItem::select('product_id', \DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        // Get sales within a date range if specified (default: last 30 days)
        $dateFrom = $request->input('date_from', Carbon::now()->subMonth()->toDateString());
        $dateTo = $request->input('date_to', Carbon::now()->toDateString());

        $salesByDate = Order::whereBetween('created_at', [$dateFrom, $dateTo])
            ->where('status', 'delivered')
            ->sum('total_price');

        return view('admin.sales.index', compact('totalSales', 'totalOrders', 'topSellingProducts', 'salesByDate', 'dateFrom', 'dateTo'));
    }
}

