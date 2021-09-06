<?php

namespace App\Utils\Filters;

use Carbon\CarbonPeriod;
use App\Utils\Bookings\TimeSlotGenerator;
use Illuminate\Database\Eloquent\Collection;

class UnavailablilityFilter implements Filter
{
    public $unvailabilities;

    public function __construct(Collection $unvailabilities)
    {
        $this->unvailabilities = $unvailabilities;
    }

    public function apply(TimeSlotGenerator $timeSlotGenerator, CarbonPeriod $interval)
    {
        $interval->addFilter(function ($slot) use ($timeSlotGenerator) {
            foreach ($this->unvailabilities as $unavailability) {
                if (
                    $slot->between(
                        $unavailability->schedule->date->setTimeFrom(
                            $unavailability->start_time->subMinutes(
                                $timeSlotGenerator->service->duration - $timeSlotGenerator::INCREMENT
                            )
                        ),
                        $unavailability->schedule->date->setTimeFrom(
                            $unavailability->end_time->subMinutes($timeSlotGenerator::INCREMENT)
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
