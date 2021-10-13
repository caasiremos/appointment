<?php

namespace App\Http\Controllers;

use App\Models\Permission;

class SystemPermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $permissions = Permission::get();
        return view('permissions.index', compact('permissions'));
    }
}
