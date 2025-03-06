@extends('layouts.admin')

<style>
    .custom-font {
        font-size: 8px; /* Adjust the font size */
    }
</style>

@section('title', 'Create New Role')

@section('content')
    <div class="container mx-auto mt-4">
        <h1 class="text-xl font-bold mb-4">Create New Role</h1>

        <form action="{{ route('admin.roles.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="roleName" class="form-label">Role Name</label>
                <input type="text" name="name" id="roleName" class="form-control text-black" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Permissions</label>
                @foreach ($permissions as $permission)
                    <div class="form-check">
                        <input class="form-check-input"
                               type="checkbox"
                               name="permissions[]"
                               value="{{ $permission->id }}"
                               id="permission{{ $permission->id }}"
                               @if(old('permissions') && in_array($permission->id, old('permissions')))
                                   checked
                               @elseif(isset($role) && $role->permissions->contains($permission))
                                   checked
                               @endif>
                        <label class="form-check-label" for="permission{{ $permission->id }}">
                            {{ $permission->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Create Role</button>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
