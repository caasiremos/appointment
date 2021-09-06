<div class="bg-gray-200 max-w-sm mx-auto m-6 p-5 rounded-lg">
    BOOK AN APPOINTMENT
    <form>
        <div class="mb-2">
            <label class="inline-block text-gray-700 font-bold mb-2">Please select a service</label>
            <select name="service" id="service" class="bg-white h-10 w-full border-none rounded-lg"
                    wire:model="state.service">
                <option value="">Select service</option>
                @foreach($services as $service)
                    <option value="{{$service->id}}">{{$service->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2" {{ !$employees->count() ? 'opacity-25' : '' }}>
            <label class="inline-block text-gray-700 font-bold mb-2">Please select an Employee</label>
            <select name="employee" id="employee" class="bg-white h-10 w-full border-none rounded-lg"
                    wire:model="state.employee" {{ !$employees->count() ? 'disabled="disabled"' : '' }}>
                <option value="">Select Employee</option>
                @foreach($employees as $employee)
                    <option value="{{$employee->id}}">{{$employee->name}}</option>
                @endforeach
            </select>
        </div>
    </form>
</div>
