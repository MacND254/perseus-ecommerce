@extends('layouts.admin') <!-- Assuming you have an admin layout -->

@section('title', 'Manage Contacts')

@section('content')
<div class="container mx-auto mt-6 text-black">
    <h1 class="text-2xl font-bold mb-4">Manage Contacts</h1>
    <div class="mb-4">
        <a href="{{ route('admin.contact-us.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Add New Contact</a>
    </div>

    <!-- Display Success Message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Contacts Table -->
    <div class="bg-white shadow-md rounded mb-6 overflow-hidden">
        <table class="table-auto w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="px-6 py-3 text-gray-600 font-bold">#</th>
                    <th class="px-6 py-3 text-gray-600 font-bold">Department</th>
                    <th class="px-6 py-3 text-gray-600 font-bold">Email</th>
                    <th class="px-6 py-3 text-gray-600 font-bold">Phone Number</th>
                    <th class="px-6 py-3 text-gray-600 font-bold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($contacts as $contact)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-3">{{ $loop->iteration + $contacts->firstItem() - 1 }}</td>
                        <td class="px-6 py-3">{{ $contact->department }}</td>
                        <td class="px-6 py-3">{{ $contact->email }}</td>
                        <td class="px-6 py-3">{{ $contact->phone_number ?? 'N/A' }}</td>
                        <td class="px-6 py-3">
                            <a href="{{ route('admin.contact-us.edit', $contact->id) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.contact-us.destroy', $contact->id) }}" method="POST" class="inline-block ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure you want to delete this contact?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-3 text-center text-gray-600">No contacts found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $contacts->links() }}
    </div>
</div>
@endsection
