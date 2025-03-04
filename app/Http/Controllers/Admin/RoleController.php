<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{


    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        return view('admin.roles.index', compact('roles', 'permissions'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
{
    // Validate the role name and permissions
    $request->validate([
        'name' => 'required|unique:roles,name',
        'permissions' => 'nullable|array',
        'permissions.*' => 'exists:permissions,id'  // Ensure that each permission ID exists in the database
    ]);

    // Create the role
    $role = Role::create(['name' => $request->name]);

    // Assign permissions if available
    if ($request->has('permissions')) {
        // Check if the permissions are IDs and not names
        $permissions = Permission::find($request->input('permissions'));

        if ($permissions->count()) {
            $role->givePermissionTo($permissions);
        }
    }

    return redirect()->route('admin.roles.index')->with('success', 'Role created.');
}


    public function update(Request $request, Role $role)
    {
        $request->validate(['name' => 'required|unique:roles,name,'.$role->id]);

        // Update the role name and make sure it uses the 'admin' guard
        $role->update([
            'name' => $request->name,
            'guard_name' => 'admin'  // Ensure that the guard is 'admin'
        ]);

        // Sync the permissions
        $role->syncPermissions($request->input('permissions', []));
        return redirect()->route('admin.roles.index')->with('success', 'Role updated.');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Role deleted.');
    }
}
