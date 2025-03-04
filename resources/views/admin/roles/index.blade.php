@extends('layouts.admin')

@section('title', 'Roles & Permissions')

@section('content')
    <div class="container mx-auto mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-xl font-bold">Roles & Permissions Management</h1>
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Create New Role</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            <!-- Roles and Permissions Table -->
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped align-middle fs-6">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center">Permission</th>
                                        @foreach($roles as $role)
                                            <th class="text-center">{{ ucfirst($role->name) }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td>{{ $permission->name }}</td>

                                            <!-- Loop through each role to display permissions -->
                                            @foreach($roles as $role)
                                                <td class="text-center">
                                                    <input type="checkbox" class="form-check-input"
                                                           name="permissions[{{ $role->name }}][]" value="{{ $permission->id }}"
                                                           @if($role->permissions->contains($permission)) checked @endif>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
