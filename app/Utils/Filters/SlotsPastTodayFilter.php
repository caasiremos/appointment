<?php

namespace App\Utils\Filters;

use Carbon\CarbonPeriod;
use App\Utils\Bookings\TimeSlotGenerator;

class SlotsPastTodayFilter implements Filter
{

    public function apply(TimeSlotGenerator $generator, CarbonPeriod $interval)
    {
        $interval->addFilter(function ($slot) use ($generator) {
            //check if the schedule we are working with is for today
            if ($generator->schedule->date->isToday()) {
                //check if current slot is less than current time(now())
                if ($slot->lt(now())) {
                    return false;
                }
            }
            return true;
        });
    }
}
