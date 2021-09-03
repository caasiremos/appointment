<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Schedule;
use App\Utils\Bookings\TimeSlotGenerator;
use App\Utils\Filters\SlotsPastTodayFilter;

class BookingController extends Controller
{
    public function __invoke()
    {
        $schedule = Schedule::findOrFail(4);
        $service = Service::findOrFail(2);

        $slots = (new TimeSlotGenerator($schedule, $service))
            ->applyFilters([new SlotsPastTodayFilter()])
            ->get();

        return view('bookings.create', compact('slots'));
    }
}
