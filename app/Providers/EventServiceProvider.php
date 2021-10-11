<?php

namespace App\Providers;

use App\Events\SendSmsEvent;
use App\Events\SendEmailEvent;
use App\Listeners\SendSmsListener;
use App\Listeners\SendEmailListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        SendEmailEvent::class => [
            SendEmailListener::class,
        ],

        SendSmsEvent::class => [
            SendSmsListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
