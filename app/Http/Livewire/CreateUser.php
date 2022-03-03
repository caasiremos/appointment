<?php

namespace App\Http\Livewire;

use App\Utils\Util;
use App\Models\User;
use App\Models\Role;
use Livewire\Component;
use App\Models\Service;
use App\Models\Employee;

class CreateUser extends Component
{
    public $email;

    public $name;

    public $password;

    public $role;

    public $service;

    public $telephone;

    public $position;

    public $services;

    public $roles;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required',
        'telephone' => 'required|max:10',
        'position' => 'required',
        'role' => 'required',
        'service' => 'required',
    ];

    public function mount()
    {
        $this->roles = Role::get();
        $this->services = Service::get();
    }

    public function createUser()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'telephone' => Util::formatTelephone($this->telephone),
            'position' => $this->position,
        ]);

        if (!$user) {
            return back()->withInput();
        }

        $user->attachRole($this->selectedRole);

        $user->services()->attach($this->selectedService);

        return redirect()->route('users.index');
    }

    public function getSelectedRoleProperty()
    {
        if (!$this->role) {
            return null;
        }

        return Role::findOrFail($this->role);
    }

    public function getSelectedServiceProperty()
    {
        if (!$this->role) {
            return null;
        }

        return Service::findOrFail($this->service);
    }

    public function render()
    {
        return view('livewire.create-user')
            ->layout('layouts.app');
    }
}
