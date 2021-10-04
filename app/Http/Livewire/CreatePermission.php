<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Permission;
use Illuminate\Support\Str;

class CreatePermission extends Component
{
    public $system_resources;

    public $system_resource;

    public $action_view;

    public $action_create;

    public $action_update;

    public $action_delete;

    public function mount()
    {
        $this->system_resources = [
            'Dashboard',
            'Services',
            'Employees',
            'Schedules',
            'ScheduleOffHours',
            'Appointments',
            'Users',
            'Roles',
            'Permissions'
        ];
    }

    protected $rules = [
        'description' => 'required'
    ];

    public function createPermission()
    {
        $actions = [];

        array_push($actions, [
                $this->action_view,
                $this->action_create,
                $this->action_update,
                $this->action_delete
            ]
        );

        foreach ($actions[0] as $action) {
            if ($action == null) {
                continue;
            } else {
                Permission::create([
                    'name' => Str::slug($action . ' ' . $this->system_resource),
                    'display_name' => ucfirst($action) . ' ' . $this->system_resource,
                    'description' => "Allow user to " . $action . ' ' . Str::lower($this->system_resource)
                ]);
            }
        }

        return redirect()->route('manage.permissions.index');
    }

    public function render()
    {
        return view('livewire.create-permission')
            ->layout('layouts.app');
    }
}
