@extends('layouts.admin')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Edit Category</h1>

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

        <!-- Edit Category Form -->
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <!-- Category Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-900 text-sm font-bold mb-2">Category Name:</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline"
                        required>
                    @error('name')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="category_image" class="block text-sm font-medium text-gray-900">Category Image</label>
                    <input type="file" name="category_image" id="category_image" class="mt-1 p-2 border rounded w-full">
                </div>


                <!-- Submit Button -->
                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Update Category
                    </button>
                    <a href="{{ route('admin.categories.index') }}"
                        class="text-gray-600 hover:text-gray-900 text-sm">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
