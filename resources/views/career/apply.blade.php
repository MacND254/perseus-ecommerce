@extends('layouts.app')

@section('title', 'Apply for ' . $position->title)

@section('content')
<div class="container mx-auto mt-4">
    <h1 class="text-3xl font-bold mb-4">Apply for {{ $position->title }}</h1>

    <form action="{{ route('career.apply.store', $position->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Name Fields -->
        <div class="flex space-x-4">
            <div class="flex-1">
                <label for="first_name" class="block font-bold">First Name <span class="text-red-500">*</span></label>
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required
                       class="border rounded w-full py-2 px-4">
                @error('first_name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="flex-1">
                <label for="middle_name" class="block font-bold">Middle Name</label>
                <input type="text" id="middle_name" name="middle_name" value="{{ old('middle_name') }}"
                       class="border rounded w-full py-2 px-4">
                @error('middle_name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="flex-1">
                <label for="surname" class="block font-bold">Surname <span class="text-red-500">*</span></label>
                <input type="text" id="surname" name="surname" value="{{ old('surname') }}" required
                       class="border rounded w-full py-2 px-4">
                @error('surname') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Address -->
        <div>
            <label for="address" class="block font-bold">Address <span class="text-red-500">*</span></label>
            <input type="text" id="address" name="address" value="{{ old('address') }}" required
                   class="border rounded w-full py-2 px-4">
            @error('address') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block font-bold">Email <span class="text-red-500">*</span></label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                   class="border rounded w-full py-2 px-4">
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Phone Number -->
        <div>
            <label for="phone_number" class="block font-bold">Phone Number <span class="text-red-500">*</span></label>
            <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required
                   class="border rounded w-full py-2 px-4">
            @error('phone_number') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Attachment -->
        <div>
            <label for="attachment" class="block font-bold">Attachment <span class="text-red-500">*</span></label>
            <input type="file" id="attachment" name="attachment" required
                   class="border rounded w-full py-2 px-4">
            @error('attachment') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
            Submit Application
        </button>
    </form>
</div>
@endsection
