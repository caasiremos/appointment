<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScheduleUnavailability;

class UnavailabilityController extends Controller
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
        if (auth()->user()->roles->first()->name === 'admin') {
            $schedule_unvailabilities = ScheduleUnavailability::with('schedule', 'user')
                ->orderBy('created_at', 'desc')
                ->get();
        }else{
            $schedule_unvailabilities = ScheduleUnavailability::with('schedule', 'user')
                ->where('user_id', auth()->user()->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }
        return view('schedule-unavailabilities.index', compact('schedule_unvailabilities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        //
    }
}
