<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\user;
use App\Models\Schedule;
use App\Models\ScheduleUnavailability;

class CreateScheduleUnavailability extends Component
{
    public $users;

    public $state = [
        'user' => '',
        'schedule' => '',
        'start_time' => '',
        'end_time' => ''
    ];

    public function mount(User $user)
    {
        $this->users = $user->get();

        $this->userSchedules = collect();
    }

    public function getuserSchedulesProperty()
    {
        if (!$this->state['user']) {
            return null;
        }

        return User::findOrFail($this->state['user'])->schedules;
    }

    public function getSelecteduserProperty()
    {
        return User::findOrFail($this->state['user']);
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
        $scheduleUnavailability->user()->associate($this->selecteduser);
        $scheduleUnavailability->save();
        return redirect()->route('unavailabilities.index');
    }

    public function render()
    {
        return view('livewire.create-schedule-unavailability')
            ->layout('layouts.app');
    }
}
