<x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Your Daily Schedule') }}
        </h2>
    </div>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form wire:submit.prevent="updateSchedule()" method="POST">
                    @csrf
                    @method('PUT')
                    <div>
                        <x-label for="date" :value="__('Schedule Date')" class="mt-3"></x-label>
                        <x-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date')"
                                 required autofocus
                                 wire:model="date"></x-input>
                    </div>

                    <!-- Start Time -->
                    <div class="mt-4">
                        <x-label for="start_time" :value="__('Start Time')"></x-label>
                        <x-input id="start_time" class="block mt-1 w-full" type="time" name="start_time"
                                 :value="old('start_time')" required
                                 wire:model="start_time"></x-input>
                    </div>

                    <!-- End Time -->
                    <div class="mt-4">
                        <x-label for="start_time" :value="__('Stop Time')"></x-label>
                        <x-input id="start_time" class="block mt-1 w-full" type="time" name="start_time"
                                 :value="old('state.start_time')" required
                                 wire:model="end_time"></x-input>
                    </div>

                    <div class="flex items-center justify-start mt-4">

                        <x-button type="submit" class="ml-4 bg-indigo-600 hover:bg-indigo-700">
                            {{ __('Update Schedule') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
