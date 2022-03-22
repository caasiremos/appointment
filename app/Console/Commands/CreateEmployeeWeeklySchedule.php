<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use Carbon\CarbonPeriod;
use Illuminate\Console\Command;

class CreateEmployeeWeeklySchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employees:create-schedules';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates employees weekly schedules';

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
        $currentDateTime = Carbon::now();
        $start_date = $currentDateTime->startOfWeek()->toDateString();
        $end_date = $currentDateTime->endOfWeek()->subDays(2)->toDateString();
        $working_days = CarbonPeriod::create($start_date, $end_date);
        collect($working_days->toArray())->each(function ($day) {
            foreach (User::all() as $employee) {
                $employee->schedules()->create([
                    'date' => $day->toDateString(),
                    'start_time' => '08:00',
                    'end_time' => '17:00',
                    'user_id' => $employee->id
                ]);
            }
        });
        return true;
    }
}
