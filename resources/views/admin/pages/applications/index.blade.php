@extends('layouts.admin')

@section('title', 'Applicants')

@section('content')
<div class="container mx-auto mt-4">
    <h1 class="text-2xl font-bold mb-6">Applicants</h1>

    @if($applications->isEmpty())
        <p class="text-gray-500">No applicants found.</p>
    @else
        <div class="overflow-x-auto">
            <table class="table-auto w-full bg-white border border-gray-200 shadow-sm rounded-lg">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border text-left text-gray-600">#</th>
                        <th class="px-4 py-2 border text-left text-gray-600">Full Name</th>
                        <th class="px-4 py-2 border text-left text-gray-600">Position Applied</th>
                        <th class="px-4 py-2 border text-left text-gray-600">Email</th>
                        <th class="px-4 py-2 border text-left text-gray-600">Phone</th>
                        <th class="px-4 py-2 border text-center text-gray-600">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $index => $application)
                        <tr>
                            <td class="px-4 py-2 border text-gray-700">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border text-gray-700">
                                {{ $application->first_name }}
                                {{ $application->middle_name }}
                                {{ $application->surname }}
                            </td>
                            <td class="px-4 py-2 border text-gray-700">
                                {{ $application->position->title ?? 'N/A' }}
                            </td>
                            <td class="px-4 py-2 border text-gray-700">{{ $application->email }}</td>
                            <td class="px-4 py-2 border text-gray-700">{{ $application->phone_number }}</td>
                            <td class="px-4 py-2 border text-center">
                                <a href="{{ route('admin.applications.download', $application->id) }}"
                                    class="text-blue-500 hover:underline">
                                    Download Document
                                 </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $applications->links() }}
        </div>
    @endif
</div>
@endsection
