@extends('layouts.admin')

@section('content')
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-6">Edit Product</h1>

        <!-- Display validation errors -->
        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                <ul class="list-disc pl-6">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <!-- Product Name -->
            <div class="mb-4">
                <label for="name" class="block text-gray-900 font-semibold">Product Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="mt-1 p-2 block w-full rounded border border-gray-300 text-black focus:ring focus:ring-blue-500 focus:outline-none"
                    value="{{ old('name', $product->name) }}"
                    required>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-gray-900 font-semibold">Description</label>
                <textarea
                    name="description"
                    id="description"
                    class="mt-1 p-2 block w-full rounded border border-gray-300 text-black focus:ring focus:ring-blue-500 focus:outline-none"
                    rows="4"
                    required>{{ old('description', $product->description) }}</textarea>
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label for="price" class="block text-gray-900 font-semibold">Price</label>
                <input
                    type="number"
                    name="price"
                    id="price"
                    class="mt-1 p-2 block w-full rounded border border-gray-300 text-black focus:ring focus:ring-blue-500 focus:outline-none"
                    value="{{ old('price', $product->price) }}"
                    step="0.01"
                    required>
            </div>

            <!-- Quantity -->
            <div class="mb-4">
                <label for="quantity" class="block text-gray-900 font-semibold">Quantity</label>
                <input
                    type="number"
                    name="quantity"
                    id="quantity"
                    class="mt-1 p-2 block w-full rounded border border-gray-300 text-black focus:ring focus:ring-blue-500 focus:outline-none"
                    value="{{ old('quantity', $product->quantity) }}"
                    required>
            </div>

            <!-- Category -->
            <div class="mb-4">
                <label for="category" class="block text-gray-900 font-semibold">Category</label>
                <select
                    name="category_id"
                    id="category"
                    class="mt-1 p-2 block w-full rounded border border-gray-300 text-black focus:ring focus:ring-blue-500 focus:outline-none"
                    required>
                    <option value="">Select a Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Product Image -->
            <div class="mb-4">
                <label for="product_image" class="block text-gray-700 font-semibold">Product Image</label>
                <input
                    type="file"
                    name="product_image"
                    id="product_image"
                    class="mt-1 p-2 block w-full rounded border border-gray-300 text-black focus:ring focus:ring-blue-500 focus:outline-none">
                @if($product->product_image)
                    <p class="mt-2">Current Image:</p>
                    <img src="{{ asset($product->product_image) }}" alt="Product Image" class="w-24 mt-2">
                @endif
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
                    Update Product
                </button>
            </div>
        </form>
    </div>
@endsection
