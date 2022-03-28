<?php

namespace App\Jobs;

use App\Models\Appointment;
use App\Events\SendSmsEvent;
use Illuminate\Bus\Queueable;
use App\Events\SendEmailEvent;
use Illuminate\Support\Facades\Redis;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Utils\Notification\NotificationHelper;

class ProcessSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $appointment;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
//    public $tries = 25;

    /**
     * The maximum number of unhandled exceptions to allow before failing.
     *
     * @var int
     */
//    public $maxExceptions = 3;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Allow only 2 emails every 1 second
//        Redis::throttle("sms_notification")->allow(2)->every(1)->then(function () {
//            event(new SendSmsEvent($this->appointment));
            NotificationHelper::sendSms($this->appointment);

//        }, function () {
//            $this->release(2);
//        });
    }
}
