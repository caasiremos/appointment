<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class SystemRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $roles = Role::withCount('permissions')->get();
        return view('roles.index', compact('roles'));
    }
}
