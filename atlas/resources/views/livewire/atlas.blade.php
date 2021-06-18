<x-guest-layout>
{{-- Nothing in the world is as soft and yielding as water. --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Atlas de Conocimiento Crítico') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg space-y-4 p-6">
                @livewire('search')
            </div>
            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div id="map"></div>
            </div> --}}
        </div>
    </div>
</x-guest-layout>
