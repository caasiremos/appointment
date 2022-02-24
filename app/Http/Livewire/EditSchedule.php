<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Schedule;
use Illuminate\Http\RedirectResponse;

class EditSchedule extends Component
{
    public $schedule_id;
    public $date;
    public $start_time;
    public $end_time;

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

    public function mount($id)
    {
        $this->schedule_id = $id;
        $schedule = Schedule::findOrFail($id)->first();
        $this->date = $schedule->getAttributes()['date'];
        $this->start_time = $schedule->getAttributes()['start_time'];
        $this->end_time = $schedule->getAttributes()['end_time'];
    }

    public function updateSchedule()
    {
        $schedule = Schedule::findOrFail($this->schedule_id)->first();

        $schedule->update([
            'date' => $this->date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
        ]);

        return redirect()->to(route('schedules.index'));
    }

    public function render()
    {
        return view('livewire.edit-schedule');
    }
}
