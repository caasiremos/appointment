<div class="bg-gray-200 max-w-sm mx-auto m-6 p-5 rounded-lg">
    <h1 class="text-lg font-extrabold mx-auto p-4 caret-indigo-700">BOOK AN APPOINTMENT</h1>
    <form>
        <div class="mb-6">
            <label class="inline-block text-gray-700 font-bold mb-2">Please select a service</label>
            <select name="service" id="service" class="bg-white h-10 w-full border-none rounded-lg"
                    wire:model="state.service">
                <option value="">Select service</option>
                @foreach($services as $service)
                    <option value="{{$service->id}}">{{$service->name}} ({{$service->duration}} minutes)</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6 {{ !$employees->count() ? 'opacity-25' : '' }}">
            <label class="inline-block text-gray-700 font-bold mb-2">Please select an Employee</label>
            <select name="employee" id="employee" class="bg-white h-10 w-full border-none rounded-lg"
                    wire:model="state.employee" {{ !$employees->count() ? 'disabled="disabled"' : '' }}>
                <option value="">Select Employee</option>
                @foreach($employees as $employee)
                    <option value="{{$employee->id}}">{{$employee->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6 {{ !$this->selectedService || !$this->selectedEmployee ? 'opacity-25' : '' }}">
            <label class="inline-block text-gray-700 font-bold mb-2">Select Appointment Time</label>
            <livewire:booking-calendar :service="$this->selectedService" :employee="$this->selectedEmployee"
                                       :key="optional($this->selectedEmployee)->id"/>
        </div>
        @if($this->hasDetailsToBook)
            confirmation message
        @endif

    </form>
</div>
