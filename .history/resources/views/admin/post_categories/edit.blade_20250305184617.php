@extends('layouts.admin')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white shadow rounded-lg">
    <h1 class="text-2xl font-bold mb-4 text-black">Edit Category</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.post_categories.update', $postCategory->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-black">Category Name</label>
            <input type="text" name="name" class="w-full p-2 border rounded mt-1" value="{{ old('name', $postCategory->name) }}" required>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Update Category</button>
    </form>
</div>
@endsection
