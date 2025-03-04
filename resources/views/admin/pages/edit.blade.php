@extends('layouts.admin')

@section('title', 'Edit Page')

@section('content')
<div class="container mx-auto mt-4">
    <h1 class="text-2xl font-bold mb-4">Edit Page</h1>
    <form method="POST" action="{{ route('admin.pages.update', $id) }}">
        @csrf
        @method('PUT')
        <label for="title" class="block font-medium">Page Title:</label>
        <input type="text" id="title" name="title" class="border border-gray-300 rounded w-full mb-4" value="">

        <label for="content" class="block font-medium">Page Content:</label>
        <textarea id="content" name="content" rows="10" class="border border-gray-300 rounded w-full mb-4"></textarea>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Page</button>
    </form>
</div>
@endsection
