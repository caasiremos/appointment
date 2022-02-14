<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Livewire\Component;
use App\Models\Permission;
use Illuminate\Http\RedirectResponse;

class CreateRolePermission extends Component
{
    public $roles;

    public $permissions;

    public $selected_role;

    public $selected_permissions = [];

    public function mount()
    {
        $this->roles = Role::get();
        $this->permissions = Permission::get();
    }

    public function createRolePermission()
    {
        if (empty($this->selected_permissions)) {
            session()->flash('message', 'Please select permissions to attach to this role.');
        }

        $role = Role::where('name', $this->selected_role)->first();
        $role->syncPermissions($this->selected_permissions);

        return redirect()->route('manage.rolesPermissions');
    }

    public function render()
    {
        return view('livewire.create-role-permission')
            ->layout('layouts.app');
    }
}
