<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <form action="#" method="GET" wire:submit.prevent="inline-search">
        @csrf

        <div class="block space-x-4 space-y-4">
            {{-- <x-jet-label for="search" value="{{ __('Buscar') }}" /> --}}
            <input class='cthulhu border-gray-300 focus:border-pink-300 focus:ring focus:ring-pink-300 focus:ring-opacity-50 rounded-md shadow-sm w-1/2' name="query" id="query" wire:model="query" type="search" placeholder="Buscar..." value="{{$query}}"/>
        </div>
    </form>
</div>
