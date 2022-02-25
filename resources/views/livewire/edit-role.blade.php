<x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit System Roles') }}
        </h2>
        <a type="button" href="{{route('users.index')}}"
           class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            View Employees
        </a>
    </div>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form wire:submit.prevent="updateRole" method="POST">
                @csrf
                    @method('PUT')
                <!-- Name -->
                    <div>
                        <x-label for="name" :value="__('Name')"></x-label>
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                                 required autofocus
                                 wire:model="name"></x-input>
                        @error('name') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <!-- Display Name -->
                    <div class="mt-5">
                        <x-label for="display" :value="__('Display Name')"></x-label>
                        <x-input id="display_name" class="block mt-1 w-full" type="text" name="display_name" :value="old('display_name')"
                                 required autofocus
                                 wire:model="display_name"></x-input>
                        @error('display_name') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <!-- Display Name -->
                    <div class="mt-5">
                        <x-label for="description" :value="__('Description')"></x-label>
                        <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')"
                                 required autofocus
                                 wire:model="description"></x-input>
                        @error('description') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center justify-start mt-4">

                        <x-button class="ml-4 bg-indigo-600 hover:bg-indigo-700">
                            {{ __('Update Role') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

