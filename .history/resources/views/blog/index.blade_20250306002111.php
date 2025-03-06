@extends('layouts.app')

@section('title', 'Blog')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold my-4">Blog</h1>

        @foreach($posts as $post)
            <div class="mb-6 border-b pb-6 flex items-start space-x-4">
                <!-- Image Section: Left Half -->
                <div class="w-1/2">
                    <img src="{{ $post->image_url ? asset('storage/' . $post->image) : asset('images/default-placeholder.png') }}"
                         alt="{{ $post->title }}"
                         class="w-full h-64 object-cover rounded-md">
                </div>

                <!-- Content Section: Right Half -->
                <div class="w-1/2 pl-6">
                    <h2 class="text-2xl font-semibold mb-2">
                        <a href="{{ route('blog.show', $post->slug) }}" class="text-blue-600 hover:text-blue-800">{{ $post->title }}</a>
                    </h2>
                    <p class="text-sm text-gray-500 mb-2">Category: {{ $post->category->name ?? 'Uncategorized' }}</p>
                    <p class="text-gray-400 mb-4">{{ Str::limit(strip_tags($post->content), 150) }}</p>
                    <a href="{{ route('blog.show', $post->slug) }}" class="text-blue-500 hover:underline">Read more...</a>
                </div>
            </div>
        @endforeach

        <div class="mt-4">
            {{ $posts->links() }} {{-- Laravel pagination --}}
        </div>
    </div>
@endsection
