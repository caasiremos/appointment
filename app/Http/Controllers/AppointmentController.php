<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        if (auth()->user()->roles()->first()->name === 'admin') {
            $appointments = Appointment::with('user', 'service')
                ->orderBy('created_at', 'desc')
                ->paginate(50);
        }else{
            $appointments = Appointment::userAppointment()
                ->with('user', 'service')
                ->orderBy('created_at', 'desc')
                ->paginate(50);
        }
        return view('appointments.index', compact('appointments'));
    }
}
