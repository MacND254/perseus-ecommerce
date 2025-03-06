@extends('layouts.admin') {{-- Assuming you have an admin layout --}}

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-semibold mb-4 text-black">Create New Category</h1>

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

        <!-- Category Form -->
        <div class="bg-white shadow-md rounded my-6 p-4">
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <!-- Category Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="category_image" class="block text-sm font-medium text-gray-700">Category Image</label>
                    <input type="file" name="category_image" id="category_image" class="mt-1 p-2 border rounded w-full">
                </div>


                <!-- Submit Button -->
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-700">Create Category</button>
            </form>
        </div>

        <a href="{{ route('admin.categories.index') }}" class="text-blue-500 hover:text-blue-700">Back to Categories</a>
    </div>
@endsection
