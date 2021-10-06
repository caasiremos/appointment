<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Livewire\Component;
use App\Models\Permission;

class RolePermissions extends Component
{
    public $roles;

    public function mount()
    {
        $this->roles = Role::with('permissions')->get();
    }

    public function render()
    {
        return view('livewire.role-permissions')
            ->layout('layouts.app');
    }
}
