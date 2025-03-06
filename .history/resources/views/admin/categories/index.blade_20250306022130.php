@extends('layouts.admin')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Manage Categories</h1>

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

        <!-- Categories Table -->
        <div class="bg-white shadow-md rounded my-6 text-black">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="w-1/12 text-left py-3 px-4 uppercase font-semibold text-sm">ID</th>
                        <th class="w-8/12 text-left py-3 px-4 uppercase font-semibold text-sm">Category Name</th>
                        <th class="w-3/12 text-left py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr class="text-gray-700">
                            <td class="w-1/12 text-left py-3 px-4">{{ $category->id }}</td>
                            <td class="w-8/12 text-left py-3 px-4">{{ $category->name }}</td>
                            <td class="w-3/12 text-left py-3 px-4 flex space-x-4">
                                <!-- Edit Button -->
                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                   class="text-blue-500 hover:text-blue-700">Edit</a>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-gray-500">No categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $categories->links() }} <!-- Pagination links -->
        </div>

        <!-- Add Category Button -->
        <div class="mt-4">
            <a href="{{ route('admin.categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-700">Add New Category</a>
        </div>
    </div>
@endsection
