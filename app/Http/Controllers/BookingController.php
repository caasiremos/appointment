<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\Utils\Bookings\TimeSlotGenerator;

class BookingController extends Controller
{
    public function __invoke()
    {
        $schedule = Schedule::findOrFail(1);

        $slots = (new TimeSlotGenerator($schedule))->get();

        return view('bookings.create', compact('slots'));
    }
}
