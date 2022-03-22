<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function dashboard()
    {
        if (auth()->user()->roles()->first()->name === 'admin') {
            $appointments = Appointment::with('user', 'service')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $appointments = Appointment::userAppointment()
                ->with('user', 'service')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        return view('dashboard', compact('appointments'));
    }
}
