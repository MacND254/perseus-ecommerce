@extends('layouts.app')

@section('title', $position->title)

@section('content')
<div class="container mx-auto mt-8">
   <!-- Responsive Careers Banner -->
<div class="relative w-full h-48 md:h-64 lg:h-80 overflow-hidden">
    <img src="{{ asset('images/careers-banner.jpg') }}" alt="Careers" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white">Careers</h1>
    </div>
</div>

    <!-- Position Details -->
    <div class="bg-white p-6 rounded shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $position->title }}</h2>
        <p class="text-gray-600 mb-6">{{ $position->description }}</p>

        <!-- Roles and Responsibilities -->
        <div class="mb-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-3">Roles and Responsibilities</h3>
            <ul class="list-disc ml-6 text-gray-700">
                @foreach(explode("\n", $position->roles_responsibilities) as $role)
                    @if(trim($role))
                        <li class="mb-2">{{ $role }}</li>
                    @endif
                @endforeach
            </ul>
        </div>

        <!-- Requirements -->
        <div class="mb-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-3">Requirements</h3>
            <ul class="list-disc ml-6 text-gray-700">
                @foreach(explode("\n", $position->requirements) as $requirement)
                    @if(trim($requirement))
                        <li class="mb-2">{{ $requirement }}</li>
                    @endif
                @endforeach
            </ul>
        </div>

        <!-- Apply Now Button -->
        <div class="text-center">
            <a href="{{ route('career.apply', $position->id) }}"
               class="bg-blue-500 text-white py-3 px-6 rounded-full text-lg font-semibold hover:bg-blue-600 transition duration-300">
                Apply Now
            </a>
        </div>
    </div>
</div>
@endsection
