<?php

namespace App\Utils\Notification;

use Twilio\Rest\Client;
use App\Models\Appointment;
use App\Mail\EmployeeNotification;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentNotification;
use AfricasTalking\SDK\AfricasTalking;

class NotificationHelper
{
    public static function sendEmail(Appointment $appointment)
    {
        Mail::to($appointment->client_email)->send(new AppointmentNotification($appointment));
        Mail::to($appointment->user->email)->send(new EmployeeNotification($appointment));
    }

    public static function sendSms(Appointment $appointment)
    {
        $africa_is_talking = new AfricasTalking(config("services.sms.username"), config("services.sms.api_key"));
        $sms = $africa_is_talking->sms();
        $response = $sms->send([
            'to' =>   $appointment->client_telephone,
            'message' => 'Hello ' . ucwords($appointment->client_name) . ' Thanks for booking ' . $appointment->service->name . ' for ' .
                $appointment->service->duration . ' minutes with ' . $appointment->user->name . ' on ' .
                $appointment->date->format('D jS M Y') . ' at ' . $appointment->start_time->format('g:i A'),
        ]);

        return $response;
    }
}
