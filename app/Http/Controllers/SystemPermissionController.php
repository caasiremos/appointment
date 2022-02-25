<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\RedirectResponse;

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

    public function destroy($id): RedirectResponse
    {
        $permission = Permission::where('id', $id)->first();

        if (!$permission->delete()) {
            return redirect()->back();
        }
        return redirect()->route('manage.permissions.index');
    }
}
