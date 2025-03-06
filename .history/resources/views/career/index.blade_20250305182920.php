@extends('layouts.app')

@section('title', 'Available Positions')

@section('content')
<!-- Responsive Careers Banner -->
<div class="relative w-full h-48 md:h-64 lg:h-80 overflow-hidden">
    <img src="{{ asset('images/careers-banner.jpg') }}" alt="Careers" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white">Careers</h1>
    </div>
</div>

<!-- Available Positions -->
<div class="container mx-auto mt-8">
    <h2 class="text-2xl font-bold mb-6 text-center">Available Positions</h2>

    <div class="space-y-6">
        @forelse($positions as $position)
            <div class="border rounded-lg shadow-sm p-4 hover:shadow-lg">
                <h2 class="text-lg font-bold mb-2">{{ $position->title }}</h2>
                <p class="text-gray-600">{{ Str::limit($position->description, 150) }}</p>
                <p class="text-sm text-gray-300 mt-2">Location: {{ $position->location }}</p>
                <p class="text-sm text-gray-500">Posted: {{ $position->created_at->format('M d, Y') }}</p>
                <a href="{{ route('careers.show', $position->id) }}"
                   class="block mt-4 text-blue-600 hover:underline">
                    Learn More &raquo;
                </a>
            </div>
        @empty
            <p class="text-center text-gray-500">No positions available at the moment.</p>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $positions->links() }}
    </div>
</div>
@endsection
