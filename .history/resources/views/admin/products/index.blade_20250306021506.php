@extends('layouts.admin')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-semibold mb-4 text-black">Product Management</h1>

        <!-- Notifications -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Products Table -->
        <div class="bg-white shadow-md rounded my-6">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="w-1/12 text-left py-3 px-4 uppercase font-semibold text-sm">ID</th>
                        <th class="w-3/12 text-left py-3 px-4 uppercase font-semibold text-sm">Name</th>
                        <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Price</th>
                        <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Quantity</th>
                        <th class="w-4/12 text-left py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="text-gray-700">
                            <td class="w-1/12 text-left py-3 px-4">{{ $product->id }}</td>
                            <td class="w-3/12 text-left py-3 px-4">{{ $product->name }}</td>
                            <td class="w-2/12 text-left py-3 px-4">Ksh {{ number_format($product->price, 2) }}</td>
                            <td class="w-2/12 text-left py-3 px-4">{{ $product->quantity }}</td>
                            <td class="w-4/12 text-left py-3 px-4">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $products->links() }}
        </div>

        <!-- Add Product Button -->
        <div class="mt-4">
            <a href="{{ route('admin.products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-700">Add New Product</a>
        </div>
    </div>
@endsection
