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
     * @return int
     */
    public function handle()
    {
        $date_time = Carbon::now();

        $appointments = Appointment::where('date', $date_time->format('Y-m-d'))->get();

        $appointments->each(function ($appointment) {
            $reminder_time_interval = $appointment->start_time->subMinutes(120);
            if (!Carbon::now()->lessThanOrEqualTo($appointment->start_time)) {
                $this->info("Past appointment time");
                return 0;
            }
            if (Carbon::now()->addMinutes(30)->equalTo($reminder_time_interval->addMinutes(30))) {
                //send notification reminder 60 minutes before appointment start time
                ProcessEmail::dispatch($appointment);
                ProcessSms::dispatch($appointment);
            }
            if (Carbon::now()->addMinutes(60)->equalTo($reminder_time_interval->addMinutes(60))) {
                // send notification reminder 30 minutes before appointment start time
                ProcessEmail::dispatch($appointment);
                ProcessSms::dispatch($appointment);
            }
        });
    }
}
