<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Service;

/**
 * @property mixed selectedService
 */
class CreateBooking extends Component
{
    public $employees;

    public $state = [
        'service' => '',
        'employee' => '',
    ];

    public function mount()
    {
        $this->employees = collect();
    }

    public function updatedStateService($serviceId)
    {
        $this->state['employee'] = '';
        if (!$serviceId) {
            $this->employees = collect();
            return null;
        }

        $this->employees = $this->selectedService->employees;
    }

    public function getSelectedServiceProperty()
    {
        if (!$this->state['service']) {
            return null;
        }

        return Service::findOrFail($this->state['service']);
    }

    public function render()
    {
        $services = Service::get();
        return view('livewire.create-booking', compact('services'))
            ->layout('layouts.guest');
    }
}
