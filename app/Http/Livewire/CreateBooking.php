<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Service;
use App\Models\Employee;
use App\Models\Appointment;

/**
 * @property mixed selectedService
 */
class CreateBooking extends Component
{
    public $employees;

    public $state = [
        'service' => '',
        'employee' => '',
        'time' => '',
        'email' => '',
        'name' => ''
    ];

    public function mount()
    {
        $this->employees = collect();
    }

    protected $listeners = [
        'updated-booking-time' => 'setTime'
    ];

    protected function rules()
    {
        return [
            'state.service' => 'required|exists:services,id',
            'state.employee' => 'required|exists:employees,id',
            'state.time' => 'required|numeric',
            'state.name' => 'required|string',
            'state.email' => 'required|email',
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

    public function updatedStateEmployee()
    {
        $this->clearTime();
    }

    public function updatedStateService($serviceId)
    {
        $this->state['employee'] = '';
        if (!$serviceId) {
            $this->employees = collect();
            return null;
        }

        $this->clearTime();

        $this->employees = $this->selectedService->employees;
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
        ]);

        $appointment->service()->associate($this->selectedService);
        $appointment->employee()->associate($this->selectedEmployee);

        $appointment->save();

        return redirect()->to(route('bookings.show', $appointment) . '?token=' . $appointment->token);
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
        return $this->state['service'] && $this->state['employee'] && $this->state['time'];
    }

    public function getSelectedEmployeeProperty()
    {
        if (!$this->state['employee']) {
            return null;
        }

        return Employee::findOrFail($this->state['employee']);
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
