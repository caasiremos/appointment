<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Jobs\ProcessSms;
use App\Jobs\ProcessEmail;
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
     */
    public function handle()
    {
        $date_time = Carbon::now();

        $appointments = Appointment::where('date', $date_time->format('Y-m-d'))->get();
        $appointments->each(function ($appointment) {
            $first_reminder = $appointment->start_time->subMinutes(60);
            $second_reminder = $appointment->start_time->subMinutes(30);
            if (Carbon::now()->greaterThanOrEqualTo($first_reminder) && $appointment->notification_count === 0) {
                //send notification reminder 60 minutes before appointment start time
                ProcessEmail::dispatch($appointment);
                ProcessSms::dispatch($appointment);
                $appointment = Appointment::findOrFail($appointment->id);
                $appointment->notification_count = 1;
                $appointment->save();
            }
            if (Carbon::now()->greaterThanOrEqualTo($second_reminder) && $appointment->notification_count == 1) {
                ProcessEmail::dispatch($appointment);
                ProcessSms::dispatch($appointment);
                $appointment = Appointment::findOrFail($appointment->id);
                $appointment->notification_count = 2;
                $appointment->save();
            }
        });
    }
}
