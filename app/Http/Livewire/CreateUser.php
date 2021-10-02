<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class CreateUser extends Component
{
    public $email;

    public $name;

    public $password;

    public $confirm_password;

    public $state = [
        'name',
        'password',
        'confirm_password'
    ];

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|confirmed'
    ];

    public function createUser()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        if (!$user) {
            return back()->withInput();
        }
        return redirect()->route('users.index');
    }

    public function render()
    {
        return view('livewire.create-user')
            ->layout('layouts.app');
    }

    //Name
    //NIN
    //Phone Number
    //
}
