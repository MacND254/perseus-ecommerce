@extends('layouts.admin')

@section('content')
<div class="container mx-auto mt-8">
    <div class="bg-gray-500 shadow rounded-lg overflow-hidden">
        <div class="bg-gray-100 px-6 py-4 border-b flex items-center justify-between">
            <h4 class="text-xl font-bold text-gray-800">Edit Admin</h4>
            <a href="{{ route('admin.admins.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300">Back to Admins</a>
        </div>

        <div class="p-6">
            <form action="{{ route('admin.admins.update', $admin) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-900">Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $admin->name) }}"
                        required
                        class="mt-1 p-2 block w-full border-gray-300 text-black rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                    >
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-900">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $admin->email) }}"
                        required
                        class="mt-1 p-2 block w-full border-gray-300 text-black rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                    >
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="role" class="block text-sm font-medium text-gray-900">Role</label>
                    <select
                        id="role"
                        name="role"
                        required
                        class="mt-1 block w-full p-2 border-gray-300 text-black rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    >
                        <option value="">Select a Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role', $admin->role_id) == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('role')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-900">New Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="mt-1 p-2 block w-full border-gray-300 text-black rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror"
                    >
                    <small class="text-green-500">Leave blank to keep current password.</small>
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-900">Confirm New Password</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="mt-1 p-2 block w-full border-gray-300 text-black rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>

                <div>
                    <button
                        type="submit"
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                        Update Admin
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
