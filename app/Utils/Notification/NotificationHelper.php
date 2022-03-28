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
        $sid = env('TWILIO_SSID');
        $token = env('TWILIO_TOKEN');
        $messaging_service_ID = env('TWILIO_MESSAGING_SSID');

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
