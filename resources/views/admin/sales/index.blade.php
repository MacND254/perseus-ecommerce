<!-- resources/views/admin/sales/index.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Sales Overview</h1>

    <!-- Filter by date range -->
    <form action="{{ route('admin.sales.index') }}" method="GET" class="mb-6">
        <div class="flex items-center space-x-4">
            <label for="date_from" class="font-semibold">From:</label>
            <input type="date" name="date_from" id="date_from" value="{{ $dateFrom }}" class="p-2 border rounded">

            <label for="date_to" class="font-semibold">To:</label>
            <input type="date" name="date_to" id="date_to" value="{{ $dateTo }}" class="p-2 border rounded">

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
        </div>
    </form>

    <!-- Displaying Sales Data -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-6">
        <!-- Total Sales -->
        <div class="bg-white p-6 shadow-lg rounded">
            <h3 class="text-xl font-bold mb-4">Total Sales</h3>
            <p class="text-2xl">${{ number_format($totalSales, 2) }}</p>
        </div>

        <!-- Total Orders -->
        <div class="bg-white p-6 shadow-lg rounded">
            <h3 class="text-xl font-bold mb-4">Total Orders</h3>
            <p class="text-2xl">{{ $totalOrders }}</p>
        </div>
    </div>

    <!-- Top Selling Products -->
    <div class="bg-white p-6 shadow-lg rounded mb-6">
        <h3 class="text-xl font-bold mb-4">Top Selling Products</h3>
        <table class="min-w-full border-collapse">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Product</th>
                    <th class="py-2 px-4 border-b">Quantity Sold</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($topSellingProducts as $product)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $product->product->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $product->total_sold }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Sales by Date Range -->
    <div class="bg-white p-6 shadow-lg rounded">
        <h3 class="text-xl font-bold mb-4">Sales Between {{ $dateFrom }} and {{ $dateTo }}</h3>
        <p class="text-2xl">${{ number_format($salesByDate, 2) }}</p>
    </div>
</div>
@endsection
