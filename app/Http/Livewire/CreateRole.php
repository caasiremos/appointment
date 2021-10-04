<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateRole extends Component
{
    public $name;

    public $display_name;

    public $description;

    protected $rules = [
        'name' => 'required',
        'display_name' => 'required',
        'description' => 'required'
    ];

    public function createRole()
    {
        $this->validate();

        $role = Role::create([
            'name' => Str::slug($this->name),
            'display_name' => $this->display_name,
            'description' => $this->description
        ]);

        if (!$role) {
            return back()->withInput();
        }

        return redirect()->route('manage.roles.index');
    }

    public function render()
    {
        return view('livewire.create-role')
            ->layout('layouts.app');
    }
}
