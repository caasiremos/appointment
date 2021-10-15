<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\Service;
use App\Models\Employee;
use App\Jobs\ProcessSms;
use App\Jobs\ProcessEmail;
use App\Models\Appointment;
use Spatie\GoogleCalendar\Event;

/**
 * @property mixed selectedService
 */
class CreateBooking extends Component
{
    public $users;

    public $state = [
        'service' => '',
        'user' => '',
        'time' => '',
        'email' => '',
        'name' => ''
    ];

    public function mount()
    {
        $this->users = collect();
    }

    protected $listeners = [
        'updated-booking-time' => 'setTime'
    ];

    protected function rules()
    {
        return [
            'state.service' => 'required|exists:services,id',
            'state.user' => 'required|exists:users,id',
            'state.time' => 'required|numeric',
            'state.name' => 'required|string',
            'state.email' => 'required|email',
            'state.client_telephone' => 'required|numeric',
        ];
    }


    public function setTime($time)
    {
        $this->state['time'] = $time;
    }

    public function clearTime()
    {
        $this->state['time'] = '';
    }

    public function updatedStateUser()
    {
        $this->clearTime();
    }

    public function updatedStateService($serviceId)
    {
        $this->state['user'] = '';
        if (!$serviceId) {
            $this->users = collect();
            return null;
        }

        $this->clearTime();

        $this->users = $this->selectedService->users;
    }

    public function createBooking()
    {
        $this->validate();

        $appointment = Appointment::make([
            'date' => $this->timeObject->toDateString(),
            'start_time' => $this->timeObject->toTimeString(),
            'end_time' => $this->timeObject->clone()->addMinutes(
                $this->selectedService->duration
            )->toTimeString(),
            'client_name' => $this->state['name'],
            'client_email' => $this->state['email'],
            'client_telephone' => $this->state['client_telephone'],
        ]);

        $appointment->service()->associate($this->selectedService);
        $appointment->user()->associate($this->selectedUser);

        $appointment->save();

        $appointment = Appointment::latest()->first();
        ProcessEmail::dispatch($appointment);
        ProcessSms::dispatch($appointment);

        return redirect()->to(route('bookings.show', $appointment) . '?token=' . $appointment->token);

//        $appointment = Appointment::latest()->first();
//        $event = new Event();
//        $event->name = 'Balon Advocate Client Appointment';
//        $event->startDateTime = Carbon::parse($appointment->start_time);
//        $event->endDateTime = Carbon::parse($appointment->end_time);
//        $event->decription = ucwords($appointment->client_name) . ' Booking for ' . $appointment->service->name . ' for ' .
//            $appointment->service->duration . ' minutes with ' . $appointment->employee->name . ' on ' .
//            $appointment->date->format('D jS M Y') . ' at ' . $appointment->start_time->format('g:i A');
//        $event->addAttendee([
//            'email' => $appointment->client_email,
//            'name' => $appointment->client_name,
//            'comment' => 'Client',
//        ]);
//        $event->addAttendee([
//            'email' => $appointment->employee->email,
//            'name' => $appointment->employee->name,
//            'comment' => 'Client',
//        ]);
//        $event->save();
    }

    public function getSelectedServiceProperty()
    {
        if (!$this->state['service']) {
            return null;
        }

        return Service::findOrFail($this->state['service']);
    }

    public function getHasDetailsToBookProperty()
    {
        return $this->state['service'] && $this->state['user'] && $this->state['time'];
    }

    public function getSelectedUserProperty()
    {
        if (!$this->state['user']) {
            return null;
        }

        return User::findOrFail($this->state['user']);
    }

    public function getTimeObjectProperty()
    {
        return Carbon::createFromTimestamp($this->state['time']);
    }


    public function render()
    {
        $services = Service::get();
        return view('livewire.create-booking', compact('services'))
            ->layout('layouts.guest');
    }
}
