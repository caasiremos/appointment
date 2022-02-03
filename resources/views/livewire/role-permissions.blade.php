<x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissions Roles') }}
        </h2>
        <a type="button" href="{{route('manage.rolesPermissions.create')}}"
           class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Attach Permissions To Roles
        </a>
    </div>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <form method="POST">
                                    <ul class="list-none md:list-disc grid grid-cols-4">
                                        @foreach($roles as $role)
                                            <div>
                                                <li class="font-semibold text-gray-800 leading-tight mt-5 pl-5 pb-5 flex flex-wrap">{{ucwords($role->display_name)}}</li>
                                                @foreach($role->permissions as $permission)
                                                    <div class="ml-5 mb-2">
                                                        <label class="inline-flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-700" viewBox="0 0 20 20"
                                                                 fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                      clip-rule="evenodd"/>
                                                            </svg>
                                                            <span
                                                                class="ml-2 text-sm font-medium leading-5 text-gray-900">{{$permission->description}}</span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
