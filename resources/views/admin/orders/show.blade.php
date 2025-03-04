<!-- resources/views/admin/orders/show.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Order #{{ $order->id }} Details</h1>

    <p><strong>User:</strong> {{ $order->user->name }}</p>
    <p><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</p>
    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>

    <h2 class="mt-4 text-xl font-bold">Order Items</h2>
    <table class="min-w-full bg-white border border-gray-200 mt-4">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Product Name</th>
                <th class="py-2 px-4 border-b">Quantity</th>
                <th class="py-2 px-4 border-b">Price</th>
                <th class="py-2 px-4 border-b">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $orderItem)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $orderItem->product->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $orderItem->quantity }}</td>
                    <td class="py-2 px-4 border-b">${{ number_format($orderItem->price, 2) }}</td>
                    <td class="py-2 px-4 border-b">${{ number_format($orderItem->price * $orderItem->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="mt-6">
        @csrf
        @method('PATCH')
        <div class="flex items-center space-x-4">
            <label for="status" class="font-bold">Update Order Status</label>
            <select name="status" id="status" class="p-2 border rounded">
                <option value="pending" @selected($order->status == 'pending')>Pending</option>
                <option value="shipped" @selected($order->status == 'shipped')>Shipped</option>
                <option value="delivered" @selected($order->status == 'delivered')>Delivered</option>
                <option value="cancelled" @selected($order->status == 'cancelled')>Cancelled</option>
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Status</button>
        </div>
    </form>
</div>
@endsection
