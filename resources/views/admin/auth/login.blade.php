@extends('layouts.login') {{-- Ensure you have a separate admin layout --}}

@section('title', 'Admin Login')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gradient-to-r from-indigo-500 to-blue-500">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg transform transition duration-300 hover:scale-105">
        <h2 class="text-3xl font-extrabold mb-6 text-center text-gray-800">Admin Login</h2>

        @if(session('error'))
            <div class="bg-red-500 text-white p-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-6">
                <label for="email" class="block text-gray-700 text-lg font-semibold">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-lg font-semibold">Password</label>
                <input id="password" type="password" name="password" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition transform duration-200 ease-in-out">
                Login
            </button>
        </form>

        <p class="mt-6 text-center text-gray-600">
            Don't have an account?
            <a href="{{ route('admin.register') }}" class="text-indigo-600 hover:underline">Register as Admin</a>
        </p>
    </div>
</div>
@endsection
