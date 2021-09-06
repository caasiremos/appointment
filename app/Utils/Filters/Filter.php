<?php
namespace App\Utils\Filters;

use Carbon\CarbonPeriod;
use App\Utils\Bookings\TimeSlotGenerator;

interface Filter
{
    public function apply(TimeSlotGenerator $timeSlotGenerator, CarbonPeriod $interval);
}
