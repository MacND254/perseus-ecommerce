@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4 text-black">Create New Product</h1>

        <!-- Display Validation Errors -->
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Product Creation Form -->
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
            @csrf

            <!-- Product Name -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Product Name</label>
                <input type="text" name="name" id="name" class="w-full border-gray-300 text-black rounded-lg shadow-sm focus:ring focus:ring-blue-200" value="{{ old('name') }}" required>
            </div>

            <!-- Category -->
            <div class="mb-4">
                <label for="category_id" class="block text-gray-700 font-medium mb-2">Category</label>
                <select name="category_id" id="category_id" class="w-full border-gray-300 text-black rounded-lg shadow-sm focus:ring focus:ring-blue-200" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                <textarea name="description" id="description" rows="4" class="w-full border-gray-300 text-black rounded-lg shadow-sm focus:ring focus:ring-blue-200" required>{{ old('description') }}</textarea>
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-medium mb-2">Price (Ksh)</label>
                <input type="number" name="price" id="price" class="w-full border-gray-300 text-black rounded-lg shadow-sm focus:ring focus:ring-blue-200" value="{{ old('price') }}" step="0.1" required>
            </div>

            <!-- Quantity -->
            <div class="mb-4">
                <label for="quantity" class="block text-gray-700 font-medium mb-2">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="w-full border-gray-300 text-black rounded-lg shadow-sm focus:ring focus:ring-blue-200" value="{{ old('quantity') }}" required>
            </div>

            <!-- Product Image -->
<div class="mb-4">
    <label for="product_images" class="block text-gray-700 font-medium mb-2">Product Images</label>
    <input type="file" name="product_images[]" id="product_images" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200" multiple>
</div>


            <!-- Submit Button -->
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-700 focus:outline-none">
                Create Product
            </button>
        </form>
    </div>
@endsection
