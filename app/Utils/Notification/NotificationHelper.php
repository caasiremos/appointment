<?php

namespace App\Utils\Notification;

use Twilio\Rest\Client;
use App\Models\Appointment;
use App\Mail\EmployeeNotification;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentNotification;

class NotificationHelper
{
    public static function sendEmail(Appointment $appointment)
    {
        Mail::to($appointment->client_email)->send(new AppointmentNotification($appointment));
        Mail::to($appointment->user->email)->send(new EmployeeNotification($appointment));
    }

    public static function sendSms(Appointment $appointment)
    {
        // Your Account SID and Auth Token from twilio.com/console
//        $account_sid = env('TWILIO_SID');
//        $auth_token = env('TWILIO_TOKEN');

        // Your Account SID and Auth Token from twilio.com/console
        $sid = 'AC95e2a81d00bc16fe154a41bbba65e711';
//        $token = 'fac584b52b5f32e63fe1c284dad164b1';
        $token = 'ffd24c357e11204eb3243d4337807717';
        $messaging_service_ID = 'MG29fede618f8b0ed68df390ea64449e5d';

        $client = new Client($sid, $token);

        // Use the client to do fun stuff like send text messages!
        $client->messages->create(
        // the number you'd like to send the message to
            $appointment->client_telephone,
            [
                // A Twilio phone number you purchased at twilio.com/console
                'MessagingServiceSid' => $messaging_service_ID,
                // the body of the text message you'd like to send
                'body' => 'Hello ' . ucwords($appointment->client_name) . ' Thanks for booking ' . $appointment->service->name . ' for ' .
                    $appointment->service->duration . ' minutes with ' . $appointment->user->name . ' on ' .
                    $appointment->date->format('D jS M Y') . ' at ' . $appointment->start_time->format('g:i A'),
            ]
        );
        return $client;
    }
}
