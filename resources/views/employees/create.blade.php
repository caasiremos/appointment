<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Employees') }}
            </h2>
            <a type="button" href="{{route('employees.index')}}"
               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                All Employees
            </a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('employees.store') }}">
                    @csrf
                    <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Name')"></x-label>
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                                     required autofocus></x-input>
                        </div>

                        <!-- Telephone -->
                        <div class="mt-4">
                            <x-label for="telephone" :value="__('Telephone')"></x-label>
                            <x-input  maxlength="10" id="telephone" class="block mt-1 w-full" type="number" name="telephone"
                                     :value="old('telephone')" required></x-input>
                        </div>

                        <!-- Email -->
                        <div class="mt-4">
                            <x-label for="email" :value="__('Email')"></x-label>
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                     :value="old('email')" required></x-input>
                        </div>

                        <!-- Email -->
                        <div class="mt-4">
                            <x-label for="position" :value="__('Position')"></x-label>
                            <select name="position" id="position" class="block mt-1 w-full border-none rounded-lg
                            rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option>Managing Partner</option>
                                <option>Associate</option>
                                <option>Legal Assistant</option>
                                <option>Law clerk</option>
                                <option>Chief strategist</option>
                                <option>General Employee</option>
                            </select>
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
    <!-- Validation Errors -->
</x-app-layout>
