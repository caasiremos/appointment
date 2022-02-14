<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EditSchedule extends Component
{
    public $state = [
        'date' => '',
        'start_time' => '',
        'end_time' => ''
    ];

    protected $rules = [
        'state.date' => 'required',
        'state.start_time' => 'required',
        'state.end_time' => 'required',
    ];

    public function mount(User $user)
    {
        $this->users = $user->get();
    }

    public function render()
    {
        return view('livewire.edit-schedule');
    }
}
