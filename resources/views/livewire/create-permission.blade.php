<x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Permissions') }}
        </h2>
    </div>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form wire:submit.prevent="createPermission" method="POST">
                @csrf
                <!-- Resource -->
                    <div class="mt-4">
                        <x-label for="system_resource" :value="__('Select System Resource')"></x-label>
                        <select name="system_resource" id="system_resource" class="block mt-1 w-full border-none rounded-lg
                            rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                wire:model="system_resource">
                            @foreach($system_resources as $system_resource)
                                <option>{{ $system_resource }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Crud Action -->
                    <div class="mt-10">
                        <x-label for="action" :value="__('Select Action')" class="mt-3"></x-label>

                        <div class="block">
                            <div class="mt-2">
                                <div>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" value="view" class="form-checkbox" wire:model="action_view">
                                        <span class="ml-2">View</span>
                                    </label>
                                </div>
                                <div class="mt-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" value="create" class="form-checkbox" wire:model="action_create">
                                        <span class="ml-2">Create</span>
                                    </label>
                                </div>
                                <div class="mt-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox"  value="update" class="form-checkbox" wire:model="action_update">
                                        <span class="ml-2">Update</span>
                                    </label>
                                </div>
                                <div class="mt-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" value="delete" class="form-checkbox" wire:model="action_delete" checked>
                                        <span class="ml-2">Delete</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-start mt-4">

                        <x-button type="submit" class="ml-4 bg-indigo-600 hover:bg-indigo-700">
                            {{ __('Create Permission') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
