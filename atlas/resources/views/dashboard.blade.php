<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-mapbox theme="light-v10" class="rounded-lg shadow-lg h-96 mt-6" :markers="[[-4.84772405594904,37.9567116],[-3.49205561203722,37.9557275]]" />
            </div> --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg space-y-4 p-6">
                @livewire('search')
            </div>
            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div id="map"></div>
            </div> --}}
        </div>
    </div>
</x-app-layout>
