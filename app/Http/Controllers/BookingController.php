<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Schedule;
use App\Models\Appointment;
use App\Utils\Filters\AppointmentFilter;
use App\Utils\Bookings\TimeSlotGenerator;
use App\Utils\Filters\SlotsPastTodayFilter;
use App\Utils\Filters\UnavailablilityFilter;

class BookingController extends Controller
{
    public function __invoke()
    {
        $schedule = Schedule::findOrFail(1);

        $service = Service::findOrFail(3);

        $appointments = Appointment::whereDate('date', '2021-09-06')->get();

        $slots = (new TimeSlotGenerator($schedule, $service))
            ->applyFilters([
                new SlotsPastTodayFilter(),
                new UnavailablilityFilter($schedule->unavailabilities),
                new AppointmentFilter($appointments)
            ])
            ->get();

        return view('bookings.create', compact('slots'));
    }
}
