@extends('layouts.admin')

@section('title', 'Messages')

@section('content')
<div class="container mx-auto mt-4">
    <h1 class="text-2xl font-bold mb-6">Messages</h1>

    <!-- Display success message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Messages Table -->
    <div class="bg-white p-6 rounded shadow">
        <table class="min-w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">#</th>
                    <th class="border border-gray-300 px-4 py-2">Name</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Tel</th>
                    <th class="border border-gray-300 px-4 py-2">Subject</th>
                    <th class="border border-gray-300 px-4 py-2">Message</th>
                    <th class="border border-gray-300 px-4 py-2">Date</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $message)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $message->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $message->email }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $message->phone_number }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $message->subject }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $message->message }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $message->created_at->format('d M Y, h:i A') }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700"
                                    onclick="return confirm('Are you sure you want to delete this message?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">No messages found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $messages->links() }}
        </div>
    </div>
</div>
@endsection
