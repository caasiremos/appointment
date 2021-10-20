<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Appointment;
use Illuminate\Console\Command;

class NotificationReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointment:send-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email and sms notification to clients and employee 1hour and 30minutes prior to the appointment time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date_time = Carbon::now();

        $appointments = Appointment::where('date', $date_time->format('Y-m-d'))
            ->latest()->first();
        dd($date_time->addMinute(10)->format('H:i:s'));

//        dd($date_time->addMinutes(1)->equalTo($appointments->start_time));
//        $appointments->each(function($appointment){
////            if ($appointment->start_time)
//        });
    }
}
