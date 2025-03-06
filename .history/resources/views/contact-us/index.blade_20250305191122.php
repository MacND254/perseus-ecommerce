@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<!-- Banner Image -->

<div class="relative">
    <img src="{{ asset('images/contact-us.jpg') }}" alt="Contact Us Banner" class="w-full h-64 object-cover">
    <div class="absolute inset-0 flex items-center">
        <h1 class="text-white font-bold pl-6" style="font-size: 56px; margin-left: 30px;">Get In Touch</h1>

    </div>
</div>

<div class="container mx-auto mt-4 grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Contact Details -->
    <div class="bg-gray-100 p-6 rounded shadow text-black">
        <h2 class="text-2xl font-bold mb-4">Contact Information</h2>
        <ul>
            @foreach($contacts as $contact)
                <li class="mb-3">
                    <strong>{{ $contact->department }}:</strong>
                    <p>Email: {{ $contact->email }}</p>
                    @if($contact->phone_number)
                        <p>Phone: {{ $contact->phone_number }}</p>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Contact Form -->
    <div class="bg-white p-6 rounded shadow text-black">
        <h2 class="text-2xl font-bold mb-4">Contact Us</h2>
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('contact.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="mt-1 p-2 border w-full rounded" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="mt-1 p-2 border w-full rounded" required>
            </div>
            <div class="mb-4">
                <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" class="mt-1 p-2 border w-full rounded" required>
            </div>
            <div class="mb-4">
                <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                <input type="text" name="subject" id="subject" class="mt-1 p-2 border w-full rounded" required>
            </div>
            <div class="mb-4">
                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea name="message" id="message" rows="4" class="mt-1 p-2 border w-full rounded" required></textarea>
            </div>
            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
                Submit
            </button>
        </form>
    </div>
</div>
@endsection
