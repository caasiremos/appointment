<?php

namespace App\Utils\Filters;

use Carbon\CarbonPeriod;
use App\Utils\Bookings\TimeSlotGenerator;
use Illuminate\Database\Eloquent\Collection;

class AppointmentFilter implements Filter
{
    public $appointments;

    public function __construct(Collection $appointments)
    {
        $this->appointments = $appointments;
    }

    public function apply(TimeSlotGenerator $timeSlotGenerator, CarbonPeriod $interval)
    {
        $interval->addFilter(function($slot) use ($timeSlotGenerator){
            foreach ($this->appointments as $appointment) {
                if (
                    $slot->between(
                        $appointment->date->setTimeFrom(
                            $appointment->start_time->subMinutes($timeSlotGenerator->service->duration)
                        ),
                        $appointment->date->setTimeFrom(
                            $appointment->end_time
                        )
                    )
                ) {
                    return false;
                }
            }
            return true;
        });
    }
}
