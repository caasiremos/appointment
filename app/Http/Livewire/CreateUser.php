<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Role;
use Livewire\Component;
use App\Models\Employee;

class CreateUser extends Component
{
    public $email;

    public $name;

    public $password;

    public $role;

    public $telephone;

    public $position;

    public $roles;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|confirmed',
        'telephone' => 'required|max:10',
        'position' => 'required'
    ];

    public function mount()
    {
        $this->roles = Role::get();
    }

    public function createUser()
    {
        $this->validate();

        $user = User::make([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'telephone' => $this->telephone,
            'position' => $this->position,
        ]);

        $user->role()->associate($this->selectedRole);

        if (!$user->save()) {
            return back()->withInput();
        }

        return redirect()->route('users.index');
    }

    public function getSelectedRoleProperty()
    {
        if (!$this->role) {
            return null;
        }

        return Role::findOrFail($this->role);
    }

    public function render()
    {
        return view('livewire.create-user')
            ->layout('layouts.app');
    }
}
