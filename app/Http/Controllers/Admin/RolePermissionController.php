<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class RolePermissionController extends Controller
{
    /**
     * Display the roles and permissions management page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.roles_permissions.index');
    }
}
