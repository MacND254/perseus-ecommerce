@extends('layouts.admin')

@section('title', 'Edit Career')

@section('content')
<div class="container mx-auto mt-4">
    <h1 class="text-2xl font-bold mb-4">Edit Career</h1>

    <form action="{{ route('admin.careers.update', $position->id) }}" method="POST" enctype="multipart/form-data" x-data="careerForm()">
        @csrf
        @method('PUT')

        <!-- Career Title -->
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-900">Title</label>
            <input type="text" name="title" id="title" class="text-black mt-1 block w-full p-2 border border-gray-300 rounded-md" value="{{ old('title', $position->title) }}" required />
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-900">Description</label>
            <textarea x-model="description" name="description" id="description" class="text-black mt-1 block w-full p-2 border border-gray-300 rounded-md" required>{{ old('description', $position->description) }}</textarea>
        </div>

        <!-- Roles and Responsibilities -->
        <div class="mb-4">
            <label for="roles_responsibilities" class="block text-sm font-medium text-gray-900">Roles and Responsibilities</label>
            <textarea x-model="rolesResponsibilities" name="roles_responsibilities" id="roles_responsibilities" class="text-black mt-1 block w-full p-2 border border-gray-300 rounded-md" required>{{ old('roles_responsibilities', $position->roles_responsibilities) }}</textarea>
        </div>

        <!-- Requirements -->
        <div class="mb-4">
            <label for="requirements" class="block text-sm font-medium text-gray-900">Requirements</label>
            <textarea x-model="requirements" name="requirements" id="requirements" class="text-black mt-1 block w-full p-2 border border-gray-300 rounded-md" required>{{ old('requirements', $position->requirements) }}</textarea>
        </div>

        <!-- Apply Now Button -->
        <div class="mb-4">
            <label for="apply_button_text" class="block text-sm font-medium text-gray-900">Apply Now Button Text</label>
            <input type="text" name="apply_button_text" id="apply_button_text" class="text-black mt-1 block w-full p-2 border border-gray-300 rounded-md" value="{{ old('apply_button_text', $position->apply_button_text) }}" required />
        </div>

        <!-- Submit Button -->
        <div class="mb-4">
            <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">Update Career</button>
        </div>
    </form>
</div>
<script>
    tinymce.init({
    selector: '#roles_responsibilities',
    plugins: 'lists link image table code',
    toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image table code',
    height: 300,
    setup: function (editor) {
    editor.on('change', function () {
        tinymce.triggerSave(); // Syncs content with the textarea
    });
    }
    });
</script>
<script>
    tinymce.init({
    selector: '#requirements',
    plugins: 'lists link image table code',
    toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image table code',
    height: 300,
    setup: function (editor) {
    editor.on('change', function () {
        tinymce.triggerSave(); // Syncs content with the textarea
    });
    }
    });
</script>

<script>
    function careerForm() {
        return {
            description: '{{ old('description', $position->description) }}',
            rolesResponsibilities: '{{ old('roles_responsibilities', $position->roles_responsibilities) }}',
            requirements: '{{ old('requirements', $position->requirements) }}'
        }
    }
</script>
@endsection
