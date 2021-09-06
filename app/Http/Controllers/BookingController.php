<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Schedule;
use App\Models\Employee;

class BookingController extends Controller
{
    public function __invoke()
    {
        $schedule = Schedule::findOrFail(1);

        $service = Service::findOrFail(3);

        $employee = Employee::find(1); 

        $slots = $employee->availableTimeSlots($schedule, $service);

        return view('bookings.create', compact('slots'));
    }
}
