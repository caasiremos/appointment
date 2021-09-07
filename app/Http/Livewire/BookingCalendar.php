<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Carbon\CarbonPeriod;
use Carbon\CarbonInterval;

class BookingCalendar extends Component
{
    public $calendarStartDate;

    public $date;

    public $employee;

    public $service;

    public $time;

    public function mount()
    {
        $this->calendarStartDate = now();

        $this->setDate(now()->timestamp);
    }

    public function updatedTime($time)
    {
        $this->emitUp('updated-booking-time', $time);
    }
    
    public function setDate($timestamp)
    {
        return $this->date = $timestamp;
    }

    /**
     * Get time slot schedules of an employee of the selected calendar date
     * @return mixed
     */
    public function getEmployeeScheduleProperty()
    {
        return $this->employee->schedules()
            ->whereDate('date', $this->calendarSelectedDateObject)
            ->first();
    }

    /**
     * Available time slots of an employee
     */
    public function getAvailableTimeSlotsProperty()
    {
        if (!$this->employee || !$this->employeeSchedule) {
            return collect();
        }

        return $this->employee->availableTimeSlots($this->employeeSchedule, $this->service);
    }

    //Convert the date time to carbon Object
    public function getCalendarSelectedDateObjectProperty(): Carbon
    {
        return Carbon::createFromTimestamp($this->date);
    }

    /**
     * @return CarbonPeriod
     */
    public function getCalendarWeekIntervalProperty(): CarbonPeriod
    {
        return CarbonInterval::day(1)
            ->toPeriod(
                $this->calendarStartDate,
                $this->calendarStartDate->clone()->addWeek()
            );
    }

    public function incrementCalendarWeek()
    {
        $this->calendarStartDate->addWeek()->addDay();
    }

    public function decrementCalendarWeek()
    {
        $this->calendarStartDate->subWeek()->subDay();
    }

    public function getWeekIsGreaterThanCurrentProperty()
    {
        return $this->calendarStartDate->gt(now());
    }

    public function render()
    {
        return view('livewire.booking-calendar');
    }
}
