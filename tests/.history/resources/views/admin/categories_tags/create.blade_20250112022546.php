@extends('layouts.admin')

@section('title', 'Create Category or Tag')

@section('content')
<div class="container mx-auto mt-4">
    <h1 class="text-2xl font-bold mb-4">Create New Category or Tag</h1>
    <form method="POST" action="{{ route('admin.categories.tags.store') }}">
        @csrf
        <label for="name" class="block font-medium">Name:</label>
        <input type="text" id="name" name="name" class="border border-gray-300 rounded w-full mb-4">

        <label for="type" class="block font-medium">Type:</label>
        <select id="type" name="type" class="border border-gray-300 rounded w-full mb-4">
            <option value="category">Category</option>
            <option value="tag">Tag</option>
        </select>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create</button>
    </form>
</div>
@endsection
