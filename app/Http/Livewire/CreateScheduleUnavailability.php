<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\user;
use App\Models\Schedule;
use App\Models\ScheduleUnavailability;

class CreateScheduleUnavailability extends Component
{
    public $user;

    public $state = [
        'schedule' => '',
        'start_time' => '',
        'end_time' => ''
    ];

    public function mount()
    {
        $this->user = auth()->user();

        $this->userSchedules = $this->user->schedules;
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
        $scheduleUnavailability->user()->associate(auth()->user()->id);
        $scheduleUnavailability->save();
        return redirect()->route('unavailabilities.index');
    }

    public function render()
    {
        return view('livewire.create-schedule-unavailability')
            ->layout('layouts.app');
    }
}
