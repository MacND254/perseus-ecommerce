@extends('layouts.admin')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-semibold mb-4 text-black">Manage Posts</h1>

        <!-- Posts Table -->
        <div class="bg-white shadow-md rounded my-6 text-black">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="w-1/12 text-left py-3 px-4 uppercase font-semibold text-sm">#</th>
                        <th class="w-4/12 text-left py-3 px-4 uppercase font-semibold text-sm">Title</th>
                        <th class="w-3/12 text-left py-3 px-4 uppercase font-semibold text-sm">Category</th>
                        <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Created At</th>
                        <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr class="text-gray-700">
                            <td class="w-1/12 text-left py-3 px-4">{{ $loop->iteration }}</td>
                            <td class="w-4/12 text-left py-3 px-4">{{ $post->title }}</td>
                            <td class="w-3/12 text-left py-3 px-4">{{ $post->category->name ?? 'Uncategorized' }}</td>
                            <td class="w-2/12 text-left py-3 px-4">{{ $post->created_at->format('d M Y') }}</td>
                            <td class="w-2/12 text-left py-3 px-4">
                                <a href="{{ route('admin.posts.edit', $post->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">Edit</a>
                                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $posts->links() }}
        </div>

        <!-- Add Post Button -->
        <div class="mt-4">
            <a href="{{ route('admin.posts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-700">Add New Post</a>
        </div>
    </div>
@endsection
