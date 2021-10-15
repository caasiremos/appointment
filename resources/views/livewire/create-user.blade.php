<x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Employee') }}
        </h2>
        <a type="button" href="{{route('users.index')}}"
           class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            All Employees
        </a>
    </div>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form wire:submit.prevent="createUser" method="POST">
                @csrf
                <!-- Name -->
                    <div>
                        <x-label for="name" :value="__('Name')"></x-label>
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                                 required autofocus
                                 wire:model="name"></x-input>
                        @error('name') <span
                            class="ml-2 mt-5 text-sm font-medium font-semibold leading-5 text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email -->
                    <div class="mt-4">
                        <x-label for="email" :value="__('Email')"></x-label>
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                 :value="old('email')" required
                                 wire:model="email"></x-input>
                        @error('email') <span
                            class="ml-2 mt-5 text-sm font-medium font-semibold leading-5 text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Telephone -->
                    <div class="mt-4">
                        <x-label for="telephone" :value="__('Telephone')"></x-label>
                        <x-input maxlength="10" id="telephone" class="block mt-1 w-full" type="number" name="telephone"
                                 :value="old('telephone')" required
                                 wire:model="telephone"></x-input>
                        @error('telephone') <span
                            class="ml-2 mt-5 text-sm font-medium font-semibold leading-5 text-red-600">{{ $message }}</span> @enderror

                    </div>

                    <div class="mt-4">
                        <x-label for="position" :value="__('Position')"></x-label>
                        <select name="position" id="position" class="block mt-1 w-full border-none rounded-lg
                            rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                wire:model="position">
                            <option>Managing Partner</option>
                            <option>Associate</option>
                            <option>Legal Assistant</option>
                            <option>Law clerk</option>
                            <option>Chief strategist</option>
                            <option>General Employee</option>
                        </select>
                    </div>

                    <div class="mt-4">
                        <x-label for="service" :value="__('Service')"></x-label>
                        <select name="service" id="service" class="block mt-1 w-full border-none rounded-lg
                            rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                wire:model="service">
                            <option value="">Select Service</option>
                            @foreach($this->services as $service)
                                <option value="{{$service->id}}">{{ucwords($service->name) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4">
                        <x-label for="role" :value="__('Role')"></x-label>
                        <select name="role" id="role" class="block mt-1 w-full border-none rounded-lg
                            rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                wire:model="role">
                            <option value="">Select Role</option>
                            @foreach($this->roles as $role)
                                <option value="{{$role->id}}">{{ucwords($role->display_name) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-label for="password" :value="__('Temporary Password')"></x-label>
                        <x-input maxlength="10" id="password" class="block mt-1 w-full" type="text" name="password"
                                 :value="old('password')" required
                                 wire:model="password"></x-input>
                        @error('password') <span
                            class="ml-2 mt-5 text-sm font-medium font-semibold leading-5 text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center justify-start mt-4">

                        <x-button class="ml-4 bg-indigo-600 hover:bg-indigo-700">
                            {{ __('Create Employee') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

