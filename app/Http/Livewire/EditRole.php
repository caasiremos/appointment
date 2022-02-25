<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Livewire\Component;
use Illuminate\Support\Str;

class EditRole extends Component
{
    public $name;

    public $display_name;

    public $description;

    public $role_id;

    protected $rules = [
        'name' => 'required',
        'display_name' => 'required',
        'description' => 'required'
    ];

    public function mount($id)
    {
        $this->role_id = $id;
        $role = Role::where('id', $id)->first();
        $this->name = $role->name;
        $this->display_name = $role->display_name;
        $this->description = $role->description;
    }

    public function updateRole()
    {
        $this->validate();
        $role = Role::where('id', $this->role_id)->first();
        $role->update([
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
        return view('livewire.edit-role');
    }
}
