@extends('layouts.admin')

@section('title', 'Manage Career Positions')

@section('content')
<div class="container mx-auto mt-4">
    <h1 class="text-2xl font-bold mb-4">Manage Career Positions</h1>

    <!-- Add New Position Button -->
    <div class="mb-4">
        <a href="{{ route('admin.careers.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Add New Position</a>
    </div>

    <!-- Career Positions Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left">Position Title</th>
                    <th class="px-4 py-2 text-left">Description</th>
                    <th class="px-4 py-2 text-left">Roles & Responsibilities</th>
                    <th class="px-4 py-2 text-left">Requirements</th>
                    <th class="px-4 py-2 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($positions as $position)
                    <tr>
                        <td class="px-4 py-2">{{ $position->title }}</td>
                        <td class="px-4 py-2">{{ \Str::limit($position->description, 50) }}</td>
                        <td class="px-4 py-2">{{ \Str::limit($position->roles_responsibilities, 50) }}</td>
                        <td class="px-4 py-2">{{ \Str::limit($position->requirements, 50) }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('career.show', $position->id) }}" class="text-blue-500 hover:underline">View</a>
                            |
                            <a href="{{ route('admin.careers.edit', $position->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                            |
                            <form action="{{ route('admin.careers.destroy', $position->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this position?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $positions->links() }}
    </div>
</div>
@endsection
