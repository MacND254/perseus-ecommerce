@extends('layouts.admin')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-semibold mb-4 text-gray-700">Manage Users</h1>

        <!-- User Table -->
        <div class="bg-white shadow-md rounded my-6 text-black">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="w-1/4 text-left py-3 px-4 uppercase font-semibold text-sm">Name</th>
                        <th class="w-1/4 text-left py-3 px-4 uppercase font-semibold text-sm">Email</th>
                        <th class="w-1/4 text-left py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="text-gray-700">
                            <td class="w-1/4 text-left py-3 px-4">{{ $user->name }}</td>
                            <td class="w-1/4 text-left py-3 px-4">{{ $user->email }}</td>
                            <td class="w-1/4 text-left py-3 px-4">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">Edit</a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $users->links() }}
        </div>

        <!-- Add User Button -->
        <div class="mt-4">
            <a href="{{ route('admin.users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-700">Add New User</a>
        </div>
    </div>
@endsection
