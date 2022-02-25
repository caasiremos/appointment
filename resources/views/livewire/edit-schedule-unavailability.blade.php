<x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Schedule some time off') }}
        </h2>
    </div>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form wire:submit.prevent="updateScheduleUnavailability" method="POST">
                @csrf
                @method('PUT')
                <!-- Schedule Date -->
                    <div class="mt-6">
                        <x-label for="date" :value="__('Schedule Date')" class="mt-3"></x-label>
                        <select name="schedule" id="position" class="block mt-1 w-full border-none rounded-lg
                            rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                wire:model="state.optionSelected" required>
                            @foreach($this->userSchedules as $schedule)
                                @if(!\Carbon\Carbon::now()->subDay()->gt($schedule->date))
                                    <option value="{{$schedule->id }}"
                                    >{{$schedule->date->format('D  jS M Y') }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <!-- Start Time -->
                    <div class="mt-4">
                        <x-label for="start_time" :value="__('Start Time')"></x-label>
                        <x-input id="start_time" class="block mt-1 w-full" type="time" name="start_time"
                                 :value="old('start_time')" required
                                 wire:model="state.start_time"></x-input>
                    </div>

                    <!-- End Time -->
                    <div class="mt-4">
                        <x-label for="start_time" :value="__('Start Time')"></x-label>
                        <x-input id="start_time" class="block mt-1 w-full" type="time" name="start_time"
                                 :value="old('state.start_time')" required
                                 wire:model="state.end_time"></x-input>
                    </div>

                    <div class="flex items-center justify-start mt-4">

                        <x-button type="submit" class="ml-4 bg-indigo-600 hover:bg-indigo-700">
                            {{ __('Update Off Schedule') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
