@extends('layouts.admin')

@section('title', 'Create Page')

@section('content')
<div class="container mx-auto mt-4">
    <h1 class="text-2xl font-bold mb-4">Create New Page</h1>
    <form method="POST" action="{{ route('admin.pages.store') }}">
        @csrf
        <label for="title" class="block font-medium">Page Title:</label>
        <input type="text" id="title" name="title" class="border border-gray-300 rounded w-full mb-4">

        <label for="content" class="block font-medium">Page Content:</label>
        <textarea id="content" name="content" rows="10" class="border border-gray-300 rounded w-full mb-4"></textarea>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create Page</button>
    </form>
</div>
@endsection
