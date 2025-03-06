@extends('layouts.admin') {{-- Assuming you have an admin layout --}}

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Manage Admins</h1>

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

        <!-- Admin Table -->
        <div class="bg-white shadow-md rounded my-6 text-black">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="w-1/12 text-left py-3 px-4 uppercase font-semibold text-sm">ID</th>
                        <th class="w-3/12 text-left py-3 px-4 uppercase font-semibold text-sm">Name</th>
                        <th class="w-3/12 text-left py-3 px-4 uppercase font-semibold text-sm">Email</th>
                        <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Role</th>
                        <th class="w-3/12 text-left py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($admins as $admin)
                        <tr class="text-gray-700">
                            <td class="w-1/12 text-left py-3 px-4">{{ $admin->id }}</td>
                            <td class="w-3/12 text-left py-3 px-4">{{ $admin->name }}</td>
                            <td class="w-3/12 text-left py-3 px-4">{{ $admin->email }}</td>
                            <td class="w-2/12 text-left py-3 px-4">
                                @foreach ($admin->getRoleNames() as $roleName)
                                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ $roleName }}</span>
                                @endforeach
                            </td>
                            <td class="w-3/12 text-left py-3 px-4">
                                <a href="{{ route('admin.admins.edit', $admin) }}" class="text-blue-500 hover:text-blue-700 mr-2">Edit</a>
                                <form action="{{ route('admin.admins.destroy', $admin) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this admin?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">No admins found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $admins->links() }}
        </div>

        <!-- Add Admin Button -->
        <div class="mt-4">
            <a href="{{ route('admin.admins.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-700">Add New Admin</a>
        </div>
    </div>
@endsection
