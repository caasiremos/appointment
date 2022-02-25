<x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$role->display_name }}
        </h2>
    </div>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form wire:submit.prevent="createRolePermission" method="POST">
                @csrf
                    <!-- Crud Action -->
                    <div>
                        <div class="block mt-2">
                            @foreach($system_permissions as $permission)
                                <div class="mt-2">
                                    <div>
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" value="{{$permission->name}}" id="{{$permission->name}}" class="form-checkbox"
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
