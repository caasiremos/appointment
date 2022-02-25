<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User Details') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ( Illuminate\Support\Facades\Session::has('success') )
                        <div
                            class="bg-green-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-5"
                            role="alert">
                            <div class="flex">
                                <div>
                                    <p class="font-bold">SUCCESS</p>
                                    <p class="text-sm">{{Illuminate\Support\Facades\Session::get('success')}}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                <!-- This example requires Tailwind CSS v2.0+ -->
                    <h6 class="font-bold text-l text-gray-800 leading-tight">
                        {{ __('Full Name') }}
                    </h6>
                    <h2 class="text-lg text-gray-400 leading-tight">
                        {{ $user->name }}
                    </h2>
                    <h6 class="font-bold text-l text-gray-800 leading-tight mt-5">
                        {{ __('Email') }}
                    </h6>
                    <h2 class="text-lg text-gray-400 leading-tight">
                        {{ $user->email }}
                    </h2>
                    <h6 class="font-bold text-l text-gray-800 leading-tight mt-5">
                        {{ __('Telephone') }}
                    </h6>
                    <h2 class="text-lg text-gray-400 leading-tight">
                        {{ $user->telephone }}
                    </h2>
                    <h6 class="font-bold text-l text-gray-800 leading-tight mt-5">
                        {{ __('Position') }}
                    </h6>
                    <h2 class="text-lg text-gray-400 leading-tight">
                        {{ $user->position }}
                    </h2>
                    <h6 class="font-bold text-l text-gray-800 leading-tight mt-5">
                        {{ __('Role') }}
                    </h6>
                    <h2 class="text-lg text-gray-400 leading-tight">
                        {{ $user->roles->first()->display_name }}
                    </h2>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- This example requires Tailwind CSS v2.0+ -->
                    <h6 class="font-bold text-l text-gray-800 leading-tight">
                        {{ __('Create New Password') }}
                    </h6>

                    <form action="{{route('employee.password.update') }}" method="POST">
                    @csrf
                    <!-- Password -->
                        <div class="mt-4">
                            <x-input maxlength="10" id="password" class="block mt-1 w-full" type="text" name="password"
                                     required></x-input>
                        </div>

                        <div class="flex items-center justify-start mt-4">

                            <x-button class="bg-blue-600 hover:bg-indigo-700">
                                {{ __('Create New Password') }}
                            </x-button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
