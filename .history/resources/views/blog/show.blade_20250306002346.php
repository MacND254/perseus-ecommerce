@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="container mx-auto px-4">
        <!-- Title -->
        <h1 class="text-4xl font-bold text-center my-4 text-white">{{ $post->title }}</h1>

        <!-- Category Info -->
        <p class="text-sm text-center text-gray-300 mb-4">Category: {{ $post->category->name ?? 'Uncategorized' }}</p>

         <!-- Image Section -->
         <div class="mb-6">
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full max-w-2xl mx-auto mb-6 object-cover rounded-lg">
        </div>

        <!-- Content Section -->
        <div class="prose lg:prose-xl mx-auto text-gray-300 ">
            {!! $post->content !!} {{-- Render the full content --}}
        </div>
    </div>
@endsection
