<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Schedule;
use App\Models\ScheduleUnavailability;

class CreateScheduleUnavailability extends Component
{
    public $employees;

    public $state = [
        'employee' => '',
        'schedule' => '',
        'start_time' => '',
        'end_time' => ''
    ];

    public function mount(Employee $employee)
    {
        $this->employees = $employee->get();

        $this->employeeSchedules = collect();
    }

    public function getEmployeeSchedulesProperty()
    {
        if (!$this->state['employee']) {
            return null;
        }

        return Employee::findOrFail($this->state['employee'])->schedules;
    }

    public function getSelectedEmployeeProperty()
    {
        return Employee::findOrFail($this->state['employee']);
    }

    public function getSelectedScheduleProperty()
    {
        if (!$this->state['schedule']) {
            return null;
        }

        return Schedule::findOrFail($this->state['schedule']);
    }

    public function createScheduleUnavailability()
    {
        $scheduleUnavailability = ScheduleUnavailability::make([
            'start_time' => $this->state['start_time'],
            'end_time' => $this->state['end_time']
        ]);

        $scheduleUnavailability->schedule()->associate($this->selectedSchedule);
        $scheduleUnavailability->employee()->associate($this->selectedEmployee);
        $scheduleUnavailability->save();
        return redirect()->route('unavailabilities.index');
    }

    public function render()
    {
        return view('livewire.create-schedule-unavailability')
            ->layout('layouts.app');
    }
}
