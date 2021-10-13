<x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create System Users') }}
        </h2>
        <a type="button" href="{{route('users.index')}}"
           class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            All Users
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
                        @error('name') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email -->
                    <div class="mt-4">
                        <x-label for="email" :value="__('Email')"></x-label>
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                 :value="old('email')" required
                                 wire:model="email"></x-input>
                        @error('email') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <!-- Telephone -->
                    <div class="mt-4">
                        <x-label for="telephone" :value="__('Telephone')"></x-label>
                        <x-input maxlength="10" id="telephone" class="block mt-1 w-full" type="number" name="telephone"
                                 :value="old('telephone')" required
                                 wire:model="telephone"></x-input>
                        @error('email') <span class="error">{{ $message }}</span> @enderror

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
                        <x-label for="role" :value="__('Role')"></x-label>
                        <select name="role" id="role" class="block mt-1 w-full border-none rounded-lg
                            rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                wire:model="role">
                            @foreach($this->roles as $role)
                                <option>{{ucwords($role->display_name) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-label for="password" :value="__('Temporary Password')"></x-label>
                        <x-input maxlength="10" id="password" class="block mt-1 w-full" type="text" name="password"
                                 :value="old('password')" required
                                 wire:model="password"></x-input>
                        @error('password') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <!-- Telephone -->
                    <div class="mt-4">
                        <x-label for="confirm_password" :value="__('Confirm Password')"></x-label>
                        <x-input id="confirm_password" class="block mt-1 w-full" type="text" name="confirm_password"
                                 :value="old('confirm_password')" required
                                 wire:model="confirm_password"></x-input>
                        @error('confirm_password') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center justify-start mt-4">

                        <x-button class="ml-4 bg-indigo-600 hover:bg-indigo-700">
                            {{ __('Create User') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

