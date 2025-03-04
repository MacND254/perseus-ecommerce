<!-- resources/views/user/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard | Perseus eCommerce')

@section('content')
    <section class="container mx-auto py-12">
        <h1 class="text-3xl font-bold mb-6">My Dashboard</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Profile Section -->
            <div class="p-6 bg-white rounded shadow">
                <h2 class="text-xl font-bold mb-4">Profile</h2>
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <a href="{{ route('user.edit') }}" class="block mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit Profile</a>
            </div>

            <!-- Order History -->
            <div class="p-6 bg-white rounded shadow lg:col-span-2">
                <h2 class="text-xl font-bold mb-4">Order History</h2>
                @if($orders->isEmpty())
                    <p>You have no orders yet.</p>
                @else
                    <ul class="space-y-4">
                        @foreach($orders as $order)
                            <li class="p-4 bg-gray-100 rounded">
                                <p><strong>Order ID:</strong> {{ $order->id }}</p>
                                <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
                                <p><strong>Total:</strong> ${{ $order->total }}</p>
                                <a href="{{ route('order.details', $order->id) }}" class="text-blue-500 hover:underline">View Details</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </section>
@endsection
