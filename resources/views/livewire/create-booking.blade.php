
<div class="bg-green-100 w-full min-h-screen relative pt-10 bg-cover" style="background-image: url('https://www.balonadvocates.com/sites/default/files/sliders/balon-advocates-practice-areas.jpg')">
    <div class="absolute bg-black opacity-50 top-0 w-full h-screen"></div>
    <div class="bg-[#141b43] max-w-sm mx-auto pt-4 p-5 rounded-lg relative">
    <h1 class="text-lg font-extrabold mx-auto p-4 caret-white text-white">BOOK AN APPOINTMENT</h1>
    <form wire:submit.prevent="createBooking">
        <div class="mb-6">
            <label class="inline-block text-white font-bold mb-2">Please select a service</label>
            <select name="service" id="service" class="bg-white h-10 w-full border-none rounded-lg"
                    wire:model="state.service">
                <option value="">Select service</option>
                @foreach($services as $service)
                    <option value="{{$service->id}}">{{$service->name}} ({{$service->duration}} minutes)</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6 {{ !$users->count() ? 'opacity-25' : '' }}">
            <label class="inline-block text-white font-bold mb-2">Please select an Employee</label>
            <select name="user" id="user" class="bg-white h-10 w-full border-none rounded-lg"
                    wire:model="state.user" {{ !$users->count() ? 'disabled="disabled"' : '' }}>
                <option value="">Select Employee</option>
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6 {{ !$this->selectedService || !$this->selectedUser ? 'opacity-25' : '' }}">
            <label class="inline-block text-white font-bold mb-2">Select Appointment Time</label>
            <livewire:booking-calendar :service="$this->selectedService" :employee="$this->selectedUser"
                                       :key="optional($this->selectedUser)->id"/>
        </div>
        @if($this->hasDetailsToBook)
            <div class="mb-6">
                <div class="text-white font-bold mb-2">
                    You're ready to book
                </div>

                <div class="border-t border-b border-gray-300 text-white py-2">
                    {{ $this->selectedService->name }} ({{ $this->selectedService->duration }} minutes)
                    with {{ $this->selectedUser->name }}
                    on {{ $this->timeObject->format('D jS M Y') }} at {{ $this->timeObject->format('g:i A') }}
                </div>
            </div>
            <div class="mb-6">
                <div class="mb-3">
                    <label for="name" class="inline-block text-white font-bold mb-2">Your name</label>
                    <input type="text" name="name" id="name" class="bg-white h-10 w-full border-none rounded-lg"
                           wire:model.defer="state.name">

                    @error('state.name')
                    <div class="font-semibold text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="inline-block text-white font-bold mb-2">Your email</label>
                    <input type="text" name="email" id="email" class="bg-white h-10 w-full border-none rounded-lg"
                           wire:model.defer="state.email">

                    @error('state.email')
                    <div class="font-semibold text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="client_telephone" class="inline-block text-white font-bold mb-2">Client Telephone</label>
                    <input type="text" name="telephone" id="client_telephone" placeholder="+2567839****" class="bg-white h-10 w-full border-none rounded-lg"
                           wire:model.defer="state.client_telephone">

                    @error('state.client_telephone')
                    <div class="font-semibold text-red-500 text-sm mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                    @if (session()->has('message'))
                        <div class="ml-2 mt-5 text-sm font-medium font-semibold leading-5 text-red-600">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
            </div>

            <button class="bg-indigo-500 text-white h-11 px-4 text-center font-bold rounded-lg w-full">
                Book now
            </button>
        @endif

    </form>
{{--    <form wire:submit.prevent="createBooking">--}}
{{--        <button type="submit" class="bg-indigo-500 text-white h-11 px-4 text-center font-bold rounded-lg w-full">--}}
{{--            Book now--}}
{{--        </button>--}}
{{--    </form>--}}
</div>
</div>
