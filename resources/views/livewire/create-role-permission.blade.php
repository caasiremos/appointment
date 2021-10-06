<x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Attach Roles To Permissions') }}
        </h2>
    </div>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form wire:submit.prevent="createRolePermission" method="POST">
                @csrf
                <!-- Resource -->
                    <div class="mt-4">
                        <x-label for="selected_role" :value="__('Select System Role')"
                                 class="font-black font-semibold"></x-label>
                        <select name="selected_role" id="selected_role" class="block mt-1 w-full border-none rounded-lg
                            rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                wire:model="selected_role">
                            <option value="">Select Role</option>
                            @foreach($roles as $role)
                                <option value="{{$role->name}}">{{ ucwords($role->display_name) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Crud Action -->
                    <div class="mt-10">
                        <x-label for="action" :value="__('Check Out Permissions To Role')"
                                 class="mt-3 mb-3 font-black font-semibold"></x-label>

                        <div class="block mt-2">
                            @foreach($permissions as $permission)
                                <div class="mt-2">
                                    <div>
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" value="{{$permission->id}}" class="form-checkbox"
                                                   wire:model="selected_permissions">
                                            <span
                                                class="ml-2 text-sm font-medium leading-5 text-gray-900">{{$permission->description}}</span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if (session()->has('message'))
                            <div class="ml-2 mt-5 text-sm font-medium font-semibold leading-5 text-red-600">
                                {{ session('message') }}
                            </div>
                        @endif
                    </div>

                    <div class="flex items-center justify-start mt-4">

                        <x-button type="submit" class="ml-4 bg-indigo-600 hover:bg-indigo-700">
                            {{ __('Attach Roles To Permissions') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
