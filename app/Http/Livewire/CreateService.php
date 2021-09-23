<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateService extends Component
{
    public $header;
    public function render()
    {
        return view('livewire.create-service')
            ->layout('layouts.app');
    }
}
