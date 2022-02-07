<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Services / Practice Areas') }}
            </h2>
            <a type="button" href="{{route('services.index')}}"
               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                All Services
            </a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('services.update', $service->id) }}">
                    @csrf
                    @method('PUT')
                    <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Name')"></x-label>
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                     value="{{$service->name}}" required autofocus></x-input>
                        </div>

                        <!-- Duration -->
                        <div class="mt-4">
                            <x-label for="duration" :value="__('Duration in Minutes')"></x-label>
                            <x-input id="duration" class="block mt-1 w-full" type="number" name="duration"
                                     value="{{$service->duration}}" required></x-input>
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <x-label for="description" :value="__('Description')"></x-label>
                            <textarea id="description"
                                      class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-5'"
                                      type="text" name="description" value="old('description')"
                                      required>{{$service->description}}</textarea>
                        </div>

                        <div class="flex items-center justify-start mt-4">

                            <x-button class="ml-4 bg-indigo-600 hover:bg-indigo-700">
                                {{ __('Update Service') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Validation Errors -->
</x-app-layout>
