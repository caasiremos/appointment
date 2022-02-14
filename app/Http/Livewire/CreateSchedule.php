<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Employee;
use App\Models\Schedule;

class CreateSchedule extends Component
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

    public function createSchedule()
    {
        $this->validate();

        $schedule = Schedule::make([
            'date' => $this->state['date'],
            'start_time' => $this->state['start_time'],
            'end_time' => $this->state['end_time'],
        ]);

        $schedule->user()->associate(auth()->user()->id);

        $schedule->save();

        return redirect()->to(route('schedules.index'));
    }

    public function render()
    {
        return view('livewire.create-schedule')
            ->layout('layouts.app');
    }
}
