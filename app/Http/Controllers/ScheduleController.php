<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        if (auth()->user()->roles()->first()->name === 'admin') {
            $schedules = Schedule::with('user', 'unavailabilities')
                ->orderBy('created_at', 'desc')
                ->paginate(40);
        }else{
            $schedules = Schedule::userSchedule()
                ->with('user', 'unavailabilities')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }
        return view('schedules.index', compact('schedules'));
    }
}
