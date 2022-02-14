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
        $appointments = Appointment::with('user', 'service')
            ->orderBy('created_at', 'desc')
            ->where('user_id', auth()->user()->id)
            ->paginate(10);

        return view('dashboard', compact('appointments'));
    }
}
