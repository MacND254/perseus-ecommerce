@extends('layouts.admin') <!-- Assuming you have an admin layout -->

@section('title', 'Edit Contact')

@section('content')
<div class="container mx-auto mt-6 text-black">
    <h1 class="text-2xl font-bold mb-4">Edit Contact</h1>

    <!-- Display Success Message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Edit Contact Form -->
    <form action="{{ route('admin.contact-us.update', $contact->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="department" class="block text-sm font-medium text-gray-700">Department</label>
            <input type="text" name="department" id="department" value="{{ old('department', $contact->department) }}" class="mt-1 p-2 border w-full rounded" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $contact->email) }}" class="mt-1 p-2 border w-full rounded" required>
        </div>

        <div class="mb-4">
            <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $contact->phone_number) }}" class="mt-1 p-2 border w-full rounded">
        </div>

        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
            Update Contact
        </button>
    </form>
</div>
@endsection
