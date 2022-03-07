<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Schedule;
use App\Models\ScheduleUnavailability;

class EditScheduleUnavailability extends Component
{
    public $start_time;
    public $end_time;
    public $schedule_id;

    public $state = [
        'start_time' => '',
        'end_time' => ''
    ];

    public function mount($id)
    {
        $this->schedule_id = $id;
        $unavailability = ScheduleUnavailability::where('id', $this->schedule_id)->first();
        $this->state['start_time'] = $unavailability->getAttributes()['start_time'];
        $this->state['end_time'] = $unavailability->getAttributes()['end_time'];
    }

    public function updateScheduleUnavailability()
    {
        $unavailability = ScheduleUnavailability::where('id', $this->schedule_id)->first();

        $unavailability->update([
            'start_time' => $this->state['start_time'],
            'end_time' => $this->state['end_time']
        ]);

        return redirect()->route('unavailabilities.index');
    }

    public function render()
    {
        return view('livewire.edit-schedule-unavailability');
    }
}
