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

    public function destroy($id)
    {
        $role = Role::where('id', $id)->first();
        
        if (!$role->delete()) {
            return redirect()->back();
        }
        return redirect()->route('manage.roles.index');
    }
}
