<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Livewire\Component;
use App\Models\Permission;

class RoleDetail extends Component
{
    public $selected_permissions = [];

    public $system_permissions;

    public $role;

    public function mount($id)
    {
        $this->system_permissions = Permission::get();

        $this->role = Role::with('permissions')
            ->where('id', $id)->first();

        $this->role->permissions->each(function($permission){
            array_push($this->selected_permissions, $permission->name);
        });
    }

    public function createRolePermission()
    {
        if (empty($this->selected_permissions)) {
            session()->flash('message', 'Please select permissions to attach to this role.');
        }

        $role = Role::where('name', $this->role->name)->first();

        $role->syncPermissions($this->selected_permissions);

        return redirect()->route('manage.rolesPermissions');
    }

    public function render()
    {
        return view('livewire.role-detail');
    }
}
