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
                <form wire:submit.prevent="createSchedule" method="POST">
                @csrf
{{--                <!-- employee -->--}}
{{--                    <div class="mt-4">--}}
{{--                        <x-label for="employee" :value="__('Select an employee')"></x-label>--}}
{{--                        <select name="user" id="position" class="block mt-1 w-full border-none rounded-lg--}}
{{--                            rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"--}}
{{--                            wire:model="state.user" {{ !$users->count() ? 'disabled="disabled"' : '' }}>--}}
{{--                            <option value="" disabled>Select employee</option>--}}
{{--                            @foreach($users as $user)--}}
{{--                                <option value="{{$user->id }}">{{$user->name }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        @error('state.user') <span class="error">{{ $message }}</span> @enderror--}}
{{--                    </div>--}}
                <!-- Schedule Date -->
                    <div>
                        <x-label for="date" :value="__('Schedule Date')" class="mt-3"></x-label>
                        <x-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date')"
                                 required autofocus
                        wire:model="state.date"></x-input>
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
                        <x-label for="start_time" :value="__('Stop Time')"></x-label>
                        <x-input id="start_time" class="block mt-1 w-full" type="time" name="start_time"
                                 :value="old('state.start_time')" required
                            wire:model="state.end_time"></x-input>
                    </div>

                    <div class="flex items-center justify-start mt-4">

                        <x-button type="submit"  class="ml-4 bg-indigo-600 hover:bg-indigo-700">
                            {{ __('Create Schedule') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
