<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Schedule;

class CreateSchedule extends Component
{
    public $employees;

    public $state = [
        'employee' => '',
        'date' => '',
        'start_time' => '',
        'end_time' => ''
    ];

    protected $rules = [
        'state.date' => 'required',
        'state.start_time' => 'required',
        'state.end_time' => 'required',
        'state.employee' => 'required'
    ];


    protected $messages = [
        'state.employee.required' => 'Employee was not selected'
    ];

    public function mount(Employee $employee)
    {
        $this->employees = $employee->get();
    }

    public function getSelectedEmployeeProperty()
    {
        $this->validate();

        if (!$this->state['employee']) {
            return null;
        }

        return Employee::findOrFail($this->state['employee']);
    }

    public function createSchedule()
    {
        $this->validate();

        $schedule = Schedule::make([
            'date' => $this->state['date'],
            'start_time' => $this->state['start_time'],
            'end_time' => $this->state['end_time'],
        ]);

        $schedule->employee()->associate($this->selectedEmployee);

        $schedule->save();

        return redirect()->to(route('schedules.index'));
    }

    public function render()
    {
        return view('livewire.create-schedule')
            ->layout('layouts.app');
    }
}
