<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Schedule;
use App\Utils\Bookings\TimeSlotGenerator;
use App\Utils\Filters\SlotsPastTodayFilter;
use App\Utils\Filters\UnavailablilityFilter;

class BookingController extends Controller
{
    public function __invoke()
    {
        $schedule = Schedule::findOrFail(1);
        $service = Service::findOrFail(3);

        $slots = (new TimeSlotGenerator($schedule, $service))
            ->applyFilters([
                new SlotsPastTodayFilter(),
                new UnavailablilityFilter($schedule->unavailabilities),
            ])
            ->get();

        return view('bookings.create', compact('slots'));
    }
}
