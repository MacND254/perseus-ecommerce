@extends('layouts.admin') <!-- Assuming you have an admin layout -->

@section('title', 'Add New Contact')

@section('content')
<div class="container mx-auto mt-6">
    <h1 class="text-2xl font-bold mb-4">Add New Contact</h1>

    <!-- Display Success Message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display Validation Errors -->
    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form to Add Contact -->
    <form action="{{ route('admin.contactus.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="department" class="block text-sm font-medium text-gray-700">Department</label>
            <input type="text" name="department" id="department" class="mt-1 p-2 border w-full rounded" placeholder="Enter department name" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="mt-1 p-2 border w-full rounded" placeholder="Enter email address" required>
        </div>
        <div class="mb-4">
            <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number" class="mt-1 p-2 border w-full rounded" placeholder="Enter phone number (optional)">
        </div>
        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
            Add Contact
        </button>
    </form>
</div>
@endsection
