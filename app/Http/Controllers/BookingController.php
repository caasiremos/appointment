<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Schedule;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\Utils\Bookings\TimeSlotGenerator;

class BookingController extends Controller
{
    public function __invoke()
    {
        $schedule = Schedule::findOrFail(1);
        $service = Service::findOrFail(2);

        $slots = (new TimeSlotGenerator($schedule, $service))->get();

        return view('bookings.create', compact('slots'));
    }
}
