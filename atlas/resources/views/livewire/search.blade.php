<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <form action="#" method="GET" wire:submit.prevent="search">
        @csrf

        <div class="block space-x-4 space-y-4">
            {{-- <x-jet-label for="search" value="{{ __('Buscar') }}" /> --}}
            <input class='cthulhu border-gray-300 focus:border-pink-300 focus:ring focus:ring-pink-300 focus:ring-opacity-50 rounded-md shadow-sm w-1/2' name="query" id="query" wire:model="query" type="search" placeholder="Buscar..." value="{{$query}}"/>
        </div>
    </form>
    @if ($mapas)
    <div class="block space-x-4 space-y-4 p-10 max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <p><h2 class="font-semibold text-xl text-gray-800 leading-tight">Mapas encontrados:</h2></p>
        @foreach($mapas as $mapa)
            <p><a href="{{ $mapa->url }}" target="_blank" rel="noreferrer noopener">{{ $mapa->nombre }}</a></p>
        @endforeach
    </div>
    @endif
    @if ($autores)
    <div class="block space-x-4 space-y-4 p-10 max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <p><h2 class="font-semibold text-xl text-gray-800 leading-tight">Autores/as encontrados:</h2></p>
        @foreach($autores as $autor)
            <p><a href="{{ $autor->url }}" target="_blank" rel="noreferrer noopener">{{ $autor->nombre }} {{ $autor->apellidos }}</a></p>
        @endforeach
    </div>
    @endif
    @if ($geos)
    <div class="block space-x-4 space-y-4 p-10 max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <p><h2 class="font-semibold text-xl text-gray-800 leading-tight">Localizaciones encontradas:</h2></p>
        @foreach($geos as $geo)
            <p>{{ $geo->nombre }}</p>
        @endforeach
    </div>
    @endif
</div>
