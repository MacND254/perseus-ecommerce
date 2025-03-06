@extends('layouts.admin')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit User</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="bg-white p-8 rounded-lg shadow-md max-w-lg">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-900">Name:</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ $user->name }}"
                required
                class="mt-1 p-2 block w-full border-gray-300 text-black rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
            >
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-900">Email:</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ $user->email }}"
                required
                class="mt-1 p-2 block w-full border-gray-300 text-black rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
            >
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-900">New Password:</label>
            <input
                type="password"
                id="password"
                name="password"
                class="mt-1 p-2 block w-full border-gray-300 text-black rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
            >
            <small class="text-gray-900">Leave blank if you don't want to change the password.</small>
        </div>

        <button
            type="submit"
            class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
            Update
        </button>
    </form>
</div>
@endsection
