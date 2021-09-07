<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\CarbonInterval;

class BookingCalender extends Component
{
    public $calenderStartDate;

    public function mount()
    {
        $this->calenderStartDate = now();
    }

    public function getCalenderWeekIntervalProperty()
    {
        return CarbonInterval::day(1)
            ->toPeriod(
                $this->calenderStartDate,
                $this->calenderStartDate->clone()->addWeek()
            );
    }

    public function incrementCalenderWeek()
    {
        $this->calenderStartDate->addWeek()->addDay();
    }

    public function decrementCalenderWeek()
    {
        $this->calenderStartDate->subWeek()->subDay();
    }

    public function getWeekIsGreaterThanCurrentProperty()
    {
        return $this->calenderStartDate->gt(now());
    }

    public function render()
    {
        return view('livewire.booking-calender');
    }
}
