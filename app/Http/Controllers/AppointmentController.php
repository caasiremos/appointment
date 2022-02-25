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
        $appointments = Appointment::userAppointment()
            ->with('user', 'service')
            ->orderBy('created_at', 'desc')
            ->paginate(7);
        return view('appointments.index', compact('appointments'));
    }
}
